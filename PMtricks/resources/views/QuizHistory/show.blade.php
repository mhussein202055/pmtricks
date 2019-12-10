@extends('layouts.app-2')

@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN THEME PANEL -->
        <!-- END THEME PANEL -->
        
        
        <!-- BEGIN PAGE TITLE-->
        <h3 >
        </h3>
        <p>
            Notice That: All Practice tests result are kept for you to reivew you progress.
        </p>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Practice tests History </div>
            </div>
            <div class="portlet-body" id="app-1">
                <div class="">
                    @php
                    $attempt = count(\App\Quiz::where('user_id', Auth::user()->id)->where('complete', 1)->orderBy('updated_at', 'desc')->get());
                    @endphp
                    @foreach(\App\Quiz::where('user_id', Auth::user()->id)->where('complete', 1)->orderBy('updated_at', 'desc')->get() as $quiz_z)
                    <div class="row" style="margin-top: 10px; margin-bottom: 10x;">
                        <div class="container" id="view1{{$quiz_z->id}}" style="border:1px solid #ccc; width:80%; padding: 25px 0;box-shadow: 0px 9px 15px -4px rgba(0,0,0,0.14); ">
                            <div style="display:flex; justify-content: space-evenly; align-items:center; flex-wrap: wrap;" >
                                <div style="min-width:250px;">
                                    @if($quiz_z->topic_type == 'chapter')
                                        {{\App\Chapters::find($quiz_z->topic_id)->name}}
                                    @elseif($quiz_z->topic_type == 'process_group')
                                        {{\App\Process_group::find($quiz_z->topic_id)->name}}
                                    @else
                                        Exam {{$quiz_z->topic_id}}
                                    @endif
                                </div>
                                <div class="">
                                    @if($quiz_z->score >= 80)
                                        <b style="color:darkgreen">Success</b>
                                    @else
                                        <b style="color:darkred">Faild</b>
                                    @endif

                                    
                                </div>
                                <div class="">
                                    <b>{{$quiz_z->score}}%</b> Correct
                                </div>
                                <div class="">
                                    @php
                                        $hours = 0;
                                        $mins = 0;
                                        $sec = 0;
                                        if($quiz_z->time_left != 0){
                                            $hours = floor($quiz_z->time_left/3600);
                                            $mins = floor( ($quiz_z->time_left%3600) / 60);
                                            $sec = floor(($quiz_z->time_left%3600) % 60);
                                        }
                                        
                                        
                                        

                                        
                                        
                                    @endphp
                                    {{$hours}} Hour {{$mins}} Min {{$sec}} Sec
                                </div>
                                <div class="">
                                    {{$quiz_z->updated_at->diffForHumans()}}
                                </div>
                                <div class="col-md-1">
                                    {{-- <i class="fa fa-arrow-down" style="font-size: 25px; color:#ccc; cursor: pointer;" v-on:click="slideMe('view2{{$quiz_z->id}}', 'view1{{$quiz_z->id}}')"></i> --}}
                                    <a href="{{route('QuizHistory.show', $quiz_z->id)}}" class="btn red">Review</a>
                                </div>
                            </div>
                        </div>

                        <div class="container" id="view2{{$quiz_z->id}}" style="border:1px solid #ccc; width:80%; padding: 25px 0;box-shadow: 0px 9px 15px -4px rgba(0,0,0,0.14);display:none;">
                            <div class="row" >
                                <div class="col-md-5"></div>     
                                <div class="col-md-6" style="display:flex; justify-content: space-evenly; align-items:flex-start; flex-direction:column; flex-wrap: wrap;">
                                    <div style="font-size: 20px; margin:5px;">
                                        

                                        @if($quiz_z->score >= 80)
                                            <i style="color: darkgreen;">Success (80% Required to pass)</i>
                                        @else
                                            <i style="color: darkred;">Faild (80% Required to pass)</i>
                                        @endif
                                    </div>
                                    <div style="margin:5px;">
                                        <b style="font-size: 25px;"> {{$quiz_z->score}}% </b><small>Correct</small>
                                    </div>
                                    <div style="color: #ccc;margin:5px;">
                                        {{$hours}} Hour {{$mins}} Min {{$sec}} Sec
                                    </div>
                                    <div style="color: #ccc;margin:5px;">
                                        {{$quiz_z->updated_at->diffForHumans()}}
                                    </div>
                                    <div style="margin:5px;">
                                        <a href="{{route('QuizHistory.show', $quiz_z->id)}}" class="btn green">Review Quiz</a>
                                    </div>

                                </div>
                                <div class="col-md-1">
                                    <i class="fa fa-arrow-up" style="font-size: 25px; color:#ccc; cursor: pointer;" v-on:click="slideMe('view1{{$quiz_z->id}}', 'view2{{$quiz_z->id}}')"></i>
                                </div>
                                                                                        
                            </div>
                        </div>
                    </div>

                    @php
                    $attempt--;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
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
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script>


var app = new Vue({
    el: '#app-1',
       data: {
           
           saved_quiz_id: 0,
           

        },
        methods: {
            showReview: function(){
               uri = '{{route('QuizHistory.show', '')}}/'+this.saved_quiz_id;
               window.location.href = uri;
            },
            slideMe: function(show, hide){
               $('#'+show).slideDown();
               $('#'+hide).slideUp();
            },
        }
});

</script>

@endsection