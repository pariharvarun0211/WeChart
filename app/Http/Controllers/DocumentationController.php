<?php

namespace App\Http\Controllers;

use App\lookup_value;
use App\diagnosis_lookup_value;
use App\med_lookup_value;
use App\imaging_orders_lookup_value;
use App\lab_orders_lookup_value;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Auth;
use App\module;
use App\User;
use App\users_patient;
use App\module_navigation;
use App\navigation;
use App\patient;
use App\active_record;
use App\doc_lookup_value;
use App\doc_control;



class DocumentationController extends Controller
{
//    public function find_diagnosis(Request $request)
//    {
//        $term = trim($request->q);
//
//        if (empty($term)) {
//            return \Response::json([]);
//        }
//
//        //Need to load the specifc document control we care about, provide the id
//        $docControl = doc_control::find($request['id']);
//        $formatted_lookups = [];
//
//        Log::info("Chouhan Test".$request['id']);
//        Log::info("Chouhan Test".$term);
//        //Use the DocControl model to join to the lookup value as shown below.
//
////        foreach ($docControl->LookupValues->where('lookup_value','LIKE','!'.$term.'!') as $lookupValue) {
////        foreach ($docControl->LookupValues->search($term) as $lookupValue) {
//        foreach ($docControl->LookupValues->where('lookup_value','like',"%$term%") as $lookupValue) {
//            $formatted_lookups[] = ['id' => $lookupValue->lookup_value_id, 'text' => $lookupValue->lookup_value];
//        }
//
//      //$lookups = doc_lookup_value::with('lookup_value')->where('lookup_value_id')->search($term)->limit(5)->get();
//        return \Response::json($formatted_lookups);
//    }
    public function find_diagnosis(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $lookups = diagnosis_lookup_value::search($term)->get();

        $formatted_lookups = [];

        foreach ($lookups as $lookup) {
            $formatted_lookups[] = ['id' => $lookup->diagnosis_lookup_value_id, 'text' => $lookup->diagnosis_lookup_value];
        }

        return \Response::json($formatted_lookups);
    }
    public function find_medications(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $lookups = med_lookup_value::search($term)->get();

        $formatted_lookups = [];

        foreach ($lookups as $lookup) {
            $formatted_lookups[] = ['id' => $lookup->med_lookup_value_id, 'text' => $lookup->med_lookup_value];
        }

        return \Response::json($formatted_lookups);
    }
    public function find_lab_orders(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }
        $lookups = lab_orders_lookup_value::search($term)->get();

        $formatted_lookups = [];

        foreach ($lookups as $lookup) {
            $formatted_lookups[] = ['id' => $lookup->lab_orders_lookup_value_id, 'text' => $lookup->lab_orders_lookup_value];
        }

        return \Response::json($formatted_lookups);
    }
    public function find_imaging_orders(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $lookups = imaging_orders_lookup_value::search($term)->get();

        $formatted_lookups = [];

        foreach ($lookups as $lookup) {
            $formatted_lookups[] = ['id' => $lookup->imaging_orders_lookup_value_id, 'text' => $lookup->imaging_orders_lookup_value];
        }

        return \Response::json($formatted_lookups);
    }
    public function post_HPI(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {
                //Saving HPI
                $HPI_record = active_record::where('patient_id', $request['patient_id'])
                    ->where('navigation_id','1')
                    ->where('doc_control_id','1')->get();

                if(!count($HPI_record)>0)
                {
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '1';
                    $active_record['doc_control_id'] = '1';
                    $active_record['value'] = $request['HPI'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                else {
                    $active_record = active_record::where('active_record_id', $HPI_record[0]->active_record_id)->first();
                    $active_record['value'] = $request['HPI'];
                    $active_record->save();
                }

                //Now redirecting to page
                return redirect()->route('History of Present Illness (HPI)',[$request['patient_id']]);

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }

    }
    public function post_results(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {
                //Saving results
                $results_record = active_record::where('patient_id', $request['patient_id'])
                    ->where('navigation_id','30')
                    ->where('doc_control_id','67')->get();

                if(!count($results_record)>0)
                {
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '30';
                    $active_record['doc_control_id'] = '67';
                    $active_record['value'] = $request['results'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                else {
                    $active_record = active_record::where('active_record_id', $results_record[0]->active_record_id)->first();
                    $active_record['value'] = $request['results'];
                    $active_record->save();
                }

                //Now redirecting to page
                return redirect()->route('Results',[$request['patient_id']]);

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }

    }
    public function post_orders(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {
                $labs = $request['search_labs_orders'];
                $images = $request['search_labs_imaging'];

                //Saving labs
                foreach ((array)$labs as $key=>$lab) {
                    $lab_value = lab_orders_lookup_value::where('lab_orders_lookup_value_id',$lab)->pluck('lab_orders_lookup_value');
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '29';
                    $active_record['doc_control_id'] = '69';
                    $active_record['value'] = $lab_value[0];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }

                //Saving Images
                foreach ((array)$images as $key=>$image) {
                    $image_value = imaging_orders_lookup_value::where('imaging_orders_lookup_value_id',$image)->pluck('imaging_orders_lookup_value');
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '29';
                    $active_record['doc_control_id'] = '70';
                    $active_record['value'] = $image_value[0];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }

                //Saving comment
                $comment_order_record = active_record::where('patient_id', $request['patient_id'])
                    ->where('navigation_id','29')
                    ->where('doc_control_id','71')->get();

                if(!count($comment_order_record)>0)
                {
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '29';
                    $active_record['doc_control_id'] = '71';
                    $active_record['value'] = $request['orders_comment'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                else {
                    $active_record = active_record::where('active_record_id', $comment_order_record[0]->active_record_id)->first();
                    $active_record['value'] = $request['orders_comment'];
                    $active_record->save();
                }

                //Now redirecting to orders page
                return redirect()->route('Orders',[$request['patient_id']]);

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }

    }
    public function delete_image_order($id)
    {
        Log::info('jhj');
        $image = active_record::find($id);
        $patient_id = $image->patient_id;
        $image->delete();
        //Now redirecting to orders page
        return redirect()->route('Orders',$patient_id);
    }
    public function delete_lab_order($id)
    {
        $lab = active_record::find($id);
        $patient_id = $lab->patient_id;
        $lab->delete();
        //Now redirecting to orders page
        return redirect()->route('Orders',$patient_id);
    }
    public function post_Demographics(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {
                    //Validating input data
                    $this->validate($request, [
                        'age' => 'required|numeric',
                        'room_number' => 'required',
                        'height' => 'required|numeric',
                        'weight' => 'required|numeric',
                    ]);
                    $patient = patient::where('patient_id', $request['patient_id'])->first();
                    //if sex is male then first name is John else Jane
                    if ($request->gender == 'Male')
                    {
                        $patient['first_name'] = 'John';
                    }
                    else
                    {
                        $patient['first_name'] = 'Jane';
                    }

                $patient->gender = $request->gender;
                $patient->room_number = $request->room_number;
                $patient->age = $request->age;
                $patient['height'] = $request['height'] ." ". $request['height_unit'];
                $patient['weight'] = $request['weight'] ." ". $request['weight_unit'];
                $patient->save();

                //Fetching all navs associated with this patient's module
                $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');
                $navs = array();

                //Now get nav names
                foreach ($navIds as $nav_id) {
                    $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                    array_push($navs, $nav_name);
                }

                //Extracting height and weight
                $height = $patient->height;
                $array1 = explode(' ', $height, 2);
                $height = $array1[0];
                $height_unit = $array1[1];

                $weight = $patient->weight;
                $array2 = explode(' ', $weight, 2);
                $weight = $array2[0];
                $weight_unit = $array2[1];
                return view('patient/demographics_patient', compact ('patient','navs','height','weight','weight_unit','height_unit'));

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function post_social_history(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {
                //Determining its save or update
                if($request['is_new_entry_social_history'] == "no")
                {
                    $social_history_smoke_tobacco_id = $request['social_history_smoke_tobacco_id'];
                    $active_record = active_record::where('active_record_id', $social_history_smoke_tobacco_id)->first();
                    $active_record['value'] = $request['smoke_tobacco'];
                    $active_record->save();
                }

                else
                {
                    //Inserting Smoke Tobacco
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '6';
                    $active_record['doc_control_id'] = '11';
                    $active_record['value'] = $request['smoke_tobacco'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }

                //Determining its save or update
                if($request['is_new_entry_social_history'] == "no")
                {
                    $social_history_non_smoke_tobacco_id = $request['social_history_non_smoke_tobacco_id'];
                    $active_record = active_record::where('active_record_id',$social_history_non_smoke_tobacco_id)->first();
                    $active_record->value = $request['non_smoke_tobacco'];
                    $active_record->save();
                }
                else
                {
                    //Inserting Non-Smoke Tobacco
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '6';
                    $active_record['doc_control_id'] = '12';
                    $active_record['value'] = $request['non_smoke_tobacco'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }

                //Determining its save or update
                if($request['is_new_entry_social_history'] == "no")
                {
                    $social_history_alcohol_id = $request['social_history_alcohol_id'];
                    $active_record = active_record::find($request['social_history_alcohol_id']);
                    $active_record->value = $request['alcohol'];
                    $active_record->save();
                }
                else
                {
                    //Inserting Alcohol
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '6';
                    $active_record['doc_control_id'] = '13';
                    $active_record['value'] = $request['alcohol'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }

                //Determining its save or update
                if($request['is_new_entry_social_history'] == "no")
                {
                    $social_history_sexual_activity_id = $request['social_history_sexual_activity_id'];
                    $active_record = active_record::where('active_record_id',$social_history_sexual_activity_id)->first();
                    $active_record['value'] = $request['sexual_activity'];
                    $active_record->save();
                }
                else
                {
                    //Inserting Sexual Activity
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '6';
                    $active_record['doc_control_id'] = '14';
                    $active_record['value'] = $request['sexual_activity'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }

                //Determining its save or update
                if($request['is_new_entry_social_history'] == "no")
                {
                    $social_history_comment_id = $request['social_history_comment_id'];
                    $active_record = active_record::where('active_record_id',$social_history_comment_id)->first();
                    $active_record['value'] = $request['social_history_comment'];
                    $active_record->save();
                }
                else
                {
                    //Inserting Comment
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '6';
                    $active_record['doc_control_id'] = '15';
                    $active_record['value'] = $request['social_history_comment'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }

                return redirect()->route('Medical History',[$request['patient_id']]);

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }

    }
    public function post_personal_history(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {
                $diagnosis = $request['search_diagnosis_personal_history'];

                //Saving medications
                foreach ((array)$diagnosis as $key=>$item) {
                    $lab_value = diagnosis_lookup_value::where('diagnosis_lookup_value_id',$item)->pluck('diagnosis_lookup_value');
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '3';
                    $active_record['doc_control_id'] = '3';
                    $active_record['value'] = $lab_value[0];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }

                //Saving comment
                $comment_personal_history_record = active_record::where('patient_id', $request['patient_id'])
                    ->where('navigation_id','3')
                    ->where('doc_control_id','4')->get();

                if(!count($comment_personal_history_record)>0)
                {
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '3';
                    $active_record['doc_control_id'] = '4';
                    $active_record['value'] = $request['personal_history_comment'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                else {
                    $active_record = active_record::where('active_record_id', $comment_personal_history_record[0]->active_record_id)->first();
                    $active_record['value'] = $request['personal_history_comment'];
                    $active_record->save();
                }

                //Now redirecting to page
                return redirect()->route('Medical History',[$request['patient_id']]);

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }

    }
    public function post_surgical_history(Request $request)
    {

        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {

                $diagnosis = $request['search_diagnosis_surgical_history'];

                //Saving medications
                foreach ((array)$diagnosis as $key=>$item) {
                    $lab_value = diagnosis_lookup_value::where('diagnosis_lookup_value_id',$item)->pluck('diagnosis_lookup_value');
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '5';
                    $active_record['doc_control_id'] = '9';
                    $active_record['value'] = $lab_value[0];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }

                //Saving comment
                $comment_surgical_history_record = active_record::where('patient_id', $request['patient_id'])
                    ->where('navigation_id','5')
                    ->where('doc_control_id','10')->get();

                if(!count($comment_surgical_history_record)>0)
                {
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '5';
                    $active_record['doc_control_id'] = '10';
                    $active_record['value'] = $request['surgical_history_comment'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                else {
                    $active_record = active_record::where('active_record_id', $comment_surgical_history_record[0]->active_record_id)->first();
                    $active_record['value'] = $request['surgical_history_comment'];
                    $active_record->save();
                }

                //Now redirecting to page
                return redirect()->route('Medical History',[$request['patient_id']]);
            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }

    }
    public function post_new_family_member(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }
        if($role == 'Student') {
//            try
//            {

                //Saving family member relation
                $active_record = new active_record();
                $active_record['patient_id'] = $request['patient_id'];
                $active_record['navigation_id'] = '4';
                $active_record['doc_control_id'] = '5';
                $active_record['value'] = $request['relation'];
                $active_record['created_by'] = $request['user_id'];
                $active_record['updated_by'] = $request['user_id'];
                $active_record->save();

                //Saving active record id to group all diagnosis together
                $saved_active_record_id = $active_record->active_record_id;

                //Saving family member status
                $active_record = new active_record();
                $active_record['patient_id'] = $request['patient_id'];
                $active_record['navigation_id'] = '4';
                $active_record['doc_control_id'] = '7';
                $active_record['value'] = $request['family_member_status'];
                $active_record['doc_control_group'] = $saved_active_record_id;
                $active_record['created_by'] = $request['user_id'];
                $active_record['updated_by'] = $request['user_id'];
                $active_record->save();


                //Saving family member's diagnosis
                foreach ($request['diagnosis_list'] as $key=>$list) {
                    $list_value = diagnosis_lookup_value::where('diagnosis_lookup_value_id',$list)->pluck('diagnosis_lookup_value');
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '4';
                    $active_record['doc_control_id'] = '6';
                    $active_record['value'] = $list_value[0];
                    $active_record['doc_control_group'] = $saved_active_record_id;
                    $active_record['doc_control_group_order'] = $key+1;
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                    }
                return redirect()->route('Medical History',[$request['patient_id']]);
//                }
//                catch (\Exception $e) {
//                    return view('errors/503');
//                }
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function post_family_history(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {

                //Saving comment
                $comment_family_history_record = active_record::where('patient_id', $request['patient_id'])
                    ->where('navigation_id','4')
                    ->where('doc_control_id','8')->get();

                if(!count($comment_family_history_record)>0)
                {
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '4';
                    $active_record['doc_control_id'] = '8';
                    $active_record['value'] = $request['family_history_comment'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                else {
                    $active_record = active_record::where('active_record_id', $comment_family_history_record[0]->active_record_id)->first();
                    $active_record['value'] = $request['family_history_comment'];
                    $active_record->save();
                }

                //Now redirecting to orders page
                return redirect()->route('Medical History',[$request['patient_id']]);

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }

    }
    public function post_medications(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {
                $medications = $request['search_medications'];
                Log::info("Aditya1".$medications[0]);
                //Saving medications
                foreach ((array)$medications as $key=>$medicine) {
                    $lab_value = med_lookup_value::where('med_lookup_value_id',$medicine)->pluck('med_lookup_value');
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '7';
                    $active_record['doc_control_id'] = '16';
                    $active_record['value'] = $lab_value[0];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                Log::info("Aditya2".$medications[0]);
                //Saving comment
                $comment_medicine_record = active_record::where('patient_id', $request['patient_id'])
                    ->where('navigation_id','7')
                    ->where('doc_control_id','17')->get();

                Log::info("Aditya3".$comment_medicine_record);
                if(!count($comment_medicine_record)>0)
                {
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '7';
                    $active_record['doc_control_id'] = '17';
                    $active_record['value'] = $request['medication_comment'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                else {
                    $active_record = active_record::where('active_record_id', $comment_medicine_record[0]->active_record_id)->first();
                    $active_record['value'] = $request['medication_comment'];
                    $active_record->save();
                }

                Log::info("Aditya4");
                //Now redirecting to orders page
                return redirect()->route('Medications',[$request['patient_id']]);

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }

    }
}
