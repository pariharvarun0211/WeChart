<?php

namespace App\Http\Controllers;
use App\module;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\patient;

class StudentController extends Controller
{
    public function index()
    {
//         $patients = DB::table('users')->where('role','Student')->get();
         //$instructors = DB::table('users')->where('role','Instructor')->get();
        return view('student/studentHome');
    }
    public function get_add_patient()
    {
        $modules = module::where('archived',0)->get();
        $append_number='';
        return view('patient/add_patient',compact('modules','append_number'));
    }
    public function post_add_patient(Request $request)
    {
        $patient = new patient($request->all());

        //Fetching last inserted patient_id to generate Patient name
        $last_patient = patient::max('patient_id');
        if($last_patient == null)
            $append_number = 1;
        else
            $append_number = $last_patient + 1;

        //if sex is male then first name is John else Jane
        if($request['sex'] == 'Male') {
            $patient['first_name'] = 'John';
        }
        else
        {
            $patient['first_name'] = 'Jane';
        }
        $patient['last_name'] = 'Doe'.$append_number;

        $patient['is_archived'] = 0;
        $patient['patient_record_status_id'] = 1;

        $patient->save();
        $modules = module::where('archived',0)->get();
        return view('patient/add_patient','modules','append_number');

    }
}
