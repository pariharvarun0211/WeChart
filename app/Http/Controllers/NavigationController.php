<?php

namespace App\Http\Controllers;
use App\active_record;
use App\module;
use App\User;
use App\users_patient;
use App\module_navigation;
use App\navigation;
use Illuminate\Support\Facades\Log;
use Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\patient;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Stmt\Switch_;

class family_member
{
    public $relation;
    public $status;
    public $diagnosis=[];
}

class vital_signs
{
    public $timestamp;
    public $BP_Systolic;
    public $BP_Diastolic;
    public $Heart_Rate;
    public $Respiratory_Rate;
    public $Temperature;
    public $Weight;
    public $Height;
    public $Pain;
    public $Oxygen_Saturation;
    public $Comment;
}

class vital_signs_header
{
    public $age;
    public $BP_systolic;
    public $BP_diastolic;
    public $heart_rate;
    public $respiratory_rate;
    public $temperature;
    public $gender;
    public $room_number;
    public $pain;
    public $visit_date;
    public $oxygen_saturation;
    public $name;
}

class NavigationController extends Controller
{
    public function get_demographics_panel($id)
    {
        if(Auth::check()) {
            $patient = patient::where('patient_id', $id)->first();

            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting height and weight
            $height = $patient->height;
            $array1 = explode(' ', $height, 2);
            $height = $array1[0];
            $height_unit = $array1[1];

            $weight = $patient->weight;
            $array2 = explode(' ', $weight, 2);
            $weight = $array2[0];
            $weight_unit = $array2[1];
            return view('patient/demographics_patient', compact ('patient','navs','vital_signs_header','height','weight','weight_unit','height_unit'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_HPI($id)
    {
        if(Auth::check()) {

            $HPI = active_record::where('patient_id', $id)
                ->where('navigation_id','1')
                ->where('doc_control_id','1')->get();

            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }

            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            return view('patient/HPI', compact ('HPI','patient','navs','vital_signs_header'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_medical_history($id)
    {
        if(Auth::check()) {

            //Getting Personal History values
            $diagnosis_list_personal_history = active_record::where('patient_id', $id)
                ->where('navigation_id','3')
                ->where('doc_control_id','3')->get();

            $personal_history_comment = active_record::where('patient_id', $id)
                ->where('navigation_id','3')
                ->where('doc_control_id','4')->get();


            //Getting Family History values
            $comment_family_history = active_record::where('patient_id', $id)
                ->where('navigation_id','4')
                ->where('doc_control_id','8')->pluck('value');


            $members_family_history = active_record::where('patient_id', $id)
                ->where('navigation_id','4')
                ->where('doc_control_id','5')->get();

            $family_members_details = Array();

            foreach($members_family_history as $member)
            {
                $member_status = active_record::where('patient_id', $id)
                    ->where('navigation_id','4')
                    ->where('doc_control_id','7')
                    ->where('doc_control_group',$member->active_record_id)->pluck('value');

                $member_diagnosis = active_record::where('patient_id', $id)
                    ->where('navigation_id','4')
                    ->where('doc_control_id','6')
                    ->where('doc_control_group',$member->active_record_id)->pluck('value');

                $family_member_details = new family_member();
                $family_member_details->relation = $member->value;
                $family_member_details->status = $member_status;
                $family_member_details->diagnosis = $member_diagnosis;

                array_push($family_members_details, $family_member_details);
            }

            //Getting Surgical History values
            $diagnosis_list_surgical_history = active_record::where('patient_id', $id)
                ->where('navigation_id','5')
                ->where('doc_control_id','9')->get();

            $surgical_history_comment = active_record::where('patient_id', $id)
                ->where('navigation_id','5')
                ->where('doc_control_id','10')->get();


            //Getting Social History values
            $social_history_smoke_tobacco="";
            $social_history_non_smoke_tobacco="";
            $social_history_alcohol="";
            $social_history_sexual_activity="";
            $social_history_comment="";
            $social_history_smoke_tobacco_id="";
            $social_history_non_smoke_tobacco_id="";
            $social_history_alcohol_id="";
            $social_history_sexual_activity_id="";
            $social_history_comment_id="";
            $is_new_entry_social_history = "";

            $social_history_values = active_record::where('patient_id',$id)->where('navigation_id','6')->get();
            foreach ($social_history_values as $social_history) {
                Switch($social_history->doc_control_id){
                    case "11":
                        $social_history_smoke_tobacco = $social_history-> value ;
                        $social_history_smoke_tobacco_id = $social_history-> active_record_id ;
                        $is_new_entry_social_history = "no";
                        break;

                    case "12":
                        $social_history_non_smoke_tobacco = $social_history-> value ;
                        $social_history_non_smoke_tobacco_id = $social_history-> active_record_id ;
                        $is_new_entry_social_history = "no";
                        break;

                    case "13":
                        $social_history_alcohol = $social_history-> value ;
                        $social_history_alcohol_id = $social_history-> active_record_id ;
                        $is_new_entry_social_history = "no";
                        break;

                    case "14":
                        $social_history_sexual_activity = $social_history-> value ;
                        $social_history_sexual_activity_id = $social_history-> active_record_id ;
                        $is_new_entry_social_history = "no";
                        break;

                    case "15":
                        $social_history_comment = $social_history-> value ;
                        $social_history_comment_id = $social_history-> active_record_id ;
                        $is_new_entry_social_history = "no";
                        break;
                }

            }
            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            return view('patient/medical_history', compact ('vital_signs_header','patient','diagnosis_list_surgical_history','surgical_history_comment','diagnosis_list_personal_history','personal_history_comment','family_members_details','comment_family_history','is_new_entry_social_history','diagnosis_list_personal_history','navs','social_history_smoke_tobacco','social_history_non_smoke_tobacco','social_history_alcohol','social_history_sexual_activity','social_history_comment','social_history_smoke_tobacco_id','social_history_non_smoke_tobacco_id','social_history_alcohol_id','social_history_sexual_activity_id','social_history_comment_id'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_medications($id)
    {
        if(Auth::check()) {

            $medications = active_record::where('patient_id', $id)
                ->where('navigation_id','7')
                ->where('doc_control_id','16')->get();

            $medication_comment = active_record::where('patient_id', $id)
                ->where('navigation_id','7')
                ->where('doc_control_id','17')->get();


            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }

            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            return view('patient/medications', compact ('vital_signs_header','medications','medication_comment','patient','navs'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_vital_signs($id)
    {
        if(Auth::check()) {
            $patient = patient::where('patient_id', $id)->first();
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');
            $navs = array();
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }
            $timestamps = active_record::where('patient_id', $id)
                ->where('navigation_id', '8')->distinct()->pluck('created_at');
            $vital_sign_details = Array();
            foreach($timestamps as $ts)
            {
                $vital_sign_detail = new vital_signs();
                $vital_sign_detail->timestamp = $ts;
                $vital_sign_detail->BP_Diastolic = active_record::where('patient_id', $id)
                    ->where('navigation_id','8')
                    ->where('doc_control_id','19')
                    ->where('created_at',$ts)->pluck('value');
                $vital_sign_detail->BP_Systolic = active_record::where('patient_id', $id)
                    ->where('navigation_id','8')
                    ->where('doc_control_id','18')
                    ->where('created_at',$ts)->pluck('value');
                $vital_sign_detail->Heart_Rate =
                    active_record::where('patient_id', $id)
                        ->where('navigation_id','8')
                        ->where('doc_control_id','20')
                        ->where('created_at',$ts)->pluck('value');
                $vital_sign_detail->Respiratory_Rate = active_record::where('patient_id', $id)
                    ->where('navigation_id','8')
                    ->where('doc_control_id','21')
                    ->where('created_at',$ts)->pluck('value');
                $vital_sign_detail->Temperature = active_record::where('patient_id', $id)
                    ->where('navigation_id','8')
                    ->where('doc_control_id','22')
                    ->where('created_at',$ts)->pluck('value');
                $vital_sign_detail->Weight = active_record::where('patient_id', $id)
                    ->where('navigation_id','8')
                    ->where('doc_control_id','72')
                    ->where('created_at',$ts)->pluck('value');
                $vital_sign_detail->Height = active_record::where('patient_id', $id)
                    ->where('navigation_id','8')
                    ->where('doc_control_id','73')
                    ->where('created_at',$ts)->pluck('value');
                $vital_sign_detail->Pain = active_record::where('patient_id', $id)
                    ->where('navigation_id','8')
                    ->where('doc_control_id','23')
                    ->where('created_at',$ts)->pluck('value');
                $vital_sign_detail->Oxygen_Saturation = active_record::where('patient_id', $id)
                    ->where('navigation_id','8')
                    ->where('doc_control_id','65')
                    ->where('created_at',$ts)->pluck('value');
                $vital_sign_detail->Comment = active_record::where('patient_id', $id)
                    ->where('navigation_id','8')
                    ->where('doc_control_id','24')
                    ->where('created_at',$ts)->pluck('value');
                array_push($vital_sign_details, $vital_sign_detail);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            return view('patient/vital_signs', compact('vital_signs_header','patient','navs','vital_sign_details'));
        }
        else
        {
            return view('auth/login');
        }
    }
    public function get_ROS($id)
    {
        if(Auth::check()) {
            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            return view('patient/general_patient', compact ('vital_signs_header','patient','navs'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_physical_exams($id)
    {
        if(Auth::check()) {
            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }

            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            return view('patient/general_patient', compact ('vital_signs_header','patient','navs'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_orders($id)
    {
        if(Auth::check()) {

            $labs = active_record::where('patient_id', $id)
                ->where('navigation_id','29')->where('doc_control_id','69')->get();
//                ->where('doc_control_id','69')->pluck('value','active_record_id');

            $images = active_record::where('patient_id', $id)
                ->where('navigation_id','29') ->where('doc_control_id','70')->get();
//                ->where('doc_control_id','70')->pluck('value','active_record_id');

            $comment_order = active_record::where('patient_id', $id)
                ->where('navigation_id','29')
                ->where('doc_control_id','71')->get();

            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            return view('patient/orders', compact ('vital_signs_header','patient','navs','labs','images','comment_order'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_results($id)
    {
        if(Auth::check()) {
            $labs = active_record::where('patient_id', $id)
                ->where('navigation_id','29')->where('doc_control_id','69')->get();

            $images = active_record::where('patient_id', $id)
                ->where('navigation_id','29') ->where('doc_control_id','70')->get();

            $results = active_record::where('patient_id', $id)
                ->where('navigation_id','30')
                ->where('doc_control_id','67')->get();

            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            return view('patient/results', compact ('vital_signs_header','labs','images','results','patient','navs'));        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_MDM($id)
    {
        if(Auth::check()) {
            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            return view('patient/general_patient', compact ('vital_signs_header','patient','navs'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_disposition($id)
    {
        if(Auth::check()) {
            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                array_push($navs, $nav_name);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            return view('patient/general_patient', compact ('vital_signs_header','patient','navs'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_vital_signs_header($id)
    {
        $vital_signs_header = new vital_signs_header();
        $patient = patient::where('patient_id', $id)->first();

        $vital_signs_header->age = $patient->age;
        $vital_signs_header->name = $patient->first_name. ' '.$patient->last_name ;
        $vital_signs_header->gender = $patient->gender;
        $vital_signs_header->room_number = $patient->room_number;
        $vital_signs_header->visit_date = $patient->visit_date;


        $vital_signs_header->BP_systolic = active_record::where('patient_id', $id)
            ->where('navigation_id','8')
            ->where('doc_control_id','18')
            ->orderBy('created_at','desc')
            ->pluck('value');

        $vital_signs_header->BP_diastolic = active_record::where('patient_id', $id)
            ->where('navigation_id','8')
            ->where('doc_control_id','19')
            ->orderBy('created_at','desc')
            ->pluck('value');

        $vital_signs_header->heart_rate = active_record::where('patient_id', $id)
            ->where('navigation_id','8')
            ->where('doc_control_id','20')
            ->orderBy('created_at','desc')
            ->pluck('value');

        $vital_signs_header->respiratory_rate = active_record::where('patient_id', $id)
            ->where('navigation_id','8')
            ->where('doc_control_id','21')
            ->orderBy('created_at','desc')
            ->pluck('value');

        $vital_signs_header->temperature = active_record::where('patient_id', $id)
            ->where('navigation_id','8')
            ->where('doc_control_id','22')
            ->orderBy('created_at','desc')
            ->pluck('value');

        $vital_signs_header->oxygen_saturation = active_record::where('patient_id', $id)
            ->where('navigation_id','8')
            ->where('doc_control_id','65')
            ->orderBy('created_at','desc')
            ->pluck('value');

        $vital_signs_header->pain = active_record::where('patient_id', $id)
            ->where('navigation_id','8')
            ->where('doc_control_id','23')
            ->orderBy('created_at','desc')
            ->pluck('value');

        return $vital_signs_header;

    }
}
