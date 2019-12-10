<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';
    protected $username = 'email';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(Request $request)
    {
        \Session(['process' => 'login']);
        $attmpt_user = \App\User::where('email', $request->input('email'))->get()->first();
        if($attmpt_user){
            \Session(['attempt_user_id' => $attmpt_user->id]);    
        }else{
            \Session(['attempt_user_id' => 'not_found']);    
        }
        
        
        
        
        $this->validateLogin($request);
        
        
        

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        
        // if ($this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

        //     return $this->sendLockoutResponse($request);
        // }


        if ($this->attemptLogin($request)) {
            
            if(\Session('attempt_user_id') != Auth::user()->id && Auth::guard('web')->check() )
            {
                \Storage::append('loginErrorLog.txt', '['.\Carbon\Carbon::now().'] - User_ID_Bad[authenticatesUsers] - Session_id: '.\Session('attempt_user_id').' - logged_in_id: '.Auth::user()->id);   
                Auth::logout();
                return back()->with('error', 'Authentication Error, Please try Again!');
            }else{
                // \Storage::append('loginErrorLog.txt', '['.\Carbon\Carbon::now().'] - User_ID_Correct[authenticatesUsers] - Session_id: '.\Session('attempt_user_id').' - logged_in_id: '.Auth::user()->id);   
            }
            
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    
    protected function sendLoginResponse(Request $request)
    {
        
        // 
        
        $loginUser = \App\User::find($request->session()->get('attempt_user_id'));
        if($loginUser)
        {
            if(Auth::user()->id != $loginUser->id && Auth::guard('web')->check() )
            {
                \Storage::append('loginErrorLog.txt', '['.\Carbon\Carbon::now().'] - [loginController][ERROR] Atempted_from_user: '.$request->session()->get('attempt_user_id').' - Logged_In_user: '.Auth::user()->id);
                Auth::logout();
                return back()->with('error', 'Authentication Error, Please try Again!');
            }    
        }
        else
        {
            if(Auth::guard('web')->check()){
                \Storage::append('loginErrorLog.txt', '['.\Carbon\Carbon::now().'] - [loginController][ERROR] User_id_not_found: '.$request->session()->get('attempt_user_id'));
                Auth::logout();
                return back()->with('error', 'Authentication Error, Please try Again!');
            }
        }
        

        $request->session()->regenerate();
        
        
        if(Auth::user()->id != $loginUser->id && Auth::guard('web')->check())
        {
            \Storage::append('loginErrorLog.txt', '['.\Carbon\Carbon::now().'] - [loginController|afterRegenerate][ERROR] Atempted_from_user: '.$request->session()->get('attempt_user_id').' - Logged_In_user: '.Auth::user()->id);
            Auth::logout();
            return back()->with('error', 'Authentication Error, Please try Again!');
        }    
        

        // one device per account !
        $previous_session = Auth::user()->last_session_id;
        if($previous_session){
            \Session::getHandler()->destroy($previous_session);
        }
        Auth::user()->last_session_id = \Session::getId();
        Auth::user()->save();


        

        $this->clearLoginAttempts($request);

        if($request->has('prev_url')){
            return \Redirect::to($request->input('prev_url'));
        }

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }


}
