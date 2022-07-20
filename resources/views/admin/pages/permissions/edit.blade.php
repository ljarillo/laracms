@extends('adminlte::page')

@section('title', "Editar a Permissão {$permission->name}")

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Editar a Permissão</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Permissões</a></li>
                <li class="breadcrumb-item active">Editar a Permissão</li>
                <li class="breadcrumb-item active">{{ $permission->name }}</li>
            </ol>
        </div>
    </div>
@stop


@section('content')
    @include('admin.includes.alerts')
    <form action="{{ route('profiles.update', $permission->id) }}" class="form" method="POST">
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

                        @include('admin.pages.permissions._partials.form')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('profiles.index') }}" class="btn btn-secondary"><i class="fa fa-times"></i> Fechar</a>
                <button type="submit" class="btn btn-success float-right">
                    <i class="fa fa-save"></i> Gravar
                </button>
            </div>
        </div>
    </form>
@stop

