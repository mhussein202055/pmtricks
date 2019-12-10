<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use \App\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public $pagination = 20;

    public function __construct()
    {
        $this->middleware('auth:admin'); //default auth --->> auth:web
    }




    public function Vimeo_GetVideo($video_id){
        if($video_id == ''){
            return 0;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.vimeo.com/videos/'.$video_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer 0160c68b3e161aba0836d05288a7195d',
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/vnd.vimeo.*+json;version=3.4'
        ));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        try{
            $output = curl_exec($ch);
            $output = json_decode($output);
            if(isset($output->error))
            {
                return 0;
            }
            else
            {
                return ($output);
            }
        }catch(\Exception $e){
            return 0;
        }
        
    }

    public function secToString($seconds){
        $hour   = 0;
        $min    = 0;
        $sec    = $seconds;

        $min = floor($sec / 60);
        $sec = $sec % 60;

        $hour = floor($min / 60);
        $min = $min % 60;

        return $this->NumberPrefix($hour).':'.$this->NumberPrefix($min).':'.$this->NumberPrefix($sec);

    }
    public function NumberPrefix($number){
        if($number == 0){
            return '00';
        }else if($number < 10 && $number > 0){
            return '0'.$number;
        }else{
            return "$number";
        }
    }
    public function VimeoGetDuration($video_id){
        $video = $this->Vimeo_GetVideo($video_id);
        
        if($video){
            $duration_string = $this->secToString($video->duration);

            return $duration_string;
        }

        return 0;
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $videos = \App\Video::orderBy('updated_at', 'desc')->paginate($this->pagination);
        // $questions = DB::select('SELECT * FROM questions');
        $result_counter = count(\App\Video::all());
        
        $chapters = \App\Chapters::all();
        $ch_select = ['00'=>''];
        foreach($chapters as $ch){
            $ch_select[$ch->id] = $ch->name;
        }

        $process_group = \App\Process_group::all();
        $pg_select = ['00'=>''];
        foreach($process_group as $pg){
            $pg_select[$pg->id] = $pg->name;
        }
        
        $pmg = \App\ProjectManagementGroup::all();
        $pmg_list = ['00' =>''];
        foreach($pmg as $i){
            $pmg_list[$i->id] = $i->name;
        }

        
        return view('videos.index')->with('videos', $videos)->with('ch_select', $ch_select)->with('pg_select', $pg_select)
            ->with('pmg', $pmg_list)->with('result_counter',$result_counter);
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

        return view('videos.create')->with('course_select', $course_select);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        
        /**
         * 
         * 
         * validation
         * 
         * 
         * 
         */

        $this->validate($request, [
            'demo'=>'required|numeric',
            'vimeo_id'=>'required'
        ]);
        
        if($request->input('title') == ''){
            return 'Title is required !';
        }
        if($request->input('description') == ''){
            return 'Description is required !';
        }
        if($request->input('chapter') == ''){
            return 'Chapter is required !';
        }
        
        if(!$request->hasFile('video') && $request->input('vimeo_id') == ''){
            return 'Select The Video or enter Viemo ID !';
        }


        if($request->hasFile('video')){
            $file = $request->file('video');        
            if(!$file->isValid()){
                return 'Video file not valid to be uploaded !';
            }

            if($file->extension() != 'mp4'){
                return 'Only Accept `MP4` format !';
            }
        }
        

        // check if the vimeo id is exist !
    
        $duration = $this->VimeoGetDuration($request->input('vimeo_id'));

        if($duration === 0){
            back()->with('error', 'Enter Valid Vimeo Video ID !!');
        }
        


        


        /**
         * 
         * 
         * upload and save data
         * 
         * 
         */

        /**
         * {"_token":"BBsRcDC95lv9rwFqHzVBvsHyAH0NsLx9AYZlkLiK",
         * "title":"tite",
         * "description":"fuck yes",
         * "chapter":"name",
         * "video":{}}
         */
        // if($request->hasFile('video')){
        //     $product->img = $request->file('img')->store('public/videos');
        // }   
            
        $video = new \App\Video;
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $chapter = \App\Chapters::where('name','=', $request->input('chapter'))->where('course_id', $request->input('coure_id') )->get()->first();
        if(!$chapter){
            return 'chapter not found !';
        }
        $video->chapter = $chapter->id;
        
        if($request->input('attachement') != 0){
            $video->attachment_url = \App\Material::find($request->input('attachment'))->file_url;
        }
        
        $video->demo = $request->input('demo');
        $video->duration = $duration;
        if($request->hasFile('video')){
            $video->video_url = $file->store('public/videos');    
        }

        $video->vimeo_id = $request->input('vimeo_id');
        
        $video->index_z = 10;
        $video->save();
        
        $video->index_z = $video->id;
        $video->save();
        return 'ok';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = \App\Video::find($id);
        
        $courses = \App\Course::all();
        $course_select = [''];
        foreach($courses as $ch){
            $course_select[$ch->id] = $ch->title;
        }

        return view('videos.edit')->with('course_select', $course_select)->with('video',$video);
        

        
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
            'title'         => 'required',
            'description'   => 'required',
            'chapter'       => 'required',
            'attachment'    => 'required|numeric',
            'demo'=>'required|numeric',
            'vimeo_id' => 'required',
        ]);

        $video = \App\Video::find($id);

        
        $duration = $this->VimeoGetDuration($request->input('vimeo_id'));

        if($duration === 0){
            return back()->with('error', 'Enter Valid Vimeo Video ID !!');
        }
        
        

        
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $chapter_id = \App\Chapters::where('name', '=', $request->input('chapter'))->where('course_id', $request->input('course_id'))->get()->first()->id;
        $video->chapter = $chapter_id;
        if($request->input('attachment') != 0){
            $video->attachment_url = \App\Material::find( $request->input('attachment') )->file_url;
        }else{
            $video->attachment_url = null;
        }

        $video->demo = $request->input('demo');
        
        if($request->input('vimeo_id')){
            $video->vimeo_id = $request->input('vimeo_id');
            $video->duration = $duration;

        }

        
        $video->save();
        return \redirect(route('video.index'))->with('success', 'Video Updated successfully .');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = \App\Video::find($id);
        if(Storage::exists($video->video_url)){
            Storage::delete($video->video_url);
        }
        if($video->attachment_url){
            if(Storage::exists($video->attachment_url)){
                Storage::delete($video->attachment_url);
            }
        }
        $video->delete();
        return \redirect(route('video.index'))->with('success','Video Deleted !');
    }



    /* Additional Function other than resource */

    public function search(Request $Request){
        $word = Input::get('word');
        $chapter = Input::get('chapter');
        $process_group = Input::get('process_group');
        $pmg = Input::get('project_management_group');
        $exam = Input::get('exam');


        $videos = Video::where('title', 'LIKE', '%'.$word.'%')
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


        
        $result_counter = count($videos->get());
        $videos = $videos->orderBy('updated_at', 'desc')->paginate($this->pagination);


        $chapters = \App\Chapters::all();
        $ch_select = [''];
        foreach($chapters as $ch){
            $ch_select[$ch->id] = $ch->name;
        }

        $process_group = \App\Process_group::all();
        $pg_select = [''];
        foreach($process_group as $pg){
            $pg_select[$pg->id] = $pg->name;
        }

        $pmg = \App\ProjectManagementGroup::all();
        $pmg_list = ['00' =>''];
        foreach($pmg as $i){
            $pmg_list[$i->id] = $i->name;
        }



        return view('videos.index')->with('videos', $videos)->with('ch_select', $ch_select)->with('pg_select', $pg_select)
            ->with('pmg', $pmg_list)->with('result_counter', $result_counter);

    }


}


