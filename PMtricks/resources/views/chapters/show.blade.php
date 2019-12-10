@extends('layouts.app')

@section('content')
    <div class="container" id = "app-1">
        <div class="card">
            <div class="card-header">Knowledge Area & Proccess Group Settings  </div>

            <div class="card-body">
                {{-- @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif --}}

                <div class="container" id="error-msg"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Courses</div>
                            <div class="card-body">
                                <ul class="Proccess_Group">
                                    <li v-for="i in courses_data">
                                        <strong>@{{i}}</strong>
                                        <i class="fa fa-times" v-on:click="DeleteCourse(i)"></i>
                                    </li>
                                    
                                </ul>
                                <form @submit.prevent="addNewCourse" class="card-body add_pgroup_form">
                                    <div class="form-group ">
                                        <label for="course_new"> Add New Course: </label>
                                        <br>
                                        <input type="text" id="course_new" v-model="course_new" class="form-control">
                                        <br>
                                        <select class="form-control" v-model="private">
                                            <option value="1">Private</option>
                                            <option value="0">Public</option>
                                        </select>
                                        <br>
                                        
                                        <a v-on:click="addNewCourse" class="btn btn-outline-primary" >Add</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Chapters</div>
                            <div class="card-body">
                                <ul class="knowledgeArea">
                                    <li v-for="i in Karea_data">
                                        <strong>@{{i}}</strong>
                                        <i class="fa fa-times" v-on:click="DeleteKarea(i)"></i>
                                    </li>
                                </ul>
                                <form @submit.prevent="addNewKarea" class="card-body add_karea_form">
                                    
                                    <div class="form-group form-inline" class="add_karea_form">
                                        <label for="Karea_new"> Add Chapter: </label>
                                        <input type="text" id="Karea_new" v-model="Karea_new" class="form-control">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                Knowledge Area : 
                                              <input type="checkbox" class="form-check-input" v-model="checkedCK" style="margin-left: 10px;">
                                              @{{checkedCK}}
                                            </label>
                                            <div class="form-group form-inline">
                                                <label for="list3"> Attach to Course : </label>
                                                <select v-model="selected3" class="form-control" id="list3" >
                                                    <option disabled value="">Choose Course</option>
                                                    <option v-for="i in courses_data">@{{i}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <a v-on:click="addNewKarea" class="btn btn-outline-primary">Add</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Proccess Group</div>
                            <div class="card-body">
                                <ul class="Proccess_Group">
                                    <li v-for="i in PGroup_data">
                                        <strong>@{{i}}</strong>
                                        <i class="fa fa-times" v-on:click="DeletePGroup(i)"></i>
                                    </li>
                                    
                                </ul>
                                <form @submit.prevent="addNewPGroup" class="card-body add_pgroup_form">
                                    <div class="form-group form-inline">
                                        <label for="PGroup_new"> Add Proccess Group: </label>
                                        <input type="text" id="PGroup_new" v-model="PGroup_new" class="form-control">
                                        <a v-on:click="addNewPGroup" class="btn btn-outline-primary" >Add</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Project Management Group</div>
                            <div class="card-body">
                                <ul class="Project_Group">
                                    <li v-for="i in projectMGroup_data">
                                        <strong>@{{i}}</strong>
                                        <i class="fa fa-times" v-on:click="DeletePMG(i)"></i>
                                    </li>
                                    
                                </ul>
                                <form @submit.prevent="addNewPMG" class="card-body PMG">
                                    <div class="form-group form-inline">
                                        <label for="list1"> Attach to  : </label>
                                        <select v-model="selected1" class="form-control" id="list1" >
                                            <option disabled value="">Choose Knowledge Area</option>
                                            <option v-for="i in Karea_data">@{{i}}</option>
                                        </select>
                                        <label for="list2"> Attach to : </label>
                                        <select v-model="selected2" class="form-control" id="list2" >
                                            <option disabled value="">Choose Process Group</option>
                                            <option v-for="i in PGroup_data">@{{i}}</option>
                                        </select>
                                        <label for="projectMGroup_new"> Add Projcet Group: </label>
                                        <input type="text" id="projectMGroup_new" v-model="projectMGroup_new" class="form-control">
                                        <a v-on:click="addNewPMG" class="btn btn-outline-primary" >Add</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row save-data">
                    <div class="card-body" >
                    {{-- <a v-on:click="save" class="btn btn-primary">Save</a> --}}
                </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
        // $all { chapters, process groups, project management group } (0,1,2)
        var app = new Vue({
            el: '#app-1',
            data: {
                selected1: '',
                selected2:'',
                selected3: '',
                PGroup_new: '',
                PGroup_data: [
                    
                    @if(count($all[1]) > 0)
                        @foreach($all[1] as $pg)
                        '{{ $pg->name}}',
                        @endforeach
                    @endif
                    
                ],
                Karea_new: '',
                checkedCK: '',
                Karea_data: [
                    
                    @if(count($all[0]) > 0)
                        @foreach($all[0] as $ka)
                        '{{ $ka->name}}',
                        @endforeach
                    @endif
                    
                ],
                course_new: '',
                courses_data: [
                    @if(count($all[3]) > 0)
                        @foreach($all[3] as $cr)
                        '{{$cr->title}}',
                        @endforeach
                    @endif
                ],
                projectMGroup_new: '',
                projectMGroup_data: [
                    @if(count($all[2]) > 0)
                        @foreach($all[2] as $pmg)
                        '{{ $pmg->name}}',
                        @endforeach
                    @endif
                ],
                private: 1,
            },
            methods: {
                addNewCourse: function(e){
                    if( this.course_new == ''){
                        alert("Course title Required ");
                    }else{
                        this.courses_data.push(this.course_new);

                        var Data = {
                            value: this.course_new,
                            private: this.private,
                            type: 'course'
                        };
                        this.course_new = '';

                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        
                        $.ajax ({
                           type: 'POST',
                           url: '{{ route('chapterManager.add')}}', 
                           data: Data,
                           success: function(res){
                                // do nothing
                                // console.log(res);
                                
                           },
                           error: function(res){
                                console.log('Error:', res);    
                           }
                        });


                    }
                },
                remove_course: function(item){
                    i = this.courses_data.indexOf(item);
                    if(i > -1){
                        this.courses_data.splice(i, 1);
                    }
                    console.log("deleted");
                },
                DeleteCourse: function(item){
                    var Data= {
                        value: item,
                        type: 'course'
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'DELETE',
                        url: '{{ route('chapterManager.delete')}}', 
                        data: Data,
                        success: function(res){
                            // do nothing
                            console.log(res);
                            if( res != '300'){
                                app.remove_course(item);
                                $("#error-msg").removeClass('alert alert-danger').html('');
                            }else{
                                // cant delete it (alert)
                                var err = $("#error-msg").addClass('alert alert-danger');
                                err.html('<strong>Error : </strong> You can\'t Delete it, It\'s already in use ! ');
                            }
                            
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    });
                },
                addNewPGroup: function(e){
                    if (this.PGroup_new == '')
                    { 
                        alert("It's Rquired")
                    }else{
                        this.PGroup_data.push(this.PGroup_new);
                        var Data = { 
                            value: this.PGroup_new,
                            type: 'process_group'
                        };

                        this.PGroup_new = '';
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        
                        $.ajax ({
                           type: 'POST',
                           url: '{{ route('chapterManager.add')}}', 
                           data: Data,
                           success: function(res){
                                // do nothing
                                // console.log(res);
                                
                           },
                           error: function(res){
                                console.log('Error:', res);    
                           }
                        });
                    }
                },
                remove_PGroup: function(item){
                    i = this.PGroup_data.indexOf(item);
                    if(i > -1){
                        this.PGroup_data.splice(i, 1);
                    }
                    console.log("deleted");
                },
                DeletePGroup: function(item){

                    var Data= {
                        value: item,
                        type: 'process_group'
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'DELETE',
                        url: '{{ route('chapterManager.delete')}}', 
                        data: Data,
                        success: function(res){
                            // do nothing
                            console.log(res);
                            if( res != '300'){
                                app.remove_PGroup(item);
                                $("#error-msg").removeClass('alert alert-danger').html('');
                            }else{
                                // cant delete it (alert)
                                var err = $("#error-msg").addClass('alert alert-danger');
                                err.html('<strong>Error : </strong> You can\'t Delete it, It\'s already in use ! ');
                            }
                            
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    });
                },
                addNewPMG: function(e){
                    if (this.projectMGroup_new == '' || this.selected1=='')
                    { 
                        alert("It's Rquired");
                    }else{
                        this.projectMGroup_data.push(this.projectMGroup_new);
                        var Data = { 
                            value: this.projectMGroup_new,
                            chapter: this.selected1,
                            process_group: this.selected2,
                            type: 'PMG'
                        };

                        this.projectMGroup_new = '';
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        
                        $.ajax ({
                           type: 'POST',
                           url: '{{ route('chapterManager.add')}}', 
                           data: Data,
                           success: function(res){
                                // do nothing
                                console.log(res);
                                
                           },
                           error: function(res){
                                console.log('Error:', res);    
                           }
                        });
                    }
                },
                remove_PMG: function(item){
                    i = this.projectMGroup_data.indexOf(item);
                    if(i > -1){
                        this.projectMGroup_data.splice(i, 1);
                    }
                    console.log("deleted");
                },
                DeletePMG: function(item){

                    var Data= {
                        value: item,
                        type: 'PMG'
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'DELETE',
                        url: '{{ route('chapterManager.delete')}}', 
                        data: Data,
                        success: function(res){
                            // do nothing
                            console.log(res);
                            if( res != '300'){
                                app.remove_PMG(item);
                                $("#error-msg").removeClass('alert alert-danger').html('');
                            }else{
                                // cant delete it (alert)
                                var err = $("#error-msg").addClass('alert alert-danger');
                                err.html('<strong>Error : </strong> You can\'t Delete it, It\'s already in use ! ');
                            }
                            
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    });
                },
                addNewKarea: function(e){
                    if (this.Karea_new == '')
                    { 
                        alert("It's Rquired")
                    }else{
                        
                        
                        if(this.selected3 == ''){
                            var err = $("#error-msg").addClass('alert alert-danger');
                            err.html('<strong>Error : </strong> Please select a course ! ');
                            
                        }else{
                            this.Karea_data.push(this.Karea_new);
                            var Data = { 
                                value: this.Karea_new,
                                CK: this.checkedCK,
                                course: this.selected3,
                                type: 'knowledge'
                                
                            };
                            this.Karea_new = '';
                            
                            e.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            
                            $.ajax ({
                            type: 'POST',
                            url: '{{ route('chapterManager.add')}}', 
                            data: Data,
                            success: function(res){
                                    // do nothing
                                    if(res != ''){
                                        app.remove_chapter(app.Karea_new);
                                    }else{
                                        app.Karea_new = '';
                                    }
                                    
                            },
                            error: function(res){
                                    console.log('Error:', res);    
                            }
                            });
                        }    
                    }
                },
                remove_chapter: function(item){
                    i = this.Karea_data.indexOf(item);
                    if(i > -1){
                        this.Karea_data.splice(i, 1);
                    }
                    console.log('deleted');
                },
                DeleteKarea: function(item){
                    var Data= {
                        value: item,
                        type: 'knowledge'
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'DELETE',
                        url: '{{ route('chapterManager.delete')}}', 
                        data: Data,
                        success: function(res){
                            // do nothing
                            console.log(res);
                            if( res != '300'){
                                app.remove_chapter(item);
                                $("#error-msg").removeClass('alert alert-danger').html('');
                            }else{
                                // cant delete it (alert)
                                var err = $("#error-msg").addClass('alert alert-danger');
                                err.html('<strong>Error : </strong> You can\'t Delete it, It\'s already in use ! ');
                            }
                            
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    });
                },
            }
        });
    </script>
@endsection