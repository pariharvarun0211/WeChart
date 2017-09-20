<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {  
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fetching all students and instructors for admin
         $students = DB::table('users')->where('role','Student')->get();
         $instructors = DB::table('users')->where('role','Instructor')->get();
         return view('Admin/home', compact('students','instructors'));
    }
    public function getStudentEmails()
    {
        $counter = 1;
        session()->put('counter', 1);
        return view('Admin/AddStudentEmails', compact('counter'));
    }
    public function postStudentEmails(Request $request)
    {
        try {
                $counter = session()->get('counter');

                // for ($i = 0; $i < $counter; $i++)
                // {
                    $messages = ['unique' => 'This email id is already present in the database.'];
                    $this->validate($request, [
                    'email' => 'required|unique:EmailIdRole',
                    ],$messages);

                    DB::table('EmailIdRole')->insert(
                        ['email' => $request->email, 'role' => 'Student']
                        // ['email' => $request->email[$i], 'role' => 'Student']
                    );                      
                // } 
                $counter = session()->get('counter');
                $EmailSubmitted =  'Yes';   
                return view('Admin/AddStudentEmails',compact('EmailSubmitted','counter'));
            }
         catch (\Illuminate\Database\QueryException $e)
        {
            return view ('errors/503');
        }
    }
    public function addStudentEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter + 1;
        session()->put('counter', $counter);
        return view('Admin/AddStudentEmails',compact('counter'));

    }
    public function removeStudentEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter - 1;
        session()->put('counter', $counter);        
        return view('Admin/AddStudentEmails',compact('counter'));

    }
     public function getInstructorEmails()
    {
        $counter = 1;
        session()->put('counter', 1);
        return view('Admin/AddInstructorEmails', compact('counter'));
    }
    public function postInstructorEmails(Request $request)
    {
        try {
                $counter = session()->get('counter');
                // $email = $request->input('email');

                // for ($i = 0; $i < $counter; $i++)
                // {
                    $messages = ['unique' => 'This email id is already present in the database.'];
                    $this->validate($request, [
                    'email' => 'required|unique:EmailIdRole',
                    ],$messages);

                    DB::table('EmailIdRole')->insert(
                        ['email' => $request->email, 'role' => 'Instructor']
                        // ['email' => $request->email[$i], 'role' => 'Student']
                    );                      
                // } 
                $counter = session()->get('counter');
                $EmailSubmitted =  'Yes';   
                return view('Admin/AddInstructorEmails',compact('EmailSubmitted','counter'));
            }
         catch (\Illuminate\Database\QueryException $e)
        {
            return view ('errors/503');
        }
    }
    public function addInstructorEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter + 1;
        session()->put('counter', $counter);
        return view('Admin/AddInstructorEmails',compact('counter'));
    }
    public function removeInstructorEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter - 1;
        session()->put('counter', $counter);        
        return view('Admin/AddInstructorEmails',compact('counter'));
    }
}
