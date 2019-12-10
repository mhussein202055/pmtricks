<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// use Illuminate\Http\Request;




Route::get('/Video/Secure/{id}/{package_id}', 'VideoStreamController@stream_video')->middleware('auth')->name('tv');


Route::get('QuizHistory/review/{id}', 'Users\PremiumQuizController@QuizHistory_show')->middleware('auth')->name('QuizHistory.show');
Route::post('QuizHistory/review/load', 'Users\PremiumQuizController@QuizHistory_load')->middleware('auth')->name('QuizHistory.load');





Route::get('PublicFAQ', function(){
    return view('faq');
})->name("public.faq");
Route::get('/', 'HomeController@index')->name('index');

Route::get('user/dashboard', 'HomeController@user_board')->name('user.dashboard');

Route::get('/PackageByCourse', function(){
    $package_selles_list = [];
    $course_id = Illuminate\Support\Facades\Input::get('course_id');
    $packages = \App\Packages::where('course_id', $course_id)->get();
    if($packages->first()){

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

        return view('PackageByCourse')->with('best_sell', $package_selles_list);

    }else{
        return back();
    }
    return view('PackageByCourse');
})->name('package.by.course');







Route::get('/mobileVersion', function(){
    return view('indexNoLogin');
});


Route::get('/package/view/{id}', 'HomeController@package_view')->name('public.package.view');

Auth::routes();

Route::get('/home', function(){
    // return view('packages.showAll',2);
    return \Redirect::to(route('my.package.view',['all','all']));

    
})->name('home');

Route::prefix('admin')->group(function(){
    // login interfaces and home pages
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('', 'AdminController@index')->name('admin.dashboard');
    // question management
    Route::resource('question', 'QuestionsController');
    Route::get('/questions', 'QuestionsController@search')->name('question.search');
    Route::post('/question/create', 'QuestionsController@store')->name('question.store');  
    // Route::get('/question/review/{title}/{a}/{b}/{c}/{d}', 'QuestionsController@showReview')->name('question.review');
    //section handle creation of question form ..

    Route::post('/question/searchCourse', 'QuestionsController@searchCourse')->name('question.searchCourse');   
    Route::post('/question/searchChapter', 'QuestionsController@searchChapter')->name('question.searchChapter');
    Route::post('/question/searchPMG', 'QuestionsController@searchPMG')->name('question.searchPMG');
    Route::post('/question/showProcess', 'QuestionsController@showProcess')->name('question.showProcess');

    Route::resource('video', 'VideoController');
    Route::get('/videos','VideoController@search')->name('video.search');

    
    // admin password reset 
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    // chapters and process groups management
    Route::get('/chapter_pgroup', 'ChapterManagerController@index')->name('chapterManager.show');
    Route::post('/chapter_pgroup', 'ChapterManagerController@add')->name('chapterManager.add');
    Route::delete('/chapter_pgroup', 'ChapterManagerController@delete')->name('chapterManager.delete');
    // Packages Management 
    Route::resource('packages', 'packageController');
    Route::get('paypal/config', 'PayPalController@index')->name('paypal.config.index');
    Route::post('paypal/config', 'PayPalController@update')->name('paypal.config.store');

    Route::get('/inbox','MessageController@adminIndex')->middleware('auth:admin')->name('admin.inbox');
    Route::post('/inbox', 'MessageController@adminSend')->middleware('auth:admin')->name('admin.sendMessage');
    
    Route::get('/AllUsers', 'AdminController@allUsersIndex')->name('showAllUsers');
    Route::get('/AllUsers/search/', 'AdminController@searchByEMail')->name('search.user.by.email');
    Route::get('/AllUsers/search/package', 'AdminController@searchByPackage')->name('search.user.by.package');

    Route::get('/disabled/users','AdminController@disabled_users_view')->name('disabled.user.view');

    Route::get('/payment_approve', 'AdminController@payment_approve_index')->name('payment.approve.index');
    Route::get('/payment_approve/approve/{approve_id}', 'AdminController@payment_approve')->name('payment.approve.approve');
    Route::get('/payment_approve/cancel/{approve_id}', 'AdminController@payment_cancel')->name('payment.approve.cancel');

    Route::get('/extension_payment_approve', 'AdminController@extension_payment_approve_index')->name('extension.payment.approve.index');
    Route::get('/extension_payment_approve/approve/{approve_id}', 'AdminController@extension_payment_approve')->name('extension.payment.approve');
    Route::get('/extension_payment_appprove/cancel/{approve_id}', 'AdminController@extension_payment_cancel')->name('extension.payment.cancel');

    Route::get('/user/disable/{user_id}', 'AdminController@user_disable')->name('admin.user.disable');
    Route::get('/user/enable/{user_id}', 'AdminController@user_enable')->name('admin.user.enable');
    Route::get('/user/add_package/{user_id}', 'AdminController@manual_add_package')->name('admin.user.manual.add.package');
    Route::post('/user/add_package/', 'AdminController@manual_add_package_post')->name('admin.user.manual.add.package.post');

    /*
        Screen shot 
    */
    Route::get('/ScreenShot', 'AdminController@ScreenShotView')->name('ScreenShotAttempts');


    /*
        Coupons
    */
    Route::get('/coupons/create', 'CouponController@create_coupons')->middleware('auth:admin')->name('coupon.create');
    Route::post('/coupons/generate','CouponController@generate')->middleware('auth:admin')->name('coupon.generate');
    Route::get('/coupons', 'CouponController@show')->middleware('auth:admin')->name('coupon.show');
    Route::get('/coupons/delete/{id}', 'CouponController@destroy')->middleware('auth:admin')->name('coupon.destroy');

    /**
     * add material
     */
    Route::get('/material/add', 'AdminController@material_show')->middleware('auth:admin')->name('material.show.admin');
    Route::post('/material/add', 'AdminController@material_add')->middleware('auth:admin')->name('material.add');
    Route::get('/material/delete/{id}', 'AdminController@material_delete')->middleware('auth:admin')->name('material.delete');

    /**
     * study plan
     */
    Route::get('/StudyPlan/add', 'AdminController@studyPlan_show')->middleware('auth:admin')->name('studyPlan.show.admin');
    Route::post('/StudyPlan/store', 'AdminController@studyPlan_add')->middleware('auth:admin')->name('studyPlan.add');
    Route::get('/StudyPlan/delete/{id}', 'AdminController@studyPlan_delete')->middleware('auth:admin')->name('studyPlan.delete');
    /**
     * Flash Card
     */
    Route::get('/FlashCard/add', 'AdminController@flashCard_show')->middleware('auth:admin')->name('flashCard.show.admin');
    Route::post('/FlashCard/store', 'AdminController@flashCard_add')->middleware('auth:admin')->name('flashCard.add');
    Route::get('/FlashCard/delete/{id}', 'AdminController@FlashCard_delete')->middleware('auth:admin')->name('flashCard.delete');
    Route::get('/FlashCard/edit/{id}', 'AdminController@FlashCard_edit')->middleware('auth:admin')->name('flashCard.edit');
    Route::post('/FlashCard/edit/{id}', 'AdminController@FlashCard_update')->middleware('auth:admin')->name('flashCard.update');

    /** 
     * FAQs
     */
    Route::get('/FAQ/add','AdminController@faq_show')->middleware('auth:admin')->name('faq.show.admin');
    Route::post('/FAQ/store','AdminController@faq_add')->middleware('auth:admin')->name('faq.add');
    Route::get('/FAQ/delete/{id}', 'AdminController@faq_delete')->middleware('auth:admin')->name('faq.delete');
    Route::get('/FAQ/edit/{id}', 'AdminController@faq_edit')->middleware('auth:admin')->name('faq.edit');
    Route::post('/FAQ/edit/{id}', 'AdminController@faq_update')->middleware('auth:admin')->name('faq.update');

    Route::get('/users/FeedBack', 'AdminController@FeedbackView')->name('users.feedback.view');
    Route::get('/users/feedback/disable/{id}', 'AdminController@toggle_feedback')->name('users.feedback.disable.toggle');
});

Route::post('/makeallasreadnotifications', function(){
    $all= \App\Notification::where('sight','=','0')->get();
    foreach($all as $i){
        $i->sight = 1;
        $i->save();
    }
})->name('MakeRead');

Route::post('/makeallasreadmessages', function(){
    $all= \App\Message::where('sight','=','0')->where('to_user_id','=',Auth::user()->id)->get();
    foreach($all as $i){
        $i->sight = 1;
        $i->save();
    }
})->name('MakeReadMsg');
Route::post('/admin/makeallasreadmessages', function(){
    $all= \App\Message::where('sight','=','0')->where('to_user_type','=','admin')->get();
    foreach($all as $i){
        $i->sight = 1;
        $i->save();
    }
})->name('MakeReadMsg.admin');



/**
 * Free Quiz
 */


Route::get('/allPackages/course/{id}','HomeController@showAllPackages')->name('showAllPackages');


Route::get('/quiz', 'Users\QuizController@index')->name('FreeQuiz');
Route::post('/quiz/generate', 'Users\QuizController@generate')->name('quiz.generate');
Route::post('/quiz/reloadQuestionsNumber', 'Users\QuizController@reloadQuestionsNumber')->name('quiz.reloadQuestionsNumber');
Route::get('/quiz/feedback/{id}', 'Users\QuizController@showFeedback')->name('feedback');

Route::get('/Free/Video', 'Users\QuizController@videoIndex')->name('video.index.free');
Route::get('/Free/Video/{video_id}', 'Users\QuizController@videoShow')->name('video.show.free');

Route::get('/contactAdmin', 'MessageController@userIndex')->name('user.index')->middleware('auth');
Route::post('/contactAdmin/post', 'MessageController@userSend')->name('user.send')->middleware('auth');

/**
 * Premium Quiz
 */
Route::get('/PremiumQuiz/exams', 'Users\PremiumQuizController@indexSt1')->name('PremiumQuiz-st1');
Route::get('/PremiumQuiz/videos', 'Users\PremiumQuizController@indexSt1Video')->name('PremiumQuiz-st1-videos');

Route::get('/my_packages/{type}/cat/{cat}', 'Users\PremiumQuizController@myPackages_view')->name('my.package.view');


Route::post('/PremiumQuiz/generate', 'Users\PremiumQuizController@generate')->name('PremiumQuiz.generate');
Route::get('/PremiumQuiz/{package_id}', 'Users\PremiumQuizController@reloadTopics')->name('PremiumQuiz-st2');
Route::get('/PremiumQuiz/video/{package_id}', 'Users\PremiumQuizController@reloadTopics_video')->name('PremiumQuiz-st2Vid');
Route::get('/PremiumQuiz/{package_id}/{topic}/{topic_id}/preview/{quiz_id}', 'Users\PremiumQuizController@reloadQuestionsNumber')->name('PremiumQuiz-st3');
Route::post('/PremiumQuiz/score/store', 'Users\PremiumQuizController@scoreStore')->name('PremiumQuiz.scoreStore');
Route::get('/PremiumQuiz/score/history', 'Users\PremiumQuizController@scoreHistory')->name('scoreHistory');
Route::get('/PremiumQuiz/feedback/{id}', 'Users\PremiumQuizController@showFeedback')->name('feedback')->middleware('auth');
Route::post('/PremiumQuiz/store/answers','Users\PremiumQuizController@SaveAnswersForLaterOn')->name('saveForLaterOn');
Route::get('/PremiumQuiz/reset_package/{package_id}', 'Users\PremiumQuizController@reset_package')->middleware('auth')->name('reset.package');
Route::get('/Quiz_hisory', 'Users\PremiumQuizController@QuizHistoryShow')->middleware('auth')->name('QuizHistoryShow');
Route::get('/material/show/{course_id}', 'Users\PremiumQuizController@material_show')->middleware('auth')->name('material.show');
Route::get('/material/download/{id}', 'Users\PremiumQuizController@download_material')->middleware('auth')->name('download.material');
Route::get('/studyPlan/show/{course_id}', 'Users\PremiumQuizController@studyPlan_show')->middleware('auth')->name('studyPlan.show');

Route::get('/flashCard', 'Users\PremiumQuizController@flashCard_index')->middleware('auth')->name('flashCard.index');
Route::get('/flashCard/{id}', 'Users\PremiumQuizController@flashCard_show')->middleware('auth')->name('flashCard.show');
Route::get('/FAQ', 'Users\PremiumQuizController@faq_index')->middleware('auth')->name('faq.index');
Route::get('/user/feedback', 'Users\PremiumQuizController@feedback_index')->middleware('auth')->name('user.feedback.index');
Route::post('/user/store', 'Users\PremiumQuizController@feedback_store')->middleware('auth')->name('user.feedback.store');
Route::get('/user/delete/{id}', 'Users\PremiumQuizController@feedback_delete')->middleware('auth')->name('user.feedback.delete');
Route::post('/PremiumQuiz/VideoComplete', 'Users\PremiumQuizController@VideoComplete')->middleware('auth')->name('PremiumQuiz.VideoComplete');

/** Rating System */
Route::post('/user/rate', 'Users\PremiumQuizController@rate')->middleware('auth')->name('user.rate');
Route::post('/user/review', 'Users\PremiumQuizController@storeReview')->middleware('auth')->name('user.review');




Route::get('/PremiumQuiz/vid/{package_id}/{topic}/{topic_id}', 'Users\PremiumQuizController@st3_vid')->name('st3_vid');
Route::get('/PremiumQuiz/vid/{package_id}/{topic}/{topic_id}/{video_id}', 'Users\PremiumQuizController@st4_vid')->name('st4_vid');
/* 
    Payment Routes
*/

Route::post('generate/payment/link', function(\Illuminate\Http\Request $req){
    if($req->input('coupon_code') != ''){
        return route('pay', [$req->input('package_id'), $req->input('coupon_code')]);
        
    }else{
        // return \Redirect::to(route('public.package.view', $req->input('package_id')));
        return route('pay', [$req->input('package_id'), 'ignore']);
    }


})->name('generate.payment.link');


Route::get('generate/payment/coupon/{id}', function(\Illuminate\Http\Request $req, $id /** Coupon Code */){    

    return \Redirect::to(  route('public.package.view', \App\Coupon::where('code', '=', $id)->get()->first()->package_id  ).'?coupon='.$id);
    // return \Redirect::to(route('pay', [\App\Coupon::where('code', '=', $id)->get()->first()->package_id , $id]));
})->name('generate.payment.with.coupon');

Route::get('/payment/package/{id}/{coupon}', 'PaymentController@pay')->name('pay');
Route::get('/payment/status/{payment_status}/{package_id}/{coupon_code}', 'PaymentController@paymentStatus')->name('payment.status');

Route::post('/payment/check','PaymentController@check')->name('pay.check');

Route::get('/payment/extend/package/{id}', 'PaymentController@extend')->name('extend');
Route::get('/payment/extend/status/{payment_status}/{package_id}', 'PaymentController@extendStatus')->name('extend.status');

/**
 * mobile redirect
 */

Route::get('/mobile/redirect/', function(){
    return view('layouts.app-mobile');
})->name('mobile.redirect');

/*
    User Routes
*/
Route::get('profile', 'HomeController@showProfile')->name('show.profile');
Route::post('user/change/password', 'HomeController@UserUpdatePasswordRequest')->name('user.update.password');
Route::post('user/update/profile', 'HomeController@UserUpdateProfileInfo')->name('user.update.profile');
Route::post('user/update/profile/pic','HomeController@UserUpdateProfilePic')->name('user.update.profile.pic');

/*
    Screen shot 
*/
Route::get('user/screenShot', 'Users\PremiumQuizController@ScreenShot')->middleware('auth')->name('ScreenShot');


/** 
 * Comments
 */

Route::post('user/comment/store', 'CommentController@store')->name('comment.store');
Route::post('user/comment/reply', 'CommentController@reply')->name('comment.reply');