<?php
/*
 Developer - Varun Parihar
 Date - 09/23/2017
 Description - Controller Code for Edit Profile functionality.
*/
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
                $email = Auth::user()->email;
                $user = User::where('email', $email)->first();
                $securityquestions = DB::table('security')->select('id', 'security_question')->get();
                $security_question1 = DB::table('security')->where('id', $user->security_question1_Id)->value('security_question');
                $security_question2 = DB::table('security')->where('id', $user->security_question2_Id)->value('security_question');
                $security_question3 = DB::table('security')->where('id', $user->security_question3_Id)->value('security_question');
                array_add($request->all(), 'role', $user->role);
                array_add($request->all(), 'security_question1_Id', $user->security_question1_Id);
                array_add($request->all(), 'security_question2_Id', $user->security_question2_Id);
                array_add($request->all(), 'security_question3_Id', $user->security_question3_Id);
                $user->update($request->all());
                $Profilesubmitted = 'Yes';

                return view('auth/editprofile', compact('Profilesubmitted', 'user', 'securityquestions', 'security_question1', 'security_question2', 'security_question3'));
            }

            catch (\Exception $e)
            {
                return view ('errors/503');

            }

	}
}
