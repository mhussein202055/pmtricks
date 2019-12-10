<?php $__env->startSection('content'); ?>

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
                    <!--            <span>Add Questions</span>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                        
                    <!--</div>-->
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <?php echo $__env->make('include.msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                                        <span class="caption-subject bold uppercase"> Add Questions </span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body form vueform">
                                    <?php echo Form::open(['action' => 'QuestionsController@create', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal']); ?>

                                        <div class="form-body">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="form_control_1">Question</label>
                                                <div class="col-md-10">
                                                    <?php echo e(Form::textarea('question', '', ['v-model'=>'title','class' => 'form-control', 'placeholder'=>'Question', 'row'=>'3','style'=>'margin: 0px 0.65625px 0px 0px; height: 200px;'])); ?>

                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Correct Answer :</label>
                                                <div class="col-md-10">
                                                    <?php echo e(Form::text('correct_answer', '', ['v-model'=>'a','class' => 'form-control', 'placeholder'=>'Correct Answer', 'id'=>'form_control_1'])); ?>

                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Answer A : </label>
                                                <div class="col-md-10">
                                                
                                                    <?php echo e(Form::text('answer_a', '', ['v-model'=>'b','class' => 'form-control input-sm', 'placeholder'=>'False Answer','id'=>'form_control_1'])); ?>

                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Answer B :</label>
                                                <div class="col-md-10">
                                            
                                                    <?php echo e(Form::text('answer_b', '', ['v-model'=>'c','class' => 'form-control input-sm', 'placeholder'=>'False Answer','id'=>'form_control_1'])); ?>

                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Answer C :</label>
                                                <div class="col-md-10">
                                                    <?php echo e(Form::text('answer_c', '', ['v-model'=>'d','class' => 'form-control input-sm', 'placeholder'=>'False Answer','id'=>'form_control_1'])); ?>

                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> Cours Name :</label>
                                                <div class="col-md-10">
                                                    

                                                    
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div> -->
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> Course:</label>
                                                <div class="col-md-10">
                                                    
                                                    <?php echo e(Form::select('course', 
                                                    
                                                    $course_select
                                                    
                                                    ,'chapter', ['class' => 'form-control','v-on:change'=>'searchCourse', 'v-model'=>'course', 'id'=>'form_control_1'] )); ?>

                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> chapter:</label>
                                                <div class="col-md-10">
                                                    <select v-model="chapter" class="form-control chapter" id="form_control_1" v-on:change="searchChapter"  v-model="chapter" name="chapter" disabled>
                                                        <option disabled value="">Choose one </option>
                                                        <option v-for="i in chapter_data">{{i}}</option>
                                                    </select>
                                                    
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                             <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> Project Management Group:</label>
                                                <div class="col-md-10">
                                                    
                                                    <select v-model="pmg" class="form-control" id="pmg" v-on:change="searchPMG"  v-model="pmg" name="pmg" disabled>
                                                            <option disabled value="">Choose one </option>
                                                            <option v-for="i in pmg_data">{{i}}</option>
                                                        </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> Process Group:</label>
                                                <div class="col-md-10">
                                                    <select v-model="process_group" class="form-control" id="process_group" name="process_group" disabled>
                                                        <option disabled value="">Choose one </option>
                                                        <option v-for="i in process_group_data">{{i}}</option>
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
                                             
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> Exam Number:</label>
                                                <div class="col-md-10">
                                                    <select  class="form-control" id="form_control_1" name = "exam_num[]" multiple>  
                                                        <option disabled selected>Choose one </option>
                                                        <option value="1">Exam 1</option>
                                                        <option value="2">Exam 2</option>
                                                        <option value="3">Exam 3</option>
                                                        <option value="4">Exam 4</option>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label col-md-3">Image Upload #1</label>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                                        <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                
                                                                <input type="file" name="img" id="img">
                                                            </span>
                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="form_control_1">Feedback</label>
                                                <div class="col-md-10">
                                                        <?php echo e(Form::textarea('feedback','',['class'=>'form-control','row'=>'3','placeholder'=>'Feedback for the Correct Answer', 'style'=>'margin: 0px 0.65625px 0px 0px; height: 200px;'])); ?>

                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <div class="review-msg alert alert-warning" style="max-width: 500px; display:none;">
                                                        Question title and its answers are requeired !
                                                    </div>
                                                    <!-- <button type="button" class="btn default">Cancel</button> -->
                                                    <!-- <button type="button" class="btn blue">Submit</button> -->
                                                    <?php echo e(Form::submit('Submit', ['class'=>'btn blue'])); ?>

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                           
                           
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
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo e(asset('assets/global/scripts/app.min.js')); ?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo e(asset('assets/pages/scripts/dashboard.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')); ?>" type="text/javascript"></script>

        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo e(asset('assets/layouts/layout/scripts/layout.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/layouts/layout/scripts/demo.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/layouts/global/scripts/quick-sidebar.min.js')); ?>" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
        <script>
          
            var app = new Vue({
                el: '.vueform',
                data:{
                    test:'',
                    course:'',
                    chapter:'',
                    pmg: '',
                    chapter_data: [],
                    pmg_data: [],
                    process_group: '',
                    process_group_data: [],
                    title: '', // question title
                    // answers
                    a: '',
                    b: '',
                    c: '',
                    d: '',
                },
                methods:{
                    searchCourse: function(e){
                        this.process_group_data = [];
                        this.pmg_data = [];
                        $("#pmg").attr('disabled','disabled');
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
                            url: '<?php echo e(route('question.searchCourse')); ?>', 
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
                    searchChapter: function(e){
                        
                        Data = {
                            name : this.chapter
                        };

                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        
                        $.ajax ({
                            type: 'POST',
                            url: '<?php echo e(route('question.searchChapter')); ?>', 
                            data: Data,
                            success: function(res){
                                //validate the response 
                                // if(res.length > 0){
                                    
                                // }
                                //empty the array pmg_data 
                                app.pmg_data = [];
                                //store new data 
                                res.forEach(function(ele){
                                    app.pmg_data.push(ele);
                                });
                                if(res.length > 0){
                                    $("#pmg").removeAttr('disabled');
                                    console.log(res);
                                }else{
                                    $("#pmg").attr('disabled','disabled');
                                    app.process_group_data = [];
                                    app.pmg_data = [];
                                    app.showProcess();
                                }
                                $("#process_group").attr('disabled', 'disabled');
                                
                            },
                            error: function(res){
                                console.log('Error:', res);    
                            }
                        });
                    },
                    showProcess: function(){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax ({
                            type: 'POST',
                            url: '<?php echo e(route('question.showProcess')); ?>', 
                            success: function(res){
                                if(res){
                                    res.forEach(i => {
                                        app.process_group_data.push(i);
                                    });
                                    $("#process_group").removeAttr("disabled");
                                }
                            },
                            error: function(res){
                                console.log('Error:', res);    
                            }
                        });  
                    },
                    searchPMG: function(e){
                        Data = {
                            pmg : this.pmg
                        };

                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        
                        $.ajax ({
                            type: 'POST',
                            url: '<?php echo e(route('question.searchPMG')); ?>', 
                            data: Data,
                            success: function(res){
                                if(res){
                                    app.process_group_data = [];
                                    app.process_group_data.push(res);
                                    $("#process_group").removeAttr("disabled");

                                }
                            },
                            error: function(res){
                                console.log('Error:', res);    
                            }
                        });
                    },
                    review: function(){
                        if(
                            this.title == '' ||
                            this.a == '' ||
                            this.b == '' ||
                            this.c == '' ||
                            this.d == '' 
                        ){
                            $('.review-msg').show();
                        }else{
                            $('.review-msg').hide();
                            window.open("<?php echo e(url('/admin/question/review')); ?>/"+this.title+'/'+this.a+'/'+this.c+'/'+this.b+'/'+this.d,'_blank','resizable,height=560,width=1070'); return false;
                        }
                        
                
                    }
                    
                }
            });
        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>