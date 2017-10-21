<?php

namespace App\Http\Controllers;
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

            return view('patient/demographics_patient', compact ('patient','navs'));
        }
        else
        {
            return view('auth/login');
        }
    }
    public function get_HPI($id)
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

            return view('patient/HPI', compact ('patient','navs'));
        }
        else
        {
            return view('auth/login');
        }
    }
    public function get_medical_history($id)
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
            return view('patient/medical_history', compact ('patient','navs'));
        }
        else
        {
            return view('auth/login');
        }
    }
    public function get_medications($id)
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

            return view('patient/general_patient', compact ('patient','navs'));
        }
        else
        {
            return view('auth/login');
        }
    }
    public function get_vital_signs($id)
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

            return view('patient/general_patient', compact ('patient','navs'));
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

            return view('patient/general_patient', compact ('patient','navs'));
        }
        else
        {
            return view('auth/login');
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

            return view('patient/general_patient', compact ('patient','navs'));
        }
        else
        {
            return view('auth/login');
        }
    }
    public function get_orders($id)
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

            return view('patient/general_patient', compact ('patient','navs'));
        }
        else
        {
            return view('auth/login');
        }
    }
    public function get_results($id)
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

            return view('patient/general_patient', compact ('patient','navs'));
        }
        else
        {
            return view('auth/login');
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

            return view('patient/general_patient', compact ('patient','navs'));
        }
        else
        {
            return view('auth/login');
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

            return view('patient/general_patient', compact ('patient','navs'));
        }
        else
        {
            return view('auth/login');
        }
    }
}
