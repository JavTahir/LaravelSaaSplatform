<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social_accounts;
use Laravel\Socialite\Facades\Socialite; // Fix the namespace here
use Illuminate\Support\Facades\Auth;

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
        return Socialite::driver('linkedin-openid')->redirect();


    }

   

    public function linkedinCallback(Request $request){
        // dd($request->all());


        $user = Socialite::driver('linkedin-openid')->user();
        //  dd($user);
        $data=User::where('email',$user->email)->first();

        if(is_null($data)){

            $userData['name'] = $user->name;
            $userData['email'] = $user->email;
            // $userData['pass']

            $data = User::create($userData);


        }

        Auth::login($data);

        return redirect()->route('dashboard');

        // dd($user);
        // // $this->createOrUpdateUser($user,'twitter');
        // // return redirect()->route('dashboard');


        
    }



}
