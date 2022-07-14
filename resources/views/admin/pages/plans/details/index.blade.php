@extends('adminlte::page')

@section('title', "Detalhes do Plano {$plan->name}")

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Detalhes do Plano <a href="{{ route('details.create', $plan->url) }}" class="btn btn-primary"><i class="fas fa-plus-square"></i></a></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
                <li class="breadcrumb-item active">Detalhes do Plano</li>
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
                </div>
                <div class="card-body">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th style="width: 20%">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $detail)
                            <tr>
                                <td>{{ $detail->name }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('details.show', [$plan->url, $detail->id]) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        Ver
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('details.edit', [$plan->url, $detail->id]) }}">
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
                                    {!! $details->appends($filters)->links() !!}
                                @else()
                                    {!! $details->links() !!}
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
