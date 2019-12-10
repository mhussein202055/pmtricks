@extends('layouts.app')

@section('content')

    <div class="container">
        
        {!! Form::open(['action'=>'QuestionsController@search', 'method'=>'POST', 'class'=>'form-inline', 'style'=>'margin: 10px 0 20px 0;']) !!}
            <div class="form-group">
                <strong>{{Form::label('word','Search :')}}</strong>
                {{Form::text('word', '', ['class' => 'form-control', 'placeholder'=>'Search', 'style'=>'margin: 0 10px 0 10px;'])}}
                
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
                        ,'', ['class' => 'form-control'] ) }}
                </div>
                <div class="form-group">
                    <strong>{{Form::label('process_group','Process Group :')}}</strong>
                    {{ Form::select('process_group', $pg_select
                        // '1' => 'Initiating', 
                        // '2' => 'Planning',
                        // '3' => 'Executing',
                        // '4' => 'Monitoring and controlling',
                        // '5' => 'Closing',
                        ,'', ['class' => 'form-control'] ) }}
                </div>
                <div class="form-group">
                    {{Form::submit('search', ['class'=>'btn btn-primary float-right', 'style'=>'margin: 0 10px 0 10px;'])}}
                </div>
            
        {!! Form::close() !!}
        
        <div class="container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Questions</td>
                        <td>Last Update</td>
                        <td>Chapter</td>
                        <td>Project Management Process</td>
                        <td>Process Group</td>
                        <td>Free Quiz </td>
                        <td>Exam No.</td>
                        <td>Edit</td>
                        <td>Delete</td>

                    </tr>
                </thead>
                <tbody>

                    @if(count($questions)> 0)
                        @foreach($questions as $q)
                            <tr>
                                <td>{{$q->id}}</td>
                                <td><strong>{{substr($q->title, 0, 80)}} ..</strong></td>
                                <td>{{$q->updated_at}}</td>
                                <td>
                                    @if($q->chapter != '')
                                    {{\App\Chapters::where('id','=',$q->chapter)->get()->first()->name }}
                                    @else
                                    --
                                    @endif
                                </td>
                                <td>
                                    @if($q->project_management_group != '')
                                    {{\App\ProjectManagementGroup::where('id','=',$q->project_management_group)->get()->first()->name }}
                                    @else
                                    --
                                    @endif
                                </td>
                                <td>
                                    @if($q->process_group != '')
                                    {{\App\Process_group::where('id','=',$q->process_group)->get()->first()->name }}
                                    @else
                                    --
                                    @endif
                                </td>
                                <td>
                                    @if($q->demo == 1)
                                        True
                                    @else
                                        False
                                    @endif
                                </td>
                                <td>
                                    @if($q->exam_num != '')
                                        {{$q->exam_num}}
                                    @else
                                        --
                                    @endif
                                </td>
                                <td><a style="border:0;" href="{{ route('question.edit', $q->id) }}" class="btn btn-outline-info" style="margin-right: 10px;"> <i class="fa fa-edit"></i> </a></td>
                                <td><a style="border:0;" href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#DeleteModal-{{$q->id}}"> <i class="fa fa-trash-alt"></i> </a></td>
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
                                            <p><strong>Correct Answer: </strong> {{$q->correct_answer}}</p>
                                            <p><strong>Attached to Package: </strong> 
                                                @isset($roles_list[$q->id])
                                                    {{ $roles_list[$q->id] }}
                                                @else 
                                                    None
                                                @endisset
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            {!! Form::open(['action'=>['QuestionsController@destroy', $q->id], 'method'=>'POST']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                            {!! Form::close() !!}
                                        </div>
                                      </div>
                                      
                                    </div>
                                </div>

                        @endforeach
                    @else
                        <p>noting to show !</p>
                    @endif
                    


                </tbody>
            </table>
        </div>
        {{-- <div class="card">
            <div class="card-header">Questions: </div>


            
        
            <div class="card-body">
                @if(count($questions)> 0)
                    @foreach($questions as $question)
                        <div class="wrapper">
                            <div>
                                <h5><strong>{{substr($question->title, 0, 40)}} ..</strong></h5>
                                <small>Last Update {{$question->updated_at}}</small>
                            </div>
                            <div  style="align-item: flex-end; display:flex;">
                                <a href="{{ route('question.edit', $question->id) }}" class="btn btn-outline-info" style="margin-right: 10px;"> Edit </a>
                                <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#DeleteModal-{{$question->id}}"> Delete </a>

                                <div class="modal fade" id="DeleteModal-{{$question->id}}" role="dialog">
                                    <div class="modal-dialog">
                                    
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header" style="text-align: left;">
                                            <h4 class="modal-title">Are You Sure ?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{$question->title}}</p>
                                            <p><strong>Correct Answer: </strong> {{$question->correct_answer}}</p>
                                            <p><strong>Attached to Package: </strong> 
                                                @isset($roles_list[$question->id])
                                                    {{ $roles_list[$question->id] }}
                                                @else 
                                                    None
                                                @endisset
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            {!! Form::open(['action'=>['QuestionsController@destroy', $question->id], 'method'=>'POST']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                            {!! Form::close() !!}
                                        </div>
                                      </div>
                                      
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                @else
                        <p>No Questions found !</p>
                @endif                                 
                    
                
            </div>
        </div> --}}
        <div class="pagination-wrapper">
            {{ $questions->links() }}
        </div>
    </div>
@endsection