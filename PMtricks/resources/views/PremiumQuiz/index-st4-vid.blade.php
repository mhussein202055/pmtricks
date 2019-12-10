@extends('layouts.app-2')

@section('head')
<style>
    .fancy-checkbox{
        font-size: 18px;
        cursor: pointer;
        
    }

    .fancy-checkbox input[type="checkbox"],
    .fancy-checkbox .checked {
        display: none;
    }
    
    .fancy-checkbox input[type="checkbox"]:checked ~ .checked
    {
        display: inline-block;
        
    }
    
    .fancy-checkbox input[type="checkbox"]:checked ~ .unchecked
    {
        display: none;
    }
    .video-title{
        padding-left: 15px;
    }
    .video-title{
        color: #333;

    }
    .video-title:hover, .video-title:active{
        color: #333 !important;
        text-decoration: none !important;
    }
    .rate {
    display: flex;
    justify-content: center;
    flex-direction: row-reverse;
    
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:120px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '&#9733; ';
    
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
</style>


@endsection

@section('content')


        <!-- BEGIN SIDEBAR -->
    
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->


<div class="page-content-wrapper" id="app-1">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding: 0 !important;">
            <!-- BEGIN PAGE HEAD-->
           
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="blog-page blog-content-2" >
                
                <div class="row">
                    <div class="col-lg-8" style="margin: 0 !important; padding: 0 !important;">
                        
                        <div class="blog-single-content bordered blog-container" style="padding-top:10px;">
                            
                            <div class="row" style="padding: 0px; margin-top: 20px;">
                                <div class="col-md-2" style="text-align: center;">
                                    @php
                        
                                    $chapters_inc = [];
                                    $total_videos_no = 0;
                                    $completed_videos_no = count(\App\VideoProgress::where('package_id', $package->id)->where('user_id', Auth::user()->id)->where('complete', 1)->get());
                                    // calculate the chapters included within the package 
                                    if($package->chapter_included != '' || $package->chapter_included != null){
                                        $arr_chapters_id = explode(',',$package->chapter_included);
                                        if( !empty($arr_chapters_id)){
                                            foreach($arr_chapters_id as $id){
                                                $ch = \App\Chapters::where('id', '=', $id)->get()->first();
                                                array_push($chapters_inc, $ch->id);
                                            }
                                        }
                                    }
                                    foreach($chapters_inc as $chapter){
                                        $n = count(\App\Video::where('chapter', $chapter)->get());
                                        $total_videos_no += $n;
                                    }
            
                                    $percentage = round($completed_videos_no/$total_videos_no * 100);
                                    @endphp
                                    <i style="font-size: 13px; font-weight: bold;">
                                        {{$completed_videos_no}}  / {{$total_videos_no}}
                                    </i>
                                    
                                </div>        
                                <div class="col-md-6">
                                    <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{$percentage}}%" aria-valuemin="0" aria-valuemax="100">{{$percentage}}%</div>
                                    </div>
                                </div>
                                
                                
                                @if($percentage == 100 && $package->certification == 1)
                                <div class="col-md-2" style="text-align: center !important;">
                                    
                                    <i style="  font-size:18px;color: orange;" class="fa fa-trophy"></i>
                                    <a style="color: black !important; font-size:15px;" type="button" data-toggle="modal" data-target="#certification">Get Certification</a>
                                    
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="certification" role="dialog">
                                        <div class="modal-dialog">
                                        
                                        <!-- Modal content-->
                                            
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Course Certification</h4>
                                                </div>
                                                <div class="modal-body">
                                                    @if(!\App\Certification::where('package_id', $package->id)->where('user_id', Auth::user()->id)->get()->first())
                                                    <p>This action is can't be repeated so you have the right to have only one Certification.<br>Please make sure you write your full name e.g.(4 parts).</p>
                                                    @endif
                                                    <form action="{{route('generate.certification')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="pacakge_id" value="{{$package->id}}">
                                                        <div class="row">
                                                            @if(!\App\Certification::where('package_id', $package->id)->where('user_id', Auth::user()->id)->get()->first())
                                                            <div class="col-md-3">
                                                                Your Full Name: 
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="name" class="form-control">
                                                            </div>
                                                            @else
                                                                <input type="hidden" name="name" value="0">
                                                            @endif
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-2 col-md-offset-3">
                                                                <input type="submit" value="Get Certification" class="btn green">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                                @endif
                                
                                @if(!\App\Rating::where('user_id',Auth::user()->id)->where('package_id', $package->id)->get()->first())
                                <div class="col-md-2">
                                    <a style="color: black !important; font-size:15px;" v-on:click="ShowRate">
                                        <i style="  font-size:18px;" class="fa fa-star-o"></i>
                                        Leave a Rating
                                        
                                    </a>
                                </div>
                                @else
                                <div class="col-md-2" style="text-align: center !important;">
                                    
                                    <a style="color: black !important; font-size:15px;" v-on:click="ShowRate">
                                        <i style="  font-size:18px;color: orange;" class="fa fa-star"></i>
                                        Update Rate
                                    </a>

                                    
                                </div>
                                @endif
                                
                            </div>
                            <hr style="border-color:#ccc;">
                            <div class="blog-single-head" style="margin-top: 8px;">
                                <h1 class="blog-single-head-title font-green" style="margin-bottom:0;">{{$video->title}} </h1>
                                @if($next_video)
                                <small style="float:right;">Play Next : 
                                
                                {{$next_video->title}}
                                
                                
                                </small>
                                @endif
                                <hr style="width: 100%; margin-top: 10px;">    
                            </div>
                            
                            <div class="blog-single-img">
                                @if($video->vimeo_id)
                                    <iframe id="player1" src="https://player.vimeo.com/video/{{$video->vimeo_id}}?api=1&player_id=player1" width="100%" height="400px" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                @else
                                <video oncontextmenu="return false;" width="100%" controls controlsList="nodownload">
                                    {{-- <source src="{{url('storage/videos/'.basename($video->video_url) )}}" type="video/mp4"> --}}
                                    <source src="{{route('tv',[$video->id,$package->id]) }}" type="video/mp4"> 
                                </video>
                                @endif
                                
                            </div>
                            <hr style="border-color:#ccc;">
                            
                            
                            
                            
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="portlet light">
                                        
                                        <div class="portlet-body">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab1" data-toggle="tab"> OverView </a>
                                                </li>
                                                <li>
                                                    <a href="#tab2" data-toggle="tab"> Q&amp;A </a>
                                                </li>
                                                <li>
                                                    <a href="#tab3" data-toggle="tab"> Resources </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade active in" id="tab1">
                                                    <p>
                                                        


                                                        <h3>What you'll learn</h3>
                                                        {!! $package->what_you_learn !!} 
                                                        <hr>
                                                        <h3>Requirements</h3>
                                                        {!! $package->requirement !!}
                                                        
                                                        <hr>
                                                        <h3>Description</h3>
                                                        <p>
                                                            {!! $package->description !!}
                                                        </p>
                                                        <hr>
                                                        <h3>Who this course is for</h3>
                                                        <p>
                                                            {!! $package->who_course_for !!}
                                                        </p>

                                                    </p>



                                                    
                                                </div>
                                                <div class="tab-pane fade" id="tab2">
                                                    <h3 class="sbold blog-comments-title">Leave A Comment</h3>
                                                    <form action="{{route('comment.store')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="page" value="video">
                                                        <input type="hidden" name="item_id" value="{{$video->id}}">
                                                        <div class="form-group">
                                                            <textarea rows="8" name="contant" placeholder="Write comment here ..." class="form-control c-square"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn blue uppercase btn-md sbold btn-block">Submit</button>
                                                        </div>
                                                    </form>
                            
                            
                            
                                                    <div class="row">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            @foreach($comments as $comment)
                                                            <div class="row" style="border-bottom: 1px solid #ccc; padding: 10px 0;">
                                                                <div class="col-md-11">
                                                                    <h5><b>{{\App\User::find($comment->user_id)->name}}</b> <i style="color:#333;">{{$comment->created_at->diffForHumans()}}</i></h5>
                                                                    <p>{{$comment->contant}}</p>
                                                                    <b><a v-on:click="ShowReplyForm({{$comment->id}})">Reply</a></b>
                                                                </div>
                            
                                                                {{--               Replies                       --}}
                                                                <div class="row" id="replies" style="">
                                                                    @foreach(\App\Comment::whereIn('id', \App\Reply::where('reply_to_id','=',$comment->id)->pluck('comment_id')->toArray() )->orderBy('created_at', 'desc')->get() as $reply)
                                                                    <div class="col-md-10 col-md-offset-2">
                                                                        <h5><b>{{\App\User::find($reply->user_id)->name}}</b> <i style="color:#333;">{{$reply->created_at->diffForHumans()}}</i></h5>
                                                                        <p>{{$reply->contant}}</p>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                            
                            
                                                                {{-- Reply form --}}
                                                                <div class="fluid-container" id="reply-form-{{$comment->id}}">
                                                                    
                                                                    {{-- <div class="row">
                                                                        <div class="col-md-10 col-md-offset-2">
                                                                            <form action="" method="post">
                                                                                @csrf
                                                                                
                                                                                <input type="hidden" name="comment_id" value="">
                                                                                <div class="form-group col-md-10" style="padding-left: 0 !important;">
                                                                                    <textarea rows="1" name="contant" placeholder="Write comment here ..." class="form-control c-square"></textarea>
                                                                                </div>
                                                                                <div class="form-group col-md-2">
                                                                                    <button type="submit" class="btn blue uppercase btn-md sbold btn-block">Reply</button>
                                                                                    <button v-on:click="removeReplyForm()" class="btn red uppercase btn-md sbold btn-block">Cancel</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                            
                                                            
                                                            @endforeach
                            
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab3">
                                                    @if($video->attachment_url) 
                    
                                                    <div class="row">
                                                        Attachment: 
                                                        {{-- <a href="{{url('storage/attachment/'.basename($video->attachment_url) )}}" style="text-decoration:underline;">Download</a> --}}
                                                        <a href=" {{route('download.material', \App\Material::where('file_url', '=', $video->attachment_url)->get()->first()->id )}}" class="btn green">   <i class="fa fa-download"></i></a>
                                                        
                                                    </div>
                                                    @else
                                                    <p>No Resource For this Video.</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix margin-bottom-20"> </div>
                                        </div>
                                    </div>
                                </div>      
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="margin: 0 !important; padding: 0 !important;">
                        <div class="blog-single-sidebar bordered blog-container" style="margin: 0; padding: 0;">

                            <div class="panel-group accordion scrollable" id="accordion2" style="margin: 0;">
                            
                                <div class="panel panel-default" style="margin:0; border: 0;">
                                    <div class="panel-heading" style="background-color: #fff; ">
                                        <h4 class="panel-title" style="font-weight: bold; border-bottom: 1px solid #ccc;">
                                            <a class="accordion-toggle font-green" data-toggle="collapse" data-parent="#accordion2" style="padding-top:20px; padding-bottom:20px;">
                                                Course Content 
                                                <div style="float:right;">{{$total_time[0]}} Hr {{$total_time[1]}} Min</div>
                                            </a>
                                            
                                        </h4>
                                    </div>
                                </div>
                                @foreach($chapters as $chapter)
                                @if(\App\Video::where('chapter', $chapter->id)->get()->first())
                                <div class="panel panel-default" style="margin:0; border: 0;">
                                    <div class="panel-heading" style="background-color: #fff; ">
                                        <h4 class="panel-title" style="font-weight: bold; border-bottom: 1px solid #ccc;">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_{{$chapter->id}}" style="padding-top:20px; padding-bottom:20px;">
                                                <i class="fa fa-plus" style="padding-right: 5px;"></i>
                                                {{$chapter->name}} ({{count(\App\Video::where('chapter', $chapter->id)->get())}} Lecture )  <i style="float:right;">{{$chapter->total_time_toString}}</i>
                                            </a>
                                        </h4>
                                    </div>

                                    
                                    <div id="collapse_{{$chapter->id}}" class="panel-collapse @if($chapter_id != $chapter->id) collapse @endif" >
                                        <div class="panel-body" style="padding: 0; border: 0;">
                                            <ul style="margin: 0; list-style-type: none; padding-left: 0px;">
                                                
                                                @foreach(\App\Video::where('chapter',$chapter->id)->orderBy('index_z')->get() as $v)
                                                <li style="padding-left: 20px; @if($video->id == $v->id) background-color:bisque; @endif">
                                                    
                                                    
                                                    
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" v-on:click="complete({{$package->id}}, {{$v->id}})" 
                                                        @if(\App\VideoProgress::where('user_id', Auth::user()->id)->where('package_id',$package->id)->where('video_id', $v->id)->get()->first())
                                                            @if(\App\VideoProgress::where('user_id', Auth::user()->id)->where('package_id',$package->id)->where('video_id', $v->id)->get()->first()->complete == 1)
                                                                checked
                                                            @endif
                                                        @endif/>
                                                        <i class="fa fa-circle-o unchecked"></i>
                                                        <i class="icon-check checked"></i>
                                                    </label>
                                                    <a href="{{ route('st4_vid', [$package->id, 'chapter', $chapter->id, $v->id]) }}" class="video-title">{{$v->title}}</a>
                                                    <b style="float:right; margin-right: 5px;">{{\Carbon\Carbon::parse($v->duration)->format('i')}} Min</b>
                                                </li>
                                                @endforeach
                                                
                                            </ul>
                                        </div>
                                    </div>

                                </div>   
                                @endif
                                @endforeach


                                <div class="modal" id="myModalRating">
                                    <div class="modal-dialog" style="width: 65%;">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header" style="border:0; margin: 10px 0;">
                                                
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="container">
                                                    <center>
                                                        <h2>
                                                            How would you rate this course?
                                                        </h2>
                                                        <p style="color:#333; font-size: 20px; font-weight: 10; min-height: 30px;">
                                                            @{{rate_sentance}}
                                                        </p>
                                                    
                                                        <div class="row rate" style=" min-height: 100px; margin: 50px 0 15px 0;">
                                                            <input type="radio" id="star5" v-model="rate_value" v-on:change="rate"  name="rate" value="5" />
                                                            <label for="star5" title="text" @mouseover="rate_state('Amazing, above expectations!')">5 stars</label>
                                                        
                                                        
                                                            <input type="radio" id="star4" v-model="rate_value" v-on:change="rate"  name="rate" value="4" />
                                                            <label for="star4" title="text" @mouseover="rate_state('Good, what i expected')">4 stars</label>
                                                        
                                                        
                                                            <input type="radio" id="star3"  v-model="rate_value" v-on:change="rate"  name="rate" value="3" />
                                                            <label for="star3" title="text" @mouseover="rate_state('Average, could be better')">3 stars</label>
                                                        
                                                        
                                                            <input type="radio" id="star2" v-model="rate_value" v-on:change="rate"  name="rate" value="2" />
                                                            <label for="star2" title="text" @mouseover="rate_state('Poor, pretty disappointed')">2 stars</label>
                                                        
                                                        
                                                            <input type="radio" id="star1" v-model="rate_value" v-on:change="rate"  name="rate" value="1" />
                                                            <label for="star1" title="text" @mouseover="rate_state('Awful, not what i expected at all')">1 stars</label>
                
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 col-md-offset-3">
                                                                <div class="form-group">
                                                                    <textarea v-model="user_review" placeholder="Tell us about your own personal experience taking this course. Was it a good match for you?" cols="30" rows="10" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            
                                                                <a v-on:click="post_review" class="btn green col-md-2 col-md-offset-4">Submit</a>    
                                                            
                                                            
                                                                <a v-on:click="HideRate" class="btn red col-md-2">Dismiss</a>    
                                                            
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                    
                                </div>     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    
    
    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->

@endsection
@section('jscode')

<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('assets/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!---->
    <script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>
    <!--<script src="https://player.vimeo.com/api/player.js"></script>-->
    <script>
        
        $(function() {
            var iframe = $('#player1')[0];
            var player = $f(iframe);
            
        
            // When the player is ready, add listeners for pause, finish, and playProgress
            player.addEvent('ready', function() {
                player.addEvent('finish', onFinish);
            });
        
            // Call the API when a button is pressed
            function onFinish() {
                
                
                Data = {
                    package_id  : {{$package->id}},
                    video_id    : {{$video->id}},
                    complete    : 1
                    
                };
                
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax ({
                    type: 'POST',
                    url: '{{ route('PremiumQuiz.VideoComplete')}}', 
                    data: Data,
                    success: function(res){
                        @if($next_video)
                            window.location.href = "{{route('st4_vid', [$package->id, $topic, $next_video->chapter, $next_video->id])}}";    
                        @endif
                                          
                    },
                    error: function(res){
                        console.log('Error:', res);    
                    }
                });
            }
        
        });

        
    </script>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
        // @if(!\App\Rating::where('user_id',Auth::user()->id)->where('package_id', $package->id)->get()->first())
        //     $('#myModalRating').show();
        // @endif

        


        var app = new Vue({
            el: '#app-1',

            data: {
                package_id: '{{$package->id}}',
                rate_value: 0,
                rate_sentance: '',
                user_review: '',
            },
            methods: {
                _: function(ele){
                    return document.getElementById(ele);
                },
                ShowRate: function(){
                    $('#myModalRating').show();
                },
                HideRate: function(){
                    $('#myModalRating').hide();
                },
                post_review: function(){
                    Data = {
                        user_review: this.user_review,
                        package_id: this.package_id
                    };
                    
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'POST',
                        url: '{{ route('user.review')}}', 
                        data: Data,
                        success: function(res){
                            $('#myModalRating').hide();
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    
                    
                    });
                    
                },
                rate_state: function(r_s){
                   this.rate_sentance = r_s;
                },
                rate: function(){
                    
                    Data = {
                        rate: this.rate_value,
                        package_id: this.package_id
                    };
                    
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'POST',
                        url: '{{ route('user.rate')}}', 
                        data: Data,
                        success: function(res){
                            // $('#myModalRating').hide();
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    
                    
                    });
                    
                           
                      
                    
                    
                },
                ShowReplyForm:function(comment_id){
                    if(this._('reply-form-'+comment_id).innerHTML == ''){
                        this._('reply-form-'+comment_id).innerHTML = '<div class="row"><div class="col-md-10 col-md-offset-2"><form action="{{route("comment.reply")}}" method="post">@csrf<input type="hidden" name="reply_to_id" value="'+comment_id+'"><div class="form-group col-md-8" style="padding-left: 0 !important;"><textarea rows="1" name="contant" placeholder="Write comment here ..." class="form-control c-square"></textarea></div><div class="form-group col-md-4"><div class="row"><button type="submit" class="btn blue uppercase btn-md col-md-6 sbold">Reply</button></div></div></form></div></div>';
                    }else{
                        this._('reply-form-'+comment_id).innerHTML = '';
                    }
                },
                removeReplyForm: function(comment_id){
                    this._('reply-form-'+comment_id).innerHTML = '';
                    alert('ok');
                },
                complete: function(package_id, video_id){
                    Data = {
                        package_id  : package_id,
                        video_id    : video_id
                    };
                    
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'POST',
                        url: '{{ route('PremiumQuiz.VideoComplete')}}', 
                        data: Data,
                        success: function(res){
                            console.log(res);                    
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    });

                }


            }
        });
    </script>

@endsection
