@extends('adminlte::page')

@section('title', "Detalhes da Permissão {$permission->name}")

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Detalhes da Permissão</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Permissões</a></li>
                <li class="breadcrumb-item active">Detalhes da Permissão</li>
                <li class="breadcrumb-item active">{{ $permission->name }}</li>
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
                    <h3 class="text-primary">{{ $permission->name }}</h3>
                    <div class="text-muted">
                        <p class="text-sm">Descrição
                            <b class="d-block">{{ $permission->description }}</b>
                        </p>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('profiles.destroy', $permission->id) }}" method="POST">
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
