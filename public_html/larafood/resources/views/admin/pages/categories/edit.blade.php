@extends('adminlte::page')

@section('title', 'Atualizando categoria')

@section('content_header')
<h1>{{ $title }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('categories.update', $category->url) }}" class="form" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.categories._partials.form')
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">Atualizar</button>
            </div>
            
        </form>
        
    </div>
</div>
@endsection



