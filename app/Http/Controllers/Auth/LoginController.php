<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    //Overwriting post login method
    protected function redirectTo()
    {
        if (Auth::check())
        {
            $email=strtolower(Auth::user()->email);
            $role = DB::table('users')->where('email',$email)->value('role');
            
            if($role == 'Student')
                return '/StudentHome';
            if($role == 'Admin')
                return '/home';
            if($role == 'Instructor')
                return '/InstructorHome';
        }

        return '/login';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function email()
    {
        return strtolower(Input::get('email'));
    }
}
