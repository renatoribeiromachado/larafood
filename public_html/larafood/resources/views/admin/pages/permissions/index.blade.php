@extends('adminlte::page')

@section('title', 'Permissão')

@section('content_header')
<h1>{{ $title; }} <a href="{{ route('permissions.create')}}" class="btn btn-primary">ADD</a></h1>
@stop

@section('content')
<div class="card">
    
    <div class="card-header">
        <form action="{{ route('permissions.search') }}" class='form form-inline' method="POST">
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
                    <th>Descrição</th>
                    <th style="width: 70px;">Detalhes</th>
                    <th style="width: 50px;">Atualizar</th>
                </tr>
            </thead>

            <tbody>
                @foreach($permissions AS $permission)
                <tr>
                    <td>{{ $permission->name;}}</td>
                    <td>{{ $permission->description; }}</td>
                    <td class="text-center"><a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning"><i class="fa fa-arrow-down"></i></a></td>
                    <td class="text-center"><a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
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



