@extends('layouts.app-1')

@section('header')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="{{asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-summernote/summernote.css')}}" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-summernote/summernote.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/jquery-te-1.4.0.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height:1318px">
        <div class="row">
            <div class="col-md-12">
                <div class="tab-pane" id="tab_2">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Add Package  </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                <a href="javascript:;" class="reload"> </a>
                                <a href="javascript:;" class="remove"> </a>
                            </div>
                        </div>
                        <div class="portlet-body form" >

                            <div class="container" id="app1" style="display:flex; justify-content: center; align-items:center;  padding:20px 0;">

                                <div class="card col-lg-10 col-md-10 col-sm-12 col-xm-12" style="padding:0">
                                    
                                    <div class="card-body">
                                        
                                            {!! Form::open(['action' => 'packageController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                                            <div class="form-group">
                                                <strong>{{Form::label('name','Package Name :')}}</strong>
                                                {{Form::text('name', '', ['class' => 'form-control', 'placeholder'=>'Package name'])}}
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong>{{Form::label('price','Original Price :')}}</strong>
                                                        {{Form::text('price', '', ['class' => 'form-control', 'placeholder'=>'Price before the discount'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong>{{Form::label('discount','Discount (%) :')}}</strong>
                                                        {{Form::text('discount', '', ['class' => 'form-control', 'placeholder'=>'discount percentage'])}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <strong><label for="expire">Expire in (days) : </label></strong>
                                                        <input type="number" id="expire" name="expire" class="form-control" min="1" step="1" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <strong><label for="expire">Extend for (days) : </label></strong>
                                                        <input type="number" id="extension_in_days" name="extension_in_days" class="form-control" min="1" step="1" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <strong><label for="expire">Max Extension (days) : </label></strong>
                                                        <input type="number" id="max_extension" name="max_extension" class="form-control" min="1" step="1" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3"> 
                                                    <div class="form-group">
                                                        <strong><label for="contant_type">Extension Price ($): </label></strong>
                                                        {{Form::text('extension_price', '', ['class' => 'form-control', 'placeholder'=>'extension price'])}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong><label for="filter">Filter By: </label></strong>
                                                        <select name="filter" id="filter" class="form-control" v-model='filter' v-on:change="choose">
                                                            <option value="none" disabled selected>Choose</option>
                                                            <option value="chapter">Chapter</option>
                                                            <option value="process">Process Groups</option>
                                                            <option value="chapter_process">Both</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong><label for="contant_type">Contant Type: </label></strong>
                                                        <select name="contant_type" id="contant_type" class="form-control">
                                                            <option value="none" disabled selected>Choose</option>
                                                            <option value="question">Questions</option>
                                                            <option value="video">Videos</option>                                
                                                            <option value="combined">Both</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong><label for="course_id">Course : </label></strong>
                                                        <select name="course_id" id="course_id" class="form-control">
                                                            <option value="none" disabled selected>Choose</option>
                                                            @foreach(\App\Course::all() as $c)
                                                            <option value="{{$c->id}}">{{$c->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong><label for="lang">Course Language : </label></strong>
                                                        {{Form::text('lang', '', ['class' => 'form-control', 'placeholder'=>'Course language'])}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <strong><label for="description">Description: </label></strong>
                                                <textarea name="description" id="description" class="form-control jqte-test"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <strong><label for="what_you_learn">What you'll learn: </label></strong>
                                                <textarea name="what_you_learn" id="what_you_learn" class=" jqte-test form-control"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <strong><label for="requirement">Requirement : </label></strong>
                                                <textarea name="requirement" id="requirement" class="jqte-test form-control"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <strong><label for="who_course_for">Who this course is for : </label></strong>
                                                <textarea name="who_course_for" id="who_course_for" class="jqte-test form-control"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <strong><label for="enroll_msg">Enroll Confirmation Email : </label></strong>
                                                <textarea name="enroll_msg" id="enroll_msg" class="jqte-test form-control"></textarea>
                                            </div>


                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong><label for="certification">Certification : </label></strong>
                                                        <select name="certification" id="certification" class="form-control">
                                                            <option value="1">True</option>
                                                            <option value="0">False</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong><label for="certification_title">Certification Title (optional) : </label></strong>
                                                        {{Form::text('certification_title', '', ['class' => 'form-control', 'placeholder'=>'Certification Title'])}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong><label for="course_id">Package Image (large) : </label></strong>
                                                        <input type="file" name="img_large" id="img">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong><label for="course_id">Package Image (medium) : </label></strong>
                                                        <input type="file" name="img" id="img">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong><label for="course_id">Package Image (small): </label></strong>
                                                        <input type="file" name="img_small" id="img">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <strong><label for="course_id">Package Preview Video (optional): </label></strong>
                                                        <input type="file" name="preview_video" id="img">
                                                    </div>
                                                </div>
                                            </div>

                                            <label>The Package includes : </label>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="checkbox" id="exam" name="exam" v-model="exam">
                                                        <label for="exam">Exams</label>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="checkbox" v-model='chapter' id="chapter" name="chapter">
                                                    <label for="chapter">Chapters & process Groups </label>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="form-group exam_view col-lg-4" style="display:none;" >
                                                    <strong>Exam /s : </strong>
                                                    <select class="form-control" name="exams[]" id="exams" multiple>
                                                        <option value="1">Exam 1</option>
                                                        <option value="2">Exam 2</option>
                                                        <option value="3">Exam 3</option>
                                                        <option value="4">Exam 4</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group chapter_view" style="display:none;">
                                                    <strong>{{Form::label('chapter','Knowledge area :')}}</strong>
                                                    <ul class="list-group">
                                                        @foreach($chapters as $ch)
                                                            
                                                            <li class="list-group-item">
                                                                {{Form::checkbox('c'.$ch->id, $ch->name,'', ['id'=>'c'.$ch->id])}}
                                                                <label for="c{{$ch->id}}">{{$ch->name}}</label>
                                                            </li>
                                                        
                                                        @endforeach
                                                    </ul>
                                                    
                                                </div>
                                                <div class="form-group process_view" style="display:none;">
                                                    <strong>{{Form::label('process_group','Process Group :')}}</strong>
                                                    <ul class="list-group">
                                                        @foreach($process as $pg)
                                                            <li class="list-group-item">
                                                                {{Form::checkbox('p'.$pg->id, $pg->name,'',['id'=>'p'.$pg->id])}}
                                                                <label for="p{{$pg->id}}">{{$pg->name}}</label>
                                                            </li>
                                                        
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{Form::submit('Create', ['class'=>'btn green float-right'])}}
                                            </div>
                                        {!! Form::close() !!}
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
                el: '#app1',
                data:{
                    chapter: false,
                    exam: false,
                    filter: ''
                },
                methods: {
                    choose: function(){
                        if(this.chapter == true){
                            if(this.filter == 'chapter'){
                                $('.chapter_view').show();
                                $('.process_view').hide();
                            }else if (this.filter == 'process'){
                                $('.chapter_view').hide();
                                $('.process_view').show();
                            }else{
                                $('.chapter_view').show();
                                $('.process_view').show();
                            }
                        }
                    }
                },
                watch: {
                    chapter: function(){
                        if(this.chapter == true){
                            if(this.filter == 'chapter'){
                                $('.chapter_view').show();
                                $('.process_view').hide();
                            }else if (this.filter == 'process'){
                                $('.chapter_view').hide();
                                $('.process_view').show();
                            }else{
                                $('.chapter_view').show();
                                $('.process_view').show();
                            }
        
                        }else{
                            $('.chapter_view').hide();
                            $('.process_view').hide();
                        }
                    },
                    exam:function(){
                        if(this.exam == true){
                            $(".exam_view").show();
                        }else{
                            $(".exam_view").hide();
                        }
                    }
                }
            });
            
        </script>

    <script src="{{asset('assets/jquery-te-1.4.0.min.js')}}" type="text/javascript"></script>

    <script>
        $('.jqte-test').jqte();
        
        // settings of status
        var jqteStatus = true;
        $(".status").click(function()
        {
            jqteStatus = jqteStatus ? false : true;
            $('.jqte-test').jqte({"status" : jqteStatus})
        });
    </script>
@endsection
