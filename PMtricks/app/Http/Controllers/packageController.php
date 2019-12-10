<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Chapters;
use App\Process_group;
use App\Packages;
use App\QuestionRoles;
use App\Question;
use App\UserPackages;

use Illuminate\Support\Facades\Storage;

class packageController extends Controller
{

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
        $packages = Packages::all();
        return view('packages/index')->with('packages', $packages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chapters = Chapters::all();
        $process = Process_group::all();
        return view('packages/add-form')->with('chapters', $chapters)->with('process', $process);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
               
        if($request->input('chapter') != ''){

            $chapter_inc = [];
            $process_group_inc=[];
            /* Test for Check box input (Chapters) */
            $chapters = Chapters::all();
            $chapters_included = [];
            foreach($chapters as $ch){
                if($request->has('c'.$ch->id)){
                    $chapters_included[$ch->id] = $ch->name;
                    array_push($chapter_inc, $ch->id);
                }
            }

            /* Test for check box input (Proccess Groups) */
            $process_group = Process_group::all();
            $process_group_included = [];
            foreach ($process_group as $pg) {
                if($request->has('p'.$pg->id)){
                    $process_group_included[$pg->id] = $pg->name;
                    array_push($process_group_inc, $pg->id);
                }
            }    

            if( empty($chapters_included) && empty($process_group_included))
                return back()->withErrors(['You haven\'t Select any Chapter or Process Group !'])->withInput();
        }


        if($request->input('exam') != ''){
            $exams_arr = $request->input('exams');
            $exams_str = implode(',',$exams_arr);
        }
        
        

        /* Validation */
        $this->validate($request,[
            'name' => 'required',
            'price' => 'numeric|required',
            'discount' => 'numeric|required',
            'expire'    => 'numeric|required',
            'extension_in_days' => 'numeric|required',
            'extension_price' => 'numeric|required',
            'max_extension' => 'numeric|required',
            'description' => 'required',
            'filter' => 'required',
            'contant_type' => 'required',
            'img' => 'required|mimes:png,jpg,jpeg', // 100 MB
            'img_large' => 'mimes:png,jpg,jpeg', // 100 MB
            'img_small' => 'required|mimes:png,jpg,jpeg', // 100 MB
            'what_you_learn'=>'required',
            'requirement'=>'required',
            'who_course_for'=>'required',
            'enroll_msg'=>'required',
            'lang' => 'required',
            'course_id' => 'required',
            'certification'=>'numeric|required'

            
        ]);

        $packages_with_the_same_name = Packages::where('name', '=', $request->input('name'));
        if($packages_with_the_same_name->get()->first()){
            return back()->withErrors(['Please Choose Another name !'])->withInput();
        }

        if($request->input('chapter') ==''&& $request->input('exam') == ''){
            return back()->withErrors(['You haven\'t Select Package includes !'])->withInput();
        }

        if($request->input('discount') > 100){
            return back()->withErrors(['discount can not be greater than 100% !'])->withInput();
        }

        if($request->input('max_extension') != 0 && $request->input('extension_in_days') != 0){


            if($request->input('max_extension') % $request->input('extension_in_days') != 0){
                return back()->withErrors(['max number of extension days must be divisible by extend days !'])->withInput();
            }
        }


        /**
        *    Calculate the price after discount
        */
        $price = $this->price_after_discount($request->input('price'), $request->input('discount'));

        /** 
         * it's time to store data
         */
        // frist store the package info at package table
        $new_package = new Packages;
        $new_package->name = $request->input('name');
        $new_package->original_price = $request->input('price');
        $new_package->price = $price;
        $new_package->expire_in_days = $request->input('expire');
        $new_package->extension_in_days = $request->input('extension_in_days');
        $new_package->max_extension_in_days = $request->input('max_extension');
        $new_package->extension_price = $request->input('extension_price');
        $new_package->discount = $request->input('discount');
        $new_package->description = $request->input('description');
        $new_package->course_id = $request->input('course_id');
        $new_package->lang = $request->input('lang');
        $new_package->requirement = $request->input('requirement');
        $new_package->what_you_learn = $request->input('what_you_learn');
        $new_package->who_course_for = $request->input('who_course_for');
        $new_package->enroll_msg = $request->input('enroll_msg');
        $new_package->img = $request->file('img')->store('public/package/imgs/');
        $new_package->img_large = $request->file('img_large')->store('public/package/imgs/');
        $new_package->img_small = $request->file('img_small')->store('public/package/imgs/');
        if($request->hasFile('preview_video')){
            $new_package->preview_video_url = $request->file('preview_video')->store('public/package/preview/');
        }

        $new_package->certification = $request->input('certification');
        if($request->input('certification')){
            $new_package->certification_title = $request->input('certification_title');
        }


        $new_package->active = 1;

        if($request->input('chapter') != ''){
            $new_package->chapter_included = implode(",", $chapter_inc);
            $new_package->process_group_included= implode(",", $process_group_inc);
        }
        if($request->input('exams') != ''){
            $new_package->exams = $exams_str;
        }
        $new_package->filter = $request->input('filter');
        $new_package->contant_type = $request->input('contant_type');
        $new_package->save();

        // then setup the question roles for this package
        if($request->input('chapter') != ''){
            if(!empty($chapters_included)){
                foreach ($chapters_included as $key => $val) { // $val is the name of chapter
                    $query1 = Question::where('chapter', '=', $key)->get();//get query data to loop through
                    if($query1->first()){
                        foreach ($query1 as $q) { 
                            // $q is a row in questions table
                            // and you have the $new_package->id which is the id of the package

                            // check if the question is exits with the same package record !
                            $test = QuestionRoles::where('question_id','=',$q->id)->where('package_id', '=',$new_package->id);
                            if(!$test->first()){
                                $query2 = new QuestionRoles;
                                $query2->question_id = $q->id;
                                $query2->package_id = $new_package->id;
                                $query2->save();
                            }

                        }    
                    }
                }
            }
            if(!empty($process_group_included)){
                foreach ($process_group_included as $key => $val) {
                    $query1 = Question::where('process_group', '=', $key)->get();
                    if($query1->first()){
                        foreach ($query1 as $q) {
                            // $q is a row in questions table
                            // and you have the $new_package->id which is the id of the package

                            // check if the question is exits with the same package record !
                            $test = QuestionRoles::where('question_id','=',$q->id)->where('package_id', '=',$new_package->id);
                            if(!$test->first()){
                                $query2 = new QuestionRoles;
                                $query2->question_id = $q->id;
                                $query2->package_id = $new_package->id;
                                $query2->save();
                            }
                        }
                    }
                }
            }
        }





        return redirect(route('packages.index'))->with('success', 'Package Created Successfully.');

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
        $package = Packages::find($id);
        return view('packages.edit')->with('package', $package);
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
        
        

        $this->validate($request,[
            'name' => 'required',
            'price' => 'numeric|required',
            'extension_price' => 'numeric|required',
            'expire' => 'numeric|required',
            'extension_in_days' => 'numeric|required',
            'max_extension' => 'numeric|required',
            'description' => 'required',
            'discount' => 'numeric|required',
            'what_you_learn'=>'required',
            'requirement'=>'required',
            'enroll_msg'=>'required',
            'lang' => 'required',
            'course_id' => 'required',
            'who_course_for'=>'required',
            'certification'=>'numeric|required'
        ]);

        

        if($request->input('discount') > 100){
            return back()->withErrors(['discount can not be greater than 100% !'])->withInput();
        }

        if($request->input('max_extension') != 0 && $request->input('extension_in_days') != 0){


            if($request->input('max_extension') % $request->input('extension_in_days') != 0){
                return back()->withErrors(['max number of extension days must be divisible by extend days !'])->withInput();
            }
        }

        $price = $this->price_after_discount($request->input('price'), $request->input('discount'));

        $package = Packages::find($id);
        $package->name = $request->input('name');
        $package->original_price = $request->input('price');
        $package->price = $price;
        $package->expire_in_days = $request->input('expire');
        $package->extension_in_days = $request->input('extension_in_days');
        $package->extension_price = $request->input('extension_price');
        $package->max_extension_in_days = $request->input('max_extension');
        $package->discount = $request->input('discount');
        $package->description = $request->input('description');
        $package->requirement = $request->input('requirement');
        $package->what_you_learn = $request->input('what_you_learn');
        $package->who_course_for = $request->input('who_course_for');
        $package->enroll_msg = $request->input('enroll_msg');
        $package->course_id = $request->input('course_id');
        $package->lang = $request->input('lang');

        if($request->input('popular') == ''){
            $package->popular = 0;
        }else{
            $package->popular = 1;
        }

        $package->certification = $request->input('certification');
        if($request->input('certification')){
            $package->certification_title = $request->input('certification_title');
        }

        if($request->hasFile('img')){
            $oldPath = $package->img;
            if(Storage::exists($oldPath)){
                Storage::delete($oldPath);
            }
            // store the pdf
            $package->img = $request->file('img')->store('public/package/imgs/');
        }

        if($request->hasFile('img_large')){
            $oldPath = $package->img_large;
            if(Storage::exists($oldPath)){
                Storage::delete($oldPath);
            }
            // store the pdf
            $package->img_large = $request->file('img_large')->store('public/package/imgs/');
        }

        if($request->hasFile('img_small')){
            $oldPath = $package->img_small;
            if(Storage::exists($oldPath)){
                Storage::delete($oldPath);
            }
            // store the pdf
            $package->img_small = $request->file('img_small')->store('public/package/imgs/');
        }


        if($request->hasFile('preview_video')){
            $oldPath = $package->preview_video_url;
            if(Storage::exists($oldPath)){
                Storage::delete($oldPath);
            }
            $package->preview_video_url = $request->file('preview_video')->store('public/package/preview/');
        }
        
        $package->save();

        $packages = Packages::all();
        return view('packages.index')->with('packages', $packages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $query= Packages::find($id);
        if($query->count()){
            if($query->active == 1){
                $title = $query->name;
                $query->active = 0 ;
                $query->save();
                return redirect(route('packages.index'))->with('success',"$title : Package Disabled");    
            }

            $title = $query->name;
            $query->active = 1;
            $query->save();
            return redirect(route('packages.index'))->with('success',"$title : Package Enabled");    
            // // delete all roles 
            // $roles = QuestionRoles::where('package_id','=', $id)->get();
            // if($roles->count()){
            //     foreach($roles as $role){
            //         $role->delete();       
            //     }
            // }
            // $query->delete();
           

        }
        return redirect(route('packages.index'))->with('error', 'Unkown Error: Package not found !!');
    }


    public function price_after_discount($original_price, $discount){
        $take_off = ($discount/100) * $original_price;
        $new_price = $original_price - $take_off;
        return round($new_price, 2);
    }
}
