@if(count($errors) > 0)
    @foreach($errors->all() as $errors)
        <div class="alert alert-danger container-fluid" style="max-width: 300px; max-height: 50px; margin: 0 auto;">
            {{$errors}}
        </div>
        @break
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success container-fluid" style="max-width: 300px; max-height: 50px; margin: 0 auto;">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger container-fluid" style="max-width: 300px; max-height: 50px; margin: 0 auto;">
        {{session('error')}}
    </div>
@endif

