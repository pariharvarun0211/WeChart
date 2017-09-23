<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class EditProfileController extends Controller
{
	function getEditProfile()
	{
		try {
		    //$IsSecurityQuestionsEditable = false;
			$email=Auth::user()->email;
			$user = User::where('email', $email)->first();
			$securityquestions = DB::table('security')->select('id','security_question')->get();
			$security_question1 = DB::table('security') -> where('id', $user->security_question1_Id) -> value('security_question');
			$security_question2 = DB::table('security') -> where('id', $user->security_question2_Id) -> value('security_question');
			$security_question3 = DB::table('security') -> where('id', $user->security_question3_Id) -> value('security_question');

            $Profilesubmitted='';
			return view('auth/editprofile',compact('Profilesubmitted','user', 'securityquestions', 'security_question1', 'security_question2', 'security_question3'));
		}
		catch (Exception $e)
		{
			return view ('errors/503');
		}
	}

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function postEditProfile(Request $request)
	{
			try {
                $this->validate($request, [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'contactno' => 'optional|numeric',
                    //'security_question1' => 'required',
                    //'security_question2' => 'required',
                    //'security_question3' => 'required',
                    //'security_answer1' => 'required',
                    //'security_answer2' => 'required',
                    //'security_answer3' => 'required',
                ]);


//			$user= new User($request->all());
//			$email= Auth::user()->email;
//          $user = User::where('email', $email)->first();
//			$user->update($request->all());
                $ProfileSubmitted = 'Yes';
                $email = Auth::user()->email;
                $user = User::where('email', $email)->first();
                //$request1 = $request->except('role');
                $user->update($request->all());
                $securityquestions = DB::table('security')->select('id', 'security_question')->get();
                $security_question1 = DB::table('security')->where('id', $user->security_question1_Id)->value('security_question');
                $security_question2 = DB::table('security')->where('id', $user->security_question2_Id)->value('security_question');
                $security_question3 = DB::table('security')->where('id', $user->security_question3_Id)->value('security_question');
                return view('auth/editprofile', compact('ProfileSubmitted', 'user', 'securityquestions', 'security_question1', 'security_question2', 'security_question3'));
                //return view ('auth/login');
            }
            catch (Exception $e)
            {
                return view ('errors/503');

            }

	}
}