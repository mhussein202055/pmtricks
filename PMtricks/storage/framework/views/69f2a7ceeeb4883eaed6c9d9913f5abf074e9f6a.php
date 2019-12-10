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
                    <!--            <span>Add Video</span>-->
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
                                        <span class="caption-subject bold uppercase"> Add Videos </span>
                                    </div>
                                    
                                </div>
                                <p class="details" style="display:none;"></p>
                                <div class="progress" style="display:none">
                                    <div class="progress-bar progress-bar-striped" id="progress_bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                </div>

                                <div class="note note-danger" style="display:none;">
                                    <p id="note_text" style="font-size: 15px; font-weight: bold; color: crimson;"></p>
                                    
                                </div>

                                <div class="portlet-body form vueform"> 
                                    
                                    <div class="form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="form_control_1">Video Title</label>
                                                <div class="col-md-10">
                                                    <?php echo e(Form::text('title', '', ['v-model'=>'title','class' => 'form-control', 'placeholder'=>'Title', 'style'=>'margin: 0px 0.65625px 0px 0px;'])); ?>

                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>


                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="form_control_1">Description</label>
                                                <div class="col-md-10">
                                                        <?php echo e(Form::textarea('description','',['v-model'=>'description','class'=>'form-control','row'=>'3','placeholder'=>'Description . .', 'style'=>'margin: 0px 0.65625px 0px 0px; height: 200px;'])); ?>

                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>


                                            
                                            
                                            
                                            
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
                                                    <select v-model="chapter" class="form-control chapter" id="form_control_1"   v-model="chapter" name="chapter" disabled>
                                                        <option disabled value="">Choose one </option>
                                                        <option v-for="i in chapter_data">{{i}}</option>
                                                    </select>
                                                    
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Vimeo ID :</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="vimeo_id" v-model = "vimeo_id" class="form-control">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>


                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">Attachment File :</label>
                                                <div class="col-md-10">
                                                    <select v-model="material_id" name="attachment" id="attachment" class="form-control">
                                                        <option value="0" selected>none</option>
                                                        <?php $__currentLoopData = \App\Material::orderBy('created_at', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($m->id); ?>"><?php echo e($m->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1"> Add Demo:</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" id="form_control_1" v-model="demo" name = "demo">
                                                        <option disabled value=""></option>
                                                        <option value ="0">False</option>
                                                        <option value ="1">True</option>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    
                                                    <!-- <button type="button" class="btn default">Cancel</button> -->
                                                    <!-- <button type="button" class="btn blue">Submit</button> -->
                                                    
                                                    <input type="submit" value="Submit" v-on:click="submit" class="btn blue">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                    
                    chapter:'',         // ###
                    
                    title: '',          // ###
                    description: '',     // ###
                    
                    chapter_data: [],
                    material_id: 0,
                    demo: 0,
                    duration: '',
                    vimeo_id: '',

                    
                    // 
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
                    
                    
                    
                    _: function(el){
                        return document.getElementById(el);
                    },
                    submit: function(){
                        
                        error = 0;
                        
                        var file = null;
                        // var file2 = this._("file2").files[0];

                        if(file){
                            if(file.type != 'video/mp4'){
                                $('.note').show();
                                this._('note_text').innerHTML = 'Only accept `MP4` Format !';
                                error =1;
                            }
                        }

                        if(!file && this.vimeo_id == ''){
                            $('.note').show();
                            this._('note_text').innerHTML = 'Video file or Vimeo ID is required';
                            error =1;
                        }



                        

                        

                        if(this.chapter == ''){
                            $('.note').show();
                            this._('note_text').innerHTML = 'Chapter is required !';
                            error =1;
                        }
                        
                        if(this.description == ''){
                            $('.note').show();
                            this._('note_text').innerHTML = 'Description is required !';
                            error =1;
                        }

                        if(this.title == ''){
                            $('.note').show();
                            this._('note_text').innerHTML = 'Title is required !';
                            error =1;
                        }

                        
                        

                        
                        if(!error){
                            $(".note").hide();
                            $(".progress").show();
                            $('.portlet-body').hide();
                            $('.details').show();
                            if(file){
                                $('.details').html('Title: '+this.title+'</br>Size: '+Math.round(file.size/1000000)+' MB');
                            }else{
                                $('.details').html('Title: '+this.title+'</br>');
                            }
                            

                            
                            // alert(file.name+"|"+file.size/1000+"KB|"+file.type);

                            var formdata = new FormData();
                            
                            formdata.append('_token', '<?php echo e(csrf_token()); ?>');
                            formdata.append('title', this.title);
                            formdata.append('description', this.description);
                            formdata.append('chapter', this.chapter);
                            formdata.append('video', file);
                            formdata.append('attachment', this.material_id);
                            formdata.append('demo', this.demo);
                            formdata.append('duration', this.duration);
                            formdata.append('coure_id', this.course);
                            formdata.append('vimeo_id', this.vimeo_id);

                            var ajax = new XMLHttpRequest();
                            ajax.upload.addEventListener("progress", this.progressHandler, false); // progress handler
                            ajax.addEventListener('load', this.completeHandler, false); // complete event
                            ajax.addEventListener('error', this.errorHandler, false); 
                            ajax.addEventListener('abort', this.abortHandler, false);
                            
                            ajax.open("POST" ,"<?php echo e(route('video.store')); ?>");
                            ajax.send(formdata);        
                        }
                    },
                    progressHandler: function(event){
                        // this._('progress_bar').innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
                        var percent = (event.loaded / event.total) * 100;
                        // this._('progressBar').value = Math.round(percent);
                        $('.progress-bar').attr('aria-valuenow', percent);
                        $('.progress-bar').attr('style', 'width: '+percent+'%');
                        this._('progress_bar').innerHTML = percent.toString().substr(0,5)+' %';

                    },
                    completeHandler: function(event){
                        
                        if(event.target.responseText == 'ok'){    
                            window.location.href = "<?php echo e(route('video.index')); ?>";
                        }else{
                            $('.progress').hide();
                            $('.portlet-body').show();      
                            this._('note_text').innerHTML = event.target.responseText;
                            $('.note').show();
                            
                        }


                        
                    },
                    errorHandler: function(){
                        alert('error ! contact to customer services');
                    },
                    abortHandler: function(){
                        alert('error !');
                    }
                   
                }
            });
        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>