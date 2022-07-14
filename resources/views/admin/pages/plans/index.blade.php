@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Planos <a href="{{ route('plans.create') }}" class="btn btn-primary"><i class="fas fa-plus-square"></i></a></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Planos</li>
            </ol>
        </div>
    </div>
@stop


@section('content')
    @include('admin.includes.alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            @if(isset($filters))
                                <div class="alert alert-light" role="alert">
                                    A busca por <strong>{{ $filters['filter'] }}</strong> encontrou <strong>{{ $plans->count() }}</strong> resultado{{ $plans->count() == 1 ? '' : 's' }}. <a href="{{ route('plans.index') }}" class="btn btn-default"><i class="fa fa-ban"></i></a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline float-right">
                                @csrf
                                <div class="input-group">
                                    <input type="search" class="form-control" name="filter" value="{{ $filters['filter'] ?? '' }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th style="width: 20%">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plans as $plan)
                            <tr>
                                <td>{{ $plan->name }}</td>
                                <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-default btn-sm" href="{{ route('details.index', $plan->url) }}">
                                        <i class="fa fa-book">
                                        </i>
                                        Detalhes
                                    </a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('plans.show', $plan->url) }}">
                                        <i class="fas fa-eye">
                                        </i>
                                        Ver
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('plans.edit', $plan->url) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                @if(isset($filters))
                                    {!! $plans->appends($filters)->links() !!}
                                @else()
                                    {!! $plans->links() !!}
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
