@extends('adminlte::page')

@section('title', 'Permissões disponivel para o perfil')

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
        
         <form action="{{ route('profiles.permissions.attach', $profile->id)}}" method="POST">
            <table class="table table-bordered">

                <thead class="bg-dark">
                    <tr>
                        <th style='width: 50px;'>#</th>
                        <th>Nome</th>
                    </tr>
                </thead>

                <tbody>

                    @csrf
                    @foreach($permissions AS $permission)
                    <tr>
                        <td><input type="checkbox" name="permissions[]" value="{{ $permission->id;}}"></td>
                        <td>{{ $permission->name;}}</td>
                    </tr>
                    @endForeach
                    <tr>
                        @include('admin.includes.alerts')
                        <td colspan="2"><button type="submit" class="btn btn-success">Vincular</button></td>
                    </tr>

                </tbody>

            </table>
        </form>
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