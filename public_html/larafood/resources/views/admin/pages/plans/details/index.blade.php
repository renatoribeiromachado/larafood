@extends('adminlte::page')

@section('title', "{$plan->name}" )

@section('content_header')
<h1>{{ $title; }} <a href="{{ route('details.plan.create',$plan->url )}}" class="btn btn-primary">ADD</a></h1>
@stop

@section('content')
<div class="card">

    <div class="card-body">
        <table class="table table-bordered">

            <thead class="bg-dark">
                <tr>
                    <th>Detalhe do Plano</th>
                    <th style="width: 50px;">Editar</th>
                    <th style="width: 50px;">Excluir</th>
                </tr>
            </thead>

            <tbody>
                @foreach($details AS $detail)
                <tr>
                    <td>{{ $detail->name;}}</td>
                    <td class="text-center"><a href="" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                    <td class="text-center">
                        <form action="{{ route('details.plan.destroy', [$plan->url, $detail->id,]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endForeach
            </tbody>

        </table>
    </div>

    <div class="card-footer">
        @if(isset($filters))
        {!! $details->appends($filters)->links() !!}
        @else
        {!! $details->links() !!}
        @endif
        
    </div>
</div>
@endsection



