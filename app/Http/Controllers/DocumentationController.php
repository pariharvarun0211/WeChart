<?php

namespace App\Http\Controllers;

use App\lookup_value;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Auth;
use App\module;
use App\User;
use App\users_patient;
use App\module_navigation;
use App\navigation;
use App\patient;


class DocumentationController extends Controller
{
    public function find_diagnosis(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $lookups = lookup_value::search($term)->limit(5)->get();

        $formatted_lookups = [];

        foreach ($lookups as $lookup) {
            $formatted_lookups[] = ['id' => $lookup->lookup_value_id, 'text' => $lookup->lookup_value];
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
                //
//                $patient = new patient($request->all());
//
//                $patient['last_name'] = 'Doe' . $append_number;
//
//                $patient['archived'] = 0;
//                $patient['completed_flag'] = 0;
//                $patient['height'] = $request['height'] ." ". $request['height_unit'];
//                $patient['weight'] = $request['weight'] ." ". $request['weight_unit'];
//                $patient['created_by'] = $request['user_id'];
//                $patient['updated_by'] = $request['user_id'];
//
//                $patient->save();

                //Fetching all navs associated with this patient's module
                $navIds = module_navigation::where('module_id', $request->module_id)->pluck('navigation_id');
                $navs = array();

                //Now get nav names
                foreach ($navIds as $nav_id) {
                    $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                    array_push($navs, $nav_name);
                }
                return view('patient/HPI', compact ('patient','navs'));

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/login');
        }

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
                        'height' => 'required',
                        'weight' => 'required',
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
                    $patient->age = $request->age;
                    $patient->height = $request->height;
                    $patient->weight = $request->weight;
                    $patient->save();

                //Fetching all navs associated with this patient's module
                $navIds = module_navigation::where('module_id', $patient->module_id)->pluck('navigation_id');
                $navs = array();

                //Now get nav names
                foreach ($navIds as $nav_id) {
                    $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                    array_push($navs, $nav_name);
                }
                return view('patient/demographics_patient', compact ('patient','navs'));
            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/login');
        }
    }
    public function post_social_history(Request $request)
    {
        Log::info('Aditya reached here');
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {

                //Fetching all navs associated with this patient's module
                $navIds = module_navigation::where('module_id', $request->module_id)->pluck('navigation_id');
                $navs = array();

                //Now get nav names
                foreach ($navIds as $nav_id) {
                    $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                    array_push($navs, $nav_name);
                }
                return view('patient/medical_history', compact ('patient','navs'));

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/login');
        }

    }
     public function post_personal_history(Request $request)
    {
        Log::info('Aditya reached here');
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {

                //Fetching all navs associated with this patient's module
                $navIds = module_navigation::where('module_id', $request->module_id)->pluck('navigation_id');
                $navs = array();

                //Now get nav names
                foreach ($navIds as $nav_id) {
                    $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                    array_push($navs, $nav_name);
                }
                return view('patient/medical_history', compact ('patient','navs'));

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/login');
        }

    }
    
     public function post_surgical_history(Request $request)
    {
        Log::info('Aditya reached here');
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Student') {
            try {

                //Fetching all navs associated with this patient's module
                $navIds = module_navigation::where('module_id', $request->module_id)->pluck('navigation_id');
                $navs = array();

                //Now get nav names
                foreach ($navIds as $nav_id) {
                    $nav_name = navigation::where('navigation_id', $nav_id)->pluck('navigation_name');
                    array_push($navs, $nav_name);
                }
                return view('patient/medical_history', compact ('patient','navs'));

            } catch (\Exception $e) {
                return view('errors/503');
            }
        }
        else
        {
            return view('auth/login');
        }

    }
}
