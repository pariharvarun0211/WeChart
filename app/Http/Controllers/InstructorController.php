<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        // $students = DB::table('users')->where('role','Student')->get();
         //$instructors = DB::table('users')->where('role','Instructor')->get();
        return view('Instructor/Instructor_Home');
         //return view('Admin/home', compact('students','instructors'));
    }
}
