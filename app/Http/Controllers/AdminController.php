<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\EmailidRole;
use App\navigation;
use App\module;
use App\module_navigation;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {  
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Only Admin can access Admin Dashboard
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }

        if($role == 'Admin') {
        //Fetching all students and instructors for display on admin landing page

         $students = User::where('role','Student')
             ->where('archived','=','0')
             ->get();

         $instructors = User::where('role','Instructor')
             ->where('archived','=','0')
             ->get();

         return view('admin/home', compact('students','instructors'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function getStudentEmails()
    {
        $counter = 1;
        session()->put('counter', 1);
        $Error = '';
        return view('admin/addStudentEmails', compact('Error','counter'));
    }
    public function postStudentEmails(Request $request)
    {
        try {
                $counter = session()->get('counter');

                //Removing Duplicates
                $request['email'] = array_unique($request['email']);

            for ($i = 0; $i < count($request['email']) ; ++$i)
                 {
                    $EmailIdRole = new EmailidRole;
                    $EmailIdRole['email'] = strtolower($request['email'][$i]);
                    $EmailIdRole['role'] = 'Student';
                    $EmailIdRole->save();
                 }
                $Error = 'No';
                return view('admin/addStudentEmails',compact('Error','counter'));
            }
        catch (\Exception $e)
        {
            //Checking if its UNIQUE constraint violation
            if(in_array('23505',$e->errorInfo)) {
                $Error = 'Email Present';
                return view('admin/addStudentEmails',compact('Error','counter'));
            }
            return view ('errors/503');
        }
    }
    public function addStudentEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter + 1;
        session()->put('counter', $counter);
        $Error = '';
        return view('admin/addStudentEmails',compact('Error','counter'));

    }
    public function removeStudentEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter - 1;
        session()->put('counter', $counter);
        $Error = '';
        return view('admin/addStudentEmails',compact('Error','counter'));

    }
    public function getInstructorEmails()
    {
        $counter = 1;
        session()->put('counter', 1);
        $Error = '';
        return view('admin/addInstructorEmails', compact('Error','counter'));
    }
    public function postInstructorEmails(Request $request)
    {
        try {
                $counter = session()->get('counter');

                //Removing Duplicates
                $request['email'] = array_unique($request['email']);

                 for ($i = 0; $i < $counter; $i++)
                 {
                     $EmailIdRole = new EmailidRole;
                     $EmailIdRole['email'] = strtolower($request['email'][$i]);
                     $EmailIdRole['role'] = 'Instructor';
                     $EmailIdRole->save();
                 }
                $counter = session()->get('counter');
                $Error = 'No';
                return view('admin/addInstructorEmails',compact('Error','counter'));
            }
        catch (\Exception $e)
        {
            //Checking if its UNIQUE constraint violation
            if(in_array('23505',$e->errorInfo)) {
                $Error = 'Email Present';
                return view('admin/addInstructorEmails',compact('Error','counter'));
            }
            return view ('errors/503');
        }
    }
    public function addInstructorEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter + 1;
        session()->put('counter', $counter);
        $Error = '';
        return view('admin/addInstructorEmails',compact('Error','counter'));
    }
    public function removeInstructorEmails()
    {
        $counter = session()->get('counter');
        $counter = $counter - 1;
        session()->put('counter', $counter);
        $Error = '';
        return view('admin/addInstructorEmails',compact('Error','counter'));
    }
    public function getManageEmails()
        {
        //Fetching all students and instructors emails for admin
         $studentEmails = EmailidRole::where('role','Student')->get();

        // $studentEmails = explode(",", $studentEmails);

//         $studentEmails = str_replace(['['], '', $studentEmails);
//         $studentEmails = str_replace(['"'], '', $studentEmails);
//         $studentEmails = str_replace(['"'], '', $studentEmails);
//         $studentEmails = str_replace([']'], '', $studentEmails);

           $registered_student_emails = User::where('archived',FALSE)->pluck('email');

//         $registered_student_emails = str_replace(['['], '', $registered_student_emails);
//         $registered_student_emails = str_replace(['"'], '', $registered_student_emails);
//         $registered_student_emails = str_replace(['"'], '', $registered_student_emails);
//         $registered_student_emails = str_replace([']'], '', $registered_student_emails);

       //  $registered_student_emails = explode(",", $registered_student_emails);
         //array_pop($registered_student_emails);

         $instructorEmails = EmailidRole::where('role','Instructor')->get();
         //$studentEmails=array_diff($studentEmails,$registered_student_emails);
         return view('admin/manageEmails', compact('studentEmails','instructorEmails'));
        }

    public function getConfigureModules()
    {
        // $navs = navigation::where('parent_id', NULL)->get();
        $navs = navigation::all();
        $nav_array = array();

        foreach($navs as $key=>$nav)
        {
            if($nav->parent_id != NULL)
            {
                //$nav_array[$key] =
            }
        }
        $mods = module::where('archived', false)->get();
        $navs_mods = module_navigation::where('visible', true)->get();
        return view('admin/configureModules', compact ('navs', 'mods', 'navs_mods'));
    }

    public function submitmodule(Request $request)
    {
        //$name = request()->get("modulename");
        $module = new module;
        $module->module_name = $request->input('modulename');
        $module->archived = false;
        $module->save();
        $var = $module->module_id;

        $navs = $request->input('navs');
        foreach($navs as $navid)
        {
            //$modnav = new module_navigation;
            //$modnav->module_id = $var;
            //$modnav->navigation_id = $navid;
            //$modnav->visible = true;
            //$modnav->save();
            DB::table('modules_navigations')->insert(
                ['module_id' => $var, 'navigation_id' => $navid, 'visible' => true]);
        }

//         $navs = navigation::where('parent_id', NULL)->get();
       $navs = navigation::all();
        $mods = module::where('archived', false)->get();
        $navs_mods = module_navigation::where('visible', true)->get();
        return view('admin/configureModules', compact ('navs', 'mods', 'navs_mods'));
    }

    public function deletemodule($modid)
    {
        module::where('module_id',$modid)->update(['archived' => true]);
        $navs = navigation::where('parent_id', NULL)->get();
        $mods = module::where('archived', false)->get();
        $navs_mods = module_navigation::where('visible', true)->get();
        return view('admin/configureModules', compact ('navs', 'mods', 'navs_mods'));
    }

    public function delete_email($id)
    {
        $email = EmailidRole::find($id);
        $email->delete();
        return redirect('/ManageEmails')->with('success','Email has been  deleted');
    }

    public function archive_user($id)
    {
        User::where('id',$id)
            ->update(['archived'=> 1]);
        return redirect('/home')->with('success','Email has been  deleted');

    }

}
