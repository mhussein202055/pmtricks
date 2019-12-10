<?php $__env->startSection('header'); ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="<?php echo e(asset('assets/global/css/components.min.css')); ?>" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo e(asset('assets/global/css/plugins.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-summernote/summernote.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-summernote/summernote.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/jquery-te-1.4.0.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/datatables/datatables.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
            <!-- BEGIN CONTENT -->
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
                                <a >Exams Manager</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>All Questions</span>
                            </li>
                        </ul>
                       
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <?php echo $__env->make('include.msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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

                                    <?php echo Form::open(['action'=>'QuestionsController@search', 'method'=>'GET', 'class'=>'', 'style'=>'margin: 10px 0 20px 0;']); ?>

                                    <div class="form-group row" style="margin: 10px 0;">
                                        
                                        <div class="col-sm-1" style="padding:0;">
                                            <strong><?php echo e(Form::label('word','Search :')); ?></strong>
                                        </div>
                                        <div class="col-sm-11">
                                            <?php echo e(Form::text('word', '', ['class' => 'form-control', 'placeholder'=>'Search', 'style'=>'margin: 0 10px 0 10px;'])); ?>

                                        </div>                                   

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6" style="margin: 10px 0;">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <strong><?php echo e(Form::label('chapter','knowledge Area :')); ?></strong>
                                                </div>
                                                <div class="col-sm-9">
                                                    <?php echo e(Form::select('chapter', $ch_select,'', ['class' => 'form-control'] )); ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6" style="margin: 10px 0;">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <strong><?php echo e(Form::label('process_group','Process Group :')); ?></strong>
                                                </div>
                                                <div class="col-sm-10">
                                                    <?php echo e(Form::select('process_group', $pg_select,'', ['class' => 'form-control'] )); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="form-group col-sm-5" style="margin: 10px 0;">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <strong><?php echo e(Form::label('pmg','Project Management Group:')); ?></strong>
                                                </div>
                                                <div class="col-sm-9">
                                                    <?php echo e(Form::select('project_management_group', $pmg,'', ['class' => 'form-control'] )); ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6" style="margin: 10px 0;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <strong><?php echo e(Form::label('exam','Exam :')); ?></strong>
                                                </div>
                                                <div class="col-sm-8">
                                                    <?php echo e(Form::select('exam', 
                                                        [   '00'=> '',
                                                            '1'=>'Exam 1',
                                                            '2'=>'Exam 2',
                                                            '3'=>'Exam 3',
                                                            '4'=>'Exam 4'
                                                            ],'', ['class' => 'form-control'] )); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="search" value="1">
                                        <div class="form-group col-sm-1" style="margin: 10px 0; padding:0;">
                                            <?php echo e(Form::submit('search', ['class'=>'btn btn-primary float-right', 'style'=>''])); ?>

                                        </div>
                                    </div>
                                    <?php echo Form::close(); ?>

                                
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
                                    <p>
                                        
                                            Results: <?php echo e($result_counter); ?>

                                        
                                    </p>
                                    
                                    <div class="table-responsive">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption font-dark">
                                                    <i class="icon-settings font-dark"></i>
                                                    <span class="caption-subject bold uppercase">DETAILS</span>
                                                </div>
                                                <div class="tools"> </div>
                                            </div>
                                            <div class="portlet-body">
                                                <table class="table table-striped table-bordered table-hover" id="sample_2">
                                                    <thead>
                                                            <td>No.</td>
                                                            <td>Questions</td>
                                                            <td>Chapter</td>
                                                            <td>Project Management Process</td>
                                                            <td>Process Group</td>
                                                            <td>Free Quiz </td>
                                                            <td>Exam No.</td>
                                                            <td>Answer A</td>
                                                            <td>Answer B</td>
                                                            <td>Answer C</td>
                                                            <td>Answer Correct</td>
                                                            <td>Preview</td>
                                                            <td>Edit</td>                                                            
                                                            <td>Delete</td>                                                            
                                                    </thead>
                                                    
                                                    <tbody>

                                                        
                                                            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><?php echo e($q->id); ?></td>
                                                                    <td><strong><?php echo e($q->title); ?></strong></td>
                                                                    <td>
                                                                        <?php if($q->chapter != ''): ?>
                                                                        <?php echo e(\App\Chapters::where('id','=',$q->chapter)->get()->first()->name); ?>

                                                                        <?php else: ?>
                                                                        --
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if($q->project_management_group != ''): ?>
                                                                        <?php echo e(\App\ProjectManagementGroup::where('id','=',$q->project_management_group)->get()->first()->name); ?>

                                                                        <?php else: ?>
                                                                        --
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if($q->process_group != ''): ?>
                                                                        <?php echo e(\App\Process_group::where('id','=',$q->process_group)->get()->first()->name); ?>

                                                                        <?php else: ?>
                                                                        --
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if($q->demo == 1): ?>
                                                                            True
                                                                        <?php else: ?>
                                                                            False
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if($q->exam_num != ''): ?>
                                                                            <?php echo e($q->exam_num); ?>

                                                                        <?php else: ?>
                                                                            --
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td><?php echo e($q->a); ?></td>
                                                                    <td><?php echo e($q->b); ?></td>
                                                                    <td><?php echo e($q->c); ?></td>
                                                                    <td><?php echo e($q->correct_answer); ?></td>
                                                                    <td><a style="border:0;" onClick="window.open('<?php echo e(route('PremiumQuiz-st3', ['question','preview',$q->id, 'realtime'])); ?>/?ignore=1', '_blank','resizable,height=560,width=1070')" class="btn btn-outline-info" style="margin-right: 10px;"> <i class="fa fa-eye"></i> </a></td>
                                                                    <td><a style="border:0;" href="<?php echo e(route('question.edit', $q->id)); ?>" class="btn btn-outline-info" style="margin-right: 10px;"> <i class="fa fa-edit"></i> </a></td>
                                                                    
                                                                    <td><a style="border:0;" href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#DeleteModal-<?php echo e($q->id); ?>"> <i style="color: red;" class="fa fa-trash"></i> </a></td>
                                                                    
                                                                </tr>

                                                                <div class="modal fade" id="DeleteModal-<?php echo e($q->id); ?>" role="dialog">
                                                                        <div class="modal-dialog">

                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header" style="text-align: left;">
                                                                                <h4 class="modal-title">Are You Sure ?</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p><?php echo e($q->title); ?></p>
                                                                                <p><strong>Correct Answer: </strong> <?php echo e($q->correct_answer); ?></p>
                                                                                <p><strong>Attached to Package: </strong> 
                                                                                    <?php if(isset($roles_list[$q->id])): ?>
                                                                                        <?php echo e($roles_list[$q->id]); ?>

                                                                                    <?php else: ?> 
                                                                                        None
                                                                                    <?php endif; ?>
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                <?php echo Form::open(['action'=>['QuestionsController@destroy', $q->id], 'method'=>'POST']); ?>

                                                                                    <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                                                                    <?php echo e(Form::submit('Delete', ['class'=>'btn btn-danger'])); ?>

                                                                                <?php echo Form::close(); ?>

                                                                            </div>
                                                                        </div>

                                                                        </div>
                                                                    </div>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        



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
                            </div>
                            <!-- End: life time stats -->
                        </div>
                    </div>
                    
                </div>
                <!-- END CONTENT BODY -->

            </div>
            <!-- END CONTENT -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jscode'); ?>
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo e(asset('assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/js.cookie.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jquery.blockui.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo e(asset('assets/global/plugins/moment.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/morris/morris.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/morris/raphael-min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/counterup/jquery.waypoints.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/counterup/jquery.counterup.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/amcharts/amcharts/amcharts.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/amcharts/amcharts/serial.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/amcharts/amcharts/pie.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/amcharts/amcharts/radar.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/amcharts/amcharts/themes/light.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/amcharts/ammap/ammap.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/amcharts/amstockcharts/amstock.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/fullcalendar/fullcalendar.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/flot/jquery.flot.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/flot/jquery.flot.resize.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/flot/jquery.flot.categories.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jquery.sparkline.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/scripts/datatable.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/datatables/datatables.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')); ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo e(asset('assets/global/scripts/app.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-markdown/lib/markdown.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-summernote/summernote.min.js')); ?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo e(asset('assets/pages/scripts/dashboard.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/pages/scripts/components-editors.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/pages/scripts/table-datatables-rowreorder.js')); ?>" type="text/javascript"></script>
        
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo e(asset('assets/layouts/layout/scripts/layout.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/layouts/layout/scripts/demo.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/layouts/global/scripts/quick-sidebar.min.js')); ?>" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-markdown/lib/markdown.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-summernote/summernote.min.js')); ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo e(asset('assets/pages/scripts/components-editors.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/jquery-te-1.4.0.min.js')); ?>" type="text/javascript"></script>


      
        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>