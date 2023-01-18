@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
<h1>{{ $title; }} <a href="{{ route('plans.create')}}" class="btn btn-primary">ADD</a></h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p>{{ $plan->name; }}</p>
        <p>{{ $plan->price; }}</p>
        <p>{{ $plan->description; }}</p>
    </div>
    
    <div class="card-footer">
        <form action="{{ route('plans.destroy', $plan->url) }}" method="post">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Deletar {{ $plan->name; }}</button>
        </form>
    </div>
</div>
@endsection



