<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social_accounts;
use Laravel\Socialite\Facades\Socialite; // Fix the namespace here
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

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
        dd($user);
        $data=User::where('email',$user->nickname)->first();

        if(is_null($data)){

            $userData['name'] = $user->name;
            $userData['email'] = $user->nickname;
            // $userData['pass']

            $data = User::create($userData);


        }

        Auth::login($data);

        return redirect()->route('dashboard');

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
        Session::put('linkedin_token', $user->token);

        // dd($user);
        $data=User::where('linkedin_id',$user->id)->first();

        if(is_null($data)){

            $userData['name'] = $user->name;
            $userData['email'] = $user->email;
            $userData['linkedin_id'] = $user->id;

            // $userData['id'] = $user->id;
            
            // $userData['pass']

            $data = User::create($userData);


        }

        Auth::login($data);

        return redirect()->route('dashboard');

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
