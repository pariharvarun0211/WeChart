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

			return view('auth/editprofile',compact('user', 'securityquestions', 'security_question1', 'security_question2', 'security_question3'));
		}
		catch (Exception $e)
		{
			return view ('errors/503');

		}
	}

	protected function postEditProfile(Request $request)
	{
		try {
			$this->validate($request, [
				'firstname' => 'required',
				'lastname' => 'required',
				'contactno' => 'required|numeric',
				//'security_question1' => 'required',
				//'security_question2' => 'required',
                //'security_question3' => 'required',
                //'security_answer1' => 'required',
                //'security_answer2' => 'required',
                //'security_answer3' => 'required',
			]);


			$user= new User($request->all());
			$email=Auth::user()->email;
            $user = User::where('email', $email)->first();
			$user->update($request->all());

			return view('auth/profileupdated');
		}
		catch (\Exception $e)
		{
			return view ('errors/503');

		}
	}
}