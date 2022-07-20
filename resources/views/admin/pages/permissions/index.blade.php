@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Permissões <a href="{{ route('profiles.create') }}" class="btn btn-primary"><i class="fas fa-plus-square"></i></a></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Permissões</li>
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
                                    A busca por <strong>{{ $filters['filter'] }}</strong> encontrou <strong>{{ $permissions->count() }}</strong> resultado{{ $permissions->count() == 1 ? '' : 's' }}. <a href="{{ route('profiles.index') }}" class="btn btn-default"><i class="fa fa-ban"></i></a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('profiles.search') }}" method="POST" class="form form-inline float-right">
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
                            <th style="width: 20%">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-default btn-sm" href="{{ route('profiles.profiles', $permission->id) }}">
                                        <i class="fas fa-address-book">
                                        </i>
                                    </a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('profiles.show', $permission->id) }}">
                                        <i class="fas fa-eye">
                                        </i>
                                        Ver
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('profiles.edit', $permission->id) }}">
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
                                    {!! $permissions->appends($filters)->links() !!}
                                @else()
                                    {!! $permissions->links() !!}
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
