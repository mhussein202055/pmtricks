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
        <!-- BEGIN PAGE HEADER-->
        
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Package edit</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> 
            {{$package->name}}
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <form action="{{ route('packages.update', $package->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data" style="background: white; padding: 30px 15px;">
            @csrf
            {{ Form::hidden('_method', 'PUT')}}
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="popular">Popular :</label>
                <div class="col-md-8">
                <input type="checkbox" value = "1" name="popular" id="popular" class="">
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Package Name:</label>
                <div class="col-md-8">
                <input type="text" class="form-control input-sm" name="name" placeholder="Client ID" value="{{ $package->name }}" >
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Original Price :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="price" placeholder="original price before discount" value="{{ 
                    round($package->original_price, 2)
                    }}" >
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Extension Price :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="extension_price" placeholder="Extension Price" value="{{ 
                    round($package->extension_price, 2)
                    }}" >
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Expire in (days) :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="expire" placeholder="Expire in NO. of days" value="{{$package->expire_in_days}}" >
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Extend for (days) :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="extension_in_days" placeholder="extend package for NO. of days" value="{{$package->extension_in_days}}" >
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Max Extension (days) :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="max_extension" placeholder="Max Extension" value="{{$package->max_extension_in_days}}" >
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Discount :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="discount" placeholder="discount" value="{{ $package->discount }}" >
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Course :</label>
                <div class="col-md-8">
                    <select name="course_id" id="course_id" class="form-control">
                        <option value="none" disabled selected>Choose</option>
                        @foreach(\App\Course::all() as $c)
                        <option value="{{$c->id}}" 
                            @if($package->course_id == $c->id)
                                selected
                            @endif   >{{$c->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Language :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="lang" placeholder="Language" value="{{ $package->lang }}" >
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Package Image(large) :</label>
                <div class="col-md-8">
                    <input type="file" name="img_large" id="img">
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Package Image(medium) :</label>
                <div class="col-md-8">
                    <input type="file" name="img" id="img">
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Package Image(small) :</label>
                <div class="col-md-8">
                    <input type="file" name="img_small" id="img">
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Package Preview Video :</label>
                <div class="col-md-8">
                    <input type="file" name="preview_video" id="img">
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Description:</label>
                <div class="col-md-8">
                
                <textarea class="form-control input-sm jqte-test" name="description" id="" cols="30" rows="10">{{ $package->description }}</textarea>
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">What You Learn:</label>
                <div class="col-md-8">
                
                <textarea class="form-control input-sm jqte-test" name="what_you_learn" id="" cols="30" rows="10">{{ $package->what_you_learn }}</textarea>
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Requirement:</label>
                <div class="col-md-8">
                
                <textarea class="form-control input-sm jqte-test" name="requirement" id="" cols="30" rows="10">{{ $package->requirement }}</textarea>
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Who this course is for:</label>
                <div class="col-md-8">
                
                <textarea class="form-control input-sm jqte-test" name="who_course_for" id="" cols="30" rows="10">{{ $package->who_course_for }}</textarea>
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Enroll Confirmation Email :</label>
                <div class="col-md-8">
                
                <textarea class="form-control input-sm jqte-test" name="enroll_msg" id="" cols="30" rows="10">{{ $package->enroll_msg }}</textarea>
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="certification">Certification :</label>
                <div class="col-md-8">
                    <select name="certification" id="certification">
                        <option value="1" @if($package->certification == 1) selected @endif>True</option>
                        <option value="0" @if($package->certification == 0) selected @endif>False</option>
                    </select>
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="certification_title">Certification Title :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="certification_title" id="certification_title" placeholder="Certification title" value="{{ $package->certification_title }}" >
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group control-label">
                <div class="col-md-2">
                <input type="submit" value="Edit" class="btn btn-warning">
            </div>
            </div>
        </form>
    </div>
    <!-- END CONTENT BODY -->
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