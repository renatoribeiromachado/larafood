@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
<h1>{{ $title; }} <a href="{{ route('permissions.create')}}" class="btn btn-primary">ADD</a></h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p>{{ $permission->name; }}</p>
        <p>{{ $permission->description; }}</p>
    </div>
    
    <div class="card-footer">
        <form action="{{ route('profiles.destroy', $permission->id) }}" method="post">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Deletar {{ $permission->name; }}</button>
        </form>
    </div>
</div>
@endsection



