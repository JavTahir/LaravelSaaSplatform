<?php

namespace App\Http\Controllers;

use App\Models\User; // Make sure to import the User model

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
}
