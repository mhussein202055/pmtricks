<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chapters;
use App\Process_group;
use App\Question;
use App\ProjectManagementGroup as PMG;


class ChapterManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $chapters = Chapters::all();
        $PGroup = Process_group::all();
        $pmg = PMG::all();
        $courses = \App\Course::all();
        $all = [$chapters, $PGroup, $pmg, $courses];
        return view('chapters.show')->with('all', $all);
    }

    public function add(Request $request){
        $title = $request->input('value');
        $type = $request->input('type');

        if( $type == 'knowledge'){
            $ck = $request->input('CK');
            
            if($ck == 'true')
                $ck = '1';
            else
                $ck = '0';            

            $course = \App\Course::where('title', '=', $request->input('course'))->get()->first();
            if($course){

            
            $q = new Chapters;
            $q->name = $title;
            $q->ck = $ck;
            $q->course_id = $course->id;
            $q->save();

            }else{
                return 'course not fount !';
            }
        }else if ( $type == 'process_group'){
            $q = new Process_group;
            $q->name = $title;
            $q->save();
        }else if($type == 'PMG'){
            $q0 = Chapters::where('name','=', $request->input('chapter'))->get();
            $q0_1 = Process_group::where('name','=',$request->input('process_group'))->get();
            if($q0->first() && $q0_1->first()){
                $q = new PMG;
                $q->name = $title;
                $q->knowledge_area_id = $q0->first()->id;
                $q->process_group_id = $q0_1->first()->id;
                $q->save();
            }else{
                return $request->input('process_group');
            }
            
        }elseif($type == 'course'){
            $course = new \App\Course;
            $course->title = $title;
            $course->private = $request->input('private');
            $course->save();
        }else{
            return '404';
        }

        return '200';
        
    }

    public function delete(Request $request){
        $title = $request->input('value');
        $type = $request->input('type');
        if($type == 'knowledge'){
            $q1 = Chapters::where('name', '=', $title)->first();
            $check = Question::where('chapter','=',$q1->id);

            if($check->first()){
                // you can not delete it , its in use
                return '300';
            }else {
                $q1->delete();
            }
            
        }else if ($type == 'process_group'){
            $q2 = Process_group::where('name', '=', $title)->first();
            $check = Question::where('process_group','=',$q2->id);

            if($check->first()){
                // you can not delete it , its in use
                return '300';
            }else {
                $q2->delete();
            }
        }else if ($type == 'PMG'){
            // check if in use !
            // $check = Question::where('PMG','=',$q->id);
            $q3 = PMG::where('name', '=',$title)->first();
            $q3->delete();
        }elseif($type== 'course'){
            $course = \App\Course::where('title', '=', $title)->get()->first();
            if($course){
                $check = \App\Chapters::where('course_id', '=', $course->id)->get()->first();
                if($check){
                    return '300';
                }else{
                    $course->delete();
                }
            }
        }else {
            return '404';
        }
        return '200';
    }
}