<?php

namespace App\Http\Controllers\API;


use App\Chapters;
use App\Http\Resources\Package\PackageCollection;
use App\Http\Resources\Video\VideoResource;
use App\Packages;
use App\Process_group;
use App\Question;
use App\UserPackages;
use App\Http\Resources\Package\ReviewResource;
use App\Http\Resources\Package\ReviewCollection;
use App\Http\Resources\Package\UserPackageCollection;


use App\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class API_PackageController extends Controller
{

    public function search(Request $req){
        $packages = \App\Packages::where('name', 'like', '%'.$req->text.'%')->get();
        return PackageCollection::collection($packages);
    }

    public function VideoComplete(Request $req){

        $complete = \App\VideoProgress::where('user_id', Auth::user()->id)->where('package_id', $req->input('package_id'))->where('video_id', $req->input('video_id'))->first();
        if(!$complete){
            $complete= new \App\VideoProgress;
            $complete->user_id = Auth::user()->id;
            $complete->package_id = $req->input('package_id');
            $complete->video_id =  $req->input('video_id');

        }

        $complete->complete = $req->complete ? 1: 0;
        $complete->save();
        return $complete;
        return response()->json([], 201);
    }



    //all package show with less details
    public function index(Request $req){
        if($req->popular){
            return PackageCollection::collection( Packages::where('popular', 1)->get() );
        }else{
            return PackageCollection::collection( Packages::all() );
        }

    }

    public function renderPackageDetails($package_id){
        $package = \App\Packages::find($package_id);

        $no_of_quizzes = 0;
        $no_of_lectures = 0;

        if(!$package){
            return response()->json([
                'error' => 'package not exists'
            ], 404);
        }



        $package_total_video_time = [0,0,0]; // hr, min, secs
        $chapters = [];
        if( $package->chapter_included != NULL){

            $chapters_by_id = explode(',', $package->chapter_included);
            foreach($chapters_by_id as $id){
                $no_of_quizzes++;
                $query = Chapters::find((int)$id);
                // calculate number of questions attached to this process group
                $count = 0;
                $questions = \App\Question::where('chapter', $id)->get();

                $count += count($questions);
                $videos_array = [];
                $total_hours = 0;
                $total_min = 0;
                $total_sec = 0;

                if($package->contant_type == 'video' || $package->contant_type == 'combined'){
                    $video = \App\Video::where('chapter', $id)->orderBy('index_z')->get();




                    foreach($video as $v){
                        if($v->event_id == null){
                            array_push($videos_array, new VideoResource($v));
                        }

                        if($v->duration != '' && $v->duration != null){

                            $total_min += \Carbon\Carbon::parse($v->duration)->format('i');
                            $total_sec += \Carbon\Carbon::parse($v->duration)->format('s');
                            if(\Carbon\Carbon::parse($v->duration)->format('h') != 12){
                                $total_hours += \Carbon\Carbon::parse($v->duration)->format('h');
                            }

                            $no_of_lectures++;
                        }
                    }
                }


                $total_min += floor($total_sec / 60);
                $total_sec = $total_sec % 60;

                $total_hours += floor($total_min / 60);
                $total_min = $total_min % 60;

                $package_total_video_time[0] += $total_hours;
                $package_total_video_time[1] += $total_min;
                $package_total_video_time[2] += $total_sec;

                $item = [
                    'id'=> (int)$id ,
                    'name'=>$query->name ,
                    'questions_number' => $count,
                    'videos' => $videos_array,
                ];



                array_push($chapters, $item);
            }

        }

        $package_total_video_time[1] += round($package_total_video_time[2]/60);
        $package_total_video_time[2] = round($package_total_video_time[2]%60);

        $package_total_video_time[0] += round($package_total_video_time[1]/60);
        $package_total_video_time[1] = round($package_total_video_time[1]%60);


        $process_groups = [];
        if($package->process_group_included != NUll){

            $process_by_id = explode(',', $package->process_group_included);
            foreach($process_by_id as $id){
                $no_of_quizzes++;
                $query = Process_group::find((int)$id);

                // calculate number of questions attached to this process group
                $count = 0;
                $questions = \App\Question::where('process_group', $id)->get();

                $count += count($questions);

                $item = [
                    'id'=> (int)$id,
                    'name' => $query->name ,
                    'questions_number' => $count,
                ];
                array_push($process_groups, $item);

            }
        }



        $exams = [];
        if($package->exams){

            $exams_by_id = explode(',', $package->exams);
            foreach($exams_by_id as $id){
                $no_of_quizzes++;
                $count = count(Question::where('exam_num', 'like', '%'.$id.'%')->get());
                $item = ['id'=> (int)$id, 'name' => 'Exam '.$id, 'questions_number'=> $count];
                array_push($exams, $item);
            }
        }




        $users_no = count(\App\UserPackages::where('package_id', $package->id)->get());

        $total_no = 0;
        $rate = \App\Rating::where('package_id',$package->id)->get();
        $devisor = count($rate);
        foreach($rate as $i){
            $total_no+= $i->rate;
        }
        if($devisor == 0){
            $total_rate = 0;
        }else{
            $total_rate = $total_no/$devisor;
        }




        return [
            'id'=> $package->id,
            'name'=> $package->name,
            'instructor' => 'Sayed Mohsen',
            'current_price' => $package->price,
            'previous_price' => $package->original_price,
            'trending' => $package->popular,
            'number_of_students' => $users_no,
            'rate' => round($total_rate),
            'number_of_practical_tests' => $no_of_quizzes,
            'number_of_lectures' => $no_of_lectures,
            'language' => $package->lang,
            'access' => $package->expire_in_days,
            'duration' => $package_total_video_time[0].' Hr '.$package_total_video_time[1].' Min',
            'certification' => $package->certification,
            'img_large' => url('storage/package/imgs/'.basename($package->img_large)),
            'img_small' => url('storage/package/imgs/'.basename($package->img_small)),
            'img_medium' => url('storage/package/imgs/'.basename($package->img)),
            'description'=> $package->description,
            'what_you_learn' => $package->what_you_learn,
            'requirement' => $package->requirement,
            'who_course_for' => $package->who_course_for,
            'chapters' => $chapters,
            'process_groups' => $process_groups,
            'exams' => $exams,
            'content_type' => $package->contant_type,
            'course' => \App\Course::find($package->course_id)->title,
            'created_at' => $package->created_at,
            'buyer_link' => route('public.package.view', [$package->id]),
        ];
    }

    // one package show with more details
    public function show($package_id){
        $details = $this->renderPackageDetails($package_id);

        return response()->json($details,200);
    }
    
    
    
    

    public function ownPackage(){

        $packages_arr = [];
        $packages = UserPackages::where('user_id','=', Auth::user()->id )->get();

        foreach($packages as $p){
            $package_details = $this->renderPackageDetails($p->package_id);

            $no_of_completed_videos = count(\App\VideoProgress::where('package_id', $p->package_id)->where('user_id', Auth::user()->id)->get());
            $last_video = \App\VideoProgress::where('package_id', $p->package_id)->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();

            if($last_video){
                $last_video = new VideoResource(\App\Video::find($last_video->video_id));
            }else{
                $last_video = null;
            }

            $user_details = [
                'no_completed_lectures' => $no_of_completed_videos,
                'last_video' =>  $last_video,
            ];

            $package = (object)[
                'user_details' => $user_details,
                'package_details' => $package_details,

            ];

            array_push($packages_arr, $package);
        }

        return $packages_arr;
    }



    public function belongsToMe($package_id){
        $package = \App\Packages::find($package_id);
        if(!$package){
            return response()->json([
                'meta' => [
                        'code' => 404,
                        'response' => 'Package not found'
                    ]
                ]);
        }

        $user_package = \App\UserPackages::where('package_id', '=', $package_id)->where('user_id', '=', Auth::user()->id)->get()->first();
        if($user_package){
            return response()->json([
                'meta' => [
                        'code' => 200,
                        'response' => 'true'
                    ]
                ]);
        }

        $user_approve = \App\PaymentApprove::where('package_id', '=', $package_id)->where('user_id','=', Auth::user()->id)->get()->first();
        if($user_approve){
            return response()->json([
                'meta' => [
                        'code' => 200,
                        'response' => 'wait_approve'
                    ]
                ]);
        }

        return response()->json([
            'meta' => [
                'code' => 404,
                'response' => 'false'
            ]
        ]);


    }
}
