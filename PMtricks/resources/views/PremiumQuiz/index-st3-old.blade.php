@extends('layouts.app-2')

@section('head')
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
@endsection

@section('content')


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
                    <a style="z-index:100000; position: fixed; right: 0;font-size: 20px; cursor: pointer; color: #fff; padding: 10px 20px; background-color:#333;" v-on:click="toggle_right_list">
                        <i class="fa fa-arrow-right"  id="arrow"></i>
                    </a>
                    <div class="col-md-8 form-1" id="quiz_app_container" style="border: 1px solid #eef1f5 !important;">
                        {{-- optimize Quiz Questions Form --}}
                        {{-- 
                            *******************************
                            *******************************
                            *******************************
                            *******************************
                            *******************************
                            *******************************                
                            --}}
                        <div class="row" style="padding: 0px; margin-top: 20px;">
                            @if(!\App\Rating::where('user_id',Auth::user()->id)->where('package_id', $package_id)->get()->first())
                            <div class="col-md-offset-9 col-md-3">
                                <a style="color: black !important; font-size:15px;" v-on:click="ShowRate">
                                    <i style="  font-size:18px;" class="fa fa-star-o"></i>
                                    Leave a Rating
                                </a>
                            </div>
                            @else
                            <div class=" col-md-offset-9 col-md-3">
                                <a style="color: black !important; font-size:15px;" v-on:click="ShowRate">
                                    <i style="  font-size:18px;color: orange;" class="fa fa-star"></i>
                                    Update Rate
                                </a>
                            </div>
                            @endif
                        </div>
                        <form @submit.prevent="optimizeQuiz" id="optimizeForm">
                            <div class="optimization_form" style="padding-top: 16px; padding-left: 50px; width:100%; ">
                                
                                <div>
                                    <div class="row" style="margin-bottom: 30px;" >
                                        <div class="col-md-12">
                                            <h3 class="blog-single-head-title font-green">  
                                            
                                                @if($topic == 'chapter')
                                                
                                                    {{\App\Chapters::find($topic_id)->name}}
                                                @elseif($topic == 'process_group')
                                                    {{\App\Process_group::find($topic_id)->name}}
                                                @else
                                                    Exam {{$topic_id}}
                                                @endif
                                            
                                            </h3>
                                            <hr style="width: 100%; margin-top: 10px;">
                                        </div>
                                    </div>
                                    {{-- <div class="row" style="margin-bottom: 30px;">
                                        <div class="col-md-2">
                                            @{{max_questions_num}} question
                                        </div>
                                        <div class="col-md-2">
                                            @{{Math.round(max_questions_num*72/3600)}} hours
                                        </div>
                                        <div class="col-md-4">
                                            80% correct required to pass
                                        </div>
                                    </div> --}}


                                    <div class="row">
                                      
                                        <div class="col-lg-3 col-md-4 col-xs-6">
                                            <div class="mt-element-ribbon bg-grey-steel">
                                                <div class="ribbon ribbon-shadow ribbon-color-info uppercase">Qustions </div>
                                                <p class="ribbon-content" align="center" style="font-size: 20px">@{{max_questions_num}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-xs-6">
                                            <div class="mt-element-ribbon bg-grey-steel">
                                                <div class="ribbon ribbon-shadow ribbon-color-red uppercase">Hours</div>
                                                <p class="ribbon-content" align="center" style="font-size: 20px">@{{Math.round(max_questions_num*72/3600)}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-xs-8">
                                            <div class="mt-element-ribbon bg-grey-steel">
                                                <div class="ribbon ribbon-shadow ribbon-color-success uppercase">Score required to pass</div>
                                                <p class="ribbon-content" align="center" style="font-size: 20px">80%</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">

                                        <h4>Instructions: </h4>
                                        <ul type="circle" style="overflow: auto; max-width: 800px;">
                                            <li>You can pause the test at any time and resume later.</li>
                                            <li>You can retake the testas many time as you would like.</li>
                                            <li>The progress bar at the top of the screen will show you  progress as well as the time remaining in the test. if you run out of time, don't worry; you will still be able to finish the test.</li>
                                            <li>you can skip a question to come back to at the end of the exam</li>
                                            <li>You can also use “Mark for review” to come back to questions you are unsure about before you submit your test.</li>
                                            <li>If you want to finish the test and see your results immediately, press the stop button.</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                
                                


                                
                                
                                
                                <div class="row">
                                    <div class="form-group" style="display:flex; justify-content: center; align-items: center;">
                                        @if($quiz)
                                            @if($quiz->complete == 1)
                                                <a v-on:click="optimizeQuiz" class="btn btn-primary" id="startQuiz">Review</a>
                                            @else
                                                <a v-on:click="optimizeQuiz" class="btn btn-primary" id="startQuiz">Start test</a>
                                            @endif
                                        @else
                                            
                                            <a v-on:click="optimizeQuiz" class="btn btn-primary" id="startQuiz">Start test</a>
                                        @endif
                                        <a  class="btn btn-warning" style="display:none;" id="continueQuiz" v-on:click="continueQuize"  style="margin-top:23px;" >Continue</a>
                                        {{-- <a  class="btn btn-success" style="display:none;" id="saveforlateron" v-on:click="saveForLaterOn"  style="margin-top:23px;" >Save</a> --}}
                                        
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row saving_form" style="display:none; margin: 40px 0;">
                                please wait while your answer being saved . . .
                            </div>
                        </form>

                        {{-- Quiz View --}}
                        {{-- 
                            *******************************
                            *******************************
                            *******************************
                            *******************************
                            *******************************
                            *******************************                
                            --}}

                        <div class="container-fluid primeQuizViewWM" id="quiz" style="min-height: 50px; margin:20px 0; display:none;">

                                @if($quiz)

                                    @if($quiz->complete == 0)

                                    <div class="row" style=" ">
                                        <div class="col-md-1" style="padding: 0 !important;">
                                            <i class="fa fa-flag" style="color: gray; cursor:pointer; margin:0 20%;" v-on:click = "flagMe" id="flag"></i>
                                            <strong>@{{current_question_number}}</strong>/@{{q_number}}
                                        </div>
                                        
                                        <div class="col-md-9">
                                            <div class="progress" style="border: 1px solid #ccc;">
                                                <div class="progress-bar progress-bar-striped" id="progress_bar" role="progressbar" style="width: 10%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                            </div>
                                        </div>

                                        <div class="col-md-1" style=" text-align: center;">
                                            <div class="row" style="color: #333;  font-weight: lighter;" id="timer">00:00:00</div>
                                        </div>


                                        <div class="col-md-1" style="text-align: center; padding:0 !important;">
                                            
                                            <a class="aElement" id="pause" v-on:click="stopTimer_pause" style="margin-right:15px;">
                                                <i class="fa fa-pause" style=""></i>                   
                                            </a>                                                                                                 
                                            <a class="aElement" v-on:click="Confirmation">
                                                <i class="fa fa-stop" style=""></i>
                                            </a>
                                        </div>
                                        
                                    </div>              
                  

                                    @else
                                        
                                        <div class="row" style=" ">
                                            
                                            <div class="col-md-1 col-md-offset-1">
                                                <a class="btn green-meadow" v-on:click="markExam">Result</a>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <select class="form-control" v-model="answer_cat" v-on:change = "toggle_answers" id = "toggle_answers" style="display:none;">
                                                    <option value="0">Incorrect</option>
                                                    <option value="1">Correct</option>
                                                    <option value="2">All</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <div style="border: 0; outline: none; display:none; padding: 5px 0; font-size: 20px; border-radius: 10px !important; background-color: #e8ebef; text-align: center; max-width: 60px; " id = "q_number" >
                                                    @{{current_question_number}} / @{{q_number}}
                                                </div>
                                            </div>
                                            
                                            
                                            



                                        </div>              

                                    @endif

                                @else

                                    <div class="row" style=" ">
                                        <div class="col-md-1" style="padding: 0 !important;">
                                            <i class="fa fa-flag" style="color: gray; cursor:pointer; margin:0 20%;" v-on:click = "flagMe" id="flag"></i>
                                            <strong>@{{current_question_number}}</strong>/@{{q_number}}
                                        </div>
                                        
                                        <div class="col-md-9">
                                            <div class="progress" style="border: 1px solid #ccc;">
                                                <div class="progress-bar progress-bar-striped" id="progress_bar" role="progressbar" style="width: 10%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                            </div>
                                        </div>

                                        <div class="col-md-1" style=" text-align: center;">
                                            <div class="row" style="color: #333;  font-weight: lighter;" id="timer">00:00:00</div>
                                        </div>


                                        <div class="col-md-1" style="text-align: center; padding:0 !important;">
                                            
                                            <a class="aElement" id="pause" v-on:click="stopTimer_pause" style="margin-right:15px;">
                                                <i class="fa fa-pause" style=""></i>                   
                                            </a>                                                                                                 
                                            <a class="aElement" v-on:click="Confirmation">
                                                <i class="fa fa-stop" style=""></i>
                                            </a>
                                        </div>
                                        
                                    </div>              

                                @endif


                                
                            <hr style="margin-top:0">
                            <!-- Rating  -->
                            
                            <div class="row" style=" font-size: 21px; border-radius: 10px !important; background-color: #e8ebef; font-weight:bold; margin: 10px 0 20px 0;">
                                <p class="col-md-12" style="margin: 8px 0; padding: 0 10px;">
                                    @{{question_title}}
                                </p>
                            </div>
    
                            <div class="row">
                                <div class="fig" id="fig" style="display:none; margin: 0 0 10px 50px;">
                                    <img class="img-responsive" v-bind:src="img_link" width="550" alt="fig0-0">
                                </div>
                            </div>
    
                            <div class="container-fluid row options" style="font-size: 18px;  min-height: 50px; width: 100%;">
                                <div class="radio" id="radio1" style="border-radius: 9px !important; border: 1px solid rgb(204, 204, 204); min-height: 40px; padding: 10px 0 10px 10px; margin-bottom: 10px;">
                                    <label ><input v-on:click="answerd_counter" type="radio" name="optradio" v-model="rad" v-bind:value='opt1'>@{{opt1}}</label>
                                </div>
                                <div class="radio" id="radio2" style="border-radius: 9px !important; border: 1px solid rgb(204, 204, 204); min-height: 40px; padding: 10px 0 10px 10px; margin-bottom: 10px;">
                                    <label ><input v-on:click="answerd_counter" type="radio" name="optradio"  v-model="rad" v-bind:value='opt2'>@{{opt2}}</label>
                                </div>
                                <div class="radio" id="radio3" style="border-radius: 9px !important; border: 1px solid rgb(204, 204, 204); min-height: 40px; padding: 10px 0 10px 10px; margin-bottom: 10px;">
                                    <label ><input v-on:click="answerd_counter" type="radio" name="optradio" v-model="rad" v-bind:value='opt3'>@{{opt3}}</label>
                                </div>
                                <div class="radio" id="radio4" style="border-radius: 9px !important; border: 1px solid rgb(204, 204, 204); min-height: 40px; padding: 10px 0 10px 10px;">
                                    <label ><input v-on:click="answerd_counter" type="radio" name="optradio" v-model="rad" v-bind:value='opt4'>@{{opt4}}</label>
                                </div>
                            
                            </div>
                            <hr>
                            <div class="row">
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

                                
                                <div class="modal" id="flagedQuestion">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Marked Questions: </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                        
                                            <!-- Modal body -->
                                            <div class="modal-body flaged_body">
                                                <div class="flagedItem" data-dismiss="modal" v-on:click="push_question_and_store_last_answer(i)" v-for='i in flaged'>@{{i}}</div>
                                            </div>
                                        
                                        
                                        </div>
                                    </div>
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
                                    <a id="finish_btn" v-on:click="Confirmation" style="display:none;" >
                                        <b>Finish test <i class="fa fa-angle-right" style="font-weight: bold; font-size: 21px; padding-left:5px;"></i></b>
                                    </a>
                                    
                                </div>
                                
                            </div>

                            
                       
                        </div>


                        <div class="modal" id="myModal">
                            <div class="modal-dialog" style="max-width: 80%;">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Questions List: </h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <table class="table table-striped table-borderless" >
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Poinsts</th>
                                                    <th>Score</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="i in question_title_list">
                                                    <td data-dismiss="modal" v-on:click="push_question_and_store_last_answer(i.id)" style="cursor: pointer;">@{{i.title}}</td>
                                                    <td>1</td>
                                                    <td v-html="i.score"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="container-fluid primeQuizViewWM" id="quiz" style="display:none;" >
                            
                            
                            <div class="row st-row">
                                <div class="col-md-3 justify-content-center align-self-center">questions <strong>@{{current_question_number}}</strong> of <strong>@{{q_number}}</strong></div>
                                <div class="col-md-3 justify-content-center align-self-center"> Answerd <strong>@{{q_answerd}}</strong></div>
                                <div class="col-md-3 justify-content-center align-self-center"> 
                                    <a class="btn btn-info" data-toggle="modal" data-target="#flagedQuestion">Marked</a>
                                    <div class="modal" id="flagedQuestion">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Marked Questions: </h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                            
                                                <!-- Modal body -->
                                                <div class="modal-body flaged_body">
                                                    <div class="flagedItem" data-dismiss="modal" v-on:click="push_question_and_store_last_answer(i)" v-for='i in flaged'>@{{i}}</div>
                                                </div>
                                            
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 justify-content-center align-self-center" id="timer">00:00:00</div>
                                
                            </div>
                            <i class="fa fa-flag" style="color: gray; cursor:pointer;" v-on:click = "flagMe" id="flag"></i>
                            <div class="row">
                                <div class="col-lg-12 question-text" style="background-color: #e8ebef; font-weight:bold;">
                                    @{{question_title}}
                                </div>
                                
                                <div class="fig" id="fig" style="display:none;">
                                    <img class="img-responsive" v-bind:src="img_link" alt="fig0-0">
                                </div>
                            </div>
                            <div class="container-fluid options" style="" >
                                <div class="radio" id="radio1">
                                    <label ><input v-on:click="answerd_counter" type="radio" name="optradio" v-model="rad" v-bind:value='opt1'>@{{opt1}}</label>
                                </div>
                                <div class="radio" id="radio2">
                                    <label ><input v-on:click="answerd_counter" type="radio" name="optradio"  v-model="rad" v-bind:value='opt2'>@{{opt2}}</label>
                                </div>
                                <div class="radio" id="radio3">
                                    <label ><input v-on:click="answerd_counter" type="radio" name="optradio" v-model="rad" v-bind:value='opt3'>@{{opt3}}</label>
                                </div>
                                <div class="radio" id="radio4">
                                    <label ><input v-on:click="answerd_counter" type="radio" name="optradio" v-model="rad" v-bind:value='opt4'>@{{opt4}}</label>
                                </div>
                            </div>
                            
                            <div class="row contral-question" >
                                <div class="">
                                    <a class="btn btn-primary" id="prev" v-on:click="prev">Prev</a>
                                </div>
                                <div class="">
                                    <a class="btn btn-primary" id="next" v-on:click="next">Next</a>
                                </div>
                                <div class="">
                                    <a class="btn btn-success" v-on:click="markExam" >@{{make_exam.text}}</a>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
                                        Outline
                                    </button>                            
                                </div>
                                <div class="">
                                    <a style="display:none;" class="btn btn-warning" id="feedback_btn" v-on:click="feedMeBack">Explanation</a>
                                </div>
                                <div class="">
                                    <a style="" class="btn btn-warning" v-on:click="stopTimer_pause" id="pause" >Pause</a>
                                </div>
                                <div style="font-weight: bold; font-size: 25px;float:right;">
                                    www.Pm-tricks.com
                                </div>
                            </div>

                            
                                
                            <!-- The Modal -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog" style="max-width: 80%;">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Questions List: </h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <table class="table table-striped table-borderless" >
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Poinsts</th>
                                                        <th>Score</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="i in question_title_list">
                                                        <td data-dismiss="modal" v-on:click="push_question_and_store_last_answer(i.id)" style="cursor: pointer;">@{{i.title}}</td>
                                                        <td>1</td>
                                                        <td v-html="i.score"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div> --}}
                        {{-- 
                            *******************************
                            *******************************
                            *******************************
                            *******************************
                            *******************************
                            *******************************                
                            --}}
                        <div class="container-fluid" id="result" style="display:none;" >
                            <h2>
                                Your Score is : @{{score}} % 
                                <i v-html="ScoreMsg"></i>
                            </h2>

                            <h3>Score Analysis</h3>
                            
                            {{-- <h4>Planning: </h4>
                            <table class="table table-bordered score-table">
                                <thead>
                                    <th>Question No.</th>
                                    <th>Score</th>
                                </thead>
                                <tbody id ="scoreAnalysisTable">
                                    <tr>
                                        <td>10</td>
                                        <td>1</td>                            
                                    </tr>
                                </tbody>
                            </table>
                            <h5>Need Improvment</h5> --}}

                            <center>
                                {{--                                 
                                <a v-on:click="toggle_answers(1)" class="btn red-meadow">Correct Answers</a>
                                <a v-on:click="toggle_answers(0)" class="btn red-meadow">inCorrect Answers</a>
                                <a v-on:click="toggle_answers(2)" class="btn red-meadow">all Answers</a> 
                                --}}
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-4">
                                        @if($quiz)
                                        <a class="btn green-meadow" href="{{route('QuizHistory.show', $quiz->id)}}">Review</a>
                                        @else
                                        <a class="btn green-meadow" v-if="saved_quiz_id != 0" v-on:click = "showReview">Review</a>
                                        @endif
                                    </div>
                                    {{--
                                    <div class="col-md-2">
                                        <select class="form-control" v-model="answer_cat" v-on:change = "toggle_answers">
                                            <option value="0">Incorrect</option>
                                            <option value="1">Correct</option>
                                            <option value="2">All</option>
                                        </select>
                                    </div>
                                    --}}
                                </div>
                            </center>
                        </div>

                        <hr style="border-color: #ccc;">

                        <div class="row" id="">
                            <div class="col-md-12">

                                <div class="portlet light">
                                    
                                    <div class="portlet-body">
                                        <ul class="nav nav-tabs">
                                            <li class="">
                                                <a href="#tab1" data-toggle="tab"> Q&amp;A </a>
                                            </li>
                                            <li class="active">
                                                <a href="#tab2" data-toggle="tab"> Quiz History </a>
                                            </li>
                                            
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade" id="tab1">
                                                <h3 class="sbold blog-comments-title">Leave A Comment</h3>
                                                <form action="{{route('comment.store')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="page" value="{{$topic}}">
                                                    <input type="hidden" name="item_id" value="{{$topic_id}}">
                                                    <div class="form-group">
                                                        <textarea rows="8" name="contant" placeholder="Write comment here ..." class="form-control c-square"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn blue uppercase btn-md sbold btn-block">Submit</button>
                                                    </div>
                                                </form>
                        
                        
                        
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        @foreach($comments as $comment)
                                                        <div class="row" style="border-bottom: 1px solid #ccc; padding: 10px 0;">
                                                            <div class="col-md-11">
                                                                <h5><b>{{\App\User::find($comment->user_id)->name}}</b> <i style="color:#333;">{{$comment->created_at->diffForHumans()}}</i></h5>
                                                                <p>{{$comment->contant}}</p>
                                                                <b><a v-on:click="ShowReplyForm({{$comment->id}})">Reply</a></b>
                                                            </div>
                        
                                                            {{--               Replies                       --}}
                                                            <div class="row" id="replies" style="">
                                                                @foreach(\App\Comment::whereIn('id', \App\Reply::where('reply_to_id','=',$comment->id)->pluck('comment_id')->toArray() )->orderBy('created_at', 'desc')->get() as $reply)
                                                                <div class="col-md-10 col-md-offset-2">
                                                                    <h5><b>{{\App\User::find($reply->user_id)->name}}</b> <i style="color:#333;">{{$reply->created_at->diffForHumans()}}</i></h5>
                                                                    <p>{{$reply->contant}}</p>
                                                                </div>
                                                                @endforeach
                                                            </div>
                        
                        
                                                            {{-- Reply form --}}
                                                            <div class="fluid-container" id="reply-form-{{$comment->id}}">
                                                                
                                                                {{-- <div class="row">
                                                                    <div class="col-md-10 col-md-offset-2">
                                                                        <form action="" method="post">
                                                                            @csrf
                                                                            
                                                                            <input type="hidden" name="comment_id" value="">
                                                                            <div class="form-group col-md-10" style="padding-left: 0 !important;">
                                                                                <textarea rows="1" name="contant" placeholder="Write comment here ..." class="form-control c-square"></textarea>
                                                                            </div>
                                                                            <div class="form-group col-md-2">
                                                                                <button type="submit" class="btn blue uppercase btn-md sbold btn-block">Reply</button>
                                                                                <button v-on:click="removeReplyForm()" class="btn red uppercase btn-md sbold btn-block">Cancel</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                        
                                                        
                                                        @endforeach
                        
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                            <div class="tab-pane fade in active" id="tab2">
                                                {{-- <div class="row">
                                                    <div class="container" style="width:80%; margin-top: 20px; margin-bottom: 10px;">
                                                            
                                                    </div>
                                                </div> --}}
                                                @php
                                                $attempt = count(\App\Quiz::where('user_id', Auth::user()->id)->where('package_id', $package_id)->where('topic_type', $topic)->where('topic_id', $topic_id)->where('complete', 1)->orderBy('updated_at', 'desc')->get());
                                                @endphp
                                                @foreach(\App\Quiz::where('user_id', Auth::user()->id)->where('package_id', $package_id)->where('topic_type', $topic)->where('topic_id', $topic_id)->where('complete', 1)->orderBy('updated_at', 'desc')->get() as $quiz_z)
                                                <div class="row" style="margin-top: 10px; margin-bottom: 10x;">
                                                    <div class="container" id="view1{{$quiz_z->id}}" style="border:1px solid #ccc; width:80%; padding: 25px 0;box-shadow: 0px 9px 15px -4px rgba(0,0,0,0.14); ">
                                                        <div style="display:flex; justify-content: space-evenly; align-items:center; flex-wrap: wrap;" >
                                                            <div class=""></div>
                                                            <div class="">
                                                                @if($quiz_z->score >= 80)
                                                                    <b style="color:darkgreen">Success</b>
                                                                @else
                                                                    <b style="color:darkred">Faild</b>
                                                                @endif

                                                                
                                                            </div>
                                                            <div class="">
                                                                <b>{{$quiz_z->score}}%</b> Correct
                                                            </div>
                                                            <div class="">
                                                                @php
                                                                    $hours = 0;
                                                                    $mins = 0;
                                                                    $sec = 0;
                                                                    if($quiz_z->time_left != 0){
                                                                        $hours = floor($quiz_z->time_left/3600);
                                                                        $mins = floor( ($quiz_z->time_left%3600) / 60);
                                                                        $sec = floor(($quiz_z->time_left%3600) % 60);
                                                                    }
                                                                    
                                                                    
                                                                    

                                                                    
                                                                    
                                                                @endphp
                                                                {{$hours}} Hour {{$mins}} Min {{$sec}} Sec
                                                            </div>
                                                            <div class="">
                                                                {{$quiz_z->updated_at->diffForHumans()}}
                                                            </div>
                                                            <div class="col-md-1">
                                                                <i class="fa fa-arrow-down" style="font-size: 25px; color:#ccc; cursor: pointer;" v-on:click="slideMe('view2{{$quiz_z->id}}', 'view1{{$quiz_z->id}}')"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="container" id="view2{{$quiz_z->id}}" style="border:1px solid #ccc; width:80%; padding: 25px 0;box-shadow: 0px 9px 15px -4px rgba(0,0,0,0.14);display:none;">
                                                        <div class="row" >
                                                            <div class="col-md-5"></div>     
                                                            <div class="col-md-6" style="display:flex; justify-content: space-evenly; align-items:flex-start; flex-direction:column; flex-wrap: wrap;">
                                                                <div style="font-size: 20px; margin:5px;">
                                                                    Attempt {{$attempt}} : 

                                                                    @if($quiz_z->score >= 80)
                                                                        <i style="color: darkgreen;">Success (80% Required to pass)</i>
                                                                    @else
                                                                        <i style="color: darkred;">Faild (80% Required to pass)</i>
                                                                    @endif
                                                                </div>
                                                                <div style="margin:5px;">
                                                                    <b style="font-size: 25px;"> {{$quiz_z->score}}% </b><small>Correct</small>
                                                                </div>
                                                                <div style="color: #ccc;margin:5px;">
                                                                    {{$hours}} Hour {{$mins}} Min {{$sec}} Sec
                                                                </div>
                                                                <div style="color: #ccc;margin:5px;">
                                                                    {{$quiz_z->updated_at->diffForHumans()}}
                                                                </div>
                                                                <div style="margin:5px;">
                                                                    <a href="{{route('QuizHistory.show', $quiz_z->id)}}" class="btn green">Review Quiz</a>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-1">
                                                                <i class="fa fa-arrow-up" style="font-size: 25px; color:#ccc; cursor: pointer;" v-on:click="slideMe('view1{{$quiz_z->id}}', 'view2{{$quiz_z->id}}')"></i>
                                                            </div>
                                                                                                                   
                                                        </div>
                                                    </div>
                                                </div>

                                                @php
                                                $attempt--;
                                                @endphp
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>

                    
                    @if($ignore== 0)
                    <div class="col-md-4" style="padding:0;">
                        
                        <div class="right_list" style="border: 1px solid #eef1f5; min-height: 100px;  height: 100%; background-color: #fff;  overflow:scroll; padding: 16px 10px 0 10px;">
                                <h3 class="blog-single-head-title font-green">Course Content</h3>
                                <hr style="width: 100%; margin-top: 10px;">
                            @if(count($chapters_inc) > 0)
                                <table class="table table-hover">
                                    <thead>
                                        <th>
                                            <h4 ><b>Chapters</b></h4>
                                        </th>
                                    </thead>
                                    
                                    <tbody >
                                        @foreach($chapters_inc as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{route('PremiumQuiz-st3', [$package_id,'chapter', $item->id, 'realtime'])}}">
                                                        {{$item->name}}
                                                    </a>
                                                    
                                                        @if(\App\Quiz::where([
                                                            ['user_id', '=', Auth::user()->id],
                                                            ['package_id','=', $package_id],
                                                            ['topic_type', '=', 'chapter'],
                                                            ['topic_id', '=', $item->id],
                                                            ['complete', '=', 0],
                                                            ])->get()->first())
                                                                <i style="color:#c6112d;"> [Saved]</i> 
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            @endif
                            
                            @if(count($process_inc) > 0)
                                <table class="table table-hover">
                                    <thead>
                                        <th>
                                            <h4 ><b>Process Group</b></h4>
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach($process_inc as $item)
                                            <tr>
                                                <td>        
                                                    <a href="{{route('PremiumQuiz-st3', [$package_id,'process', $item->id, 'realtime'])}}">
                                                        {{$item->name}}
                                                    </a>
                                                    
                                                    @if(\App\Quiz::where([
                                                        ['user_id', '=', Auth::user()->id],
                                                        ['package_id','=', $package_id],
                                                        ['topic_type', '=', 'process'],
                                                        ['topic_id', '=', $item->id],
                                                        ['complete', '=', 0],
                                                        ])->get()->first())
                                                            <i style="color:#c6112d;"> [Saved]</i> 
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

                            @if(count($exams_inc) > 0)
                                <table class="table table-hover">
                                    <thead>
                                        <th>
                                            <h4 ><b>Exams</b></h4>
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach($exams_inc as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{route('PremiumQuiz-st3', [$package_id,'exam', $item->id, 'realtime'])}}">
                                                        {{$item->name}}
                                                    </a>
                                                    @if(\App\Quiz::where([
                                                        ['user_id', '=', Auth::user()->id],
                                                        ['package_id','=', $package_id],
                                                        ['topic_type', '=', 'exam'],
                                                        ['topic_id', '=', $item->id],
                                                        ['complete', '=', 0],
                                                        ])->get()->first())
                                                            <i style="color:#c6112d;"> [Saved]</i> 
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                    </div>
                    @endif
                    
    
                </div>

                <div class="modal" id="myModalRating">
                    <div class="modal-dialog" style="width: 65%;">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header" style="border:0; margin: 10px 0;">
                                
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="container">
                                    <center>
                                        <h2>
                                            How would you rate this course?
                                        </h2>
                                        <p style="color:#333; font-size: 20px; font-weight: 10; min-height: 30px;">
                                            @{{rate_sentance}}
                                        </p>
                                    
                                        <div class="row rate" style=" min-height: 100px; margin: 50px 0 15px 0;">
                                            <input type="radio" id="star5" v-model="rate_value" v-on:change="rate"  name="rate" value="5" />
                                            <label for="star5" title="text" @mouseover="rate_state('Amazing, above expectations!')">5 stars</label>
                                        
                                        
                                            <input type="radio" id="star4" v-model="rate_value" v-on:change="rate"  name="rate" value="4" />
                                            <label for="star4" title="text" @mouseover="rate_state('Good, what i expected')">4 stars</label>
                                        
                                        
                                            <input type="radio" id="star3"  v-model="rate_value" v-on:change="rate"  name="rate" value="3" />
                                            <label for="star3" title="text" @mouseover="rate_state('Average, could be better')">3 stars</label>
                                        
                                        
                                            <input type="radio" id="star2" v-model="rate_value" v-on:change="rate"  name="rate" value="2" />
                                            <label for="star2" title="text" @mouseover="rate_state('Poor, pretty disappointed')">2 stars</label>
                                        
                                        
                                            <input type="radio" id="star1" v-model="rate_value" v-on:change="rate"  name="rate" value="1" />
                                            <label for="star1" title="text" @mouseover="rate_state('Awful, not what i expected at all')">1 stars</label>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3">
                                                <div class="form-group">
                                                    <textarea v-model="user_review" placeholder="Tell us about your own personal experience taking this course. Was it a good match for you?" cols="30" rows="10" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                                <a v-on:click="post_review" class="btn green col-md-2 col-md-offset-4">Submit</a>    
                                            
                                            
                                                <a v-on:click="HideRate" class="btn red col-md-2">Dismiss</a>    
                                            
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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



<script src="{{asset('js/easyTimer.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
        @if(!\App\Rating::where('user_id',Auth::user()->id)->where('package_id', $package_id)->get()->first())
            $('#myModalRating').show();
        @endif
        var app2 = new Vue({
            el: '#app-2',

            data: {
                
            },
            methods: {
                
                _: function(ele){
                    return document.getElementById(ele);
                },
                ShowReplyForm:function(comment_id){
                    
                    if(this._('reply-form-'+comment_id).innerHTML == ''){
                        this._('reply-form-'+comment_id).innerHTML = '<div class="row"><div class="col-md-10 col-md-offset-2"><form action="{{route("comment.reply")}}" method="post">@csrf<input type="hidden" name="reply_to_id" value="'+comment_id+'"><div class="form-group col-md-8" style="padding-left: 0 !important;"><textarea rows="1" name="contant" placeholder="Write comment here ..." class="form-control c-square"></textarea></div><div class="form-group col-md-4"><div class="row"><button type="submit" class="btn blue uppercase btn-md col-md-6 sbold">Reply</button></div></div></form></div></div>';
                    }else{
                        this._('reply-form-'+comment_id).innerHTML = '';
                    }
                },
                removeReplyForm: function(comment_id){
                    this._('reply-form-'+comment_id).innerHTML = '';
                    alert('ok');
                },
                


            }
        });
        

        


        var app = new Vue({
         el: '#app-1',
            data: {
                feedback: '',
                current_question_answer: '',
                rad:'',

                questions: [],
                all_questions: [],
                correct_questions: [],
                incorrect_questions: [],
                
                question_title_list: [],
                current_question_number: 0, 
                q_number: 0,
                question_title: '',
                opt1: '',
                opt2: '',
                opt3: '',
                opt4: '',
                q_answerd: 0,
                q_answerd_list: [],
                user_answers:[],
                timer: new Timer(),
                timeTaken: '',
                score: 0,
                topics: null, // original response from the server [{id: , name: }, ]
                
                package_id: '{{$package_id}}',
                topic_type: '{{$topic}}',
                topic_id: {{$topic_id}},
                
                package: '{{$package_name}}',
                question_num: {{$questionNum}},
                max_questions_num: {{$questionNum}},
                img_link: '',
                make_exam: {
                    taken: 0,
                    text: 'Submit Exam'
                }, // exam has been taken or not
                ScoreMsg: '',
                scoreAnalysis: {
                    @if(count($process))
                        @foreach($process as $type)
                            '{{$type}}': {msg: '',count: 0 , data: []},
                        @endforeach
                    @endif
                },
                flaged: [],
                time_left: 0,
                answer_cat: 2,
                toggle_list: 0,
                rate_value: 0,
                rate_sentance: '',
                user_review: '',
                base_question_number: 0,
                last_q_answer_time_taken: 0,
                time_taken: 0,
                saved_quiz_id: 0,

            },
            methods: {
                showReview: function(){
                    uri = '{{route('QuizHistory.show', '')}}/'+this.saved_quiz_id;
                    window.location.href = uri;
                },
                slideMe: function(show, hide){
                    $('#'+show).slideDown();
                    $('#'+hide).slideUp();
                },
                _: function(ele){
                    return document.getElementById(ele);
                },
                ShowRate: function(){
                    $('#myModalRating').show();
                },
                HideRate: function(){
                    $('#myModalRating').hide();
                },
                post_review: function(){
                    Data = {
                        user_review: this.user_review,
                        package_id: this.package_id
                    };
                    
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'POST',
                        url: '{{ route('user.review')}}', 
                        data: Data,
                        success: function(res){
                            $('#myModalRating').hide();
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    
                    
                    });
                    
                },
                rate_state: function(r_s){
                   this.rate_sentance = r_s;
                },
                rate: function(){
                    
                    Data = {
                        rate: this.rate_value,
                        package_id: this.package_id
                    };
                    
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'POST',
                        url: '{{ route('user.rate')}}', 
                        data: Data,
                        success: function(res){
                            // $('#myModalRating').hide();
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    
                    
                    });
                    
                           
                      
                    
                    
                },
                toggle_right_list: function(){
                    $(".right_list").slideToggle();
                    if(this.toggle_list == 0){
                        $("#arrow").addClass('fa-arrow-left');
                        $("#arrow").removeClass('fa-arrow-right');
                        $("#quiz_app_container").addClass('col-md-12');
                        $("#quiz_app_container").removeClass('col-md-8');
                        this.toggle_list = 1;
                    }else{
                        $("#quiz_app_container").removeClass('col-md-12');
                        $("#quiz_app_container").addClass('col-md-8');
                        $("#arrow").removeClass('fa-arrow-left');
                        $("#arrow").addClass('fa-arrow-right');
                        
                        this.toggle_list = 0;
                    }
                },
                _:function(ele){
                    return document.getElementById(ele);
                },
                update_progress: function(add){
                    if(app.make_exam.taken == 0){
                        percent = Math.round((app.q_answerd)/app.q_number*100);
                        $('.progress-bar').attr('aria-valuenow', percent);
                        $('.progress-bar').attr('style', 'width: '+percent+'%');
                        this._('progress_bar').innerHTML = percent.toString().substr(0,5)+' %';
                    }
                },
                toggle_answers: function(){



                    if(this.answer_cat == 1){
                        // correct answers 
                        if(app.correct_questions.length != 0){
                            questions_list = app.correct_questions;
                        }else{
                            alert("All answers are false !");
                            questions_list = app.all_questions;
                        }
                        
                        
                    }else if (this.answer_cat == 2){
                        // all questions
                        questions_list = app.all_questions;
                    }else{
                        // incorrect questions
                        if(app.incorrect_questions.length != 0){
                            questions_list = app.incorrect_questions;
                        }else{
                            alert("All answers are correct !");
                            questions_list = app.all_questions;
                        }
                    }


                    

                    app.q_number = questions_list.length;  
                    app.current_question_number = 1;
                    app.questions = questions_list;
                    
                    app.q_answerd = questions_list.length;
            
                    counter = 1;
                    app.question_title_list = [];

                    questions_list.forEach(ele => {
                        app.question_title_list.push({
                            id: counter,
                            title: counter+'. '+ele['title'].substring(0,80)+'..',
                            score: 0,
                        });
                        counter++;
                    });

                    app.push_question(app.current_question_number);
                    
                    done=0;
                    
                    c = 1;
                    app.user_answers = [];
                    app.questions.forEach(q => {
                        app.user_answers.push({
                            question_num: c,
                            question_id: q['id'],
                            user_answer: q['user_saved_answer'],
                            correct_answer: q['correct_answer'],
                            process_group: q['process_group']
                        });
                        c++;
                    });

                    done = 1;
                    $("#prev").hide();
                    while(1){
                        if(done){
                            app.selectUserAnswer();
                            app.selectCorrectAnswer();
                            break;
                        }
                    }
                    

                    this.return_to_quiz();
                    
                    
                    
                },
                continueQuize: function(){
                    this.timer.start();
                    $("#quiz").show();
                    $('#optimizeForm').hide();
                    $('#startQuiz').show();
                    $('#continueQuiz').hide();
                    // $('#saveforlateron').hide();
                },
                stopTimer_pause: function(){
                    this.timer.pause();
                    this.storeAnswers();
                    $("#quiz").hide();
                    $('#optimizeForm').show();
                    $('#startQuiz').hide();
                    $('#continueQuiz').show();
                    // $('#saveforlateron').show();

                    // if(this.package == 'test'){
                    //     $('#saveforlateron').hide();
                    // }
                },
                storeAnswers:function(){
                    this.user_answers.forEach(ele => {
                        if(ele.question_num == this.current_question_number){
                            if(ele.user_answer != this.rad){

                                ele.user_answer = this.rad;
                                // store in database !
                                // (id, answer)
                                @if($quiz)
                                    @if($quiz->complete == 0)
                                    this.storeToDB(ele.question_id, ele.user_answer);
                                    @endif
                                @else
                                this.storeToDB(ele.question_id, ele.user_answer);
                                @endif

                            }
                        }
                    });
                },
                answerd_counter: function(){
                    if(!this.q_answerd_list.includes(this.current_question_number)){
                        this.q_answerd_list.push(this.current_question_number);
                        this.q_answerd++;      
                    }
                },
                optimizeQuiz: function(){

                    done = 0;

                    $("#optimizeForm").hide();
                    
                    // send request to generate the questions
                    Data = {
                        num: this.question_num,
                        topic: this.topic_type,
                        topic_id: this.topic_id,
                        package: this.package_id,
                        quiz_id: @if($quiz) {{$quiz->id}} @else 'realtime' @endif
                    };
                    
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    console.log('[+] Send Request : '+new Date().getHours()+':'+new Date().getMinutes()+':'+new Date().getSeconds());
                    
                    $.ajax ({
                        type: 'POST',
                        url: '{{ route('PremiumQuiz.generate')}}', 
                        data: Data,
                        success: function(res){
                            if(res == '500' || res == '404'){
                                location.reload();
                                
                            }else{
                                
                                console.log('[+] Request Recived : '+new Date().getHours()+':'+new Date().getMinutes()+':'+new Date().getSeconds());
                                console.log('[+] Start processing');
                                
                                app.q_number = res[0].length;  
                                app.current_question_number = 1;
                                app.questions = res[0];
                                if(res[2]){
                                    app.q_answerd = res[2];                                    
                                }else{
                                    app.q_answerd = 0;
                                }

                                app.all_questions = res[0];

                                app.all_questions.forEach(ele => {
                                    if( ele['correct_answer'] == ele['user_saved_answer']){
                                        app.correct_questions.push(ele);
                                    }else{
                                        app.incorrect_questions.push(ele);
                                    }
                                });

                                


                                counter = 1;
                                res[0].forEach(ele => {
                                    app.question_title_list.push({
                                        id: counter,
                                        title: counter+'. '+ele['title'].substring(0,80)+'..',
                                        score: 0,
                                    });
                                    counter++;
                                });

                                app.push_question(app.current_question_number);
                                
                                
                                c = 1;
                                app.questions.forEach(q => {
                                    app.user_answers.push({
                                        question_num: c,
                                        question_id: q['id'],
                                        user_answer: q['user_saved_answer'],
                                        correct_answer: q['correct_answer'],
                                        process_group: q['process_group']
                                    });
                                    c++;
                                });
                                app.base_question_number = app.question_num - app.q_answerd;
                                app.selectUserAnswer();
                                app.timer.start({countdown: true, startValues: {seconds: (app.base_question_number) * 72 } });
                                app.timer.addEventListener('secondsUpdated', function (e) {
                                    $('#timer').html(app.timer.getTimeValues().toString());
                                    app.time_taken = (app.base_question_number * 72) - ((app.timer.getTimeValues().days * 24 * 3600 ) + (app.timer.getTimeValues().hours * 3600) + (app.timer.getTimeValues().minutes * 60) +(app.timer.getTimeValues().seconds));
                                });
                                app.timer.addEventListener('targetAchieved', function(e){
                                    app.markExam();
                                });

                                

                                done = 1;


                                
                                while(1){
                                    if(done == 1){
                                        
                                        console.log('[+] Respond is Ready : '+new Date().getHours()+':'+new Date().getMinutes()+':'+new Date().getSeconds());

                                        @if($quiz != null)
                                            @if($quiz->complete == 1)
                                                app.markExam();
                                            @else
                                                app.update_progress();
                                            @endif

                                        @else

                                            app.update_progress();
                                        @endif  

                                        break;
                                    }
                                }
                                
                            }                          
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    });

                    // show the quiz form and fire the timer on
                    
                    

                    $("#quiz").show();
                    $("#prev").hide();
                    if(app.question_num <= 1){
                        $("#next").hide();
                    }


                    

                    

                },
                push_question: function(CQN/* Current question Number */){
                    this.question_title = this.questions[CQN-1]['title'];
                    this.opt1 = this.questions[CQN-1]['answers'][0];
                    this.opt2 = this.questions[CQN-1]['answers'][1];
                    this.opt3 = this.questions[CQN-1]['answers'][2];
                    this.opt4 = this.questions[CQN-1]['answers'][3];
                    this.feedback = this.questions[CQN-1]['feedback'];
                    this.question_id = this.questions[CQN-1]['id'];
                    this.current_question_answer = this.questions[CQN-1]['correct_answer'];
                    if(this.questions[CQN-1]['img'] != 'null'){
                        this.img_link = '{{url('')}}/storage/questions/'+this.questions[CQN-1]['img'];
                        $("#fig").show();
                    }else{
                        this.img_link = '';
                        $("#fig").hide();
                    }
                    
                },
                push_question_and_store_last_answer: function(QN /* question number */){
                    
                    this.storeAnswers();
                    this.push_question(QN);
                    this.current_question_number = QN;
                    this.selectUserAnswer();
                    
                    //check the question number to adjustfy the next and prev btns
                    if(this.current_question_number == this.q_number && this.q_number > 1){
                        $("#prev").show();
                        $("#next").hide();
                    }else if(this.current_question_number == 1 && this.q_number > 1){
                        $("#next").show();
                        $("#prev").hide();
                    }else if(this.current_question_number == this.q_number && this.q_number == 1){
                        $("#prev").hide();
                        $("#next").hide();
                    }else {
                        $("#next").show();
                        $("#prev").show();
                    }
                    if(this.make_exam.taken == 1){
                        this.selectCorrectAnswer();
                    }
                    this.colorMyflag();
                },
                next: function(){
                    // store the answer if exist
                    @if($quiz)

                        @if($quiz->complete == 0)
                            this.update_progress();
                        @endif
                    @else

                        this.update_progress();
                    @endif
                    
                    this.storeAnswers();
                    
                    //show the next question
                    if((this.current_question_number+2) > this.q_number){
                        $("#next").hide();
                        if(app.make_exam.taken == 0){
                            $("#finish_btn").show();
                        }
                        $("#prev").show();                      
                    }else{
                        $("#prev").show();
                        
                    }
                    this.current_question_number++;
                    
                    
                    this.push_question(this.current_question_number);
                    
                    //select the answer if exits
                    this.selectUserAnswer();
                    if(this.make_exam.taken == 1){
                        this.selectCorrectAnswer();
                    }
                    this.colorMyflag();
                },
                prev: function(){
                    // store the answer if exist
                    @if($quiz)

                        @if($quiz->complete == 0)
                            this.update_progress();
                        @endif
                    @else

                        this.update_progress();
                    @endif

                    this.storeAnswers();
                    

                    //show the previous question
                    if((this.current_question_number - 2) < 1){
                        $("#prev").hide();
                        $("#next").show();
                        
                    }else{
                        $("#next").show();
                        if(app.make_exam.taken == 0){
                            $("#finish_btn").hide();
                        }
                    }
                    this.current_question_number--;
                    this.push_question(this.current_question_number);
                    //select the answer if exits
                    this.selectUserAnswer();
                    if(this.make_exam.taken == 1){
                        this.selectCorrectAnswer();
                    }
                    this.colorMyflag();
                },
                unselectRadio: function(){
                    this.rad = '';   
                },
                selectUserAnswer: function(){
                    
                    found = 0;
                    this.user_answers.forEach(ele => {
                        if(ele.question_num == this.current_question_number){
                            this.rad = ele.user_answer;
                            found = 1;
                        }
                    });
                    if (!found){
                        this.unselectRadio();
                        
                    }
                },
                selectCorrectAnswer: function(){
                    $("#radio1").find('.fa').remove();
                    $("#radio2").find('.fa').remove();
                    $("#radio3").find('.fa').remove();
                    $("#radio4").find('.fa').remove();

                    switch (this.questions[this.current_question_number-1].correct_answer) {
                        case this.opt1:
                            $("#radio1").prepend('<i class="fa fa-check" style="margin: 8px 0 0 -35px; color: green; position: absolute;"></i>');
                            break;
                        case this.opt2:
                            $("#radio2").prepend('<i class="fa fa-check" style="margin: 8px 0 0 -35px; color: green; position: absolute;"></i>');
                            break;
                        case this.opt3:
                            $("#radio3").prepend('<i class="fa fa-check" style="margin: 8px 0 0 -35px; color: green; position: absolute;"></i>');
                            break;
                        case this.opt4:
                            $("#radio4").prepend('<i class="fa fa-check" style="margin: 8px 0 0 -35px; color: green; position: absolute;"></i>');
                            break;
                    }
                },
                
                Confirmation: function(){
                    
                    swal({
                      title: 'Are you sure you want to end the exam ?',
                      type: 'warning',
                      showCancelButton: true,
                    //   confirmButtonColor: '#DD6B55',
                      confirmButtonText: 'Yes',
                      cancelButtonText: 'No'
                    }).then(app.markExam);
                    
                    
                },
                markExam: function(confirmation){
                    
                    
                    
                    if(app.make_exam.taken == 0){
                        @if($quiz)
                            @if($quiz->complete == 0)
                                if(confirmation.value == 1){
                                    conf = 1;    
                                }else{
                                    conf= 0;
                                }
                                
                            @else
                                conf = 1;
                            @endif
                        @else
                            if(confirmation.value == 1){
                                conf = 1;    
                            }else{
                                conf= 0;
                            }
                        @endif
                        
                        if(conf){
                   
                            // stop the timer and stor the time .
                            this.storeAnswers();

                            

                            app.timer.pause();
                            // this.timeTaken = $("#timer").html();
                            @if($quiz)
                                @if($quiz->complete == 0)
                                $("#quiz").hide();
                                @endif
                            @else
                                $("#quiz").hide();
                            @endif
                            
                            counter = 0;
                            this.user_answers.forEach(ele => {
                                if(ele.user_answer == ele.correct_answer){
                                    this.score++;
                                    this.question_title_list[counter].score = '1  <i class="fa fa-check" style="color:green"></i>';
                                    
                                                        
                                }else{
                                    this.question_title_list[counter].score = '0 <i class="fa fa-times" style="color: red"></i>';
                                }
                                
                                counter++;
                            });
                            
                            
                            this.score /= this.q_number;
                            this.score *= 100;
                            this.score = Math.round(this.score);
        
                            if(this.score > 75){
                                this.ScoreMsg = '<small style="color:springgreen;">Congraulation you have Passed</small>';
                            }else{
                                this.ScoreMsg = '<small style="color:#DC143C;">Sorry You Failed !</small>';
                            }

                            // score analysis..
                            
                            this.user_answers.forEach(answer => {
                                score = 0;
                                if(answer.user_answer == answer.correct_answer){
                                    score = 1;
                                }
                                this.scoreAnalysis[answer.process_group].data.push({
                                    q_num: answer.question_num,
                                    q_score: score
                                });
                            });
                            // calculate number of question per process group..
                            for(i in this.scoreAnalysis){
                                this.scoreAnalysis[i].count = this.scoreAnalysis[i].data.length;
                            }
                            // generate the massage 
                            number_de_correct_answers = 0;
                            for(i in this.scoreAnalysis){
                                this.scoreAnalysis[i].data.forEach(ele => {
                                    if(ele.q_score == 1){
                                        number_de_correct_answers++;
                                    }
                                });
                                process_score = number_de_correct_answers / this.scoreAnalysis[i].count;
                                process_score *= 100;
                                process_score = Math.round(process_score);

                                if(process_score <= 60){
                                    this.scoreAnalysis[i].msg = '<i style="color: red;">Need Improvment</i>';
                                }else if(process_score > 60 && process_score<=70){
                                    this.scoreAnalysis[i].msg = '<i style="color: red;">below target</i>';
                                }else if(process_score >= 71 && process_score < 80){
                                    this.scoreAnalysis[i].msg = '<i style="color: #999900;">target</i>';
                                }else if(process_score >= 80){
                                    this.scoreAnalysis[i].msg = '<i style="color:green;">above target</i>';
                                }
                                number_de_correct_answers = 0;
                            }
                            // delete unused process groups from the object..
                            for(i in this.scoreAnalysis){
                                if(this.scoreAnalysis[i].count == 0){
                                    delete this.scoreAnalysis[i];
                                }

                            }

                            // generate the analysis with jquery ..
                            
                            
                            r = $("#result");
                            html_ = '';
                            for(var k in this.scoreAnalysis){
                                if(this.scoreAnalysis.hasOwnProperty(k)){
                                    html_ += '<h4>'+k+' :</h4><h5>'+this.scoreAnalysis[k].msg+'</h5><table class="table table-bordered table-hover"><thead><th>Question No.</th><th>Score</th></thead><tbody>';
                                    this.scoreAnalysis[k].data.forEach(x => {
                                        if(x.q_score == 1){
                                            html_ += '<tr><td>'+x.q_num+'</td><td><i class="fa fa-check" style="color:green"></i></td></tr>';
                                        }else{
                                            html_ += '<tr><td>'+x.q_num+'</td><td><i class="fa fa-times" style="color: red"></i></td></tr>';
                                        }
                                    });
                                    html_ += '</tbody></table>';
                                    r.append(html_);
                                    html_ = '';
                                }
                            }


                            this.make_exam.taken = 1;
                            this.make_exam.text = 'Your Score';
                        
                            this.selectCorrectAnswer();

                            $("#feedback_btn").show();
                            $("#result").show();
                            $("#pause").hide();
                            
                            if(app.last_q_answer_time_taken != 0){
                                timeI = (app.time_taken - app.last_q_answer_time_taken);
                            }else{
                                timeI = app.time_taken;
                            }

                            app.last_q_answer_time_taken = app.time_taken;


                            console.log(timeI);

                            Data = {
                                totalScore: app.score,
                                question_num: app.q_number,
                                package: app.package,
                                package_id: app.package_id,
                                topic_type: app.topic_type,
                                topic_id: app.topic_id,
                                time_left: timeI,
                            };


                            
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            if(this.package_id != 'question'){
                                $.ajax ({
                                    type: 'POST',
                                    url: '{{ route('PremiumQuiz.scoreStore')}}', 
                                    data: Data,
                                    success: function(res){
                                        console.log(res);
                                        console.log('done');
                                    },
                                    error: function(res){
                                        console.log('Error:', res);    
                                    }
                                });
                            }

                            $("#toggle_answers").show();
                            $("#q_number").show();
                            $("#finish_btn").hide();

                            @if($quiz)
                                @if($quiz->complete == 1)
                                $("#result").hide();
                                @endif
                            @endif    
                        }
                        
                    }else{
                        $("#quiz").hide();
                        $("#result").show();
                    }
                    
                },
                return_to_quiz: function(){
                    $("#result").hide();
                    $("#quiz").show();
                },
                flagMe: function(){
                    located = 0;
                    this.flaged.forEach(ele => {
                        if(ele == this.current_question_number)
                        {
                            //remove from array
                            this.flaged.splice(this.flaged.indexOf(this.current_question_number), 1);
                            located = 1;
                        }
                    });
                    if(located == 0 ){
                        // add it to array
                        this.flaged.push(this.current_question_number);                        
                    }
                    // add color,
                    this.colorMyflag();
                },
                colorMyflag:function(){
                    located = 0;
                    this.flaged.forEach(ele => {
                        if(ele == this.current_question_number){
                            //color to red 
                            $("#flag").css('color','red');
                            located =1;
                        }
                    });
                    if(located ==  0)
                    {
                        $("#flag").css('color','gray');
                    }
                },
                feedMeBack: function(){
                    window.open("{{url('PremiumQuiz/feedback')}}/"+this.question_id,'_blank','resizable,height=350,width=500'); 
                    return false;
                },
                saveForLaterOn: function(e){

                    

                    answers_arr = [];
                    app.user_answers.forEach(i => {
                        answers_arr.push([i.question_id, i.user_answer]);
                    });

                    
                    answered_question_number = app.q_answerd;
                    
                    if(answered_question_number < this.question_num){                 
                        $('.optimization_form').hide();
                        $('.saving_form').show();

                        

                        Data = {
                            num: this.question_num,
                            topic: this.topic_type,
                            topic_id: this.topic_id,
                            package: this.package_id,
                            answers: answers_arr,
                            time_left: app.time_taken,
                            answered_number: answered_question_number
                        };
                        
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                                            
                        $.ajax ({
                            type: 'POST',
                            url: '{{ route('saveForLaterOn')}}', 
                            data: Data,
                            success: function(res){
                                $('.saving_form').html('<b style="color:green"> Your answers have been saved, and you can access then any time .</b>');        
                            },
                            error: function(res){
                                console.log('Error:', res);    
                            }
                        });
                    }else{
                        alert('you already have done the exam, please submit the exam !');
                    }
                },
                storeToDB: function(id, answer){
                    
                    if(app.last_q_answer_time_taken != 0){
                        timeI = (app.time_taken - app.last_q_answer_time_taken);
                    }else{
                        timeI = app.time_taken;
                    }

                    app.last_q_answer_time_taken = app.time_taken;

                    console.log(timeI);
                    Data = {
                        topic: this.topic_type,
                        topic_id: this.topic_id,
                        package: this.package_id,
                        questions_number: app.question_num,
                        question_id: id,
                        user_answer: answer,
                        time_left: timeI,
                    };
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax ({
                        type: 'POST',
                        url: '{{ route('saveForLaterOn')}}', 
                        data: Data,
                        success: function(res){
                            console.log('stored !');
                            app.saved_quiz_id = res;
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    });
                    
                }

            }
        });
    </script>
@endsection
