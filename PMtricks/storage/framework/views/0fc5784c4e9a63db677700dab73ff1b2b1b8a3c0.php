	

<?php $__env->startSection('head'); ?>
<style>
    
    /* .fa-star {
        font-size: 120px;
        color: black;
    }
    .checked ,.fa-star:hover{
        color: orange;
    } */
.rate {
    display: flex;
    justify-content: center;
    flex-direction: row-reverse;
    
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:120px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
    
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}


    
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="page-content-wrapper">
    
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN THEME PANEL -->
            <!-- END THEME PANEL -->
            <!-- BEGIN PAGE BAR -->
            
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 >
            </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="container-fluid" id="app-1">
                
                <div class="row">
                    
                    <div class="col-md-8 form-1" id="quiz_app_container" style="border: 1px solid #eef1f5 !important;">
                        
                        

                        
                        

                        <div id="loading">
                            Please wait !
                        </div>
                        <div id="quiz" style="display:none;">
                            <div class="row">
                                <div class="col-md-3 col-md-offset-9">
                                    <select class="form-control" v-model="toggle_value" style="margin:10px 0; width:100%;" v-on:change = "toggle_answers" id = "toggle_answers">
                                        <option value="3">All</option>
                                        <option value="0">Incorrect</option>
                                        <option value="1">Correct</option>
                                        <option value="2">Skipped</option>
                                        
                                    </select>
                                </div>
                            </div>  
                            <div class="container-fluid primeQuizViewWM"   id="quiz" style="min-height: 50px; margin:20px 0; " v-for="i in data">
    					        Question: {{i[8]}} 

                                <b v-if=" i[6] == 1" style="color: green;">Correct</b>
                                <b v-if=" i[6] == 0 && i[5] != ''" style="color: red;">Incorrect</b>
                                <b v-if=" i[6] == 0 && i[5] == ''" style="color: gray;">skipped</b>

                                <div class="row" style=" font-size: 21px; border-radius: 10px !important; background-color: #e8ebef; font-weight:bold; margin: 10px 0 20px 0;">
                                    <p class="col-md-12" style="margin: 8px 0; padding: 0 10px;">
                                        {{i[0]}}
                                    </p>
                                </div>
        
                                <div class="row">
                                    <div class="fig" id="fig" style=" margin: 0 0 10px 50px;" v-if="i[7]">
                                        <img class="img-responsive" v-bind:src="i[7]" width="550" alt="fig0-0">
                                    </div>
                                </div>
        
                                <div class="container-fluid row options" style="font-size: 18px;  min-height: 50px; width: 100%;">
                                    <div class="radio" id="radio1" style="border-radius: 9px !important; border: 2px solid green; min-height: 40px; padding: 10px 0 10px 10px; margin-bottom: 10px;" >
                                        <label >{{i[1]}}</label>
                                    </div>
                                    <div class="radio" id="radio2" style="border-radius: 9px !important; min-height: 40px; padding: 10px 0 10px 10px; margin-bottom: 10px;" v-bind:style = "[i[2] == i[5] ? {'border': '2px solid red'} : {'border': '1px solid rgb(204, 204, 204)'}]">
                                        <label >{{i[2]}}</label>
                                    </div>
                                    <div class="radio" id="radio3" style="border-radius: 9px !important;  min-height: 40px; padding: 10px 0 10px 10px; margin-bottom: 10px;" v-bind:style = "[i[3] == i[5] ? {'border': '2px solid red'} : {'border': '1px solid rgb(204, 204, 204)'}]">
                                        <label >{{i[3]}}</label>
                                    </div>
                                    <div class="radio" id="radio4" style="border-radius: 9px !important;  min-height: 40px; padding: 10px 0 10px 10px;" v-bind:style = "[i[4] == i[5] ? {'border': '2px solid red'} : {'border': '1px solid rgb(204, 204, 204)'}]">
                                        <label >{{i[4]}}</label>
                                    </div>
                                
                                </div>
                                <div class="row">
                                    <div class="container-fluid">

                                        <p>
                                        <b>Explanation</b> <br>
                                           <b> {{i[9]}}</b>
                                        </p>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <!-- 
                                    <div class="col-md-2" style="  min-height: 30px; font-size: 18px;">
                                        <a id="prev" v-on:click="prev">
                                          <b>  <i class="fa fa-angle-left" style="font-weight: bold; font-size: 21px; padding-right:5px;"></i> Back</b>
                                        </a>
                                    </div>

                                    <div class="col-md-2" style="  min-height: 30px; font-size: 18px;">
                                        <a data-toggle="modal" data-target="#flagedQuestion" class="btn red">
                                            Marked
                                        </a>
                                    </div>

                                    
                                    

                                    <div class="col-md-2" style="  min-height: 30px; font-size: 18px;">
                                        <button type="button" class="btn purple" data-toggle="modal" data-target="#myModal">
                                            See all questions
                                        </button>
                                    </div>

                                    <div class="col-md-2" style="  min-height: 30px; font-size: 18px;">
                                        <a style="display:none;" class="btn btn-warning" id="feedback_btn" v-on:click="feedMeBack">Explanation</a>
                                    </div>

                                    <div class="col-md-offset-2 col-md-2" style="  min-height: 30px; text-align: right; font-size: 18px;">
                                        <a id="next" v-on:click="next"  > <b> NEXT <i class="fa fa-angle-right" style="font-weight: bold; font-size: 21px; padding-left:5px;"></i></b>
                                           
                                        </a>
                                        <a id="finish_btn" v-on:click="markExam" style="display:none;" >
                                            <b>Finish test <i class="fa fa-angle-right" style="font-weight: bold; font-size: 21px; padding-left:5px;"></i></b>
                                        </a>
                                        
                                    </div> --></div>

                                
                            </div>
                        </div>  
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

	<script type="text/javascript">

        $(document).ready(function(){
            
            app.start();

        });

        var app = new Vue({
		    el: '#app-1',
	        data:
            {
                data:
                    [
                        
	            	],
                    questions: [],
                    answers: [],
                    toggle_value: 3,

            }, 
            methods:{
                toggle_answers: function(){
                    this.data = [];

                    if(this.toggle_value == 3)
                    {

                        this.toggle_all();
                    }
                    else if(this.toggle_value == 0) // incorrect
                    {
                        this.toggle_incorrect();
                    }
                    else if(this.toggle_value == 1) // correct
                    {
                        this.toggle_correct();
                    }
                    else if(this.toggle_value == 2) // skipped
                    {
                        this.toggle_skipped();
                    }

                },
                toggle_skipped: function(){
                    i = 0;
                    app.questions.forEach(function(question){
                        
                        find = 0;

                        if(question.img){
                            link = '<?php echo e(url('')); ?>/storage/questions/'+app.basename(question.img);
                        }else{
                            link = null;
                        }


                        app.answers.forEach(function(answer){
                            if(question.id == answer.question_id){
                                find = 1;
                            }
                        });


                        if(!find){
                            i++;
                            list = [
                                question.title,
                                question.correct_answer,
                                question.a,
                                question.b,
                                question.c,
                                '',
                                0,
                                link,
                                i,
                                question.feedback
                            ];
                            app.data.push(list);
                        }
                    });
                },
                toggle_correct: function(){
                    i =0;
                    app.answers.forEach(function(answer, index){
                        app.questions.forEach(function(question){
                            if(question.img){
                                link = '<?php echo e(url('')); ?>/storage/questions/'+app.basename(question.img);
                            }else{
                                link = null;
                            }
                            if(answer.question_id == question.id){
                                if(answer.user_answer == question.correct_answer){
                                    i++;
                                    list = [    
                                        question.title,
                                        question.correct_answer,
                                        question.a,
                                        question.b,
                                        question.c,
                                        answer.user_answer,
                                        1,
                                        link,
                                        i,
                                        question.feedback
                                    ];
                                    app.data.push(list);                                    
                                }
                            }
                        });
                    });
                },
                toggle_incorrect: function(){
                    i =0;


                    app.answers.forEach(function(answer, index){
                        app.questions.forEach(function(question){
                            if(question.img){
                                link = '<?php echo e(url('')); ?>/storage/questions/'+app.basename(question.img);
                            }else{
                                link = null;
                            }
                            if(answer.question_id == question.id){
                                if(answer.user_answer != question.correct_answer){
                                    i++;
                                    list = [    
                                        question.title,
                                        question.correct_answer,
                                        question.a,
                                        question.b,
                                        question.c,
                                        answer.user_answer,
                                        0,
                                        link,
                                        i,
                                        question.feedback
                                    ];
                                    app.data.push(list);                                    
                                }
                            }
                        });
                    });
                },
                toggle_all: function(){
                    app.questions.forEach(function(question, index){
                        if(question.img){
                            link = '<?php echo e(url('')); ?>/storage/questions/'+app.basename(question.img);
                        }else{
                            link = null;
                        }
                        find = 0;
                        app.answers.forEach(function(answer){
                            if(answer.question_id == question.id){
                                if(answer.user_answer == question.correct_answer){
                                    correct = 1;
                                }else{
                                    correct = 0;
                                }


                                list = [
                                    question.title,
                                    question.correct_answer,
                                    question.a,
                                    question.b,
                                    question.c,
                                    answer.user_answer,
                                    correct,
                                    link,
                                    index+1,
                                    question.feedback
                                ];
                                app.data.push(list);
                                find = 1;
                                
                            }
                        });
                        

                        if(!find){
                            
                            list = [
                                question.title,
                                question.correct_answer,
                                question.a,
                                question.b,
                                question.c,
                                '',
                                0,
                                link,
                                index+1,
                                question.feedback
                            ];
                            app.data.push(list);    
                        }

                    });
                },
                start: function(){
                    Data = {
                        'quiz_id': <?php echo e($quiz->id); ?>

                    };
                    
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    
                    $.ajax ({
                        type: 'POST',
                        url: '<?php echo e(route('QuizHistory.load')); ?>', 
                        data: Data,
                        success: function(res){
                            app.questions = res[0];
                            app.answers = res[1];
                        
                            app.toggle_all();
                            
                            $("#loading").hide();
                            $("#quiz").show();
                        },

                        error: function(res){
                            console.log('Error:', res);    
                        }
                    });
                                
                    
                },
                basename: function(str){
                    var base = new String(str).substring(str.lastIndexOf('/') + 1); 
                   return base;
                },
            } 
    	});
    
	</script>
    
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>