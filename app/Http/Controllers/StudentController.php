<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
         $patients = DB::table('users')->where('role','Student')->get();
         //$instructors = DB::table('users')->where('role','Instructor')->get();
        return view('student/studentHome',compact('patients'));
    }
}
