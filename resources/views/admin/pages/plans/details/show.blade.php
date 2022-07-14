@extends('adminlte::page')

@section('title', "Detalhe {$detail->name} do Plano")

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Detalhe do Plano</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('details.index', $plan->url) }}">Detalhes do Plano</a></li>
                <li class="breadcrumb-item active">{{ $detail->name }}</li>
            </ol>
        </div>
    </div>
@stop


@section('content')
    @include('admin.includes.alerts')
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h3 class="text-primary">{{ $detail->name }}</h3>
                </div>
                <div class="card-footer">
                    <form action="{{ route('details.destroy', [$plan->url, $detail->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash">
                            </i>
                            Deletar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
