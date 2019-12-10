<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

        

        try{

            

            $user = \App\User::find($event->user->id);
            $user->last_action = 'loged in';
            $user->last_ip     = getenv('REMOTE_ADDR');
            $user->last_login  = date('Y-m-d H:i:s');
            $user->save();    
            
            
            if(\Session('attempt_user_id') != $event->user->id && Auth::guard('web')->check()){
                \Storage::append('loginErrorLog.txt', '['.\Carbon\Carbon::now().'] - [listener][ERROR] Atempted_from_user: '.\Session('attempt_user_id').' - Logged_In_user: '.$event->user->id);
                Auth::logout();
                return back()->with('error', 'Authentication Error, Please try Again!');
            }
            
            
        }catch(\Exception $ex){
            
        }
        


        
        
    }
}
