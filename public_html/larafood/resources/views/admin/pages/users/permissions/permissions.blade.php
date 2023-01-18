@extends('adminlte::page')

@section('title', 'Permissões do perfil')

@section('content_header')
<h1>{{ $title; }} <a href="{{ route('profiles.permissions.available', $profile->id)}}" class="btn btn-primary">ADD NOVA PERMISSÃO</a></h1>
@stop

@section('content')
<div class="card">
    
    <div class="card-header">
        <form action="{{ route('profiles.search') }}" class='form form-inline' method="POST">
            @csrf
            <input type="text" name="filter" class="form-control" value="{{ $filters['filter'] ?? '' }}" placeholder="Pesquisa..." required="">
            <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i></button>
        </form>
    </div>
    
    <div class="card-body">
        <table class="table table-bordered">

            <thead class="bg-dark">
                <tr>
                    <th>Nome</th>
                    <th style="width: 50px;">Desvincular</th>
                </tr>
            </thead>

            <tbody>
                @foreach($permissions AS $permission)
                <tr>
                    <td>{{ $permission->name;}}</td>
                    <td class="text-center"><a href="{{ route('profiles.permissions.detach', [$profile->id, $permission->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
                @endForeach
            </tbody>

        </table>
    </div>

    <div class="card-footer">
        @if(isset($filters))
        {!! $permissions->appends($filters)->links() !!}
        @else
        {!! $permissions->links() !!}
        @endif
        
    </div>
</div>
@endsection



