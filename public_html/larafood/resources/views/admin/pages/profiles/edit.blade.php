@extends('adminlte::page')

@section('title', 'Atualizando perfil')

@section('content_header')
<h1>{{ $title }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('profiles.update', $profile->id) }}" class="form" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.profiles._partials.form')
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">Atualizar</button>
            </div>
            
        </form>
        
    </div>
</div>
@endsection



