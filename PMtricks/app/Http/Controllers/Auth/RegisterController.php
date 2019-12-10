<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        \Session(['process' => 'register']);

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:disabled_users',
            'password' => 'required|string|min:6|confirmed',
            'country' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|numeric|unique:users|unique:disabled_users',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'],
            'city' => $data['city'],
            'phone' => $data['phone'],
            'last_login' => date('Y-m-d H:i:s'),
            'last_ip' => getenv('REMOTE_ADDR'),
            'last_action' => 'loged in',
        ]);
        
        $i = [
            'name' => $data['name']
        ];

        Mail::to($data['email'])->send(new Welcome($i));

        $new_msg = new \App\Message;
        $new_msg->from_user_id = \App\Admin::all()->first()->id;
        $new_msg->from_user_type = 'admin';
        $new_msg->to_user_id = $user->id;
        $new_msg->to_user_type = 'user';
        $new_msg->message = 'Dear, '.$user->name.'<br>Welcome To PM-Tricks.';
        $new_msg->save();

        $detail = \App\UserDetail::where('user_id', $user->id)->get()->first();
        if(!$detail){
            $detail = new \App\UserDetail;
            
        }

        $detail->user_id = $user->id;
        $detail->save();



        \Session(['attempt_user_id' => $user->id]);    

        return $user;
        
        

    }
}
