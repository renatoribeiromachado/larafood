@extends('adminlte::page')

@section('title', 'Cadastro de categorias')

@section('content_header')
<h1>Cadastro de Categoria(s)</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('categories.store') }}" class="form" method="POST">
            @csrf
            @include('admin.pages.categories._partials.form')
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
            
        </form>
        
    </div>
</div>
@endsection



