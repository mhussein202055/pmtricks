<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;

class HomeController extends Controller
{

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index'
            , 'is_package_expired'
            , 'package_view'
            ,'testupload'
            , 'sendEmailCustomer'
            , 'index_termsOfSevice'
            , 'store_termsOfSevice'
            , 'securityCheck']); //default auth --->> auth:web
        

    }

    public function securityCheck(Request $req){
        if(Auth::check()){
            if(Auth::user()->id == \Session('attempt_user_id')){
                return 200;
            }else{
                Auth::logout();
                return 500;
            }
        }else{
            return 500;
        }
    }

    public function index_termsOfSevice(){
        return view('admin.termOfService');
    }

    public function store_termsOfSevice(Request $req){
        $data = \App\PaypalConfig::all()->first();
        $data->term_of_service = $req->input('terms');
        $data->save();

        return back()->with('success', 'Terms are Updated !');
    }

    public function show_inobox(){
        return view('user.inbox');
    }

    public function sendEmailCustomer(Request $req){
        $this->validate($req, [
            'name'  =>  'required',
            'email' =>  'required',
            'msg'   =>  'required'
        ]);
        $data = [
            $req->input('name'),
            $req->input('email'),
            $req->input('msg')
        ];

        Mail::to("sayed@pm-tricks.com")->send(new ContactUsMail($data));

        return \Redirect::to(route('index').'#contact_us_form')->with('success', 'Message Sent .');
    }

    public function testupload(Request $req){
        if($req->hasFile('file')){
            $x = $req->file('file')->store('public/testupload');
            return $x;
        }else{
            return 0;
        }
    }

    public function user_board(){
        
        return view('user.dashboard');
    }
    public function package_view($id){
        $package = \App\Packages::find($id);
    if($package){


        $item = (object)[];
        $item->package = $package;
        $item->users_no = count(\App\UserPackages::where('package_id', $package->id)->get());
        $total_no = 0;
        $rate = \App\Rating::where('package_id',$package->id)->get();
        $devisor = count($rate);
        foreach($rate as $i){
            $total_no+= $i->rate;
        }
        if($devisor == 0){
            $item->total_rate = 0;
        }else{
            $item->total_rate = $total_no/$devisor;
        }

        $total_quiz_num = 0;
        $total_question_num = 0;

        /**
         * included content of package generation.
         */
        $chapters_inc   = [];
        $process_inc    = [];
        $exams_inc      = [];

        $total_videos_num = 0;
        $chapter_data = (object)['question_num'=>0, 'quiz_num'=>0];
        $process_data = (object)['question_num'=>0, 'quiz_num'=>0];
        $exam_data = (object)['question_num'=>0, 'quiz_num'=>0];

        $exams = $package->exams;


        $package_total_video_time = [0,0,0]; // hr,min,sec
        $package_total_time_toString = '';
        if($package->chapter_included != '' || $package->chapter_included != null){
            $arr_chapters_id = explode(',',$package->chapter_included);

            if( !empty($arr_chapters_id)){
                $i=1;
                foreach($arr_chapters_id as $id){
                    $ch = \App\Chapters::where('id', '=', $id)->get()->first();
                    $x = (object)[];
                    $x->num = $i;
                    $x->id = $ch->id;
                    $x->name = $ch->name;
                    $x->total_hours = 0;
                    $x->total_min = 0;
                    $x->total_sec = 0;
                    $x->total_time_toString = '';

                    foreach(\App\Video::where('chapter', $ch->id)->get() as $video){
                        if($video->duration != '' && $video->duration != null){

                            $x->total_min += \Carbon\Carbon::parse($video->duration)->format('i');
                            $x->total_sec += \Carbon\Carbon::parse($video->duration)->format('s');
                            if(\Carbon\Carbon::parse($video->duration)->format('h') != 12){
                                $x->total_hours += \Carbon\Carbon::parse($video->duration)->format('h');
                            }
                        }
                    }
                    
                                        
                    $x->total_min += floor($x->total_sec / 60);
                    $x->total_sec = $x->total_sec % 60;

                    $x->total_hours += floor($x->total_min / 60);
                    $x->total_min = $x->total_min % 60;

                    
                    
                    



                    $package_total_video_time[0] += $x->total_hours;
                    $package_total_video_time[1] += $x->total_min;
                    $package_total_video_time[2] += $x->total_sec;

                    $x->total_time_toString = \Carbon\Carbon::create(2012, 1, 1, 0, 0, 0)->addHours($x->total_hours)->addMinutes($x->total_min)->addSeconds($x->total_sec)->format('H  i');

                    if(count(\App\Question::where('chapter', $ch->id)->get()) > 0){
                        $total_quiz_num++;
                        $total_question_num += count(\App\Question::where('chapter', $ch->id)->get());
                        $chapter_data->question_num += count(\App\Question::where('chapter', $ch->id)->get());
                        $chapter_data->quiz_num++;
                    }

                    array_push($chapters_inc, $x);

                    $total_videos_num += count(\App\Video::where('chapter', $id)->get());
                    $i++;
                }
            }     
        }

        $package_total_time_toString = \Carbon\Carbon::create(2012, 1, 1, 0, 0, 0)->addHours($package_total_video_time[0])->addMinutes($package_total_video_time[1])->addSeconds($package_total_video_time[2]);
        $number_of_hours = $package_total_time_toString->diffInHours(\Carbon\Carbon::create(2012, 1, 1, 0, 0, 0));
         $number_of_minutess = $package_total_time_toString->format('i');
         
         $total_time = ($number_of_hours) . ' Hr '.($number_of_minutess).' Min';
        
        if($package->process_group_included != '' || $package->process_group_included != null){
            $arr_process_id = explode(',',$package->process_group_included);
            if( !empty($arr_process_id != '')){
                $i=1;
                foreach($arr_process_id as $id){
                    $ch = \App\Process_group::where('id', '=', $id)->get()->first();
                    $x = (object)[];
                    $x->id = $ch->id;
                    $x->num = $i;
                    $x->name = $ch->name;

                    if(count(\App\Question::where('process_group', $ch->id)->get()) > 0){
                        $total_quiz_num++;
                        $total_question_num += count(\App\Question::where('process_group', $ch->id)->get());
                        $process_data->question_num += count(\App\Question::where('process_group', $ch->id)->get());
                        $process_data->quiz_num++;
                    }
                    array_push($process_inc, $x);
                    $i++;
                    
                }
            }    
        }

        if($exams != null){
            $exams = explode(',', $exams);
            $i=1;
            foreach($exams as $e){
                $x = (object)[];
                $x->id = $e;
                $x->num = $i;
                $x->name = 'Exam '.$e;
                if(count(\App\Question::where('exam_num', 'LIKE','%'.$e.'%')->get()) > 0){
                    $total_quiz_num++;
                    $total_question_num += count(\App\Question::where('exam_num', 'LIKE','%'.$e.'%')->get());
                    $exam_data->question_num += count(\App\Question::where('exam_num', 'LIKE','%'.$e.'%')->get());
                    $exam_data->quiz_num++;
                }
                array_push($exams_inc, $x);
                $i++;
                
            }
        }

        $package_total_video_time[1] += round($package_total_video_time[2]/60);
        $package_total_video_time[2] = round($package_total_video_time[2]%60);
        
        $package_total_video_time[0] += round($package_total_video_time[1]/60);
        $package_total_video_time[1] = round($package_total_video_time[1]%60);
        
        
        
        return view("Package")->with('i', $item)
        ->with('chapter_list', $chapters_inc)
        ->with('process_list', $process_inc)
        ->with('exam_list', $exams_inc)
        ->with('total_videos_num', $total_videos_num)
        ->with('total_quiz_num', $total_quiz_num)
        ->with('total_question_num', $total_question_num)
        ->with('chapter_data', $chapter_data)
        ->with('process_data', $process_data)
        ->with('exam_data', $exam_data)
         ->with('total_time', $total_time)
        ->with('package_total_video_time', $package_total_video_time);   

    }else{
        return back();
    }

    }

    public function is_package_expired($package_id){

        $package = \App\Packages::find($package_id);
        if(!$package){
            return 1;
        }

        $user_package = \App\UserPackages::where('user_id', '=' ,Auth::user()->id)->where('package_id', '=', $package_id)->get()->first();
        if(!$user_package){
            return 1;
        }

        if(\Carbon\Carbon::parse($user_package->created_at)->addDays($package->expire_in_days)->gte(\Carbon\Carbon::now())){ // original package still not expired
            return 0;
        }else{
            $extension = \App\PackageExtension::where('user_id', '=', Auth::user()->id)->where('package_id', '=', $package_id)->orderBy('expire_at', 'desc')->first();
            if(!$extension){
                return  1;
            }else{
                if(\Carbon\Carbon::parse($extension->expire_at)->gte(\Carbon\Carbon::now())){
                    return 0;
                }else{
                    return 1;
                }
            }
        }

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $package_selles_list = [];
        $packages = \App\Packages::where('popular', 1)->get();
        foreach($packages as $package){
            $item = (object)[];
            $item->package = $package;
            $item->users_no = count(\App\UserPackages::where('package_id', $package->id)->get());
            $total_no = 0;
            $rate = \App\Rating::where('package_id',$package->id)->get();
            $devisor = count($rate);
            foreach($rate as $i){
                $total_no+= $i->rate;
            }
            if($devisor == 0){
                $item->total_rate = 0;
            }else{
                $item->total_rate = $total_no/$devisor;
            }
            
            
            array_push($package_selles_list, $item);
        }

        
        for($i=0;$i<count($package_selles_list);$i++){
            $val = $package_selles_list[$i]->users_no;
            $val2 = $package_selles_list[$i]->package;
            $val3 = $package_selles_list[$i]->total_rate;

            $j = $i-1;
            while($j>=0 && $package_selles_list[$j]->users_no < $val){
                $package_selles_list[$j+1]->users_no = $package_selles_list[$j]->users_no;
                $package_selles_list[$j+1]->package = $package_selles_list[$j]->package;
                $package_selles_list[$j+1]->total_rate = $package_selles_list[$j]->total_rate;
                $j--;
            }
            $package_selles_list[$j+1]->users_no = $val;
            $package_selles_list[$j+1]->package = $val2;
            $package_selles_list[$j+1]->total_rate = $val3;
        }

        $my_courses = [];
        if(Auth::guard('web')->check()){
            $user_packages = \App\UserPackages::where('user_id', Auth::user()->id)->get();
            foreach($user_packages as $user_package){

            
                $item = (object)[];
                $item->package = \App\Packages::find($user_package->package_id);
                $item->users_no = count(\App\UserPackages::where('package_id', $user_package->package_id)->get());
                $total_no = 0;
                $rate = \App\Rating::where('package_id',$user_package->package_id)->get();
                $devisor = count($rate);
                foreach($rate as $i){
                    $total_no+= $i->rate;
                }
                if($devisor == 0){
                    $item->total_rate = 0;
                }else{
                    $item->total_rate = $total_no/$devisor;
                }
                
                if(!$this->is_package_expired($user_package->package_id)){
                    array_push($my_courses, $item);
                }
            }
        }
        // dd(array_slice($package_selles_list, 0, 4));
        return view('index')->with('best_sell', array_slice($package_selles_list, 0, 4))->with('my_courses', $my_courses);

    }

    public function showAllPackages($course_id){
        return view('packages.showAll')->with('course_id',$course_id);
    }

    public function showProfile(){
        $user_details = \App\UserDetail::where('user_id', '=', Auth::user()->id)->get()->first();
        return view('user.profile')->with('user_details', $user_details);
    }


    public function UserUpdatePasswordRequest(Request $req){
        $this->validate($req, [
            'old_password'              =>  'required|string|min:6',
            'password'                  =>  'required|string|min:6|confirmed', 
        ]);

        

        if(!\Hash::check($req->input('old_password'), Auth::user()->password)){
            return \redirect(route('show.profile').'#tab_1_3')->with('error', 'wrong password !');
        }
        $user = \App\User::find(Auth::user()->id);
        $user->password = \Hash::make($req->input('password'));
        $user->save();

        return back()->with('success', 'Password Updated');
            
    }

    public function UserUpdateProfileInfo(Request $req){
        $this->validate($req, [
            'name'      =>'required|string',
            'email'     =>'required',
            'phone'     =>'required',
            'city'      =>'required',
            // country is required , check for it later on
            'occupation'=>'required',
        ]);

        $user1 = \App\User::where('email','=',$req->input('email'))->get()->first();
        if($user1){
            if($user1->id != Auth::user()->id){
                return back()->with('error', 'this email is already in use !');
            }
        }
        
        
        $user = \App\User::find(Auth::user()->id);
        $user->name = $req->input('name');
        
        $user->email = $req->input('email');
        $user->phone = $req->input('phone');
        $user->city = $req->input('city');
        if($req->input('country') != ''){
            $user->country = $req->input('country');
        }
        $user->save();
        
        $info = \App\UserDetail::where('user_id', '=', $user->id)->get()->first();
        if(!$info){
            $info = new \App\UserDetail;
            $info->user_id = $user->id;
        }
        
        $info->interests = $req->input('interests');
        $info->occupation = $req->input('occupation');
        $info->about = $req->input('about');
        $info->fb_url = $req->input('fb_url');
        $info->tw_url = $req->input('tw_url');
        $info->website_url = $req->input('website_url');
        $info->save();

        return back()->with('success', 'Profile Updated !');
        
    }

    public function UserUpdateProfilePic(Request $req){
        $this->validate($req, [
            'profile_pic' => 'required|mimes:jpg,png,jpeg'
        ]);

        
        

        $info = \App\UserDetail::where('user_id', '=', Auth::user()->id)->get()->first();
        if(!$info){
            $info = new \App\UserDetail;
            $info->user_id = Auth::user()->id;
        }

        if($info->profile_pic){
            if(Storage::exists($info->profile_pic)){
                Storage::delete($info->profile_pic);
            }
        }

        // store the img
        $path = $req->file('profile_pic')->store('public/profile_picture');

        $info->profile_pic = $path;
        $info->save();
        return back()->with('success', 'Profile picture updated');
    }

    











}
