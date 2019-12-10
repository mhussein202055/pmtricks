@extends('layouts.app-1')
@section('content')

            <!-- BEGIN CONTENT -->

            <div class="page-content-wrapper">
                
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                    <!-- END THEME PANEL -->
                    <!-- BEGIN PAGE BAR -->
                    <!--<div class="page-bar">-->
                    <!--    <ul class="page-breadcrumb">-->
                    <!--        <li>-->
                    <!--            <a>Exams Manager</a>-->
                    <!--            <i class="fa fa-circle"></i>-->
                    <!--        </li>-->
                    <!--        <li>-->
                    <!--            <span>Edit Video</span>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                        
                    <!--</div>-->
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    @include('include.msg')
                    <h3 >
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> Edit Video  </span>
                                    </div>
                                    
                                </div>
                                <p class="details" style="display:none;"></p>
                                <div class="progress" style="display:none">
                                    <div class="progress-bar progress-bar-striped" id="progress_bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                </div>

                                <div class="note note-danger" style="display:none;">
                                    <p id="note_text" style="font-size: 15px; font-weight: bold; color: crimson;"></p>
                                    
                                </div>

                                <div class="portlet-body form vueform"> 
                                    {!! Form::open(['action' => ['VideoController@update', $video->id], 'method'=>'POST', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal']) !!}
                                    
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="form_control_1">Video Title</label>
                                                <div class="col-md-10">
                                                    {{Form::text('title', '', ['v-model'=>'title','class' => 'form-control', 'placeholder'=>'Title', 'style'=>'margin: 0px 0.65625px 0px 0px;'])}}
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>


                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="form_control_1">Description</label>
                                                <div class="col-md-10">
                                                        {{ Form::textarea('description','',['v-model'=>'description','class'=>'form-control','row'=>'3','placeholder'=>'Description . .', 'style'=>'margin: 0px 0.65625px 0px 0px; height: 200px;'])}}
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>


                                            {{-- <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Correct Answer :</label>
                                                <div class="col-md-10">
                                                    
                                                    {{Form::file('video', '', ['id'=>'video_file','class' => 'form-control', 'placeholder'=>'Video', 'id'=>'form_control_1'])}}
                                                    {{Form::text('correct_answer', '', ['v-model'=>'a','class' => 'form-control', 'placeholder'=>'Correct Answer', 'id'=>'form_control_1'])}}
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div> --}}
                                            
                                            
                                            
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> Course:</label>
                                                <div class="col-md-10">
                                                    
                                                    {{ Form::select('course', 
                                                    
                                                    $course_select
                                                    
                                                    ,'chapter', ['class' => 'form-control','v-on:change'=>'searchCourse', 'v-model'=>'course','name'=>'course_id', 'id'=>'form_control_1'] ) }}
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> chapter:</label>
                                                <div class="col-md-10">
                                                    <select v-model="chapter" class="form-control chapter" id="form_control_1"   v-model="chapter" name="chapter" disabled>
                                                        <option disabled value="">Choose one </option>
                                                        <option v-for="i in chapter_data">@{{i}}</option>
                                                    </select>
                                                    {{-- {{ Form::select('chapter', 
                                                    
                                                    $ch_select
                                                    
                                                    ,'chapter', ['class' => 'form-control','v-on:change'=>'searchChapter', 'v-model'=>'chapter', 'id'=>'form_control_1'] ) }} --}}
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Attachment File :</label>
                                                <div class="col-md-10">
                                                    <select v-model="material_id" name="attachment" id="attachment" class="form-control">
                                                        <option value="0">none</option>
                                                        @foreach(\App\Material::orderBy('created_at', 'desc')->get() as $m)
                                                            <option value="{{$m->id}}">{{$m->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> Add Demo:</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" id="form_control_1" name = "demo">
                                                        <option disabled value=""></option>
                                                        <option value ="0">False</option>
                                                        <option value ="1">True</option>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> Duration :</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name ="duration" v-model="duration">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div> --}}
                                            
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> Vimeo ID :</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name ="vimeo_id" v-model="vimeo_id">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    
                                                    <!-- <button type="button" class="btn default">Cancel</button> -->
                                                    <!-- <button type="button" class="btn blue">Submit</button> -->
                                                    {{ Form::hidden('_method', 'PUT')}}
                                                    {{ Form::submit('Edit', ['class'=>'btn btn-success float-right'])}}
                                                    
                                                    {{-- <a style="btn btn-success" onclick="window.open('{{url('/admin/question/review')}}', 'newwindow', 'width=300,height=250');">Review</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                        
                        
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                           
                           
                        </div>
                    </div>
                    
                  
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
@endsection
@section('jscode')
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>

        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
        <script>
          
            var app = new Vue({
                el: '.vueform',
                data:{
                    test:'',
                    chapter:'{{ $video->chapter }}',         // ###
                    title: '{{ $video->title }}',          // ###
                    description: '{{ $video->description }}',     // ###
                    duration: '{{$video->duration}}',   // ###
                    vimeo_id: '{{$video->vimeo_id}}',
                    chapter_data: [],
                    // material_id: @if($video->attachment_url != null) {{\App\Material::where('file_url','=',$video->attachment_url)->get()->first()->id}} @else 0 @endif,
                    
                },
                methods:{
                    searchCourse: function(e){
                        
                        
                        Data = {
                            id : this.course
                        };

                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        
                        $.ajax ({
                            type: 'POST',
                            url: '{{ route('question.searchCourse')}}', 
                            data: Data,
                            success: function(res){
                                //validate the response 
                                // if(res.length > 0){
                                console.log("start");      
                                // }
                                //empty the array pmg_data 
                                app.chapter_data = [];
                                //store new data 
                                res.forEach(function(ele){
                                    app.chapter_data.push(ele);
                                });
                                if(res.length > 0){
                                    $(".chapter").removeAttr('disabled');
                                    console.log(res);
                                    console.log('ok');
                                }
                                
                                
                            },
                            error: function(res){
                                console.log('Error:', res);    
                            }
                        });
                    },
                    
                    
                    
                   
                }
            });
        </script>
@endsection