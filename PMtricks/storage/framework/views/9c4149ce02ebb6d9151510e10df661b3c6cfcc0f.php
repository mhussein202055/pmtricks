<?php $__env->startSection('content'); ?>

<div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 >
            </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->

            <div class="container">
                
                <div class="row">
                    <div class="col-md-10 mx-auto form-1" >
                        
                        <h2>Select A Topic: </h2>
                        
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet">
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-advance table-hover">
                                        <thead align="center">
                                            <tr>
                                                <th>Name </th>
                                                <th>QNM  </th>
                                                <th>Time </th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody align="center">
                                            <?php if($topics['chapters'] || $topics['process']): ?>
                                                
                                            <?php endif; ?>


                                            <?php if($topics['chapters'] != null): ?>
                                                
                                                <td colspan="4">Knowledge Area</td>
                                                <?php $__currentLoopData = $topics['chapters']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(count( \App\Question::where('chapter', '=', $item->id)->get() ) > 0): ?>
                                                    <tr>
                                                        <td >
                                                            <?php echo e($item->name); ?> 

                                                            <?php if(\App\Quiz::where([
                                                            ['user_id', '=', Auth::user()->id],
                                                            ['package_id','=', $topics['package_id']],
                                                            ['topic_type', '=', 'chapter'],
                                                            ['topic_id', '=', $item->id],
                                                            ['complete', '=', 0],
                                                            ])->get()->first()): ?>
                                                                <i style="color:#c6112d;"> [Saved]</i> 
                                                            <?php endif; ?>

                                                        </td>
                                                        <td > <?php echo e(count( \App\Question::where('chapter', '=', $item->id)->get() )); ?> </td>
                                                        <td> <?php echo e(round( (count(\App\Question::where('chapter', '=', $item->id)->get()) * 72)/ 3600)); ?> ~hr</td>
                                                        
                                                        <td>
                                                            <a href="<?php echo e(route('PremiumQuiz-st3', [$topics['package_id'],'chapter', $item->id, 'realtime'])); ?>" class="btn btn-outline btn-circle btn-sm purple">
                                                                <i class="fa fa-power-off"></i> Start </a>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                            <?php if($topics['process'] != null): ?>
                                                
                                                <td colspan="4">Process Group</td>
                                                
                                                <?php $__currentLoopData = $topics['process']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(count( \App\Question::where('process_group', '=', $item->id)->get() ) > 0): ?>
                                                    <tr>
                                                        <td >
                                                            <?php echo e($item->name); ?> 

                                                            <?php if(\App\Quiz::where([
                                                            ['user_id', '=', Auth::user()->id],
                                                            ['package_id','=', $topics['package_id']],
                                                            ['topic_type', '=', 'process_group'],
                                                            ['topic_id', '=', $item->id],
                                                            ['complete', '=', 0],
                                                            ])->get()->first()): ?>
                                                                <i style="color:#c6112d;"> [Saved]</i> 
                                                            <?php endif; ?>

                                                        </td>
                                                        <td >  <?php echo e(count( \App\Question::where('process_group', '=', $item->id)->get() )); ?> </td>
                                                        <td> <?php echo e(round( (count(\App\Question::where('process_group', '=', $item->id)->get()) * 72)/ 3600)); ?> ~hr</td>
                                                        <td>
                                                            <a href="<?php echo e(route('PremiumQuiz-st3', [$topics['package_id'],'process', $item->id, 'realtime'])); ?>" class="btn btn-outline btn-circle btn-sm purple">
                                                                <i class="fa fa-power-off"></i> Start </a>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                            <?php if($topics['exams'] != null): ?>
                                                
                                                <td colspan="4">Exams</td>
                                                
                                                <?php $__currentLoopData = $topics['exams']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td >
                                                            <?php echo e($item->name); ?> 

                                                            <?php if(\App\Quiz::where([
                                                            ['user_id', '=', Auth::user()->id],
                                                            ['package_id','=', $topics['package_id']],
                                                            ['topic_type', '=', 'exam'],
                                                            ['topic_id', '=', $item->id],
                                                            ['complete', '=', 0],
                                                            ])->get()->first()): ?>
                                                                <i style="color:#c6112d;"> [Saved]</i> 
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>  <?php echo e(count( \App\Question::where('exam_num', 'LIKE', '%'.$item->id.'%')->get() )); ?> </td>
                                                        <td> <?php echo e(round( (count(\App\Question::where('exam_num', 'LIKE', '%'.$item->id.'%')->get()) * 72)/ 3600)); ?> ~hr</td>
                                                        
                                                        <td>
                                                            <a href="<?php echo e(route('PremiumQuiz-st3', [$topics['package_id'],'exam', $item->id, 'realtime'])); ?>" class="btn btn-outline btn-circle btn-sm purple">
                                                                <i class="fa fa-power-off"></i> Start </a>
                                                        </td>
                                                    </tr>
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
        </div>


        
    </div>

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
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo e(asset('assets/global/scripts/app.min.js')); ?>" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(asset('assets/pages/scripts/dashboard.min.js')); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo e(asset('assets/layouts/layout/scripts/layout.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/layouts/layout/scripts/demo.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/layouts/global/scripts/quick-sidebar.min.js')); ?>" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
        

        


        var app = new Vue({
            el: '#app-1',

            data: {
                
            },
            methods: {
                _: function(ele){
                    return document.getElementById(ele);
                },
                ShowReplyForm:function(comment_id){
                    
                    if(this._('reply-form-'+comment_id).innerHTML == ''){
                        this._('reply-form-'+comment_id).innerHTML = '<div class="row"><div class="col-md-10 col-md-offset-2"><form action="<?php echo e(route("comment.reply")); ?>" method="post"><?php echo csrf_field(); ?><input type="hidden" name="reply_to_id" value="'+comment_id+'"><div class="form-group col-md-8" style="padding-left: 0 !important;"><textarea rows="1" name="contant" placeholder="Write comment here ..." class="form-control c-square"></textarea></div><div class="form-group col-md-4"><div class="row"><button type="submit" class="btn blue uppercase btn-md col-md-6 sbold">Reply</button></div></div></form></div></div>';
                    }else{
                        this._('reply-form-'+comment_id).innerHTML = '';
                    }
                },
                removeReplyForm: function(comment_id){
                    this._('reply-form-'+comment_id).innerHTML = '';
                    alert('ok');
                }


            }
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>