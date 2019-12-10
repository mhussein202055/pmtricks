@extends('layouts.app-2')

@section('content')

    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN THEME PANEL -->
            <!-- END THEME PANEL -->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Dashboard</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                        <i class="icon-calendar"></i>&nbsp;
                        <span class="thin uppercase hidden-xs"></span>&nbsp;
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 >
            </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
    

            <div class="container" id="app-1">
                @if(!count($package_list))
                    <div class="alert alert-warning">
                    <strong>Notice: </strong> You have not subscribed to any package yet. <a href="{{route('FreeQuiz')}}">Test Free Quiz</a> or you may check our <a href="{{route('home')}}"> Packages </a>.
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-10 mx-auto form-1" >
                        {{-- optimize Quiz Questions Form --}}
                        {{-- 
                            *******************************
                            *******************************
                            *******************************
                            *******************************
                            *******************************
                            *******************************                
                            --}}
                        
                        <h3>Video Package/s: </h3>
                        
                        <div class="portlet-body" style="margin-top: 35px;">
                            <div class="panel-group accordion scrollable" id="accordion2">
                                
                                
                                 @if(count($package_list))
                                    @foreach($package_list as $pack)
                                    @if($pack->contant_type == 'video' || $pack->contant_type == 'combined')    
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_{{$pack->id}}"> {{$pack->name}}</a>
                                                </h4>
                                            </div>
                                            <div id="collapse_{{$pack->id}}" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p> {!!$pack->description !!} </p>
                                                    
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: @foreach($package_progress as $progress) @if($progress->package_id == $pack->id) {{$progress->progress}}%@endif @endforeach" aria-valuemin="0" aria-valuemax="100">@foreach($package_progress as $progress) @if($progress->package_id == $pack->id) {{$progress->progress}}%@endif @endforeach</div>
                                                    </div>
                                                    
                                                    <p>

                                                        {{-- {{ route('st4_vid', [$pack->id, 'chapter', $topic_id, $v->id]) }} --}}
                                                        @if(\App\VideoProgress::where('user_id', Auth::user()->id)->where('package_id',$pack->id)->where('complete', 1)->orderBy('updated_at', 'desc')->get()->first())
                                                            <a href="{{ route('st4_vid', [$pack->id, 'chapter', \App\Video::find(\App\VideoProgress::where('user_id', Auth::user()->id)->where('package_id',$pack->id)->where('complete', 1)->orderBy('updated_at', 'desc')->get()->first()->video_id)->chapter , \App\VideoProgress::where('user_id', Auth::user()->id)->where('package_id',$pack->id)->where('complete', 1)->orderBy('updated_at', 'desc')->get()->first()->video_id]) }}" class="btn blue"> Go to course </a>
                                                        @else
                                                            <a href="{{ route('st4_vid', [$pack->id, 'chapter', explode(',',\App\Packages::find($pack->id)->chapter_included)[0] , \App\Video::where('chapter',explode(',',\App\Packages::find($pack->id)->chapter_included)[0])->get()->first()->id]) }}" class="btn blue">  Go to course </a>
                                                        @endif
                                                        {{-- <a href="{{route('PremiumQuiz-st2Vid', $pack->id)}}" class="btn blue">  Go to course </a> --}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>        
                                    @endif
                                    @endforeach
                                @endif 
                                {{-- <p style="color: red;">Coming Soon !</p> --}}
                                
                            </div>
                        </div>


                    </div>
                </div>
                <br>
                @if(count($expire_package))
                <div class="row">
                    <div class="col-md-10 mx-auto form-1" >
                        {{-- optimize Quiz Questions Form --}}
                        {{-- 
                            *******************************
                            *******************************
                            *******************************
                            *******************************
                            *******************************
                            *******************************                
                            --}}
                        <h3>Expired Package/s: </h3>
                        
                        <div class="portlet-body" style="margin-top: 35px;">
                            <div class="panel-group accordion scrollable" id="accordion2">
                                
                                
                                @if(count($expire_package))
                                    @foreach($expire_package as $pack)
                                    @if($pack->contant_type == 'video'  || $pack->contant_type == 'combined')    
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_{{$pack->id}}"> {{$pack->name}}</a>
                                                </h4>
                                            </div>
                                            <div id="collapse_{{$pack->id}}" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p> {!!$pack->description !!} </p>
                                                    
                                                    <p>
                                                        @if($pack->max_extension_in_days != 0)
                                                            @if(\App\ExtensionHistory::where('user_id', '=', Auth::user()->id)->where('package_id', '=', $pack->id)->get()->first())

                                                                @if(\App\ExtensionHistory::where('user_id', '=', Auth::user()->id)->where('package_id', '=', $pack->id)->get()->first()->extend_num >= $pack->max_extension_in_days)
                                                                    <a href="{{route('reset.package', $pack->id)}}" class="btn green"> Reset </a>
                                                                @else
                                                                    <a href="{{route('extend', $pack->id)}}" class="btn yellow"> Extend ({{$pack->extension_price}} $ ) +{{$pack->extension_in_days}} days </a>
                                                                @endif
                                                            @else
                                                                <a href="{{route('extend', $pack->id)}}" class="btn yellow"> Extend ({{$pack->extension_price}} $ ) +{{$pack->extension_in_days}} days </a>
                                                            @endif
                                                        @else
                                                            <a href="{{route('reset.package', $pack->id)}}" class="btn green"> Reset </a>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>        
                                    @endif
                                    @endforeach
                                @endif


                                
                            </div>
                        </div>

                        
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

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

@endsection
