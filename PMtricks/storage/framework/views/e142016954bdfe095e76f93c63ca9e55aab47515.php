<?php $__env->startSection('content'); ?>

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
            <!--            <a href="index.html">Home</a>-->
            <!--            <i class="fa fa-circle"></i>-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <span>Dashboard</span>-->
            <!--        </li>-->
            <!--    </ul>-->
            <!--    <div class="page-toolbar">-->
            <!--        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">-->
            <!--            <i class="icon-calendar"></i>&nbsp;-->
            <!--            <span class="thin uppercase hidden-xs"></span>&nbsp;-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 >
            </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->

            <div class="container" id="app-1">
                
                <div class="row">
                    <div class="col-md-10 mx-auto form-1" >
                        
                        <h2><?php echo e($video->title); ?> </h2>

                        <?php if($video->vimeo_id): ?>
                            <iframe id="player1" src="https://player.vimeo.com/video/<?php echo e($video->vimeo_id); ?>?api=1&player_id=player1" width="100%" height="400px" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                        <?php else: ?>
                        <video oncontextmenu="return false;" width="512" height="380" controls controlsList="nodownload">
                            <source src="<?php echo e(url('storage/videos/'.basename($video->video_url) )); ?>" type="video/mp4">
                        </video>
                        <?php endif; ?>
                        

                        <div class="row" style="margin: 50px 0">
                            <div class="col-sm-2 col-md-2 col-lg-2">
                                Description:
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-8 " >
                                <?php echo e($video->description); ?>

                            </div>
                        </div>
                        
                        <?php if($video->attachment_url): ?> 
                        
                        <div class="row">
                            Attachment: 
                            
                            <a href=" <?php echo e(route('download.material', \App\Material::where('file_url', '=', $video->attachment_url)->get()->first()->id )); ?>" class="btn green">   <i class="fa fa-download"></i></a>
                            
                        </div>
                        <?php endif; ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>