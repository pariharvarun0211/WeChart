<?php

namespace App\Http\Controllers;
use App\module;
use App\User;
use App\users_patient;
use App\module_navigation;
use App\navigation;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\patient;

class StudentController extends Controller
{
    public function index()
    {
        //Only Student can access Student Dashboard
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {

            $modules = array();
            $saved_message = '';
            $submitted_message = '';
            $saved_patients = patient::where('created_by', Auth::user()->id)
                ->where('completed_flag',false)
                ->get();
            $submitted_patients = patient::where('created_by', Auth::user()->id)
                ->where('completed_flag',true)
                ->get();

            if(!empty($saved_patients)) {
                foreach ($saved_patients as $patient) {
                    if ($patient->module) {
                        array_push($modules, $patient->module->module_name);
                    } else {
                        $saved_message = 'There are no saved patients associated with this student.';
                    }
                }
            }
            else {
                $saved_message = 'There are no saved patients associated with this student.';
            }

            if($submitted_patients == null) {
                foreach ($submitted_patients as $patient) {
                    if ($patient->module) {
                        array_push($modules, $patient->module->module_name);
                    } else {
                        $submitted_message = 'There are no saved patients associated with this student.';
                    }
                }
            }
            else {
                $submitted_message = 'There are no saved patients associated with this student.';
            }

            $modules = array_unique($modules);
            return view('student/studentHome', compact('saved_patients', 'modules', 'saved_message','submitted_patients','submitted_message'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function view_patient(Request $request){
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            return redirect()->route('Demographics',[$request['patient_id']]);
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function destroy(Request $request){
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            $modules = array();
            $patient = patient::where('patient_id', $request['patient_id'])->update([
                'archived' => true
            ]);
            $patients = patient::where('created_by', Auth::user()->id)->get();
            foreach ($patients as $patient) {
                if ($patient->module) {
                    array_push($modules, $patient->module->module_name);
                } else {
                    $message = 'There is no patient record associated with this student.';
                }
            }
            $modules = array_unique($modules);
            return view('student/studentHome', compact('patients', 'modules', 'message'));
        }
        else
        {
            return view('auth/login');
        }
    }
    public function get_add_patient()
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }
        if($role == 'Student') {
            try {
                    $modules = module::where('archived', 0)->get();
                    return view('patient/add_patient', compact('modules'));

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function post_add_patient(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {

               //Validating input data
                $this->validate($request, [
                    'age' => 'required|numeric',
                    'height' => 'required|numeric',
                    'weight' => 'required|numeric',
                    'room_number' => 'required',
                    'visit_date' => 'required|date|date_format:Y-m-d|before:today',
                ]);

                $patient = new patient($request->all());

                //Fetching last inserted patient_id to generate Patient name
                $last_patient = patient::max('patient_id');
                if ($last_patient == null)
                    $append_number = 1;
                else
                    $append_number = $last_patient + 1;

                //if sex is male then first name is John else Jane
                $patient['first_name'] = $request['gender'] === 'Male' ? 'John' : 'Jane';
                $patient['last_name'] = 'Doe' . $append_number;
                $patient['archived'] = false;
                $patient['completed_flag'] = false;
                $patient['module_id'] = $request['module_id'];
                $patient['height'] = $request['height'] ." ". $request['height_unit'];
                $patient['weight'] = $request['weight'] ." ". $request['weight_unit'];
                $patient['room_number'] = $request['room_number'];
                $patient['created_by'] = $request['user_id'];
                $patient['updated_by'] = $request['user_id'];

                $patient->save();

                //Inserting record for admin
                DB::table('users_patient')->insert(
                    array(
                        'patient_record_status_id' => 1,
                        'patient_id' => $patient->patient_id,
                        'user_id' => $request['user_id'],
                        'created_by' => $request['user_id'],
                        'updated_by' => $request['user_id']
                    )
                );

                //Now redirecting student to active record page.
                return redirect()->route('Demographics',[$patient->patient_id]);
        }
        else
        {
            return view('auth/not_authorized');
        }

    }
}
