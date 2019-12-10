@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Edit question :</h2>
        {!! Form::open(['action' => ['QuestionsController@update', $question->id], 'method'=>'POST']) !!}
            <div class="form-group">
                <strong>{{Form::label('question','Question :')}}</strong>
                {{Form::textarea('question', $question->title, ['class' => 'form-control', 'placeholder'=>'Question'])}}
            </div>
            <div class="form-group">
                <strong>{{Form::label('correct_answer','Correct Answer :')}}</strong>
                {{Form::text('correct_answer', $question->correct_answer, ['class' => 'form-control', 'placeholder'=>'Correct Answer'])}}
            </div>
            <div class="form-group">
                    <strong>{{Form::label('answer_a','Answer A :')}}</strong>
                {{Form::text('answer_a', $question->a, ['class' => 'form-control', 'placeholder'=>'False Answer'])}}
            </div>
            <div class="form-group">
                <strong>{{Form::label('answer_b','Answer B :')}}</strong>
                {{Form::text('answer_b', $question->b, ['class' => 'form-control', 'placeholder'=>'False AnsweR'])}}
            </div>
            <div class="form-group">
                <strong>{{Form::label('answer_c','Answer C :')}}</strong>
                {{Form::text('answer_c', $question->c, ['class' => 'form-control', 'placeholder'=>'False Answer'])}}
            </div>
            <div class="form-group">
                <strong>{{Form::label('chapter','Knowledge area :')}}</strong>
                {{ Form::select('chapter', $ch_select
                    // '1' => 'Introduction', 
                    // '2' => 'Project environment',
                    // '3' => 'Project manager role ',
                    // '4' => 'Integration Management',
                    // '5' => 'Scope Management',
                    // '6' => 'Cost Management',
                    // '7' => 'Quality Management',
                    // '8' => 'Resource Management',
                    // '9' => 'Resource Management',
                    // '10' => 'Communication Management',
                    // '11' => 'Risk Management',
                    // '12' => 'Procurement Management',
                    // '13' => 'Stakeholder Management',
                    // '14' => 'Exam Outline/ Domains'
                    ,$question->chapter, ['class' => 'form-control'] ) }}
            </div>
            <div class="form-group">
                <strong>{{Form::label('process_group','Process Group :')}}</strong>
                {{ Form::select('process_group', $pg_select
                    // '1' => 'Initiating', 
                    // '2' => 'Planning',
                    // '3' => 'Executing',
                    // '4' => 'Monitoring and controlling',
                    // '5' => 'Closing',
                    ,$question->process_group, ['class' => 'form-control'] ) }}
            </div>
            <div class="form-group">
                <strong>{{Form::label('feedback','Feedback :')}}</strong>
                {{ Form::textarea('feedback',$question->feedback,['class'=>'form-control','placeholder'=>'Feedback for the Correct Answer'])}}
            </div>
            <div class="form-group">
                {{ Form::hidden('_method', 'PUT')}}
                {{Form::submit('Edit', ['class'=>'btn btn-primary float-right'])}}
            </div>            
        {!! Form::close() !!}
    </div>
    <br>
    <br>
@endsection