@extends('adminlte::page')

@section('title', 'Cadastro de Planos')

@section('content_header')
<h1>Cadastro de Plano</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('details.plan.store', $plan->url) }}" class="form" method="POST">
            @csrf
            @include('admin.pages.plans.details._partials.form')
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
            
        </form>
        
    </div>
</div>
@endsection



