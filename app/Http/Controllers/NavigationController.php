<?php

namespace App\Http\Controllers;
use App\active_record;
use App\lookup_value;
use App\module_navigation;
use App\navigation;
use App\users_patient;
use Dompdf\Exception;
use Illuminate\Support\Facades\Log;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\patient;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Stmt\Switch_;
use PDF;
use App\doc_lookup_value;

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

class symptom
{
    public $value;
    public $is_saved;
}

class NavigationController extends Controller
{
    public function get_demographics_panel($id)
    {
        if(Auth::check()) {
            $patient = patient::where('patient_id', $id)->first();

            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }

            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();

            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;

            return view('patient/demographics_patient', compact ('patient','navs','vital_signs_header','disposition', 'status_id'));
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
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();

            //Now get nav names
            foreach ($navIds as $key=>$nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }

            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();
            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;

            return view('patient/HPI', compact ('status_id','HPI','patient','navs','vital_signs_header','disposition'));
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
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');
            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }

            //Converting object to array
            $navIds = str_replace(['['], '', $navIds);
            $navIds = str_replace(['"'], '', $navIds);
            $navIds = str_replace(['"'], '', $navIds);
            $navIds = str_replace([']'], '', $navIds);

            $navIds = explode(",", $navIds);
            array_pop($navIds);

            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();

            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;

            return view('patient/medical_history', compact ('status_id','navIds','disposition','vital_signs_header','patient','diagnosis_list_surgical_history','surgical_history_comment','diagnosis_list_personal_history','personal_history_comment','family_members_details','comment_family_history','is_new_entry_social_history','diagnosis_list_personal_history','navs','social_history_smoke_tobacco','social_history_non_smoke_tobacco','social_history_alcohol','social_history_sexual_activity','social_history_comment','social_history_smoke_tobacco_id','social_history_non_smoke_tobacco_id','social_history_alcohol_id','social_history_sexual_activity_id','social_history_comment_id'));
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
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }

            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();
            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;

            return view('patient/medications', compact ('status_id','vital_signs_header','medications','medication_comment','patient','navs','disposition'));
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
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');
            $navs = array();
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
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

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();
            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;


            return view('patient/vital_signs', compact('status_id','vital_signs_header','patient','navs','vital_sign_details','disposition'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_ROS($id)
    {
        if(Auth::check()) {
            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();
            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;


            return view('patient/general_patient', compact ('status_id
            ','vital_signs_header','patient','navs','disposition'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_physical_exams($id)
    {
        if(Auth::check()) {

            //Now getting actual selected values
            $psychological_symptoms= $this->get_physical_exams_psychological_symptoms($id);
            $psychological_comment = active_record::where('patient_id', $id)
                ->where('navigation_id','28')->where('doc_control_id','60')->pluck('value');

            // Other PE code comes here.. $XYZ_symptoms and $XYZ_comment for each XYZ

            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }

            //Converting object to array
            $navIds = str_replace(['['], '', $navIds);
            $navIds = str_replace(['"'], '', $navIds);
            $navIds = str_replace(['"'], '', $navIds);
            $navIds = str_replace([']'], '', $navIds);

            $navIds = explode(",", $navIds);

            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();
            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;


            return view('patient/physical_exams', compact ('status_id','navIds','vital_signs_header','patient','navs','disposition','psychological_symptoms','psychological_comment'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_physical_exams_psychological_symptoms($id)
    {
        $psychological_all_symptoms = array();
        $psychological_all_lookup_values = doc_lookup_value::where('doc_control_id',59)->pluck('lookup_value_id');

        foreach ($psychological_all_lookup_values as $psychological_all_lookup_value)
        {
            $symptom = lookup_value::where('lookup_value_id',$psychological_all_lookup_value)->pluck('lookup_value');
            array_push($psychological_all_symptoms,$symptom );
        }

        $psychological_saved_symptoms = active_record::where('patient_id', $id)
            ->where('navigation_id','28')->where('doc_control_id','59')->pluck('value');

        //Converting object to array
        $psychological_saved_symptoms = str_replace(['['], '', $psychological_saved_symptoms);
        $psychological_saved_symptoms = str_replace(['"'], '', $psychological_saved_symptoms);
        $psychological_saved_symptoms = str_replace(['"'], '', $psychological_saved_symptoms);
        $psychological_saved_symptoms = str_replace([']'], '', $psychological_saved_symptoms);
        $psychological_saved_symptoms = explode(",", $psychological_saved_symptoms);

        $psychological_symptoms = Array();

        foreach($psychological_all_symptoms as $symptom)
        {
            $psychological_symptom = new symptom();
            $psychological_symptom->value = $symptom[0];
            if(in_array($symptom[0], $psychological_saved_symptoms))
            {
                $psychological_symptom->is_saved = true;
            }
            else
            {
                $psychological_symptom->is_saved = false;
            }
            array_push($psychological_symptoms, $psychological_symptom);
        }
        return $psychological_symptoms;

    }
    public function get_orders($id)
    {
        if(Auth::check()) {

            $labs = active_record::where('patient_id', $id)
                ->where('navigation_id','29')->where('doc_control_id','69')->get();

            $images = active_record::where('patient_id', $id)
                ->where('navigation_id','29') ->where('doc_control_id','70')->get();

            $comment_order = active_record::where('patient_id', $id)
                ->where('navigation_id','29')
                ->where('doc_control_id','71')->get();

            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();
            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;


            return view('patient/orders', compact ('status_id','vital_signs_header','patient','navs','labs','images','comment_order','disposition'));
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
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();
            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;


            return view('patient/results', compact ('status_id','vital_signs_header','labs','images','results','patient','navs','disposition'));        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_MDM($id)
    {
        if(Auth::check()) {
            $MDM = active_record::where('patient_id', $id)
                ->where('navigation_id','31')
                ->where('doc_control_id','61')->get();

            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();
            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;
            return view('patient/MDM', compact ('MDM','patient','navs','vital_signs_header','disposition', 'status_id'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_disposition($id)
    {
        if(Auth::check()) {
            $disposition_value = active_record::where('patient_id', $id)
                ->where('navigation_id','32')
                ->where('doc_control_id','63')->pluck('value');

            $disposition_comment = active_record::where('patient_id', $id)
                ->where('navigation_id','32')
                ->where('doc_control_id','64')->pluck('value');


            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();

            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;

            return view('patient/disposition', compact ('disposition_value','disposition_comment','status_id','vital_signs_header','patient','navs','disposition'));
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
    public function get_assignInstructor($id)
    {
        if(Auth::check()) {
            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');
            $navs = array();
            //Now get nav names
            foreach ($navIds as $nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }
            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);
            //Extracting disposition to enable or disable the submit button
            $disposition = active_record::where('patient_id', $id)
                ->where('navigation_id', '32')->get();
            $user_id = Auth::user()->id;
            $status = users_patient::where('patient_id',$id)->where('user_id',$user_id)->first();
            $status_id = $status->patient_record_status_id;

            return view('patient/assign_instructor', compact ('disposition','status_id','vital_signs_header','medications','medication_comment','patient','navs'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function generate_pdf($id)
    {
        if(Auth::check()) {
            $HPI = active_record::where('patient_id', $id)
                ->where('navigation_id','1')
                ->where('doc_control_id','1')->get();

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

            $social_history_values = active_record::where('patient_id',$id)->where('navigation_id','6')->get();
            foreach ($social_history_values as $social_history) {
                Switch($social_history->doc_control_id){
                    case "11":
                        $social_history_smoke_tobacco = $social_history-> value ;
                        break;

                    case "12":
                        $social_history_non_smoke_tobacco = $social_history-> value ;
                        break;

                    case "13":
                        $social_history_alcohol = $social_history-> value ;
                        break;

                    case "14":
                        $social_history_sexual_activity = $social_history-> value ;
                        break;

                    case "15":
                        $social_history_comment = $social_history-> value ;
                        break;
                }

            }

            //Getting medications
            $medications = active_record::where('patient_id', $id)
                ->where('navigation_id','7')
                ->where('doc_control_id','16')->get();

            $medication_comment = active_record::where('patient_id', $id)
                ->where('navigation_id','7')
                ->where('doc_control_id','17')->get();

            //Getting vital signs
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

            // Get orders
            $labs = active_record::where('patient_id', $id)
                ->where('navigation_id','29')->where('doc_control_id','69')->get();

            $images = active_record::where('patient_id', $id)
                ->where('navigation_id','29') ->where('doc_control_id','70')->get();

            $comment_order = active_record::where('patient_id', $id)
                ->where('navigation_id','29')
                ->where('doc_control_id','71')->get();

            $results = active_record::where('patient_id', $id)
                ->where('navigation_id','30')
                ->where('doc_control_id','67')->get();

            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();

            //Now get nav names
            foreach ($navIds as $key=>$nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }

            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);

            try{
                $pdf = PDF::loadView('patient.preview', compact ('patient','navs','vital_signs_header','HPI','diagnosis_list_surgical_history','surgical_history_comment','diagnosis_list_personal_history','personal_history_comment','family_members_details','comment_family_history','social_history_smoke_tobacco','social_history_non_smoke_tobacco','social_history_alcohol','social_history_sexual_activity','social_history_comment','medications','medication_comment','vital_sign_details','comment_order','labs','images','results'));
                return $pdf->download('patient_report.pdf');
            }
            catch (\Exception $e)
            {
                return view('errors/503');
            }
         }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_preview($id){
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            $HPI = active_record::where('patient_id', $id)
                ->where('navigation_id','1')
                ->where('doc_control_id','1')->get();

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

            $social_history_values = active_record::where('patient_id',$id)->where('navigation_id','6')->get();
            foreach ($social_history_values as $social_history) {
                Switch($social_history->doc_control_id){
                    case "11":
                        $social_history_smoke_tobacco = $social_history-> value ;
                        break;

                    case "12":
                        $social_history_non_smoke_tobacco = $social_history-> value ;
                        break;

                    case "13":
                        $social_history_alcohol = $social_history-> value ;
                        break;

                    case "14":
                        $social_history_sexual_activity = $social_history-> value ;
                        break;

                    case "15":
                        $social_history_comment = $social_history-> value ;
                        break;
                }

            }

            //Getting medications
            $medications = active_record::where('patient_id', $id)
                ->where('navigation_id','7')
                ->where('doc_control_id','16')->get();

            $medication_comment = active_record::where('patient_id', $id)
                ->where('navigation_id','7')
                ->where('doc_control_id','17')->get();

            //Getting vital signs
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

            // Get orders
            $labs = active_record::where('patient_id', $id)
                ->where('navigation_id','29')->where('doc_control_id','69')->get();

            $images = active_record::where('patient_id', $id)
                ->where('navigation_id','29') ->where('doc_control_id','70')->get();

            $comment_order = active_record::where('patient_id', $id)
                ->where('navigation_id','29')
                ->where('doc_control_id','71')->get();

            //Get results
            $results = active_record::where('patient_id', $id)
                ->where('navigation_id','30')
                ->where('doc_control_id','67')->get();

            $patient = patient::where('patient_id', $id)->first();
            //Fetching all navs associated with this patient's module
            $navIds = module_navigation::where('module_id', $patient->module_id)->orderBy('navigation_id')->pluck('navigation_id');

            $navs = array();

            //Now get nav names
            foreach ($navIds as $key=>$nav_id) {
                $nav = navigation::where('navigation_id', $nav_id)->get();
                array_push($navs, $nav);
            }

            //Extracting vital signs for header
            $vital_signs_header = $this->get_vital_signs_header($id);
            return view('patient/preview', compact ('patient','navs','vital_signs_header','HPI','diagnosis_list_surgical_history','surgical_history_comment','diagnosis_list_personal_history','personal_history_comment','family_members_details','comment_family_history','social_history_smoke_tobacco','social_history_non_smoke_tobacco','social_history_alcohol','social_history_sexual_activity','social_history_comment','medications','medication_comment','vital_sign_details','comment_order','labs','images','results'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
}
