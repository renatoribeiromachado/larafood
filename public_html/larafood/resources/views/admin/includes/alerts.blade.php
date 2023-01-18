@if($errors->any())
    @foreach($errors->all() AS $error)
        <div class='alert alert-danger'>
            <p>{{ $error }}</p>
        </div>
    @endforeach
@endif

@if(session('message'))
    <div class='alert alert-success'>
        <p>{{ session('message') }}</p>
    </div>
@endif

@if(session('error'))
    <div class='alert alert-danger'>
        <p>{{ session('error') }}</p>
    </div>
@endif

@if(session('info'))
    <div class='alert alert-warning'>
        <p>{{ session('info') }}</p>
    </div>
@endif

