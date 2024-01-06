<?php

namespace App\Http\Controllers;

use App\Models\Admin; // Make sure to import the User model
use App\Models\User; // Make sure to import the User model
use App\Models\Linkedin;
use App\Models\Twitter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        // Retrieve admin from the database based on the email
        $admin = Admin::where('email', $credentials['email'])->first();

        // Check if the admin exists and the password is correct
        if ($admin && $admin->password===$request->password) {
          
            // Store admin data in the session
            Session::put('admin', $admin);

            return redirect('/dashboardadm');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function dashboard(){
        return view('dashboard_admin');
    }


    public function logout()
    {
        // Remove admin data from the session
        Session::forget('admin');
        
        return redirect('/adm-login');
    }

    public function allusers()
    {
        $users = User::all(); // Retrieve all users from the 'users' table

        return view('users', ['users' => $users]);
    }

    public function destroy(User $user)
    {
    $user->delete();

    return redirect()->route('users')->with('success', 'User deleted successfully.');
    }


    
    
    
    public function viewUser($userid)
{
    $user = User::where('id', $userid)->first();
    $userLd = Linkedin::where('user_id', $userid)->first();
    $userTw = Twitter::where('user_id', $userid)->first();

    $data = [];

    if (($userLd) && ($userTw)) {
        // User has a LinkedIn account
        $data['linkedin_name'] = $userLd->linkedin_name;
        $data['linkedin_avatar'] = $userLd->linkedin_avatar;
        $data1['twitter_uname'] = $userTw->twitter_uname;
        $data1['twitter_avatar'] = $userTw->twitter_avatar;
        return view('viewuser', [
            'users' => $user,
            'userDataL' => $data,
            'userDataT' => $data1 , // Pass the combined data to the view
        ]);
        
    }

    elseif ($userLd) {
        $data['linkedin_name'] = $userLd->linkedin_name;
        $data['linkedin_avatar'] = $userLd->linkedin_avatar;
        return view('viewuser', [
            'users' => $user,
            'userDataL' => $data,
           
        ]);
        
    }
    elseif ($userTw){
        $data1['twitter_uname'] = $userTw->twitter_uname;
        $data1['twitter_avatar'] = $userTw->twitter_avatar;
        return view('viewuser', [
            'users' => $user,
            'userDataT' => $data1 
           
        ]);
    }

    return view('viewuser', [
        'users' => $user,
        'userDataT' => [],
        'userDataL' => [] 

        
       
    ]);

}



public function viewProfile($userid)
{
    
    $user = User::where('id', $userid)->first();
    $userLd = Linkedin::where('user_id', $userid)->first();
    $userTw = Twitter::where('user_id', $userid)->first();

    $data = [];

    if (($userLd) && ($userTw)) {
        // User has a LinkedIn account
        $data['linkedin_name'] = $userLd->linkedin_name;
        $data['linkedin_avatar'] = $userLd->linkedin_avatar;
        $data1['twitter_uname'] = $userTw->twitter_uname;
        $data1['twitter_avatar'] = $userTw->twitter_avatar;
        return view('userView', [
            'users' => $user,
            'userDataL' => $data,
            'userDataT' => $data1 , // Pass the combined data to the view
        ]);
        
    }

    elseif ($userLd) {
        $data['linkedin_name'] = $userLd->linkedin_name;
        $data['linkedin_avatar'] = $userLd->linkedin_avatar;
        return view('userView', [
            'users' => $user,
            'userDataL' => $data,
           
        ]);
        
    }
    elseif ($userTw){
        $data1['twitter_uname'] = $userTw->twitter_uname;
        $data1['twitter_avatar'] = $userTw->twitter_avatar;
        return view('userView', [
            'users' => $user,
            'userDataT' => $data1 
           
        ]);
    }

    return view('userView', [
        'users' => $user,
        'userDataT' => [],
        'userDataL' => [] 

        
       
    ]);
    

}


// UsersController.php

public function index(Request $request)
{
    $search = $request->input('search', ''); // Set a default value if not provided


    $users = User::query();

    if ($search) {
        $users->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
                 
        });
    }

    $users = $users->get();

    return view('users', compact('users', 'search'));
}


public function search($term){
      
    $user = User::where('first_name', 'like', "$term%")->get();
    

    return $user;

}


public function searchUser(Request $request)
{
    $search = $request->input('search');

    // Perform the search query on the User model
    $users = User::where('first_name', 'LIKE', "%$search%")
                  ->orWhere('last_name', 'LIKE', "%$search%")
                  ->get();

    return view('users')->with('users', $users);
}






}
