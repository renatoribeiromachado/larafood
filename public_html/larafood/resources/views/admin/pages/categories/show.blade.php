@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
<h1>{{ $title; }} <a href="{{ route('categories.create')}}" class="btn btn-primary">ADD</a></h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p>{{ $category->name; }}</p>
        <p>{{ $category->description; }}</p>
    </div>
    
    <div class="card-footer">
        <form action="{{ route('categories.destroy', $category->url) }}" method="post">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Deletar {{ $category->name; }}</button>
        </form>
    </div>
</div>
@endsection



