@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
<h1>{{ $title; }} <a href="{{ route('categories.create')}}" class="btn btn-primary">ADD</a></h1>
@stop

@section('content')
<div class="card">
    
    <div class="card-header">
        <form action="{{ route('categories.search') }}" class='form form-inline' method="POST">
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
                    <th style="width: 50px;">Ver</th>
                    <th style="width: 50px;">Atualizar</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories AS $category)
                <tr>
                    <td>{{ $category->name;}}</td>
                    <td>{{ $category->description; }}</td>
                    <td class="text-center"><a href="{{ route('categories.show', $category->url) }}" class="btn btn-warning"><i class="fa fa-arrow-down"></i></a></td>
                    <td class="text-center"><a href="{{ route('categories.edit', $category->url) }}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                </tr>
                @endForeach
            </tbody>

        </table>
    </div>

    <div class="card-footer">
        @if(isset($filters))
        {!! $categories->appends($filters)->links() !!}
        @else
        {!! $categories->links() !!}
        @endif
        
    </div>
</div>
@endsection



