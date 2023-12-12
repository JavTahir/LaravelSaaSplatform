<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social_accounts;
use Laravel\Socialite\Facades\Socialite; // Fix the namespace here
use Illuminate\Support\Facades\Auth;

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
}
