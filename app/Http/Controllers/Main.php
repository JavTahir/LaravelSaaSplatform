<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class Main extends Controller
{
    public function  addaccounts(){
        return view('addaccounts');
    }

    
    
    public function  addpages(){
        return view('addpages');
    }

    public function show(Request $request)
    {
        // Retrieve and decode the data from the URL
        $data = json_decode(urldecode($request->query('data')), true);

        // Pass the data to the view
        return view('pagesadded', ['data' => $data]);
    }

    

    public function students () {
        $students=[
            ['name'=>'Muhammad Ali', 'Email'=>'ali@gmail.com', 'CNIC' => 1234],
            ['name'=>'Muhammad Usman', 'Email'=>'usman@gmail.com', 'CNIC' => 
            1234], ['name'=>'Muhammad Arslan', 'Email'=>'arslan@gmail.com',
            'CNIC' => 1234]
            ];
            return view('students', ['students' => $students]);

        }


        public function store(Request $request){

            $user = new Admin;
            $user->name = $request->input('username');
            $user->password =$request->input('password');
            $user->save();
    
           
            return redirect('/admin-login');
    
        }

        public function login(Request $request){

            $name = $request->input('username');
            $admin = Admin::find(4);

            

            if (!$admin) {
                // Handle the case where admin is not found
                return redirect()->back()->with('error', 'Admin not found');
            }

            if($admin->password=="134"){
                return redirect('/dashboardadm');

            }


            
    
        }


        public function delete(Request $request){

            $id = $request->input('id');

            $user = User::find($id);
            if($user){
                $user->delete();
                return "User with $id deleted!!";
            }
            else{
                return "user not found";
            }
    
           
            
    
        }
}

