<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        // Validate the form data
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'contactNo' => 'required|digits:10',
            'dob' => 'required|date',
            'country' => 'required|alpha',
            'city' => 'required|alpha',
            'password' => 'required|min:8',
            'profilePic' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        // Handle image upload
        $profilePicPath = null;
       
        if ($request->hasFile('fileInput')) {
            $profilePic = $request->file('fileInput');
            $profilePicPath = $profilePic->store('uploads', 'public'); // Save the image to storage
        }

        // Update user data
        $user = Auth::user();
        $profilecomplete=1;
        $user->update([
            'first_name' => $request->input('fname'),
            'last_name' => $request->input('lname'),
            'email' => $request->input('email'),
            'phone' => $request->input('contactNo'),
            'dob' => $request->input('dob'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'password' => bcrypt($request->input('password')),
            'image_path' => $profilePicPath,
            'profile_completed'=>$profilecomplete,
        ]);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}
