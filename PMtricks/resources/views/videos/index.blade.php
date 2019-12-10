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
                    <!--            <a >Exams Manager</a>-->
                    <!--            <i class="fa fa-circle"></i>-->
                    <!--        </li>-->
                    <!--        <li>-->
                    <!--            <span>All Videos</span>-->
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
                                        <span class="caption-subject font-green sbold uppercase">Search</span>
                                    </div>
                                </div>
                                <div class="portlet-body">

                                    {!! Form::open(['action'=>'VideoController@search', 'method'=>'GET', 'class'=>'', 'style'=>'margin: 10px 0 20px 0;']) !!}
                                    <div class="form-group row" style="margin: 10px 0;">
                                        
                                        <div class="col-sm-1" style="padding:0;">
                                            <strong>{{Form::label('word','Search :')}}</strong>
                                        </div>
                                        <div class="col-sm-11">
                                            {{Form::text('word', '', ['class' => 'form-control', 'placeholder'=>'Search', 'style'=>'margin: 0 10px 0 10px;'])}}
                                        </div>                                   

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6" style="margin: 10px 0;">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <strong>{{Form::label('chapter','knowledge Area :')}}</strong>
                                                </div>
                                                <div class="col-sm-9">
                                                    {{ Form::select('chapter', $ch_select,'', ['class' => 'form-control'] ) }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6" style="margin: 10px 0;">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <strong>{{Form::label('process_group','Process Group :')}}</strong>
                                                </div>
                                                <div class="col-sm-10">
                                                    {{ Form::select('process_group', $pg_select,'', ['class' => 'form-control'] ) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="form-group col-sm-5" style="margin: 10px 0;">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <strong>{{Form::label('pmg','Project Management Group:')}}</strong>
                                                </div>
                                                <div class="col-sm-9">
                                                    {{ Form::select('project_management_group', $pmg,'', ['class' => 'form-control'] ) }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6" style="margin: 10px 0;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <strong>{{Form::label('exam','Exam :')}}</strong>
                                                </div>
                                                <div class="col-sm-8">
                                                    {{ Form::select('exam', 
                                                        [   '00'=> '',
                                                            '1'=>'Exam 1',
                                                            '2'=>'Exam 2',
                                                            '3'=>'Exam 3',
                                                            '4'=>'Exam 4'
                                                            ],'', ['class' => 'form-control'] ) }}
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="search" value="1">
                                        <div class="form-group col-sm-1" style="margin: 10px 0; padding:0;">
                                            {{Form::submit('search', ['class'=>'btn btn-primary float-right', 'style'=>''])}}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                
                                </div>
                            </div>
                        </div>
                    </div>




                    
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Begin: life time stats -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">All Videos </span>
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
                                    <p>
                                        
                                            Results: {{$result_counter}}
                                        
                                    </p>
                                    <div class="table-container">
                                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                                            
                                            <thead>
                                                    <tr>
                                                        <td>No.</td>
                                                        <td>Title</td>
                                                        <td>Course</td>
                                                        <td>Chapter</td>
                                                        <td>Edit</td>
                                                        <td>Delete</td>
                                                    </tr>
                                             </thead>
                                             
                                             <tbody>

												{{-- @if(count($questions)> 0) --}}
													@foreach($videos as $q)
														<tr>
															<td>{{$q->id}}</td>
                                                            <td><strong>{{substr($q->title, 0, 80)}}</strong></td>
                                                            <td>
                                                                {{\App\Course::find(\App\Chapters::find($q->chapter)->course_id)->title}}
                                                            </td>
															<td>
																@if($q->chapter != '')
																{{\App\Chapters::where('id','=',$q->chapter)->get()->first()->name }}
																@else
																--
																@endif
															</td>
															
															<td><a style="border:0;" href="{{ route('video.edit', $q->id) }}" class="btn btn-outline-info" style="margin-right: 10px;"> <i class="fa fa-edit"></i> </a></td>
															<td><a style="border:0;" href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#DeleteModal-{{$q->id}}"> <i style="color: red;" class="fa fa-trash"></i> </a></td>
														</tr>

														<div class="modal fade" id="DeleteModal-{{$q->id}}" role="dialog">
																<div class="modal-dialog">

																  <!-- Modal content-->
																  <div class="modal-content">
																	<div class="modal-header" style="text-align: left;">
																		<h4 class="modal-title">Are You Sure ?</h4>
																	</div>
																	<div class="modal-body">
                                                                        <p>{{$q->title}}</p>															
																	</div>
																	<div class="modal-footer">
																	  <button type="button" class="btn btn-default" data-dismiss="modal" style="float:right;">Close</button>
																		{!! Form::open(['action'=>['VideoController@destroy', $q->id], 'method'=>'POST']) !!}
																			{{Form::hidden('_method', 'DELETE')}}
																			{{Form::submit('Delete', ['class'=>'btn btn-danger', 'style'=>'float:right;'])}}
																		{!! Form::close() !!}
																	</div>
																  </div>

																</div>
															</div>

													@endforeach
												{{-- @else
													<p>noting to show !</p>
												@endif --}}



											</tbody>
            
										</table>
										{{ $videos->appends(Request::input())->links() }}
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