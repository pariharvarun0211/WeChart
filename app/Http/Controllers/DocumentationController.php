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
    //Below four are autocomplete search methods
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
//                    'height' => 'required|numeric',
//                    'weight' => 'required|numeric',
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
//                $patient['height'] = $request['height'] ." ". $request['height_unit'];
//                $patient['weight'] = $request['weight'] ." ". $request['weight_unit'];
                $patient->save();

                return redirect()->route('Demographics',[$patient->patient_id]);

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/not_authorized');
        }
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
        $image = active_record::find($id);
        $patient_id = $image->patient_id;
        $image->delete();
        //Now redirecting back to the orders page
        return redirect()->route('Orders',$patient_id);
    }
    public function delete_lab_order($id)
    {
        Log::info('Aditya1'.$id);
        $lab = active_record::find($id);
        Log::info('Aditya2'.$lab);
        $patient_id = $lab->patient_id;
        $lab->delete();
        Log::info('Aditya3');
        //Now redirecting back to the orders page
        return redirect()->route('Orders',$patient_id);
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
                //Saving comment
                $comment_medicine_record = active_record::where('patient_id', $request['patient_id'])
                    ->where('navigation_id','7')
                    ->where('doc_control_id','17')->get();

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
    public function post_vital_signs(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }         if($role == 'Student') {
        try {
            $active_record = new active_record();
            $active_record['patient_id'] = $request['patient_id'];
            $active_record['navigation_id'] = '8';
            $active_record['doc_control_id'] = '18';
            $active_record['value'] = $request['BP_Systolic'];
            $active_record['created_by'] = $request['user_id'];
            //$active_record['created_at'] = $request['timestamp'];
            $active_record['updated_by'] = $request['user_id'];
            $active_record->save();
            $active_record = new active_record();
            $active_record['patient_id'] = $request['patient_id'];
            $active_record['navigation_id'] = '8';
            $active_record['doc_control_id'] = '19';
            $active_record['value'] = $request['BP_Diastolic'];
            $active_record['created_by'] = $request['user_id'];
            //$active_record['created_at'] = $request['timestamp'];
            $active_record['updated_by'] = $request['user_id'];
            $active_record->save();
            $active_record = new active_record();
            $active_record['patient_id'] = $request['patient_id'];
            $active_record['navigation_id'] = '8';
            $active_record['doc_control_id'] = '20';
            $active_record['value'] = $request['Heart_Rate'];
            $active_record['created_by'] = $request['user_id'];
            //$active_record['created_at'] = $request['timestamp'];
            $active_record['updated_by'] = $request['user_id'];
            $active_record->save();
            $active_record = new active_record();
            $active_record['patient_id'] = $request['patient_id'];
            $active_record['navigation_id'] = '8';
            $active_record['doc_control_id'] = '21';
            $active_record['value'] = $request['Respiratory_Rate'];
            $active_record['created_by'] = $request['user_id'];
            //$active_record['created_at'] = $request['timestamp'];
            $active_record['updated_by'] = $request['user_id'];
            $active_record->save();
            $active_record = new active_record();
            $active_record['patient_id'] = $request['patient_id'];
            $active_record['navigation_id'] = '8';
            $active_record['doc_control_id'] = '22';
            $active_record['value'] = $request['Temperature'] . " " . $request['temperature_unit'];
            $active_record['created_by'] = $request['user_id'];
            //$active_record['created_at'] = $request['timestamp'];
            $active_record['updated_by'] = $request['user_id'];
            $active_record->save();
            $active_record = new active_record();
            $active_record['patient_id'] = $request['patient_id'];
            $active_record['navigation_id'] = '8';
            $active_record['doc_control_id'] = '72';
            $active_record['value'] = $request['Weight'] . " " . $request['weight_unit'];
            $active_record['created_by'] = $request['user_id'];
            //$active_record['created_at'] = $request['timestamp'];
            $active_record['updated_by'] = $request['user_id'];
            $active_record->save();
            $active_record = new active_record();
            $active_record['patient_id'] = $request['patient_id'];
            $active_record['navigation_id'] = '8';
            $active_record['doc_control_id'] = '73';
            $active_record['value'] = $request['Height'] . " " . $request['height_unit'];
            $active_record['created_by'] = $request['user_id'];
            //$active_record['created_at'] = $request['timestamp'];
            $active_record['updated_by'] = $request['user_id'];
            $active_record->save();
            $active_record = new active_record();
            $active_record['patient_id'] = $request['patient_id'];
            $active_record['navigation_id'] = '8';
            $active_record['doc_control_id'] = '23';
            $active_record['value'] = $request['Pain'];
            $active_record['created_by'] = $request['user_id'];
            //$active_record['created_at'] = $request['timestamp'];
            $active_record['updated_by'] = $request['user_id'];
            $active_record->save();
            $active_record = new active_record();
            $active_record['patient_id'] = $request['patient_id'];
            $active_record['navigation_id'] = '8';
            $active_record['doc_control_id'] = '65';
            $active_record['value'] = $request['Oxygen_Saturation'];
            $active_record['created_by'] = $request['user_id'];
            //$active_record['created_at'] = $request['timestamp'];
            $active_record['updated_by'] = $request['user_id'];
            $active_record->save();
            $active_record = new active_record();
            $active_record['patient_id'] = $request['patient_id'];
            $active_record['navigation_id'] = '8';
            $active_record['doc_control_id'] = '24';
            $active_record['value'] = $request['Comments'];
            $active_record['created_by'] = $request['user_id'];
            //$active_record['created_at'] = $request['timestamp'];
            $active_record['updated_by'] = $request['user_id'];
            $active_record->save();
            return redirect()->route('Vital Signs',[$request['patient_id']]);
        }
        catch (\Exception $e)
        {
            return view('errors/503');
        }
    }
    else {
        return view('auth/not_authorized');
    }
    }
    public function delete_vital_signs($ts, Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }         if($role == 'Student') {
        try {
            active_record::where('created_at',$ts)->where('navigation_id', '8')->where('doc_control_id','18')->delete();
            active_record::where('created_at',$ts)->where('navigation_id', '8')->where('doc_control_id','19')->delete();
            active_record::where('created_at',$ts)->where('navigation_id', '8')->where('doc_control_id','20')->delete();
            active_record::where('created_at',$ts)->where('navigation_id', '8')->where('doc_control_id','21')->delete();
            active_record::where('created_at',$ts)->where('navigation_id', '8')->where('doc_control_id','22')->delete();
            active_record::where('created_at',$ts)->where('navigation_id', '8')->where('doc_control_id','23')->delete();
            active_record::where('created_at',$ts)->where('navigation_id', '8')->where('doc_control_id','24')->delete();
            active_record::where('created_at',$ts)->where('navigation_id', '8')->where('doc_control_id','65')->delete();
            active_record::where('created_at',$ts)->where('navigation_id', '8')->where('doc_control_id','72')->delete();
            active_record::where('created_at',$ts)->where('navigation_id', '8')->where('doc_control_id','73')->delete();

            return redirect()->route('Vital Signs',[$request['patient_id']]);
        }
        catch (\Exception $e)
        {
            return view('errors/503');
        }
    }
    else {
        return view('auth/not_authorized');
    }
    }
    public function post_psychological(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {
                //First deleting all saved symptoms
                active_record::where('patient_id', $request['patient_id'])
                    ->where('navigation_id','28')->where('doc_control_id','59')->delete();

                $psychological_symptoms = $request['$psychological_symptoms'];

                //Now saving
                foreach ((array)$psychological_symptoms as $key=>$psychological_symptom) {
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '28';
                    $active_record['doc_control_id'] = '59';
                    $active_record['value'] = $psychological_symptom;
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                //Saving comment
                $comment_psychological_record = active_record::where('patient_id', $request['patient_id'])
                    ->where('navigation_id','28')
                    ->where('doc_control_id','60')->get();

                if(!count($comment_psychological_record)>0)
                {
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '28';
                    $active_record['doc_control_id'] = '60';
                    $active_record['value'] = $request['psychological_comment'];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                else {
                    $active_record = active_record::where('active_record_id', $comment_psychological_record[0]->active_record_id)->first();
                    $active_record['value'] = $request['psychological_comment'];
                    $active_record->save();
                }

                //Now redirecting to orders page
                return redirect()->route('Physical Exam',[$request['patient_id']]);

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
