<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Question;
use App\Chapters;
use App\Process_group;
use App\QuestionRoles;
use App\Packages;
use App\ProjectManagementGroup as PMG;
use Illuminate\Support\Facades\Input;

// we could use
// use DB;

class QuestionsController extends Controller
{
    
    public $pagination = 20;

    public function __construct()
    {
        $this->middleware('auth:admin'); //default auth --->> auth:web
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('updated_at', 'desc')->get();
        // $questions = DB::select('SELECT * FROM questions');
        $result_counter = count(Question::all());
        $chapters = Chapters::all();
        $ch_select = ['00'=>''];
        foreach($chapters as $ch){
            $ch_select[$ch->id] = $ch->name;
        }

        $process_group = Process_group::all();
        $pg_select = ['00'=>''];
        foreach($process_group as $pg){
            $pg_select[$pg->id] = $pg->name;
        }
        
        $pmg = PMG::all();
        $pmg_list = ['00' =>''];
        foreach($pmg as $i){
            $pmg_list[$i->id] = $i->name;
        }

        
        $roles_list = []; // to hold the full role -> (question id => package name) list
        $packages_name = []; // to hold the name of packages that attached to one question .
        
        $packages = Packages::all();
        if($packages->first()){
            foreach($packages as $package){
                $question = QuestionRoles::where('package_id', '=', $package->id)->get();
                // loop throug and add them to the roles _list..
                if($question->first()){
                    foreach($question as $q){
                        if(isset($roles_list[$q->question_id])){
                            $to_array = explode(", ",$roles_list[$q->question_id]);
                            array_push( $to_array,  $package->name);
                            $roles_list[$q->question_id] = implode(", ", $to_array);
                        }else{
                            $roles_list[$q->question_id]= $package->name;
                        }
                    }
                }
            }
        }

        return view('questions.show')->with('questions', $questions)->with('ch_select', $ch_select)->with('pg_select', $pg_select)
            ->with('roles_list', $roles_list)->with('pmg', $pmg_list)->with('result_counter',$result_counter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = \App\Course::all();
        $course_select = [''];
        foreach($courses as $ch){
            $course_select[$ch->id] = $ch->title;
        }

        // $process_group = Process_group::all();
        // $pg_select = [];
        // foreach($process_group as $pg){
        //     $pg_select[$pg->id] = $pg->name;
        // }
        
        return view('questions.create')->with('course_select', $course_select);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $this->validate($request, [
            'question' => 'required',
            'correct_answer' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'chapter' => 'required',
            'demo' => 'required',
            'feedback' => 'required',
            'process_group'=>'required'
        ]);

        

        $question = new Question;
        $question->title = $request->input('question');
        $question->a = $request->input('answer_a');
        $question->b = $request->input('answer_b');
        $question->c = $request->input('answer_c');
        $question->correct_answer = $request->input('correct_answer');
        if(!empty($request->input('exam_num'))){
            $exams_arr = implode(',',$request->input('exam_num'));
            $question->exam_num = $exams_arr;
        }else{
            $question->exam_num = null;
        }
        
        $chapter = \App\Chapters::where('name', '=', $request->input('chapter'))->get()->first();
        $question->chapter = $chapter->id;
        if($request->input('pmg') != ''){
            $q0 = PMG::where('name','=',$request->input('pmg'))->get()->first();
            $question->project_management_group = $q0->id;
        }
        if($request->input('process_group') != ''){
            $q01 = Process_group::where('name','=',$request->input('process_group'))->get()->first();
            $question->process_group = $q01->id;
        }
        if($request->input('demo') != 0){
            $question->demo = $request->input('demo');
        }
        
        // validate for the img
        if ($request->hasFile('img')){
            // store the img
            $path = $request->file('img')->store('public/questions');
            $question->img = $path;
        }
        $question->feedback = $request->input('feedback');
        $question->save();

        // update the roles table ..
        $packages = Packages::all();
        foreach($packages as $package){
            
            $chapter_inc = explode(",", $package->chapter_included);
            $process_group_inc = explode(",", $package->process_group_included);
            

            if(in_array($question->chapter, $chapter_inc) || in_array($question->process_group, $process_group_inc)){
                // add the question to its related package ..
                $new_role = new QuestionRoles;
                $new_role->question_id = $question->id;
                $new_role->package_id = $package->id;
                $new_role->save();
            }           
        }

        return redirect(route('question.index'))->with('success', 'Question Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'OK';
    }


    public function showReview($title, $a, $b, $c, $d){
        return view('questions.review')
            ->with('title', $title)
            ->with('a', $a)
            ->with('b', $b)
            ->with('c', $c)
            ->with('d', $d);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::where('id','=',$id)->get()->first();

        $courses = \App\Course::all();
        $course_select = [''];
        foreach($courses as $ch){
            $course_select[$ch->id] = $ch->title;
        }

        $chapters = Chapters::all();
        $ch_select = [''];
        foreach($chapters as $ch){
            $ch_select[$ch->id] = $ch->name;
        }

        $process_group = Process_group::all();
        $pg_select = [];
        foreach($process_group as $pg){
            $pg_select[$pg->id] = $pg->name;
        }

        $pmg_list = [];
        $q = PMG::where('knowledge_area_id', '=',$question->chapter)->get();
        if($q->first()){
            foreach($q as $q){
                array_push($pmg_list, $q->name);
            }
        }
        if( $question->project_management_group){
            $q2 = PMG::where('id', '=', $question->project_management_group)->get()->first()->name;
        }else {
            $q2 = null;
        }
        if($question->process_group){
            $q3 = Process_group::where('id', '=', $question->process_group)->get()->first()->name;
        }else{
            $q3 = null;
        }
        
        
        return view('questions.edit')->with('question',$question)->with('ch_select', $ch_select)->with('pg_select', $pg_select)
            ->with('pmg_list', $pmg_list)
            ->with('pmg_value', $q2)
            ->with('pgroup_value',$q3)
            ->with('exams', $question->exam_num)
            ->with('course_select', $course_select)
            ->with('course', \App\Chapters::find($question->chapter)->course_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'question' => 'required',
            'correct_answer' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'chapter' => 'required',
            'demo' => 'required',
            'feedback' => 'required'
        ]);

        $question = Question::find($id);
        $question->title = $request->input('question');
        $question->a = $request->input('answer_a');
        $question->b = $request->input('answer_b');
        $question->c = $request->input('answer_c');
        $question->correct_answer = $request->input('correct_answer');
        if($request->input('exam_num') != ''){
            $question->exam_num = implode(',',$request->input('exam_num'));
        }else{
            $question->exam_num = null;
        }
        $chapter = \App\Chapters::where('name','=', $request->input('chapter'))->get()->first();
        if(!$chapter){
            return back()->with('error','chapter not found !');
        }
        $question->chapter = $chapter->id;

        if($request->input('pmg') != ''){
            $q0 = PMG::where('name','=',$request->input('pmg'))->get()->first();
            $question->project_management_group = $q0->id;
        }
        if($request->input('process_group') != ''){
            $q01 = Process_group::where('name','=',$request->input('process_group'))->get()->first();
            $question->process_group = $q01->id;
        }
        
        $question->demo = $request->input('demo');
        // validate for the img
        if ($request->hasFile('img')){
            //delete the old one
            $oldPath = $question->img;
            if(Storage::exists($oldPath)){
                Storage::delete($oldPath);
            }
            // store the img
            $path = $request->file('img')->store('public/questions');
            $question->img = $path;
        }
        $question->feedback = $request->input('feedback');
        $question->save();

        
        // remove the old roles
        $question_role = QuestionRoles::where('question_id','=',$id)->get();
        foreach($question_role as $role){
            $role->delete();
        }

        // add new roles 
        $packages = Packages::all();
        foreach($packages as $package){
            
            $chapter_inc = explode(",", $package->chapter_included);
            $process_group_inc = explode(",", $package->process_group_included);

            if(in_array($question->chapter, $chapter_inc) || in_array($question->process_group, $process_group_inc)){
                // add the question to its related package ..
                $new_role = new QuestionRoles;
                $new_role->question_id = $question->id;
                $new_role->package_id = $package->id;
                $new_role->save();
            }           
        }

        return redirect(route('question.index'))->with('success', 'Question Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $oldPath = $question->img;
            if(Storage::exists($oldPath)){
                Storage::delete($oldPath);
            }
        $question->delete();
        // remove the roles from Question _roles table
        $question_role = QuestionRoles::where('question_id','=',$id)->get();
        if($question_role->first()){
            foreach($question_role as $role){
                $role->delete();
            }
        }
        
        return redirect(route('question.index'))->with('success', 'Question Deleted');
    }

    /* Additional Function other than resource */

    public function search(Request $Request){
        $word = Input::get('word');
        $chapter = Input::get('chapter');
        $process_group = Input::get('process_group');
        $pmg = Input::get('project_management_group');
        $exam = Input::get('exam');

        // $queries = [];

        // $columns = [
        //     'word', 'chapter','process_group','exam','project_management_group'
        // ];

        // $questions = new Question;

        // foreach($columns as $col){
        //     if(Input::get($col) != '00'){
        //         $questions = $questions->where($column, Input::get($col));
        //         $queries[$col] = Input::get($col);
        //     }
        // }


        $questions = Question::where('title', 'LIKE', '%'.$word.'%')
            ->where(function($qq) use ($chapter) {
                if($chapter!= '00'){
                    return $qq->where('chapter','=',$chapter);
                }else{
                    return 1;
                }
            })
            ->where(function($qq) use ($process_group){
                if($process_group !='00' ){
                    return $qq->where('process_group','=',$process_group);
                }else{
                    return 1;
                }
            })->where(function($qq) use ($pmg){
                if($pmg != '00'){
                    return $qq->where('project_management_group', '=', $pmg);
                }else{
                    return 1;
                }
            })->where(function($qq) use($exam){
                if($exam != '00'){
                    return $qq->where('exam_num', 'LIKE', '%'.$exam.'%');
                }else{
                    return 1;
                }
            });


        
            $result_counter = count($questions->get());
            $questions = $questions->orderBy('updated_at', 'desc')->get();
        // if ($chapter != '0' && $process_group != '0'){

        //     $questions = Question::where('title', 'LIKE', '%'.$word.'%')->where('chapter','=',$chapter)->where('process_group','=',$process_group)->orderBy('updated_at', 'desc')->paginate($this->pagination);
        // }elseif( $chapter != '0' && $process_group == '0') {
        //     $questions = Question::where('title', 'LIKE', '%'.$word.'%')->where('chapter','=',$chapter)->orderBy('updated_at', 'desc')->paginate($this->pagination);
        // }elseif( $chapter == '0' && $process_group != '0'){
        //     $questions = Question::where('title', 'LIKE', '%'.$word.'%')->where('process_group','=',$process_group)->orderBy('updated_at', 'desc')->paginate($this->pagination);
        // }else {
        //     $questions = Question::where('title', 'LIKE', '%'.$word.'%')->orderBy('updated_at', 'desc')->paginate($this->pagination);
        // }

        $chapters = Chapters::all();
        $ch_select = [''];
        foreach($chapters as $ch){
            $ch_select[$ch->id] = $ch->name;
        }

        $process_group = Process_group::all();
        $pg_select = [''];
        foreach($process_group as $pg){
            $pg_select[$pg->id] = $pg->name;
        }

        $pmg = PMG::all();
        $pmg_list = ['00' =>''];
        foreach($pmg as $i){
            $pmg_list[$i->id] = $i->name;
        }



        $roles_list = []; // to hold the full role -> (question id => package name) list
        $packages_name = []; // to hold the name of packages that attached to one question .
        
        $packages = Packages::all();
        if($packages->first()){
            foreach($packages as $package){
                $question = QuestionRoles::where('package_id', '=', $package->id)->get();
                // loop throug and add them to the roles _list..
                if($question->first()){
                    foreach($question as $q){
                        if(isset($roles_list[$q->question_id])){
                            $to_array = explode(", ",$roles_list[$q->question_id]);
                            array_push( $to_array,  $package->name);
                            $roles_list[$q->question_id] = implode(", ", $to_array);
                        }else{
                            $roles_list[$q->question_id]= $package->name;
                        }
                    }
                }
            }
        }
        // dd($questions);
        // $questions = Question::where('title', 'LIKE', '%'.$word.'%')->where('chapter','=',$chapter)->orderBy('updated_at', 'desc')->paginate($this->pagination);
        return view('questions.show')->with('questions', $questions)->with('ch_select', $ch_select)->with('pg_select', $pg_select)
            ->with('roles_list', $roles_list)->with('pmg', $pmg_list)->with('result_counter', $result_counter);
        // dd($questions);
    }


    /**
     * functions that handle the ajax request from add question page
     */

    public function searchCourse(Request $request){
        // return $request->input('id');
        $chapter_list = [];
        $q = \App\Chapters::where('course_id', '=',$request->input('id'))->get();
        if($q->first()){
            foreach($q as $q){
                array_push($chapter_list, $q->name);
            }
            return $chapter_list;
        }
        return [];
    }

    public function searchChapter(Request $request){
        // return $request->input('name');
        $pmg_list = [];
        $chapter = \App\Chapters::where('name', '=',$request->input('name'))->get()->first();

        if($chapter){
            $q = PMG::where('knowledge_area_id', '=',$chapter->id)->get();
            if($q->first()){
                foreach($q as $q){
                    array_push($pmg_list, $q->name);
                }
                return $pmg_list;
            }
        }
        return [];
    }

    public function searchPMG(Request $request){
        $q = PMG::where('name', '=',$request->input('pmg'))->get();
        if($q->first()){
            $process_group_id = $q->first()->process_group_id;
            $q1 = Process_group::where('id', '=', $process_group_id);
            return $q1->get()->first()->name;
        }
    }

    public function showProcess(){
        $process=[];
        $q = Process_group::all();
        foreach($q as $i){
            array_push($process, $i->name);
        }
        return $process;
        
    }
    /**
     * end of the ajax request handler functions
     */


}
