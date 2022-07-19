@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if(session('message'))
{{--    https://getbootstrap.com/docs/4.3/components/toasts/--}}
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if(session('warning'))
    {{--    https://getbootstrap.com/docs/4.3/components/toasts/--}}
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

@if(session('error'))
    {{--    https://getbootstrap.com/docs/4.3/components/toasts/--}}
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
