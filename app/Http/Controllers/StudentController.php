<?php

namespace App\Http\Controllers;
use App\module;
use App\User;
use App\users_patient;
use Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\patient;

class StudentController extends Controller
{
    public function index()
    {
        $modules = array();
        $message = '';
        $patients = patient::where('created_by', Auth::user()->id)->get();
        foreach($patients as $patient){;
            if($patient->module) {
                array_push($modules, $patient->module->module_name);
            } else{
                $message = 'There is no patient record associated with this student.';
            }
        }
        $modules = array_unique($modules);
       // var_dump($patients[0]->age);
        return view('student/studentHome', compact('patients', 'modules', 'message'));
    }

    public function edit(Request $request){
        $patient = patient::where('patient_id', $request['id'])->first();
        return view('/patient/edit_patient', compact('patient'));
    }
    public function view(Request $request){
        $patient = patient::where('patient_id', $request['patient_id'])->first();
        return view('/patient/view_patient', compact('patient'));
    }
    public function destroy(Request $request){
        $modules = array();
        $patient = patient::where('patient_id', $request['patient_id'])->update([
            'archived' => true
        ]);
        $patients = patient::where('created_by', Auth::user()->id)->get();
        foreach($patients as $patient){
            if($patient->module) {
                array_push($modules, $patient->module->module_name);
            }else{
                $message = 'There is no patient record associated with this student.';
            }
        }
        $modules = array_unique($modules);
        return view('student/studentHome', compact('patients', 'modules', 'message'));
    }
    public function store(Request $request){
        $modules = array();
        $message = '';
        $patient = patient::where('patient_id', $request['patient_id'])->update([
            'first_name' => $request['gender'] === 'Male' ? 'John' : 'Jane',
            'age' => $request['age'],
            'gender' => $request['gender'],
            'height' => $request['height'],
            'weight' => $request['weight']
        ]);
        $patients = patient::where('created_by', Auth::user()->id)->get();
        foreach($patients as $patient){
            if($patient->module) {
                array_push($modules, $patient->module->module_name);
            }else{
                $message = 'There is no patient record associated with this student.';
            }
        }
        $modules = array_unique($modules);
        return view('student/studentHome', compact('patients', 'modules', 'message'));
    }

        public function get_add_patient()
    {
           try {
            if (Auth::check()) {
                $modules = module::where('archived', 0)->get();
                return view('patient/add_patient', compact('modules'));
            }
        }
        catch (\Exception $e)
        {
            return view ('errors/503');
        }
    }
    public function post_add_patient(Request $request)
    {
        try {
//          Validating input data
            $this->validate($request, [
                'age' => 'required|numeric',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
                'visit_date' => 'required|date|date_format:Y-m-d|before:today',
            ]);

            $patient = new patient($request->all());
            $modules = array();
            $message = '';

            //Fetching last inserted patient_id to generate Patient name
            $last_patient = patient::max('patient_id');
            if ($last_patient == null)
                $append_number = 1;
            else
                $append_number = $last_patient + 1;

            //if sex is male then first name is John else Jane
            if ($request['gender'] == 'Male') {
                $patient['first_name'] = 'John';
            } else {
                $patient['first_name'] = 'Jane';
            }
            $patient['last_name'] = 'Doe' . $append_number;

            $patient['archived'] = 0;
            $patient['completed_flag'] = 0;
            $patient['height'] = $request['height'] . $request['height_unit'];
            $patient['weight'] = $request['weight'] . $request['weight_unit'];
            $patient['created_by'] = $request['user_id'];
            $patient['updated_by'] = $request['user_id'];

            $patient->save();

         //   $user_patient = new users_patient();
           // $user_patient->patient_record_status_id = 1;
           // $user_patient->patient_id = $patient->patient_id;
            //$user_patient->user_id = $request['user_id'];
            //$user_patient->created_by = $request['user_id'];
            //$user_patient->save();
            
            //Inserting record for admin
            DB::table('users_patient')->insert(
                array(
                    'patient_record_status_id' => 1,
                    'patient_id' => $patient->patient_id,
                    'user_id' => $request['user_id'],
                    'created_by' =>  $request['user_id'],
                    'updated_by' =>  $request['user_id']
                    )
            );

             //Now redirecting student to the same page.
            $modules = module::where('archived', 0)->get();
            return view('patient/add_patient', compact('modules'));
           }
        catch (\Exception $e)
        {
          return view ('errors/503');
        }

    }
}
