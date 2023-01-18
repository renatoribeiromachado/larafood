@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
<h1>{{ $title; }} <a href="{{ route('plans.create')}}" class="btn btn-primary">ADD</a></h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p>{{ $profile->name; }}</p>
        <p>{{ $profile->description; }}</p>
    </div>
    
    <div class="card-footer">
        <form action="{{ route('profiles.destroy', $profile->id) }}" method="post">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Deletar {{ $profile->name; }}</button>
        </form>
    </div>
</div>
@endsection



