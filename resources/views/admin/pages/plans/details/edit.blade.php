@extends('adminlte::page')

@section('title', "Editar o Detalhe {$detail->name}")

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Editar o Detalhe do Plano</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('details.index', $plan->url) }}">Detalhes do Plano</a></li>
                <li class="breadcrumb-item active">Editar {{ $detail->name }}</li>
            </ol>
        </div>
    </div>
@stop


@section('content')
    @include('admin.includes.alerts')
    <form action="{{ route('details.update', [$plan->url, $detail->id]) }}" class="form" method="POST">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informações Gerais</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')

                        @include('admin.pages.plans.details._partials.form')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('details.index', $plan->url) }}" class="btn btn-secondary"><i class="fa fa-times"></i> Fechar</a>
                <button type="submit" class="btn btn-success float-right">
                    <i class="fa fa-save"></i> Gravar
                </button>
            </div>
        </div>
    </form>
@stop

