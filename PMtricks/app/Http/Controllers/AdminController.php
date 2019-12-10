<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Payments;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\Input;
use App\Mail\PromotionMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function comments_show($page){
        $comments = \App\PageComment::where('page', $page)->pluck('comment_id')->toArray();
        $comments = \App\Comment::whereIn('id', $comments)->paginate(15);

        
        return view('admin.comments')
            ->with('page', $page)
            ->with('comments', $comments);

    }

    public function rearrange_index($course_id){
        
        return view('admin.rearrangeVideo')
            ->with('course_id', $course_id);
    }

    public function getChapterVideos(Request $req){
        
        $chapter = \App\Chapters::find($req->input('chapter_id'));
        if($chapter){
            
            $videos = \App\Video::where('chapter', $chapter->id)->orderBy('index_z')->get();
            $item = (object)[]; 
            $item->chapter_id = $chapter->id;
            $item->chapter_name = $chapter->name;
            $item->videos = $videos;
            return [$item];
            

            
        }else{
            return null;
        }
    }

    public function videoReplace(Request $req){
        $video_one = \App\Video::where('index_z', $req->input('video_one_index_z'))->get()->first();
        $video_two = \App\Video::where('index_z', $req->input('video_two_index_z'))->get()->first();
        $switch = 0;

        if($video_one && $video_two){
            $switch = $video_one->index_z;
            $video_one->index_z = $video_two->index_z;
            $video_one->save();
            $video_two->index_z = $switch;
            $video_two->save();
            

            return 0;
        }

        return 1;


    }

    public function statics_query(Request $req){
        return $this->statics_index($req->input('course_id'), $req->input('year'), $req->input('month'), $req->input('package_id'));
    }
    public function statics_index($course_id, $year,  $month, $package_id){

        if($package_id == 'all'){
            $package_id_array = \App\Packages::where('course_id', $course_id)->pluck('id')->toArray();
            $payment_id_array = \App\PaymentApproveHistory::whereIn('package_id', $package_id_array)->pluck('payment_id')->toArray();
        }else{
            $payment_id_array = \App\PaymentApproveHistory::where('package_id', $package_id)->pluck('payment_id')->toArray();
        }

        
        // array of payment to which filters (year, month) , will apply
        $payments = \App\Payments::whereIn('id',$payment_id_array)->where('complete', 1)->get();


        
        
        if($year != 'all'){
            $payments = $payments->filter(function($payment) use($year){
                return \Carbon\Carbon::parse($payment->created_at)->year == $year;
            });
        }

        if($month != 'all'){
            $payments = $payments->filter(function($payment) use($month){
                return \Carbon\Carbon::parse($payment->created_at)->month == $month;
            });
        }
        
        /**
         * required data
         */
        $manual_payments = $payments->filter(function($payment){
            return $payment->paymentMethod == 'manual';
        });


        $paypal_payments = $payments->filter(function($payment){
            return ($payment->paymentMethod == 'paypal') || ($payment->paymentMethod == 'coupon');
        });
        

        return view('admin.statics')
            ->with('course_id', $course_id)
            ->with('year', $year)
            ->with('month', $month)
            ->with('package_id', $package_id)
            ->with('payments', $payments)
            ->with('paypal_payments', $paypal_payments)
            ->with('manual_payments', $manual_payments);
    }

    public function promotion_send(Request $req){

        $failToSendArray = [];

        $this->validate($req, [
            'package_id'    =>  'numeric|required',
            'msg'           =>  'required'
        ]);


        $package_id = $req->package_id;
        $users = \App\User::all()->filter(function($i) use($package_id) {
            $user_package = \App\UserPackages::where('user_id', $i->id)->where('package_id', $package_id)->get()->first();
            return $user_package != null;
        });
        
        foreach($users as $u){
            // send email to each one
            try{
                Mail::to($u->email)->send(new PromotionMail($req->input('msg')));
            }catch(\Exception $e){
                array_push($failToSendArray, $u);
            }

            // send notification to each user
            $user_local_msg = new \App\Message;
            $user_local_msg->from_user_id   = Auth::user()->id; 
            $user_local_msg->from_user_type = 'admin';
            $user_local_msg->to_user_id     = $u->id;
            $user_local_msg->to_user_type   = 'user';
            $user_local_msg->message        = $req->input('msg');
            $user_local_msg->save();
            
            
        }

        if(count($failToSendArray)){
            $sent_to = count($users)-count($failToSendArray);
            return back()->with('error', 'Fail to Send :'.count($failToSendArray).', Sent: '.$sent_to.' Emails');
        }else{
            return back()->with('success', 'Promotion Sent to total '.count($users).' User');
        }


    }

    public function promotion_view(){
        return view('admin.promotion');
    }


    public function FeedbackView(){
        return view('admin.feedbackView');
    }

    public function toggle_feedback($id){
        $feed = \App\Feedback::find($id);

        if($feed){
            if($feed->disable == 1){
                $feed->disable = 0;
                $feed->save();

                return back()->with('success', 'Feedback Enabled.');
            }else{
                $feed->disable = 1;
                $feed->save();

                return back()->with('error', 'Feedback Disabled');    
            }
        }else{
            return back()->with('error');
        }
    }

    public function FlashCard_update(Request $req, $id){
        $this->validate($req, [
            'title'=>'required',
            'contant'=>'required'
        ]);

        $f = \App\FlashCard::find($id);
        $f->title = $req->input('title');
        if($req->hasFile('img')){
            if(Storage::exists($f->img)){
                Storage::delete($f->img);
            }
            $f->img = $req->file('img')->store('public/flashcard');
        }
        $f->contant = $req->input('contant');
        $f->save();

        return back()->with('success','Item updated successfully.');
        
    }

    public function FlashCard_edit($id){
        return view('admin.FlashCard_edit')->with('f',\App\FlashCard::find($id));
    }

    public function faq_update(Request $req, $id){
        
        $this->validate($req, [
            'title'=>'required',
            'contant'=>'required'
        ]);

        $f = \App\FAQ::find($id);
        $f->title = $req->input('title');
        $f->contant = $req->input('contant');
        $f->save();

        return back()->with('success','New FAQ has been added .');
    }

    public function faq_edit($id){
        return view('admin.FAQ_edit')->with('q',\App\FAQ::find($id));
    }


    public function material_delete($id){
        $f = \App\Material::find($id);
        if($f){  
            
            $url = $f->file_url;
            $video = \App\Video::where('attachment_url', '=', $url)->get()->first();

            
            if(!$video){
                if($f->file_url != null){
                    if(Storage::exists($f->file_url)){
                        Storage::delete($f->file_url);
                    }
                }
                $f->delete();
                return back()->with('success', 'deleted !');
            }else{
                return back()->with('error', 'this material is already in use !');
            }

            
        }else{
            return back()->with('success', 'deleted !');
        }
    }

    public function studyPlan_delete($id){
        $f = \App\StudyPlan::find($id);
        if($f){   
            if($f->video_url != null){
                if(Storage::exists($f->video_url)){
                    Storage::delete($f->video_url);
                }
            }
            $f->delete();
            return back()->with('success', 'deleted !');
        }else{
            return back()->with('success', 'deleted !');
        }
    }

    public function FlashCard_delete($id){
        $f = \App\FlashCard::find($id);
        if($f){   
            if($f->img != null){
                if(Storage::exists($f->img)){
                    Storage::delete($f->img);
                }
            }
            $f->delete();
            return back()->with('success', 'deleted !');
        }else{
            return back()->with('success', 'deleted !');
        }
    }

    public function faq_delete($id){
        $faq = \App\FAQ::find($id);
        if($faq){   
            $faq->delete();
            return back()->with('success', 'deleted !');
        }else{
            return back()->with('success', 'deleted !');
        }
    }

    public function faq_add(Request $req){
        $this->validate($req, [
            'title'=>'required',
            'contant'=>'required'
        ]);

        $f = new \App\FAQ;
        $f->title = $req->input('title');
        $f->contant = $req->input('contant');
        $f->save();

        return back()->with('success','New FAQ has been added .');
        
    }

    public function faq_show(){
        return view('admin.FAQ');
    }

    

    public function flashCard_show(){
        return view('admin.flashCard');
    }

    public function flashCard_add(Request $req){
        $this->validate($req, [
            'title'=>'required',
            'contant'=>'required'
        ]);

        $f = new \App\FlashCard;
        $f->title = $req->input('title');
        if($req->hasFile('img')){
            $f->img = $req->file('img')->store('public/flashcard');
        }
        $f->contant = $req->input('contant');
        $f->save();

        return back()->with('success','New FlashCard has been added .');
    }

    public function studyPlan_show(){
        return view('admin.studyPlan');
    }

    public function studyPlan_add(Request $req){
        $this->validate($req, [
            'title' => 'required',
            'course_id' => 'required|numeric',
            'description' => 'required'
        ]);

        if(!$req->hasFile('video')){
            return back()->with('error', 'Video file is required');
        }

        $s = new \App\StudyPlan;
        $s->title = $req->input('title');
        $s->description = $req->input('description');
        $s->course_id = $req->input('course_id');
        $s->video_url = $req->file('video')->store('public/studyPlan');
        $s->save();

        return back()->with('success', 'New Study Plan has been loaded successfully');
    }

    public function material_add(Request $req){
        
        $this->validate($req,[
            'title'=>'required',
            'course_id'=>'required|numeric',
        ]);

        if(!$req->hasFile('file')){
            return back()->with('error', 'File is required !');
        }

        $m = new \App\Material;
        $m->title = $req->input('title');
        $m->course_id = $req->input('course_id');
        $m->file_url = $req->file('file')->store('public/material');
        $m->save();
        return back()->with('success', 'Saved.');
    }

    public function material_show(){
        return view('admin.material');
    }



    public function ScreenShotView(){
        
        return view('admin.screenshot');
    }


    public function searchByEmail(){
        $users = \App\User::where('email', 'LIKE', '%'.Input::get('email').'%' )->paginate(25);
        return view('admin.users')->with('users', $users)->with('email', Input::get('email'));
    }

    public function searchByPackage(){
        $userPackage = \App\UserPackages::where('package_id','=', Input::get('package_id'))->get();
        $ids = [];
        foreach ($userPackage as $user){
            array_push($ids, $user->user_id);
        }

        $users = \App\User::whereIn('id', $ids)->paginate(25);
        return view('admin.users')->with('users', $users)->with('package_id', Input::get('package_id'));

    }


    public function manual_add_package($user_id){
        $user = User::find($user_id);
        return view('admin.ManualAddPackage')->with('user', $user);
    }

    public function manual_add_package_post(Request $req){
        if($req->input('package_id') == 'null' || $req->input('package_id') == ''){
            return back()->with('error', 'Please, select a package !');
        }
        

        // create a virual payment
        $payment = new Payments;
        $payment->user_id = $req->input('user_id');
        $payment->totalPaid = \App\Packages::find($req->input('package_id'))->price;
        $payment->paypalEmail = \App\User::find($req->input('user_id'))->email;
        $payment->paymentMethod = 'manual';
        $payment->complete = 1;
        $payment->save();

        // add to approve history
        $approve = new \App\PaymentApproveHistory;
        $approve->payment_id = $payment->id;
        $approve->package_id = $req->input('package_id');
        $approve->user_id = $req->input('user_id');
        $approve->save();
        
        // add to user_packages 
        $user_package = new \App\UserPackages;
        $user_package->user_id = $req->input('user_id');
        $user_package->package_id = $req->input('package_id');
        $user_package->save();

        $package = \App\Packages::find($user_package->package_id);
        try{
            Mail::to(\App\User::find($user_package->user_id)->email)->send(new \App\Mail\EnrollConfirmationMail($package->enroll_msg));
        }catch(\Exception $e){
            /**
             * do nothing !
             */
        }

        return back()->with('success', 'New Package has been added.');
    }


    public function disabled_users_view(){
        return view('admin.disabled-users');
    }
    public function user_disable(Request $req, $user_id){
        $user = \App\User::find($user_id);
        $disUser = new \App\DisabledUser;
        $disUser->user_id = $user->id;
        $disUser->name = $user->name;
        $disUser->email = $user->email;
        $disUser->city = $user->city;
        $disUser->country = $user->country;
        $disUser->phone = $user->phone;
        $disUser->last_login = $user->last_login;
        $disUser->last_action = $user->last_action;
        $disUser->last_ip = $user->last_ip;
        $disUser->password = $user->password;
        $disUser->remember_token = $user->remember_token;
        $disUser->created_at = $user->created_at;
        $disUser->updated_at = $user->updated_at;
        $disUser->save();
        $user->delete();
        return back()->with('success', 'User Disabled !');
    }

    public function user_enable(Request $req, $id){
        // $id is the field id in the table , not the user id 
        $disabled = \App\DisabledUser::find($id);
        $user = new \App\User;
        $user->id = $disabled->user_id;
        $user->name = $disabled->name;
        $user->email = $disabled->email;
        $user->city = $disabled->city;
        $user->country = $disabled->country;
        $user->phone = $disabled->phone;
        $user->last_login = $disabled->last_login;
        $user->last_action = $disabled->last_action;
        $user->last_ip = $disabled->last_ip;
        $user->password = $disabled->password;
        $user->remember_token = $disabled->remember_token;
        $user->created_at = $disabled->created_at;
        $user->updated_at = $disabled->updated_at;
        $user->save();

        $disabled->delete();
        return back()->with('success', 'User Enabled !');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // calculate the question number
        $q_num = count(Question::all());

        //total orders number
        $o_num = count(Payments::where('complete','=', 1)->get());

        // total users 
        $u_num = count(User::all());

        //total profit
        $p_num = 0;
        foreach(Payments::where('complete', '=', 1)->get() as $pay){
            $p_num += $pay->totalPaid;
        }


        return view('admin')
            ->with('q_num', $q_num)
            ->with('o_num', $o_num)
            ->with('u_num', $u_num)
            ->with('p_num', $p_num);
    }

    public function allUsersIndex(){
        $users = \App\User::orderBy('last_action','desc')->orderBy('created_at', 'desc')->paginate(25);
        return view('admin.users')->with('users', $users);
    }

    public function payment_approve_index(){
        return view('admin.paymentApprove');
    }

    public function payment_approve(Request $req, $approve_id){
        $approve = \App\PaymentApprove::find($approve_id);
        if(!$approve){
            return Redirect::to(route('payment.approve.index'))->with('error','Cant find such a Approve id !');
        }

        $payment = \App\Payments::find($approve->payment_id);
        $payment->complete = 1;
        $payment->save();

        $up = \App\UserPackages::where('package_id', '=', $approve->package_id)->where('user_id','=',$approve->user_id)->get();
        if($up->first()){
            return Redirect::to(route('payment.approve.index'))->with('error','The User Already have this Package !');
        }
        
        $up = new \App\UserPackages;
        $up->package_id = $approve->package_id;
        $up->user_id = $approve->user_id;
        $up->save();


        /** Store in history */
        $history = new \App\PaymentApproveHistory;
        $history->user_id = $approve->user_id;
        $history->package_id = $approve->package_id;
        $history->payment_id = $approve->payment_id;
        if($approve->img){
            $history->img = $approve->img;    
        }else{
            $history->img = null;
        }
        $history->save();

        $package = \App\Packages::find($approve->package_id);
        try{
            Mail::to($approve->user_id)->send(new \App\Mail\EnrollConfirmationMail($package->enroll_msg));
        }catch(\Exception $e){
            /**
             * do nothing !
             */
        }

        $approve->delete();
        return Redirect::to(route('payment.approve.index'))->with('success','Payment Approved !');
    }

    public function payment_cancel(Request $req, $approve_id){
        $approve = \App\PaymentApprove::find($approve_id);
        if(!$approve){
            return Redirect::to(route('payment.approve.index'))->with('error','Cant find such a Approve id !');
        }

        // $payment = \App\Payments::find($approve->payment_id);
        
        
        $approve->delete();
        
        

        return Redirect::to(route('payment.approve.index'))->with('error','Payment Canceled !');


    }

    public function extension_payment_approve_index(){
        return view('admin.extensionApprove');
    }

    public function extension_payment_approve(Request $req, $approve_id){
        $approve = \App\PaymentExtensionApprove::find($approve_id);
        if(!$approve){
            return Redirect::to(route('extension.payment.approve.index'))->with('error','Cant find such a Approve id !');
        }

        $package = \App\Packages::find($approve->package_id);
        if(!$package){
            return back()->with('error','package not found !');
        }

        
        $payment = \App\Payments::find($approve->payment_id);
        

        /**
         * update extension table
         */
        $expire_at = \Carbon\Carbon::now()->addDays($package->expire_in_days);

        $exten = new \App\PackageExtension;
        $exten->user_id = $approve->user_id;
        $exten->payment_id = $payment->id;
        $exten->package_id = $package->id;
        $exten->expire_at = $expire_at;
        $exten->save();


        $history = \App\ExtensionHistory::where('user_id','=', $approve->user_id)->where('package_id', '=', $package->id)->get()->first();
        if(!$history){
            $history = new \App\ExtensionHistory;
            $history->package_id = $package->id;
            $history->user_id = $approve->user_id;
            $history->extend_num = 0;
        }
        $history->extend_num += $package->extension_in_days;
        $history->save();

        $approve->delete();

        return back()->with('success', 'Payment Approved !');
    }  

    public function extension_payment_cancel(Request $req, $approve_id){
        $approve = \App\PaymentExtensionApprove::find($approve_id);
        if(!$approve){
            return Redirect::to(route('extension.payment.approve.index'))->with('error','Cant find such a Approve id !');
        }

        
        
        $approve->delete();
        
        

        return Redirect::to(route('extension.payment.approve.index'))->with('error','Payment Canceled !');
    }
}
