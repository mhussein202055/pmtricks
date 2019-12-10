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
    <link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('content')
<div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                
                <!-- END PAGE TITLE -->
                <!-- BEGIN PAGE TOOLBAR -->
                
                <!-- END PAGE TOOLBAR -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
               <div class="col-lg-12">
              <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class=" icon-magnifier font-dark"></i>
                                <span class="caption-subject bold uppercase"> search option</span>
                            </div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                           <form role="form" action="{{route('statics.query')}}" method="POST">
                                @csrf
                                <input type="hidden" name="course_id" value="{{$course_id}}"/>
                                <div class="row">
                                    <div class="col-md-3 ">
                                      <lable>Year</lable>
                                       <select name="year">
                                            <option value="all" >All</option>
                                            @php
                                                //first record - oldest
                                                $first = \Carbon\Carbon::parse(\App\Payments::all()->first()->created_at)->year;
                                                // last record - newer
                                                $last = \Carbon\Carbon::parse(\App\Payments::orderBy('created_at', 'desc')->get()->first()->created_at)->year;
                                                $i = $last - $first;
                                                $year_list = [];
                                                

                                                if($i > 0){
                                                    $year_list = range($first, $last);    
                                                }else{
                                                    $year_list = [$first];
                                                }

                                            @endphp

                                            @foreach($year_list as $y)
                                                <option value="{{$y}}" @if($year == $y) selected @endif>{{$y}}</option>
                                            @endforeach
                                        
                                       </select>
                                    </div> 
                                    <div class="col-md-3 ">
                                        <lable>Month</lable>
                                        <select name="month">
                                            <option value="all">All</option>
                                            
                                            @foreach(range(1,12) as $m)
                                                <option value="{{$m}}" @if($month == $m) selected @endif>{{$m}}</option>
                                            @endforeach
                                        
                                        </select>
                                    </div> 
                                    
                                    <div class="col-md-3 ">
                                        <lable>Package</lable>
                                        <select name="package_id">
                                            <option value="all">All</option>
                                            @php
                                                $packages = \App\Packages::where('course_id', $course_id)->orderBy('created_at', 'desc')->get();
                                            @endphp

                                            @foreach($packages as $package)
                                                <option value="{{$package->id}}" @if($package->id == $package_id) selected @endif>{{$package->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div> 
                                    <div class="col-md-3 ">
                                        <input type="submit" class="btn green" value="Search"/>
                                    </div> 
                                </div>
                            </form>
                        </div>
                        <hr>
                        
                        <div class="row widget-row">
                <div class="col-md-2">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Payments</h4>
                        <div class="widget-thumb-wrap">
<!--                                    <i class="widget-thumb-icon bg-green icon-bulb"></i>-->
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{count($payments)}}"></span>
                                Payment
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
                <div class="col-md-2">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">PayPAl&amp;VISA</h4>
                        <div class="widget-thumb-wrap">
                            
                            <div class="widget-thumb-body">
                                @php
                                    $total_revenue_paypal = 0;
                                    foreach($paypal_payments as $payment){
                                        $total_revenue_paypal += $payment->totalPaid;
                                    }
                                @endphp
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$total_revenue_paypal}}"></span>
                                USD
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
                <div class="col-md-2">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">manual</h4>
                        <div class="widget-thumb-wrap">
                            <div class="widget-thumb-body">
                                @php
                                    $total_revenue_manual = 0;
                                    foreach($manual_payments as $payment){
                                        $total_revenue_manual += $payment->totalPaid;
                                    }
                                @endphp
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$total_revenue_manual}}">{{$total_revenue_manual}} </span>
                                USD
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
                 <div class="col-md-2">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Package Price</h4>
                        <div class="widget-thumb-wrap">
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="@if($package_id != 'all') {{\App\Packages::find($package_id)->price}} @endif">
                                    @if($package_id == 'all')
                                        --
                                    @else
                                        {{\App\Packages::find($package_id)->price}}
                                    @endif
                                </span>
                                USD
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
               
                <div class="col-md-2">
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">ToTAl</h4>
                        <div class="widget-thumb-wrap">
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$total_revenue_manual + $total_revenue_paypal}}"></span>
                                USD
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>
            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">DETAILS</span>
                            </div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th> User </th>
                                        <th> Date </th>
                                        <th> Package </th>
                                        <th> Revenue </th>
                                        <th> Payment Method </th>
                                        <th>coupon Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($payments as $pay)
                                        @if(\App\User::find($pay->user_id))
                                        <tr>
                                            <td>{{\App\User::find($pay->user_id)->name}}</td>
                                            <td>{{$pay->created_at}}</td>
                                            <td>{{\App\Packages::find(\App\PaymentApproveHistory::where('payment_id', $pay->id)->get()->first()->package_id)->name}}</td>
                                            <td>{{$pay->totalPaid}}</td>
                                            <td>{{$pay->paymentMethod}}</td>
                                            <td>{{$pay->coupon_code}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
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
        <script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-markdown/lib/markdown.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-summernote/summernote.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/components-editors.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/table-datatables-rowreorder.min.js')}}" type="text/javascript"></script>
        
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        <script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-markdown/lib/markdown.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-summernote/summernote.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('assets/pages/scripts/components-editors.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/jquery-te-1.4.0.min.js')}}" type="text/javascript"></script>


      
        
@endsection