<?php

namespace App\Http\Controllers\API;


use App\Chapters;
use App\Http\Resources\Video\VideoResource;
use App\Packages;
use App\Process_group;
use App\Question;
use App\UserPackages;
use App\Http\Resources\Package\PackageResource;
use App\Http\Resources\Package\PackageCollection;
use App\Http\Resources\Package\UserPackageCollection;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class API_PackageController extends Controller
{
    //all package show with less details
    public function index(){
        // return PackageResource::collection( Packages::all() );
        return PackageCollection::collection( Packages::all() );
    }

    public function renderPackageDetails($package_id){
        $package = \App\Packages::find($package_id);
        if(!$package){
            return response()->json([
                'error' => 'package not exists'
            ], 404);
        }




        $chapters = [];
        if( $package->chapter_included != NULL){

            $chapters_by_id = explode(',', $package->chapter_included);
            foreach($chapters_by_id as $id){
                $query = Chapters::find((int)$id);
                // calculate number of questions attached to this process group
                $count = 0;
                $questions = \App\Question::where('chapter', $id)->get();

                $count += count($questions);
                $videos_array = [];
                if($package->contant_type == 'video' || $package->contant_type == 'combined'){
                    $video = \App\Video::where('chapter', $id)->orderBy('index_z')->get();

                    foreach($video as $v){
                        if($v->event_id == null){
                            array_push($videos_array, new VideoResource($v));
                        }
                    }
                }

                $item = [
                    'id'=> (int)$id ,
                    'name'=>$query->name ,
                    'questions_number' => $count,
                    'videos' => $videos_array,
                ];
                array_push($chapters, $item);
            }

        }

        $process_groups = [];
        if($package->process_group_included != NUll){

            $process_by_id = explode(',', $package->process_group_included);
            foreach($process_by_id as $id){
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
                $count = count(Question::where('exam_num', 'like', '%'.$id.'%')->get());
                $item = ['id'=> (int)$id, 'name' => 'Exam '.$id, 'questions_number'=> $count];
                array_push($exams, $item);
            }
        }

        return [
            'id'=> $package->id,
            'name'=> $package->name,
            'price'=>$package->price,
//            'description'=> $package->description,
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
            $details = $this->renderPackageDetails($p->package_id);
            array_push($packages_arr, $details);
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
