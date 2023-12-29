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
            'contactNo' => 'required|digits:10',
            'dob' => 'required|date',
            'country' => 'required|alpha',
            'city' => 'required|alpha',
            'profilePic' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        // Handle image upload
        $profilePicPath = null;
       
        if ($request->hasFile('fileInput')) {
            $profilePic = $request->file('fileInput');
            $profilePicPath = $profilePic->store('uploads', 'public');
            $profilePicType = $profilePic->getClientOriginalExtension();
            $profilePicpathstr = substr($profilePicPath, strlen('uploads/'));

            $profilePicPath = $profilePicpathstr;
        }

        // Update user data
        $user = Auth::user();
        $profilecomplete=1;
        $user->update([
            'first_name' => $request->input('fname'),
            'last_name' => $request->input('lname'),
            'phone' => $request->input('contactNo'),
            'dob' => $request->input('dob'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'image_path' => $profilePicPath,
            'profile_completed'=>$profilecomplete,
        ]);

        toast('Profile updated successfully!','success')->width('400px');;
        return redirect()->route('addaccounts');
    }

    public function update(){
        $userid=Auth::user()->id;
        $user = User::find($userid);

       
        if ($user) {
            // If found, return the view with the user data
            return view('updateprofile', ['user' => $user]);
       
        }
    }



    public function saveChanges(Request $request)
    {
        // Validate the form data
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'contactNo' => 'required|digits:10',
            'dob' => 'required|date',
            'country' => 'required|alpha',
            'city' => 'required|alpha',
            'profilePic' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        // Handle image upload
   
        $user = Auth::user();
       
        if ($request->hasFile('fileInput')) {
            $profilePic = $request->file('fileInput');
            $profilePicPath = $profilePic->store('uploads', 'public');
            $profilePicType = $profilePic->getClientOriginalExtension();
            $profilePicpathstr = substr($profilePicPath, strlen('uploads/'));

            $profilePicPath = $profilePicpathstr;

            $user->update([
                'first_name' => $request->input('fname'),
                'last_name' => $request->input('lname'),
                'phone' => $request->input('contactNo'),
                'dob' => $request->input('dob'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'image_path' => $profilePicPath,
           
            ]);
        }

        $user->update([
            'first_name' => $request->input('fname'),
            'last_name' => $request->input('lname'),
            'phone' => $request->input('contactNo'),
            'dob' => $request->input('dob'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
    
        ]);

        return redirect()->route('dashboard');
    }


    public function planLimit(Request $request)
    {
       
        $selectedPlan = $request->input('selectedPlan');
        $planLimit =0;
        $planName="";
        $planDate="";
        

        // Set plan limit based on the selected plan
        switch ($selectedPlan) {
            case 'option1':
                // Set plan limit for option1 (Bronze)
                $planLimit = 5;
                $planName="Basic";
                $planDate = now()->format('Y-m-d');

                
                break;
            case 'option2':
                // Set plan limit for option2 (Gold)
                $planLimit = 15;
                $planName="Gold";
                $planDate = now()->format('Y-m-d');
                break;
            case 'option3':
                // Set plan limit for option3 (Platinum)
                $planLimit = -1;
                $planName="Platinum";
                $planDate = now()->format('Y-m-d'); 
                break;
            default:
                // Handle default case or validation errors
                return redirect()->back()->with('error', 'Invalid selected plan');
        }

        $userid=Auth::user()->id;
        $user = User::find($userid);
        $user->plan_limit= $planLimit;
        $user->plan_name=$planName;
        $user->plan_date=$planDate;
        $user->last_renewal_date=$planDate;
        $user->save();
        

        // Optionally, you can redirect the user or return a response
        return redirect()->route('dashboard')->with('success', 'Plan purchased successfully');
    }


    public function decrementPlanLimit(Request $request)
    {
        $user = Auth::user();
        

        // Check if the user has a valid plan and plan_limit
       
                // Decrement the plan_limit by 1
                $user->decrement('plan_limit', 1);

            
    
            // Return a JSON response indicating that the user doesn't have a valid plan or plan_limit
            return response()->json(['success' => true, 'plan_limit' => $user->plan_limit]);
        
    }
}
