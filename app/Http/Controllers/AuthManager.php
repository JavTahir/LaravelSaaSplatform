<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mail;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\Connections;



class AuthManager extends Controller
{
    function login(){

        if (Auth::check()){
            return redirect()->intended(route('dashboard'));


        }
        return view('login');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
    
        $credentials = $request->only('email','password');
    
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            // $linkedinAccount = $user->linkedin;
            if ($user->profile_completed) {
                if($user->social_accounts > 0){
                    $twitterAccount = $user->twitter;
                    $lixAccount = $user->lix;
                    
                    if($twitterAccount){
                        $twitterUser = Socialite::driver('twitter')->userFromTokenAndSecret(
                            $user->twitter->twitter_access_token,
                            $user->twitter->twitter_token_secret
                        );
                        $followersCount = $twitterUser->user['followers_count'];
                        $friendsCount  = $twitterUser->user['friends_count'];
                        $statusesCount  = $twitterUser->user['statuses_count'];
            
            
                        $existingRecord = $user->twitter->followers()
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
                            $user->twitter->followers()->create([
                                'followers_count' => $followersCount,
                                'friends_count' => $friendsCount,
                                'statuses_count' => $statusesCount,
                                'record_date' => now()->toDateString(),
                            ]);
                        }
        
                    }

                    if($lixAccount){
                        $apiKey = $lixAccount->lix_api_key;
                        $viewerId = $lixAccount->linkedin_viewer_id;


                        // $linkedin_connections = Connections::getConnections($apiKey, $viewerId);
                        // dd($linkedin_connections);
            
            
                        $existingRecord = $user->linkedin->connections()
                        ->where('record_date', now()->toDateString())
                        ->first();
            

                        if ($existingRecord) {
                            // Update the existing record
                            $existingRecord->update([
                                'connections_count' => 300,
                            ]);
                        } else {
                            // Create a new record
                            $user->linkedin->connections()->create([
                                'connections_count' => 500,
                                'record_date' => now()->toDateString(),
                            ]);
                        }
        
                    }

                    return redirect()->intended(route('dashboard'));
                }
                return view('addaccounts', [
                    'linkedinAccount' => $linkedinAccount,
                    'twitterAccount' => $twitterAccount,
                ]);
                
                
            } else {
                return view('profile', ['user' => $user]);
            }
        }
    
        return redirect()->intended(route('login'))->with("error","Login not valid!");
    }
    
    function signupPost(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        

        $user = User::create($data);
        if(!$user){
            return redirect()->intended(route('signup'))->with("error","User not created!");

        }

        return redirect("/verification/".$user->id);
    }


    public function sendOtp($user)
    {
        $otp = rand(100000,999999);
        // dd($otp);
        $time = time();

        EmailVerification::updateOrCreate(
            ['email' => $user->email],
            [
            'email' => $user->email,
            'otp' => $otp,
            'created_at' => $time
            ]
        );

        $data['email'] = $user->email;
        $data['title'] = 'Mail Verification';

        $data['body'] = 'Your OTP is:- '.$otp;

        Mail::send('mailVerification',['data'=>$data],function($message) use ($data){
            $message->to($data['email'])->subject($data['title']);
        });
    }


    public function verification($id)
    {
        $user = User::where('id',$id)->first();
        if(!$user || $user->is_verified == 1){
            return redirect('/login');
        }
        $email = $user->email;

        $this->sendOtp($user);//OTP SEND

        return view('otpverify',compact('email'));
    }

    
    
    public function verifiedOtp(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $otpData = EmailVerification::where('otp',$request->otp)->first();
        if(!$otpData){
            return response()->json(['success' => false,'msg'=> 'You entered wrong OTP']);
        }
        else{

            $currentTime = time();
            $time = $otpData->created_at;

            if($currentTime >= $time && $time >= $currentTime - (90+5)){//90 seconds
                User::where('id',$user->id)->update([
                    'is_verified' => 1
                ]);
                return response()->json(['success' => true,'msg'=> 'Mail has been verified']);
            }
            else{
                return response()->json(['success' => false,'msg'=> 'Your OTP has been Expired']);
            }

        }
    }


    public function resendOtp(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $otpData = EmailVerification::where('email',$request->email)->first();

        $currentTime = time();
        $time = $otpData->created_at;

        if($currentTime >= $time && $time >= $currentTime - (90+5)){//90 seconds
            return response()->json(['success' => false,'msg'=> 'Please try after some time']);
        }
        else{

            $this->sendOtp($user);//OTP SEND
            return response()->json(['success' => true,'msg'=> 'OTP has been sent']);
        }

    }




    function logout(){
        Session::flush();
        Auth::logout();

        return redirect()->intended(route('login'));

    }

    function signup(){
        return view('registration');
    }


}
