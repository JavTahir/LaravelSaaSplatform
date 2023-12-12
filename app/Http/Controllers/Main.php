<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

