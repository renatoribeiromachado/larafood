@extends('adminlte::page')

@section('title', 'Atualizando Plano')

@section('content_header')
<h1>{{ $title }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('plans.update', $plan->url) }}" class="form" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.plans._partials.form')
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">Atualizar</button>
            </div>
            
        </form>
        
    </div>
</div>
@endsection



