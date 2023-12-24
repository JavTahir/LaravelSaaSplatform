<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite; // Fix the namespace here
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use App\Models\Social;
use App\Models\Linkedin;
use App\Models\Twitter;
use App\Models\User;







class SocialController extends Controller
{
    public function  facebookRedirect(){
        return Socialite::driver('facebook')->redirect();
    }

   

    public function facebookCallback(){
        $user = Socialite::driver('facebook')->user();
        $this->createOrUpdateUser($user,'facebook');
        return redirect()->route('dashboard');
    }

    private function createOrUpdateUser($data, $provider){
        $user=Social_account::where('email',$data->email)->first();

        if($user){
            $user->update([
                'provider'=>$provider,
                'provider_id'=>$data->id,
            ]);
        }
        else{
           $user=Social_account::create([
            'name'=>$data->name,
            'email'=>$data->email,
            'avatar'=>$data->avatar,
            'provider'=>$provider,
            'provider_id'=>$data->id
           ]);
        }

       

    }

    public function  twitterRedirect(){
        return Socialite::driver('twitter')->redirect();
    }

   

    public function twitterCallback(){
        $user = Socialite::driver('twitter')->user();
        // dd($user);

        // Session::put('twitter_token', $user->tokenSecret);
        // Session::put('twitter_accesstoken', $user->token);


        $user_id=Auth::user()->id;

        // dd($user_id);
        $data=Twitter::where('twitter_id',$user->id)->first();

        if(is_null($data)){

            $userData['twitter_name'] = $user->name;
            $userData['twitter_email'] = $user->email;
            $userData['twitter_id'] = $user->id;
            $userData['twitter_uname'] = $user->nickname;
            $userData['twitter_avatar'] = $user->avatar;
            $userData['user_id'] =  $user_id;
            $userData['twitter_access_token'] =  $user->token;
            $userData['twitter_token_secret'] =  $user->tokenSecret;

            // $userData['pass']
            $data = Twitter::create($userData);
            Auth::user()->increment('social_accounts', 1);

            $followersCount = $user->user['followers_count'];
            $friendsCount  = $user->user['friends_count'];
            $statusesCount  = $user->user['statuses_count'];


            $existingRecord = Auth::user()->twitter->followers()
            ->where('record_date', now()->toDateString())
            ->first();

            if ($existingRecord) {
                // Update the existing record
                $existingRecord->update([
                    'followers_count' => $followersCount,
                    'friends_count' => $friendsCount,
                    'statuses_count' => $statusesCount,
                ]);
            } else {
                // Create a new record
                Auth::user()->twitter->followers()->create([
                    'followers_count' => $followersCount,
                    'friends_count' => $friendsCount,
                    'statuses_count' => $statusesCount,
                    'record_date' => now()->toDateString(),
                ]);
            }




        }

        $linkedinAccount = Auth::user()->linkedin;
        $twitterAccount = Auth::user()->twitter;
        return view('addaccounts', [
            'linkedinAccount' => $linkedinAccount,
            'twitterAccount' => $twitterAccount,
        ]);
        // dd($user);
        // // $this->createOrUpdateUser($user,'twitter');
        // // return redirect()->route('dashboard');
    }



    public function  linkedinRedirect(){
        // return Socialite::driver('linkedin-openid')->redirect();
        return Socialite::driver('linkedin-openid')->scopes(['profile', 'w_member_social'])->redirect();



    }

   

    public function linkedinCallback(){
        


        $user = Socialite::driver('linkedin-openid')->stateless()->user();
        $user_id=Auth::user()->id;

        //dd($user_id);
        $data=Linkedin::where('linkedin_id',$user->id)->first();

        if(is_null($data)){

            $userData['linkedin_name'] = $user->name;
            $userData['linkedin_email'] = $user->email;
            $userData['linkedin_id'] = $user->id;
            $userData['linkedin_uname'] = $user->nickname;
            $userData['linkedin_avatar'] = $user->avatar;
            $userData['user_id'] =  $user_id;
            $userData['linkedin_access_token'] =  $user->token;




            // $userData['id'] = $user->id;
            
            // $userData['pass']

            $data = Linkedin::create($userData);
            

            // dd(Auth::user()->social_accounts);
            Auth::user()->increment('social_accounts', 1);




            // $social_accounts = $user->social_accounts;
            // $user->update([
            //     'social_accounts' => $social_accounts + 1,
            // ]);


        }

        // Auth::login($data);
        
        $linkedinAccount = Auth::user()->linkedin;
        $twitterAccount = Auth::user()->twitter;

        return view('addaccounts', [
            'linkedinAccount' => $linkedinAccount,
            'twitterAccount' => $twitterAccount,
        ]);


        // dd($user);
        // // $this->createOrUpdateUser($user,'twitter');
        // // return redirect()->route('dashboard');


        
    }


    public function postToLinkedIn(Request $request)
    {

                // Validate the request data
        $request->validate([
            'content' => 'required|string',
        ]);

        // Extract data from the request
        $content = $request->input('content');

        // Get the authenticated user
        $user = Auth::user();
        // dd($user);




        // Get the LinkedIn access token from the authenticated user
        $accessToken = request()->session()->get('linkedin_token');

        // Prepare the post data
        $postData = [
            'author' => 'urn:li:person:' . $user->linkedin_id,
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => $content,
                    ],
                    'shareMediaCategory' => 'NONE',
                ],
            ],
            'visibility' => [
                'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
            ],
        ];

        

        // Make a POST request to the LinkedIn API
        $client = new Client();
        $response = $client->post('https://api.linkedin.com/v2/ugcPosts', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            
            'json' => $postData,
        ]);

        // Handle the response as needed
        $statusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody(), true);

        if ($statusCode == 201) {
            // Successfully posted to LinkedIn
            return redirect()->back()->with('success', 'Post successfully shared on LinkedIn!');
        } else {
            // Handle errors
            return redirect()->back()->with('error', 'Failed to post on LinkedIn. Check the LinkedIn API response for details.');
        }
    }

    public function showPostForm()
    {
        return view('post-form');
    }



}
