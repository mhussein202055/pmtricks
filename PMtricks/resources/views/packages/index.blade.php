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
                    <!--            <span>All Packages</span>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                       
                    <!--</div>-->
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    @include('include.msg')
                    <h3 class="page-title"> 
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Begin: life time stats -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">All Questions </span>
                                    </div>
                                    <!-- <div class="actions">
                                        <div class="btn-group">
                                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                                <i class="fa fa-share"></i>
                                                <span class="hidden-xs"> Trigger Tools </span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <ul class="dropdown-menu pull-right" id="sample_3_tools">
                                                <li>
                                                    <a href="javascript:;" data-action="0" class="tool-action">
                                                        <i class="icon-printer"></i> Print</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-action="1" class="tool-action">
                                                        <i class="icon-check"></i> Copy</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-action="2" class="tool-action">
                                                        <i class="icon-doc"></i> PDF</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-action="3" class="tool-action">
                                                        <i class="icon-paper-clip"></i> Excel</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-action="4" class="tool-action">
                                                        <i class="icon-cloud-upload"></i> CSV</a>
                                                </li>
                                                <li class="divider"> </li>
                                                <li>
                                                    <a href="javascript:;" data-action="5" class="tool-action">
                                                        <i class="icon-refresh"></i> Reload</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                                            
                                            <thead>
                                                <tr>
                                                    <th>Package</th>
                                                    <th>Price</th>
                                                    <th>Original price</th>
                                                    <th>Discount</th>
                                                    <th>Extension Price</th>
                                                    <th>Expire In</th>
                                                    <th>Extend For</th>
                                                    <th>Edit</th>
                                                    <th>State</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                             
                                            <tbody>

                                                @if(count($packages) > 0)
                                                    @foreach($packages as $package)
                                                        <tr>
                                                            <td>{{$package->name}}</td>
                                                            <td>{{$package->price}} $</td>
                                                            <td>{{$package->original_price}} $</td>
                                                            <td>{{$package->discount}} %</td>
                                                            <td>{{$package->extension_price }} $</td>
                                                            <td>{{$package->expire_in_days}} day(s)</td>
                                                            <td>{{$package->extension_in_days}} day(s)</td>

                                                            <td><a href="{{ route('packages.edit', $package->id) }}">Edit</a></td>
                                                            <td>
                                                                @if($package->active == 1)
                                                                    Enabled
                                                                @else
                                                                    Disabled
                                                                @endif
                                                            </td>
                                                            <td style="font-size: 22px; display:flex; ">
                                                                <a data-toggle="modal" data-target="#DeleteModal-{{$package->id}}" style="cursor:pointer;">
                                                                    @if($package->active == 1)
                                                                        <i class="fa fa-eye" style="color: #5bc0de;"></i>
                                                                    @else
                                                                        <i class="fa fa-eye-slash" style="color: #ccc;"></i>
                                                                    @endif
                                                                </a>

                                                                <div class="modal fade" id="DeleteModal-{{$package->id}}" role="dialog">
                                                                    <div class="modal-dialog">
                                                                    
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                        <div class="modal-header" style="text-align: left;">
                                                                            <h4 class="modal-title">Warning</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            @if($package->active == 0)
                                                                                <p>
                                                                                    This package is already Disabled. Do you like to Enable it Again ?
                                                                                </p>
                                                                            @else
                                                                                <p>
                                                                                    Deleting the package means that no one have the chooise to buy this package 
                                                                                    but it still available for the current users who already bought it.
                                                                                    Are You sure ?
                                                                                </p>
                                                                            @endif
                                                                            
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            {!! Form::open(['action'=>['packageController@destroy', $package->id], 'method'=>'POST']) !!}
                                                                                {{Form::hidden('_method', 'DELETE')}}
                                                                                @if($package->active == 0)
                                                                                {{Form::submit('Enable', ['class'=>'btn btn-primary'])}}
                                                                                @else
                                                                                {{Form::submit('Disable', ['class'=>'btn btn-danger'])}}
                                                                                @endif
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else 
                                                    <p>No Content !</p>
                                                @endif


											</tbody>
            
										</table>
										
								 <div class="modal fade" id="myModal" role="dialog">
											<div class="modal-dialog">
												<div id="content-data"></div>
											</div>
										</div>
									</div>
                                        

                                        
                                    </div>
                                </div>
                            </div>
                            <!-- End: life time stats -->
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
        <!-- <script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script> -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
@endsection