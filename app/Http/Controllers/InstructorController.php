<?php
namespace App\Http\Controllers;
use App\users_patient;
use App\module;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class InstructorController extends Controller
{
    public function index()
    {
        //Only Instructor can access Instructor Dashboard
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }
        if($role == 'Instructor') {
            $modules_for_review = array();
            $modules_reviewed = array();
            $for_review_message = '';
            $reviewed_message = '';
            $for_review_patients = users_patient::where('user_id', Auth::user()->id)
                ->where('patient_record_status_id', 2)
                ->get();
            $reviewed_patients = users_patient::where('user_id', Auth::user()->id)
                ->where('patient_record_status_id', 3)
                ->get();

            if(!empty($for_review_patients)) {
                foreach ($for_review_patients as $for_review_patient) {
                    if (count($for_review_patient->patient->module)> 0) {
                        array_push($modules_for_review, $for_review_patient->patient->module->module_name);
                    } else {
                        $for_review_message = 'There are no patients for review.';
                    }
                }
            }
            else {
                $for_review_message = 'There are no patients for review.';
            }
            if(!empty($reviewed_patients)) {
                foreach ($reviewed_patients as $reviewed_patient) {
                    if (count($reviewed_patient->patient->module)>0) {
                        array_push($modules_reviewed, $reviewed_patient->patient->module->module_name);
                    } else {
                        $reviewed_message = 'There are no reviewed patients.';
                    }
                }
            }
            else {
                $reviewed_message = 'There are no reviewed patients.';
            }
            $modules_for_review = array_unique($modules_for_review);
            $modules_reviewed = array_unique($modules_reviewed);
            Log::info($for_review_patients);
            return view('instructor/instructorHome', compact('for_review_patients','modules_for_review', 'modules_reviewed', 'for_review_message', 'reviewed_patients', 'reviewed_message'));
        }
        else
        {
            $error_message= "You are not authorized to view this page";
            return view('auth/not_authorized',compact($error_message));
        }
    }
}