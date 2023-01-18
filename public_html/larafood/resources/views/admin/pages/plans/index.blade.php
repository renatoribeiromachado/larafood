@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
<h1>{{ $title; }} <a href="{{ route('plans.create')}}" class="btn btn-primary">ADD</a></h1>
@stop

@section('content')
<div class="card">
    
    <div class="card-header">
        <form action="{{ route('plans.search') }}" class='form form-inline' method="POST">
            @csrf
            <input type="text" name="filter" class="form-control" value="{{ $filters['filter'] ?? '' }}" placeholder="Pesquisa..." required="">
            <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i></button>
        </form>
    </div>
    
    <div class="card-body">
        <table class="table table-bordered">

            <thead class="bg-dark">
                <tr>
                    <th>Plano</th>
                    <th>Valor</th>
                    <th style="width: 50px;">Ver</th>
                    <th style="width: 70px;">Detalhes</th>
                    <th style="width: 50px;">Atualizar</th>
                    <th style="width: 50px;">Perfil</th>
                </tr>
            </thead>

            <tbody>
                @foreach($plans AS $plan)
                <tr>
                    <td>{{ $plan->name;}}</td>
                    <td>{{ $plan->price; }}</td>
                    <td class="text-center"><a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning"><i class="fa fa-arrow-down"></i></a></td>
                    <td class="text-center"><a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-info"><i class="fa fa-arrow-up"></i></a></td>
                    <td class="text-center"><a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                    <td class="text-center"><a href="{{ route('plans.profiles', $plan->id) }}" class="btn btn-warning"><i class="fas fa-address-book"></i></a></td>
                </tr>
                @endForeach
            </tbody>

        </table>
    </div>

    <div class="card-footer">
        @if(isset($filters))
        {!! $plans->appends($filters)->links() !!}
        @else
        {!! $plans->links() !!}
        @endif
        
    </div>
</div>
@endsection



