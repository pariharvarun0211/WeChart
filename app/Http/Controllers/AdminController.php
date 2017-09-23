<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\EmailidRole;

class AdminController extends Controller
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
        //Fetching all students and instructors for display on admin landing page

         $students = User::where('role','Student')->get();
         $instructors = User::where('role','Instructor')->get();
         return view('Admin/home', compact('students','instructors'));
    }
    public function getStudentEmails()
    {
        $counter = 1;
        session()->put('counter', 1);
        $Error = '';
        return view('Admin/addStudentEmails', compact('Error','counter'));
    }
    public function postStudentEmails(Request $request)
    {
        try {
                $counter = session()->get('counter');

                //Removing Duplicates
                $request['email'] = array_unique($request['email']);

            for ($i = 0; $i < count($request['email']) ; ++$i)
                 {
                    $EmailIdRole = new EmailidRole;
                    $EmailIdRole['email'] = $request['email'][$i];
                    $EmailIdRole['role'] = 'Student';
                    $EmailIdRole->save();
                 }
                $Error = 'No';
                return view('Admin/addStudentEmails',compact('Error','counter'));
            }
        catch (\Exception $e)
        {
            //Checking if its UNIQUE constraint violation
            if(in_array('23000',$e->errorInfo)) {
                $Error = 'Email Present';
                return view('Admin/addStudentEmails',compact('Error','counter'));
            }
            return view ('errors/503');
        }
    }
    public function addStudentEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter + 1;
        session()->put('counter', $counter);
        $Error = '';
        return view('Admin/addStudentEmails',compact('Error','counter'));

    }
    public function removeStudentEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter - 1;
        session()->put('counter', $counter);
        $Error = '';
        return view('Admin/addStudentEmails',compact('Error','counter'));

    }
     public function getInstructorEmails()
    {
        $counter = 1;
        session()->put('counter', 1);
        $Error = '';
        return view('Admin/addInstructorEmails', compact('Error','counter'));
    }
    public function postInstructorEmails(Request $request)
    {
        try {
                $counter = session()->get('counter');

                //Removing Duplicates
                $request['email'] = array_unique($request['email']);

                 for ($i = 0; $i < $counter; $i++)
                 {
                     $EmailIdRole = new EmailidRole;
                     $EmailIdRole['email'] = $request['email'][$i];
                     $EmailIdRole['role'] = 'Instructor';
                     $EmailIdRole->save();
                 }
                $counter = session()->get('counter');
                $Error = 'No';
                return view('Admin/addInstructorEmails',compact('Error','counter'));
            }
        catch (\Exception $e)
        {
            //Checking if its UNIQUE constraint violation
            if(in_array('23000',$e->errorInfo)) {
                $Error = 'Email Present';
                return view('Admin/addInstructorEmails',compact('Error','counter'));
            }
            return view ('errors/503');
        }
    }
    public function addInstructorEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter + 1;
        session()->put('counter', $counter);
        $Error = '';
        return view('Admin/addInstructorEmails',compact('Error','counter'));
    }
    public function removeInstructorEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter - 1;
        session()->put('counter', $counter);
        $Error = '';
        return view('Admin/addInstructorEmails',compact('Error','counter'));
    }
     public function getManageEmails()
        {
        //Fetching all students and instructors emails for admin

         $studentEmails = EmailidRole::where('role','Student')->get();
         $instructorEmails = EmailidRole::where('role','Instructor')->get();

         return view('Admin/manageEmails', compact('studentEmails','instructorEmails'));
        }
}
