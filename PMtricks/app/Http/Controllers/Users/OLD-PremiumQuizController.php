<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use App\Chapters;
use App\Process_group;
use App\UserPackages;
use App\Packages;
use App\QuestionRoles;
use App\UserScore;
use Illuminate\Support\Facades\Auth;

class PremiumQuizController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest:admin');
        $this->middleware('auth'); //default auth --->> auth:web
        // $next = User::where('id', '>', $user->id)->min('id');
    }

    public function QuizHistory_load(Request $req){
        $quiz = \App\Quiz::find($req->input('quiz_id'));
        if($quiz){

            if($quiz->topic_type == 'exam'){
                    $questions = \App\Question::where('exam_num', 'LIKE' ,'%'.$quiz->topic_id.'%')->get();
            }else{
                    $questions = \App\Question::where($quiz->topic_type, $quiz->topic_id)->get();
            }

            $answers = \App\Answer::where('quiz_id', $quiz->id)->get();

            $data = [$questions, $answers];
            return $data;

        }   
            
    }

    public function QuizHistory_show($id){
        $quiz = \App\Quiz::find($id);
        if($quiz){

           

            return view('PremiumQuiz.review')
                ->with('quiz', $quiz);


        }else{
            return back()->with('error','Error !');
        }

    }

    public function reset_package($package_id){

        
        $history = \App\ExtensionHistory::where('package_id', '=', $package_id)->where('user_id', '=', Auth::user()->id)->get()->first();
        $package = \App\Packages::find($package_id);
        if(!$package){
            return back()->with('error', 'package not found !');
        }

        if($history){
            if($history->extend_num >= $package->max_extension_in_days){
                /** delete data from extension history */
                $history->delete();
            }else{
                return back()->with('error', 'You can extend the package with less price !');
            }
           
        }


        /** delete data from userPackages ! */
        $user_package = \App\UserPackages::where('package_id', '=', $package_id)->where('user_id', '=', Auth::user()->id)->get()->first();
        if($user_package){
            $user_package->delete();
        }
        
        /** delete data from package extension table */
        $extension = \App\PackageExtension::where('package_id', '=', $package_id)->where('user_id' , '=', Auth::user()->id)->get();
        if($extension->first()){
            foreach($extension as $ex){
                $ex->delete();
            }
        }
        
        $quizzes = \App\Quiz::where('user_id', '=', Auth::user()->id)->where('package_id','=', $package_id)->get();
        foreach($quizzes as $q){
            $answers = \App\Answer::where('quiz_id','=', $q->id)->get();
            foreach($answers as $a){
                $a->delete();
            }
            $q->delete();
        }
        

        
        

        return \Redirect::to(route('showAllPackages', \App\Course::all()->first()->id))->with('success', 'Now You can buy the package again');
    }

    public function ScreenShot(){
        $shot = \App\ScreenShot::where('user_id', '=', Auth::user()->id)->get()->first();
        if(!$shot){
            $shot = new \App\ScreenShot;
            $shot->user_id= Auth::user()->id;
            $shot->count = 1;
            
        }else{
            $shot->count+=1;
        }

        $shot->save();
        
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

    public function indexSt1(){
        $package_list = []; // list of all chapter and process Group in our data base
        $expire_package = [];
        // $package_name = '';
        $packages = UserPackages::where('user_id','=', Auth::user()->id)->get();
        if($packages->first()){
            foreach ($packages as $package) {
                $package_data = Packages::where('id', '=', $package->package_id)->get()->first();

                if($this->is_package_expired($package_data->id)){
                    array_push($expire_package, $package_data);
                }else{
                    array_push($package_list, $package_data);
                }


                


                
            }
        }

        // $process = [];
        // $process_group = Process_group::all();
        // foreach ($process_group as $p) {
        //     array_push($process, $p->name);
            
        // }

        return view('PremiumQuiz/index-st1')
            ->with('package_list', $package_list)
            ->with('expire_package', $expire_package);
    }


    public function indexSt1Video(){
        $package_list = []; // list of all chapter and process Group in our data base
        $expire_package = [];

        $package_progress = [];

        // $package_name = '';
        $packages = UserPackages::where('user_id','=', Auth::user()->id)->get();
        if($packages->first()){
            foreach ($packages as $package) {
                $package_data = Packages::where('id', '=', $package->package_id)->get()->first();

                if($this->is_package_expired($package_data->id)){
                    array_push($expire_package, $package_data);
                }else{
                    array_push($package_list, $package_data);
                }
            }
        }
        

        foreach($package_list as $package){
            if($package->contant_type == 'video' || $package->contant_type =='combined'){
                $chapters_inc = [];
                $total_videos_no = 0;
                $completed_videos_no = count(\App\VideoProgress::where('package_id', $package->id)->where('user_id', Auth::user()->id)->where('complete', 1)->get());
                // calculate the chapters included within the package 
                if($package->chapter_included != '' || $package->chapter_included != null){
                    $arr_chapters_id = explode(',',$package->chapter_included);
                    if( !empty($arr_chapters_id)){
                        foreach($arr_chapters_id as $id){
                            $ch = Chapters::where('id', '=', $id)->get()->first();
                            array_push($chapters_inc, $ch->id);
                        }
                    }
                }
                foreach($chapters_inc as $chapter){
                    $n = count(\App\Video::where('chapter', $chapter)->get());
                    $total_videos_no += $n;
                }

                $percentage = round($completed_videos_no/$total_videos_no * 100);
                $item = (object)[];
                $item->package_id = $package->id;
                $item->progress = $percentage;
                array_push($package_progress, $item);
                

            }
        }
        

        // $process = [];
        // $process_group = Process_group::all();
        // foreach ($process_group as $p) {
        //     array_push($process, $p->name);
            
        // }

        return view('PremiumQuiz/index-st1Video')
            ->with('package_list', $package_list)
            ->with('expire_package', $expire_package)
            ->with('package_progress', $package_progress);
    }





    public function reloadTopics_video($package_id){


        $comments_id = \App\PageComment::where('page', '=', 'video')->where('item_id', '=', $package_id)->pluck('comment_id')->toArray();
        $comments = \App\Comment::whereIn('id', $comments_id)->orderBy('created_at', 'desc')->get();
        

        $topic_list = [];
        $chapters_inc = [];
        $process_inc = [];
        $exams_inc = [];

        if($this->is_package_expired($package_id)){
            return back()->with('error', 'Please, Extend the package to keep access !');
        }
        

        
        $package_data = Packages::where('id', '=',$package_id)->get()->first();
        
        $userpackages = UserPackages::where('package_id', '=', $package_data->id)->where('user_id','=', Auth::user()->id)->get();
        if($userpackages->first()){
            $filter = $package_data->filter;
            $exams = $package_data->exams;


            // calculate the chapters included within the package 
            if($package_data->chapter_included != '' || $package_data->chapter_included != null){
                $arr_chapters_id = explode(',',$package_data->chapter_included);
                if( !empty($arr_chapters_id)){
                    foreach($arr_chapters_id as $id){
                        $ch = Chapters::where('id', '=', $id)->get()->first();
                        $item = (object)[];
                        $item->id = $ch->id;
                        $item->name = $ch->name;
                        array_push($chapters_inc, $item);
                    }
                }     
            }

            if($package_data->process_group_included != '' || $package_data->process_group_included != null){
                $arr_process_id = explode(',',$package_data->process_group_included);
                if( !empty($arr_process_id != '')){
                    foreach($arr_process_id as $id){
                        $ch = Process_group::where('id', '=', $id)->get()->first();
                        $item = (object)[];
                        $item->id = $ch->id;
                        $item->name = $ch->name;
                        array_push($process_inc, $item);
                    }
                }    
            }

            // // calculate the process group included ..
            // $process_group_list = Process_group::all();
            // foreach($process_group_list as $pro){
            //     if($this->reloadQuestionsNumber($package_id, 'process', $pro->id) > 0){
            //         $item = (object)[];
            //         $item->id = $pro->id;
            //         $item->name = $pro->name;

            //         $located = 0;
            //         foreach($process_inc as $p){
            //             if($p->id == $pro->id){
            //                 $located = 1;
            //             }
            //         }
                    
            //         if( !$located ){
            //             array_push($process_inc, $item);
            //         }
            //     }
            // }

            if($exams != null){
                $exams = explode(',', $exams);
                foreach($exams as $e){
                    $item = (object)[];
                    $item->id = $e;
                    $item->name = 'Exam '.$e;
                    array_push($exams_inc, $item);
                }
            }

            if($filter == 'chapter'){
                $topic_list = [];
                if(!count($chapters_inc)){
                    $chapters_inc = null;
                }
                $topic_list['chapters'] = $chapters_inc;
                $topic_list['process'] = null;

            }else if($filter == 'process'){
                $topic_list = [];
                if(!count($process_inc)){
                    $process_inc = null;
                }
                $topic_list['process'] = $process_inc;
                $topic_list['chapters'] = null;
            }else if ($filter == 'chapter_process'){ // chapter and process group

                $topic_list = [];               

                if(!count($chapters_inc)){
                    $chapters_inc = null;
                }
                $topic_list['chapters'] = $chapters_inc;
                if(!count($process_inc)){
                    $process_inc = null;
                }
                $topic_list['process'] = $process_inc;
            }

            // add the exams  if exist
            
            if(count($exams_inc)> 0){
                // foreach ($exams_inc as $i){
                //     array_push($topic_list, $i);
                // }
                $topic_list['exams'] = $exams_inc;
            }else{
                $topic_list['exams'] = null;
            }

            $topic_list['filter'] = $filter;
            $topic_list['package_id'] = $package_id;
            $topic_list['contant_type'] = $package_data->contant_type;
            
            
            // if($package_data->contant_type == 'combined'){
                return view('PremiumQuiz/index-st2-vid')->with('topics', $topic_list)->with('comments', $comments)->with('package', $package_data);
            // }else if ($package_data->contant_type == 'video'){
                // return view('PremiumQuiz/index-st2-vid')->with('topics', $topic_list);
            // }
            
            // if($package_data->contant_type == 'question' || $package_data->contant_type == 'combined'){
            //     return view('PremiumQuiz/index-st2')->with('topics', $topic_list);
            // }else{
            //     return view('PremiumQuiz/index-st2-vid')->with('topics', $topic_list);
            // }
            


        }else{
            // return $package_data->name.' ... '.Auth::user()->id;
            return back();
        }


        
    }


    public function reloadTopics($package_id){

        
        $topic_list = [];
        $chapters_inc = [];
        $process_inc = [];
        $exams_inc = [];

        if($this->is_package_expired($package_id)){
            return back()->with('error', 'Please, Extend the package to keep access !');
        }
        

        
        $package_data = Packages::where('id', '=',$package_id)->get()->first();
        
        $userpackages = UserPackages::where('package_id', '=', $package_data->id)->where('user_id','=', Auth::user()->id)->get();
        if($userpackages->first()){
            $filter = $package_data->filter;
            $exams = $package_data->exams;



            // calculate the chapters included within the package 
            if($package_data->chapter_included != '' || $package_data->chapter_included != null){
                $arr_chapters_id = explode(',',$package_data->chapter_included);
                if( !empty($arr_chapters_id)){
                    foreach($arr_chapters_id as $id){
                        $ch = Chapters::where('id', '=', $id)->get()->first();
                        $item = (object)[];
                        $item->id = $ch->id;
                        $item->name = $ch->name;
                        array_push($chapters_inc, $item);
                    }
                }     
            }
            // calsculate the process group included within the package
            if($package_data->process_group_included != '' || $package_data->process_group_included != null){
                $arr_process_id = explode(',',$package_data->process_group_included);
                if( !empty($arr_process_id != '')){
                    foreach($arr_process_id as $id){
                        $ch = Process_group::where('id', '=', $id)->get()->first();
                        $item = (object)[];
                        $item->id = $ch->id;
                        $item->name = $ch->name;
                        array_push($process_inc, $item);
                    }
                }    
            }

            // calculate exams included within the package
            if($exams != null){
                $exams = explode(',', $exams);
                foreach($exams as $e){
                    $item = (object)[];
                    $item->id = $e;
                    $item->name = 'Exam '.$e;
                    array_push($exams_inc, $item);
                }
            }

            if($filter == 'chapter'){
                $topic_list = [];
                if(!count($chapters_inc)){
                    $chapters_inc = null;
                }
                $topic_list['chapters'] = $chapters_inc;
                $topic_list['process'] = null;

            }else if($filter == 'process'){
                $topic_list = [];
                if(!count($process_inc)){
                    $process_inc = null;
                }
                $topic_list['process'] = $process_inc;
                $topic_list['chapters'] = null;
            }else if ($filter == 'chapter_process'){ // chapter and process group

                $topic_list = [];               

                if(!count($chapters_inc)){
                    $chapters_inc = null;
                }
                $topic_list['chapters'] = $chapters_inc;
                if(!count($process_inc)){
                    $process_inc = null;
                }
                $topic_list['process'] = $process_inc;
            }

            // add the exams  if exist
            
            if(count($exams_inc)> 0){
                // foreach ($exams_inc as $i){
                //     array_push($topic_list, $i);
                // }
                $topic_list['exams'] = $exams_inc;
            }else{
                $topic_list['exams'] = null;
            }

            $topic_list['filter'] = $filter;
            $topic_list['package_id'] = $package_id;
            $topic_list['contant_type'] = $package_data->contant_type;
            
            
            
            
            return view('PremiumQuiz/index-st2')->with('topics', $topic_list)->with('package', $package_data);
            
            


        }else{
            
            return back();
        }


        
    }


    public function attachThePackageContent($package_id){
        $topic_list = [];
        $chapters_inc = [];
        $process_inc = [];
        $exams_inc = [];

        if($this->is_package_expired($package_id)){
            return back()->with('error', 'Please, Extend the package to keep access !');
        }
        

        
        $package_data = Packages::where('id', '=',$package_id)->get()->first();
        
        $userpackages = UserPackages::where('package_id', '=', $package_data->id)->where('user_id','=', Auth::user()->id)->get();
        if($userpackages->first()){
            $filter = $package_data->filter;
            $exams = $package_data->exams;



            // calculate the chapters included within the package 
            if($package_data->chapter_included != '' || $package_data->chapter_included != null){
                $arr_chapters_id = explode(',',$package_data->chapter_included);
                if( !empty($arr_chapters_id)){
                    foreach($arr_chapters_id as $id){
                        $ch = Chapters::where('id', '=', $id)->get()->first();
                        $item = (object)[];
                        $item->id = $ch->id;
                        $item->name = $ch->name;
                        array_push($chapters_inc, $item);
                    }
                }     
            }
            // calsculate the process group included within the package
            if($package_data->process_group_included != '' || $package_data->process_group_included != null){
                $arr_process_id = explode(',',$package_data->process_group_included);
                if( !empty($arr_process_id != '')){
                    foreach($arr_process_id as $id){
                        $ch = Process_group::where('id', '=', $id)->get()->first();
                        $item = (object)[];
                        $item->id = $ch->id;
                        $item->name = $ch->name;
                        array_push($process_inc, $item);
                    }
                }    
            }

            // calculate exams included within the package
            if($exams != null){
                $exams = explode(',', $exams);
                foreach($exams as $e){
                    $item = (object)[];
                    $item->id = $e;
                    $item->name = 'Exam '.$e;
                    array_push($exams_inc, $item);
                }
            }

            if(count($chapters_inc)){
                $id = $chapters_inc[0]->id;
                return \Redirect::to(route('PremiumQuiz-st3', [$package_id,'chapter', $id, 'realtime']));
            }

            if(count($process_inc)){
                $id = $process_inc[0]->id;
                return \Redirect::to(route('PremiumQuiz-st3', [$package_id,'process', $id, 'realtime']));
            }

            if(count($exams_inc)){
                $id = $exams_inc[0]->id;
                return \Redirect::to(route('PremiumQuiz-st3', [$package_id,'exam', $id, 'realtime']));
            }


        }else{
            return back();
        }
    }

    public function reloadQuestionsNumber($package_id, $topic, $topic_id, $quiz_id){
        
        
        
        $process_list = [];
        $reserved_process_list = Process_group::all();
        foreach($reserved_process_list as $i){
            array_push($process_list, $i->name);
        }



        if($package_id == 'question'){
            $comments_id = \App\PageComment::where('page', '=', $topic)->where('item_id', '=', $topic_id)->pluck('comment_id')->toArray();
            $comments = \App\Comment::whereIn('id', $comments_id)->orderBy('created_at', 'desc')->get();        

            return view('PremiumQuiz.index-st3')
                ->with('process', $process_list)
                ->with('questionNum', 1)
                ->with('package_id', $package_id)
                ->with('topic', $topic)
                ->with('topic_id', $topic_id)
                ->with('package_name', 'test')
                ->with('quiz', null)
                ->with('ignore', 1)
                ->with('comments', $comments);

        }else{
            
            if($this->is_package_expired($package_id)){
                return back()->with('error', 'Please, Extend the package to keep access !!');
            }
            
        
            $package = Packages::where('id', '=', $package_id)->get();
            
            if($quiz_id == 'realtime'){
                
                $quiz = \App\Quiz::where('user_id','=',Auth::user()->id)
                    ->where('package_id','=',$package_id)
                    ->where('topic_type','=',$topic)
                    ->where('topic_id','=',$topic_id)
                    ->where('complete', '=', 0)->get()->first();
                
            }else{
                $quiz = \App\Quiz::find($quiz_id);
            }
            

            


            if($package->first()){
                $package = $package->first();
                $exams = $package->exams;
                

                $userPackages = UserPackages::where('package_id', '=', $package->id)->where('user_id', '=', Auth::user()->id)->get();
                if($userPackages->first()){
                    // handle all selection ..


                    $chapters_inc = [];
                    $process_inc = [];
                    $exams_inc = [];


                    // calculate the chapters included within the package 
                    if($package->chapter_included != '' || $package->chapter_included != null){
                        $arr_chapters_id = explode(',',$package->chapter_included);
                        if( !empty($arr_chapters_id)){
                            foreach($arr_chapters_id as $id){
                                $ch = Chapters::where('id', '=', $id)->get()->first();
                                $item = (object)[];
                                $item->id = $ch->id;
                                $item->name = $ch->name;
                                array_push($chapters_inc, $item);
                            }
                        }     
                    }

                    if($package->process_group_included != '' || $package->process_group_included != null){
                        $arr_process_id = explode(',',$package->process_group_included);
                        if( !empty($arr_process_id != '')){
                            foreach($arr_process_id as $id){
                                $ch = Process_group::where('id', '=', $id)->get()->first();
                                $item = (object)[];
                                $item->id = $ch->id;
                                $item->name = $ch->name;
                                array_push($process_inc, $item);
                            }
                        }    
                    }

                    if($package->exams != null){
                        $exams = explode(',', $package->exams);
                        foreach($exams as $e){
                            $item = (object)[];
                            $item->id = $e;
                            $item->name = 'Exam '.$e;
                            array_push($exams_inc, $item);
                        }
                    }




                    if($topic == 'All'){
                        // $ids_arr = [];
                        $count = 0;
                        $question_q = QuestionRoles::where('package_id', '=', $package->id)->get(); // imposipole to be null
                        if($question_q->first()){
                            foreach($question_q as $r){
                                $quest = Question::where('id', '=', $r->question_id)->get();
                                if($quest->first()){
                                    // array_push($ids_arr, $quest->first()->id);
                                    $count++;
                                }
                            }
                        }

                        // if($exams != null){
                        //     $exams = explode(',', $exams);
                        //     foreach($exams as $exam){
                        //         $questionWithExamFlag = Question::where('exam_num', 'like','%'.$exam.'%')->get();
                        //         foreach ($questionWithExamFlag as $q){
                        //             if( !in_array($q->id, $ids_arr) ){
                        //                 $count++;
                        //             }
                        //         }
                        //     }
                        // }
                        /**
                         * *****************
                         * *****************
                         * *****************
                         */
                        
                        
                        if($quiz){
                            $count = $quiz->questions_number;
                        }
                        
                        return view('PremiumQuiz.index-st3')
                            ->with('process', $process_list)
                            ->with('questionNum',$count)
                            ->with('package_id', $package_id)
                            ->with('topic', $topic)
                            ->with('topic_id', $topic_id)
                            ->with('package_name', $package->name)
                            ->with('quiz', $quiz)
                            ->with('chapters_inc' , $chapters_inc)
                            ->with('process_inc', $process_inc)
                            ->with('exams_inc' , $exams_inc)
                            ->with('ignore', 0)
                            ->with('comments', null);

                    }

                    
                    // handle exams case

                    if($topic == 'exam'){
                        $comments_id = \App\PageComment::where('page', '=', $topic)->where('item_id', '=', $topic_id)->pluck('comment_id')->toArray();
                        $comments = \App\Comment::whereIn('id', $comments_id)->orderBy('created_at', 'desc')->get();     

                        $exam_num = $topic_id;            
                        // then its the range of exams ..
                        $questionWithExamFlag = Question::where('exam_num', 'like', '%'.$exam_num.'%')->get();
                        /**
                         * *****************
                         * *****************
                         * *****************
                         */
                        // return count($questionWithExamFlag);
                        return view('PremiumQuiz.index-st3')
                            ->with('process', $process_list)
                            ->with('questionNum',count($questionWithExamFlag))
                            ->with('package_id', $package_id)
                            ->with('topic', $topic)
                            ->with('topic_id', $topic_id)
                            ->with('package_name', $package->name)
                            ->with('quiz', $quiz)
                            ->with('chapters_inc' , $chapters_inc)
                            ->with('process_inc', $process_inc)
                            ->with('exams_inc' , $exams_inc)
                            ->with('ignore', 0)
                            ->with('comments', $comments);
                    }

                    // handle chapter and process group selection ..
                    $questions_array = [];
                    $count = 0;
                    if ($topic == 'process'){
                        $topic = 'process_group';
                    }

                    $comments_id = \App\PageComment::where('page', '=', $topic)->where('item_id', '=', $topic_id)->pluck('comment_id')->toArray();
                    $comments = \App\Comment::whereIn('id', $comments_id)->orderBy('created_at', 'desc')->get();     

                    // $quiz = \App\Quiz::where('user_id','=',Auth::user()->id)->where('package_id','=',$package_id)->where('topic_type','=',$topic)->where('topic_id','=',$topic_id)->where('complete','=', 0)->get()->first();
                    // express is repeated due to the $topic variable value change from process to process_group
                    $questionRoles = QuestionRoles::where('package_id' ,'=', $package->id)->get();
                    if($questionRoles->first()){
                        foreach($questionRoles as $q){
                            $question = Question::where('id', '=', $q->question_id)->where($topic,'=', $topic_id)->get()->first();
                            if($question){
                                // if( ! $this->is_exist($questions_array, $question->id)){
                                    $count++;
                                    array_push($questions_array, $question);
                                // }
                            }
                        }
                        /**
                         * *****************
                         * *****************
                         * *****************
                         */
                        // return $count;
                        if($quiz){
                            $count = $quiz->questions_number;
                        }

                        // return dd($quiz);
                        
                        return view('PremiumQuiz.index-st3')
                            ->with('process', $process_list)
                            ->with('questionNum',$count)
                            ->with('package_id', $package_id)
                            ->with('topic', $topic)
                            ->with('topic_id', $topic_id)
                            ->with('package_name', $package->name)
                            ->with('quiz', $quiz)
                            ->with('chapters_inc' , $chapters_inc)
                            ->with('process_inc', $process_inc)
                            ->with('exams_inc' , $exams_inc)
                            ->with('ignore', 0)
                            ->with('comments', $comments);
                            
                    }else{
                        return 0;
                    }


                }else{
                    return back();
                }

            }else{
                return back();
            }
        }
    }

    public function generate(Request $request){

        // Data = {
        //     num: this.question_num,
        //     topic: this.topic_type,
        //     topic_id: this.topic_id,
        //     package: this.package_id
        // };
        $questions_array = [];
        if($request->input('package') == 'question'){
            $question = Question::where('id', '=', $request->input('topic_id') )->get()->first();
            if($question){                
                array_push($questions_array, $this->respose($question, null, null));
            }
            return [$questions_array];
        }else{
            $package = Packages::where('id', '=', $request->input('package'))->get()->first();
            if(!$package){
                return '500';
            }

            $security = UserPackages::where('package_id', '=', $package->id)->where('user_id', '=', Auth::user()->id)->get()->first();
            if(!$security){
                return '500';
            }


            $answers_all = null;
            
            if($request->input('quiz_id') == 'realtime'){
                $quiz = \App\Quiz::where('user_id','=',Auth::user()->id)->where('package_id','=',$request->input('package'))->where('topic_type','=',$request->input('topic'))->where('topic_id','=',$request->input('topic_id'))->where('complete', '=', 0)->get()->first();
                if($quiz){
                    $time_left = (int)($quiz->time_left);
                    $answers_number = $quiz->answered_question_number;
                    $answers_all = \App\Answer::where('quiz_id', $quiz->id)->get();
                }else{
                    $time_left = 0;
                    $answers_number = 0;
                    
                }
            }else{
                $quiz= \App\Quiz::find($request->input('quiz_id'));
                $time_left = (int)($quiz->time_left);
                $answers_number = $quiz->answered_question_number;
                $answers_all = \App\Answer::where('quiz_id', $quiz->id)->get();
            }

            
            if($request->input('topic') == 'All'){
                // all data ..

                
                // load all question by chapter
                $chapter = $package->chapter_included;
                if($chapter != null){

                    $chapter = explode(',', $chapter);
                    $questionRole = QuestionRoles::where('package_id', '=',$package->id)->get();
                    if($questionRole->first()){
                        foreach($questionRole as $q){
                            foreach($chapter as $c){
                                $question = Question::where('id', '=', $q->question_id)->where('chapter','=', $c)->get()->first();
                                if($question){
                                    if( ! $this->is_exist($questions_array, $question->title)){
                                        array_push($questions_array, $this->respose($question, $quiz,$answers_all));
                                    }
                                }
                            }
                        }
                    }
                }


                // load all question by process group
                $process = $package->process_group_included;
                if($process != null){
                    $process = explode(',', $process);
                    $questionRole = QuestionRoles::where('package_id', '=',$package->id)->get();
                    if($questionRole->first()){
                        foreach($questionRole as $q){
                            foreach($process as $p){
                                $question = Question::where('id', '=', $q->question_id)->where('process_group','=', $p)->get()->first();
                                if($question){
                                    if(! $this->is_exist($questions_array, $question->title)){
                                        array_push($questions_array, $this->respose($question, $quiz, $answers_all));
                                    }
                                }
                            }
                        }
                    }
                }
                if($quiz){
                    $questions_array = array_slice($questions_array, 0, $quiz->questions_number);
                }else{
                    $questions_array = array_slice($questions_array, 0, $request->input('num'));
                }
                
                // if(!$quiz){
                //     shuffle($questions_array);
                // }
                
                $data = [
                    $questions_array,
                    $time_left,
                    $answers_number
                ];
                return $data; /**   ###########################  select ALL */
                

            }elseif ( $request->input('topic') == 'exam'){
                
                $exam_num = $request->input('topic_id');

                if( !($exam_num >= 1 && $exam_num <= 4) ){
                    return '500';
                }

                // check if included in package ..
                $all_exams = $package->exams;
                $all_exams = explode(',', $all_exams);
                if(!in_array($exam_num, $all_exams)){
                    return '500';
                }


                // exams ..
                $question = Question::where('exam_num','like','%'.$exam_num.'%')->get();
                if($question->first()){
                    foreach($question as $q){
                        array_push($questions_array, $this->respose($q, $quiz,$answers_all));
                    }
                    // if(!$quiz){
                    //     shuffle($questions_array);
                    // }
                    // return the array ..
                    $data = [
                        $questions_array,
                        $time_left,
                        $answers_number
                    ];
                    return $data;                                    /**   ###########################  select exam */
                }else{
                    // no question attached to this exam !
                    return '404';
                }
            }else{
                // search for it in chapter table 
                
                if($request->input('topic') == 'chapter'){
                    // it's a chapter ..
                    $questions = Question::where('chapter','=',$request->input('topic_id'))->get();
                    foreach($questions as $i){
                        array_push($questions_array, $this->respose($i, $quiz, $answers_all));
                    }


                    if($quiz){
                        $questions_array = array_slice($questions_array, 0, $quiz->questions_number);
                    }else{
                        $questions_array = array_slice($questions_array, 0, $request->input('num'));
                    }

                    // if(!$quiz){
                    //     shuffle($questions_array);
                    // }
                    $data = [
                        $questions_array,
                        $time_left,
                        $answers_number
                    ];
                    return $data; /**   ###########################  select chapter */



                }elseif ($request->input('topic') == 'process_group'){
                    // search in process group table ..
                    
                
                     
                    $questions = Question::where('process_group','=',$request->input('topic_id'))->get();
                    foreach($questions as $i){
                        array_push($questions_array, $this->respose($i, $quiz, $answers_all));
                    }

                    if($quiz){
                        $questions_array = array_slice($questions_array, 0, $quiz->questions_number);
                    }else{
                        $questions_array = array_slice($questions_array, 0, $request->input('num'));
                    }

                    // if(!$quiz){
                    //     shuffle($questions_array);
                    // }
                    
                    $data = [
                        $questions_array,
                        $time_left,
                        $answers_number,
                    ];
                    return $data;        /**   ###########################  select process */

                    
                }else{
                    return '500';
                }

            }




            foreach ($quests as $q) {
                
                array_push($questions_array, $question);
            }
            
            return $questions_array;
        }
    }

    public function respose($q, $quiz /**  last parameter is for selecting user saved answer */, $answers_all){
        $question = [];
        $question['id'] = $q->id;
        $question['title'] = $q->title;
        $question['answers']['a'] = $q->a;
        $question['answers']['b'] = $q->b;
        $question['answers']['c'] = $q->c;
        $question['answers']['d'] = $q->correct_answer;
        shuffle($question['answers']);
        $question['correct_answer'] = $q->correct_answer;
        $question['feedback'] = $q->feedback;

        // $chapter = Chapters::where('id', '=',$q->chapter)->get()->first();
        // $question['chapter'] = $chapter->name;

        $process_group = Process_group::where('id','=',$q->process_group)->get()->first();
        if($process_group){
            $question['process_group'] = $process_group->name;    
        }else{
            $question['process_group'] = rand(1,10000000);
        }
        
        $question['img'] = 'null';
        if($q->img){
            $question['img'] = basename($q->img);
        }

        // if($quiz){
        //     $answer = \App\Answer::where('quiz_id', '=', $quiz->id)->where('question_id','=',$q->id)->get()->first();
            
        //     if($answer){
        //         $question['user_saved_answer'] = $answer->user_answer;
        //     }else{
        //         $question['user_saved_answer'] = '';
        //     }
        // }else{
        //     $question['user_saved_answer'] = '';
        // }
        
        if($answers_all){
            $answer = $answers_all->first(function($item) use($q){
                return $item->question_id == $q->id;
            });
            if($answer){
                $question['user_saved_answer'] = $answer->user_answer;    
            }else{
                $question['user_saved_answer'] = '';    
            }
            
        }else{
            $question['user_saved_answer'] = '';
        }

        return $question;
    }

    public function is_exist($arr, $title){
        foreach($arr as $a){
            if($a['title'] == $title){
                return 1;
            }
        }
        return 0;
    }


    public function scoreStore(Request $request){
        // $score = new UserScore;
        // $score->score = $request->input('totalScore');
        // $score->package = $request->input('package');
        // $score->question_number = $request->input('question_num');

        // if($request->input('topic_type') == 'chapter'){
        //     $q = Chapters::where('id', '=', $request->input('topic_id'))->get()->first();
        //     if($q){
        //         $score->topic = $q->name;        
        //     }else{
        //         $score->topic = '--';
        //     }
        // }else if($request->input('topic_type') == 'process_group'){ // not 'process' , but 'process_group' as it will be converted on stage 2 to that new form
        //     $q = Process_group::where('id', '=', $request->input('topic_id'))->get()->first();
        //     if($q){
        //         $score->topic = $q->name;        
        //     }else{
        //         $score->topic = '--';
        //     }
        // }else if($request->input('topic_type') == 'exam'){
        //     $score->topic = 'Exam '.$request->input('topic_id');
        // }else{
        //     $score->topic = '--';
        // }

        // $score->user_id = Auth::user()->id;
        // $score->save();

        

        /**
         * Delete the row s when user click rest after package is expired.
         */
        
        $quiz = \App\Quiz::where('user_id', '=', Auth::user()->id)
                         ->where('package_id', '=', $request->input('package_id'))
                         ->where('topic_type', '=', $request->input('topic_type'))
                         ->where('topic_id', '=', $request->input('topic_id'))
                         ->where('complete','=', 0)->get()->first();
        if($quiz){
            $quiz->complete = 1;
            $quiz->time_left += $request->input('time_left');
            $quiz->score = $request->input('totalScore');
            $quiz->save();
        }                         
        // if($quiz){
        //     $answers = \App\Answer::where('quiz_id', '=', $quiz->id)->get();
        //     foreach($answers as $_a){
        //         $_a->delete();
        //     }
        //     $quiz->delete();
        // }

        
    }

    public function scoreHistory(){
        $score = UserScore::where('user_id', '=', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(15);
        return view('PremiumQuiz.scoreHistory')->with('score', $score);
    }

    public function showFeedback($id){
        
        $q= Question::find($id);
        if($q){
            return view('PremiumQuiz.feedback')->with('feedback', $q->feedback);
        }
        return view('PremiumQuiz.feedback')->with('feedback', 'Error');
        
        
    }


    public function st3_vid($package_id, $topic , $topic_id){
        
        $topic_type = 'chapter';
        $topic_name = '';
        if($topic != $topic_type){
            $topic_type = 'process_group';
            $topic_name = \App\Process_group::find($topic_id)->name;
        }else{
            $topic_name = \App\Chapters::find($topic_id)->name;
        }

        
        
        

        $videos = \App\Video::where($topic_type, '=', $topic_id)->get();
        if(!$videos){
            return back();
        }


        return view('PremiumQuiz.index-st3-vid')->with('videos', $videos)
            ->with('topic', $topic_name)
            ->with('topic_id', $topic_id)
            ->with('package_id', $package_id)
            ->with('topic_type', $topic_type);
    }


    public function st4_vid($package_id, $topic, $topic_id, $video_id){
        $total_time = \Carbon\Carbon::create(2012, 1, 1, 0, 0, 0);
        $package = Packages::find($package_id);
        if(!$package){
            return \redirect(route('showAllPackages'))->with('error', 'something went wrong');
        }


        $comments_id = \App\PageComment::where('page', '=', 'video')->where('item_id', '=', $video_id)->pluck('comment_id')->toArray();
        $comments = \App\Comment::whereIn('id', $comments_id)->orderBy('created_at', 'desc')->get();

        $total_videos_no = 0;
        $completed_videos_no = count(\App\VideoProgress::where('package_id', $package_id)->where('user_id', Auth::user()->id)->where('complete', 1)->get());
        
        $chapters_inc = [];
        if($package->chapter_included != '' || $package->chapter_included != null){
            $arr_chapters_id = explode(',',$package->chapter_included);
            if( !empty($arr_chapters_id)){
                foreach($arr_chapters_id as $id){
                    
                    $ch = \App\Chapters::where('id', '=', $id)->get()->first();
                    $x = (object)[];
                    
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
                    $total_time->addHours($x->total_hours)->addMinutes($x->total_min)->addSeconds($x->total_sec);
                
                    $x->total_time_toString = \Carbon\Carbon::create(2012, 1, 1, 0, 0, 0)->addHours($x->total_hours)->addMinutes($x->total_min)->addSeconds($x->total_sec)->format('H \H\r i \M\i\n');

                    array_push($chapters_inc, $x);
                }
            }     
        }
      
        foreach($chapters_inc as $chapter){
            $n = count(\App\Video::where('chapter', $chapter->id)->get());
            $total_videos_no += $n;
        }

        $percentage = round($completed_videos_no/$total_videos_no * 100);
        


        $video = \App\Video::find($video_id);
        if(!$video){
            return \redirect(route('showAllPackages'))->with('error', 'Something went wrong !');
        }

        
        

        $security = UserPackages::where('package_id', '=', $package_id)->where('user_id', '=', Auth::user()->id)->get()->first();
        if(!$security){
            return \redirect(route('showAllPackages'))->with('error', 'Please, you must buy the package inorder to have access !');
        }
            
        
        $next_video = \App\Video::where('index_z',\App\Video::where('index_z','>', $video->index_z)->min('index_z'))->get()->first();
        
         $number_of_hours = $total_time->diffInHours(\Carbon\Carbon::create(2012, 1, 1, 0, 0, 0));
         $number_of_minutess = $total_time->format('i');
         
         $total_time = ($number_of_hours) . ' Hr '.($number_of_minutess).' Min';
        
        return view('PremiumQuiz.index-st4-vid')->with('video', $video)->with('comments', $comments)->with('package', $package)->with('chapters', $chapters_inc)->with('chapter_id', $topic_id)
            ->with('percentage', $percentage)
             ->with('total_time', $total_time)
            ->with('next_video', $next_video)
            ->with('topic_id', $topic_id)
            ->with('topic',$topic);
    }



    /**
     * save answers and continue later :D
     */


    public function SaveAnswersForLaterOn(Request $req){

        
        $quiz = \App\Quiz::where('user_id', '=', Auth::user()->id)
                         ->where('package_id', '=', $req->input('package'))
                         ->where('topic_type', '=', $req->input('topic'))
                         ->where('topic_id', '=', $req->input('topic_id'))
                         ->where('complete', '=', 0)->get()->first();
        
        if(!$quiz){
            // create new quiz !
            $quiz = new \App\Quiz;
            $quiz->user_id = Auth::user()->id;
            $quiz->package_id = $req->input('package');
            $quiz->topic_id = $req->input('topic_id');
            $quiz->topic_type    = $req->input('topic');
            
            $quiz->time_left    = $req->input('time_left'); // how much time did user take in seconds
            
            $quiz->answered_question_number = 0;
            $quiz->questions_number = $req->input('questions_number');  //user it first time only !
            $quiz->save();
            
        }            
        
        
        
        
        // store ones answer
        $answer = \App\Answer::where('question_id', '=', $req->input('question_id'))
                                ->where('quiz_id', '=', $quiz->id)->get()->first();
        if(!$answer){
            $answer = new \App\Answer;
            $answer->quiz_id = $quiz->id;
            $answer->question_id = $req->input('question_id');    
        }
        $answer->user_answer = $req->input('user_answer');
        $answer->save();


        // update quiz answered question number 
        $answers_number = count(\App\Answer::where('quiz_id', '=', $quiz->id)->get());
        $quiz->answered_question_number = $answers_number;
        $quiz->time_left += $req->input('time_left');
        $quiz->save();

        return $quiz->id;

    }

    public function QuizHistoryShow(){
        $quizzes = \App\Quiz::where('user_id', '=',  Auth::user()->id)->where('complete','=', 1)->orderBy('created_at', 'desc')->paginate(25);
        
        return view('QuizHistory.show')->with('quizzes', $quizzes);
    }
    

    public function material_show($course_id){
        // check if user is subjected to this course
        $has = 0;
        $userPackages = \App\UserPackages::where('user_id', '=', Auth::user()->id)->get();
        if($userPackages){
            foreach($userPackages as $i){
                $package = \App\Packages::find($i->package_id);
                if($package->course_id == $course_id && ($package->contant_type == 'combined' || $package->contant_type == 'video') ){
                    $has = 1;
                    break;
                }
            }
        }

        if(!$has){
            return back()->with('error','You are not enrolled in this course !');
        }

        return view('user.material')->with('course_id', $course_id);
    }

    public function download_material($id){
        $m= \App\Material::find($id);
        if($m){
            return response()->download(storage_path('app/'.$m->file_url), $m->title.'-'.$m->created_at.'.'.pathinfo($m->file_url, PATHINFO_EXTENSION));
        }else{
            return 'error';
        }
    }

    public function studyPlan_show($id){
        // course id -> $id
        $comments_id = \App\PageComment::where('page', '=', 'study_plan')->where('item_id', '=', $id)->pluck('comment_id')->toArray();
        $comments = \App\Comment::whereIn('id', $comments_id)->orderBy('created_at', 'desc')->get();

        $plans = \App\StudyPlan::where('course_id', '=', $id)->orderBy('created_at', 'desc')->get();
        return view('user.studyPlan')->with('plans', $plans)->with('comments', $comments)->with('id', $id);
    }

    public function flashCard_index(){
        return view('flashCard.index');
    }
    
    public function flashCard_show($id){
        $comments_id = \App\PageComment::where('page', '=', 'flashcard')->where('item_id', '=', $id)->pluck('comment_id')->toArray();
        $comments = \App\Comment::whereIn('id', $comments_id)->orderBy('created_at', 'desc')->get();

        return view('flashCard.show')->with('flashCard', \App\FlashCard::find($id))->with('comments', $comments);
    }

    public function faq_index(){
        $comments_id = \App\PageComment::where('page', '=', 'faq')->where('item_id', '=', 1)->pluck('comment_id')->toArray();
        $comments = \App\Comment::whereIn('id', $comments_id)->orderBy('created_at', 'desc')->get();
        return view('faq.index')->with('comments', $comments)->with('id',1);
    }

    public function VideoComplete(Request $req){
        $complete = \App\VideoProgress::where('user_id', Auth::user()->id)->where('package_id', $req->input('package_id'))->where('video_id', $req->input('video_id'))->get()->first();
        if(!$complete){
            $complete= new \App\VideoProgress;
            $complete->user_id = Auth::user()->id;
            $complete->package_id = $req->input('package_id');
            $complete->video_id =  $req->input('video_id');
            $complete->complete = 1;
            $complete->save();
            return 'done';
        }
        

        if($req->input('complete') == 1){
            $complete->complete = 1;
        }else{
            if( $complete->complete == 1){
                $complete->complete = 0;
            }else{
                $complete->complete = 1;
            }
        }
        $complete->save();
        return 'done';
    }

    public function feedback_index(){
        return view('user.feedback');
    }

    public function feedback_store(Request $req){
        $this->validate($req, [
            'rate' => 'numeric|required',
            'title' => 'required',
            'feedback'  =>  'required'
        ]);

        

        $f = new \App\Feedback;
        $f->feedback = $req->input('feedback');
        $f->user_id = Auth::user()->id;
        $f->title = $req->input('title');
        $f->rate = $req->input('rate');
        $f->save();

        return back()->with('success', 'feedback sent .');
    }

    public function feedback_delete($id){
        $feed = \App\Feedback::find($id);

        if($feed){
            if($feed->user_id == Auth::user()->id){
                $feed->disable = 1;
                $feed->save();

                return back()->with('success', 'Feedback deleted.');
            }else{
                return back()->with('error');    
            }
        }else{
            return back()->with('error');
        }
    }

    public function rate(Request $req){
        $rate = \App\Rating::where('user_id', Auth::user()->id)->where('package_id', $req->input('package_id'))->get()->first();
        if(!$rate){
            $rate = new \App\Rating;
        }

        $rate->user_id = Auth::user()->id;
        $rate->package_id = $req->input('package_id');
        $rate->rate = $req->input('rate');
        $rate->save();

        return 0;
    }

    public function storeReview(Request $req){
        $rate = \App\Rating::where('user_id', Auth::user()->id)->where('package_id', $req->input('package_id'))->get()->first();
        if($rate){
            $rate->review = $req->input('user_review');
            $rate->save();
        }
    }



    public function myPackages_view($type, $cat /** Course id or 'all' */){
        $exam_package_list = []; // list of all chapter and process Group in our data base
        $video_package_list = [];
        $expire_package = [];
        
        $packages = UserPackages::where('user_id','=', Auth::user()->id)->get();
        if($packages->first()){

            /** Filter by cat */
            if($cat != 'all'){
                $packages = $packages->filter(function($i) use($cat) {
                    $p_data = \App\Packages::find($i->package_id);
                    return $p_data->course_id == $cat;
                });
            }

            

            

            foreach ($packages as $package) {
                $package_data = Packages::where('id', '=', $package->package_id)->get()->first();

                if($this->is_package_expired($package_data->id)){
                    array_push($expire_package, $package_data);
                }else{
                    if($type == 'all'){
                        if($package_data->contant_type == 'question'){

                            array_push($exam_package_list, $package_data);    

                        }else if($package_data->contant_type == 'combined'){

                            array_push($exam_package_list, $package_data);
                            array_push($video_package_list, $package_data);

                        }else if($package_data->contant_type == 'video'){

                            array_push($video_package_list, $package_data);

                        }
                        
                    }else if($type == 'exam'){
                        if($package_data->contant_type == 'question' || $package_data->contant_type == 'combined'){
                            array_push($exam_package_list, $package_data);    
                        }
                    }else if($type == 'video'){
                        if($package_data->contant_type == 'video' || $package_data->contant_type == 'combined'){
                            array_push($video_package_list, $package_data);
                        }
                    }
                    
                }


                


                
            }
            
        }

        return view('user/myPackage')
            ->with('exam_package_list', $exam_package_list)
            ->with('video_package_list', $video_package_list)
            ->with('expire_package', $expire_package)
            ->with('type', $type)
            ->with('cat', $cat);
    }
}

