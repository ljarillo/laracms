@extends('adminlte::page')

@section('title', "Permissões disponíveis Perfil {$profile->name}")

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Permissões disponíveis Perfil <strong>{{$profile->name}}</strong></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profiles.permissions', $profile->id) }}">Permissões do Perfil {{ $profile->name }}</a></li>
                <li class="breadcrumb-item active">Permissões disponíveis Perfil</li>
                <li class="breadcrumb-item active">{{ $profile->name }}</li>
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
                            @if(!empty($filters))
                                <div class="alert alert-light" role="alert">
                                    A busca por <strong>{{ $filters['filter'] }}</strong> encontrou <strong>{{ $permissions->count() }}</strong> resultado{{ $permissions->count() == 1 ? '' : 's' }}. <a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-default"><i class="fa fa-ban"></i></a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('profiles.permissions.available', $profile->id) }}" method="POST" class="form form-inline float-right">
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
                            <th class="text-center" style="width: 10%">#</th>
                            <th>Nome</th>
                        </tr>
                        </thead>
                        <tbody>
                        <form action="{{ route('profiles.permissions.attach', $profile->id) }}" id="myForm" method="POST">
                            @csrf
                            @foreach($permissions as $permission)
                                <tr>
                                    <td class="project-actions text-center">
                                        <input type="checkbox" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                                    </td>
                                    <td><label for="permission-{{ $permission->id }}">{{ $permission->name }}</label></td>
                                </tr>
                            @endforeach
                        </form>
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
    <div class="row">
        <div class="col-12">
            <a href="{{ route('profiles.permissions', $profile->id) }}" class="btn btn-secondary"><i class="fa fa-times"></i> Fechar</a>
            <button type="button" class="btn btn-success float-right" onclick="document.getElementById('myForm').submit()">
                <i class="fa fa-save"></i> Gravar
            </button>
        </div>
    </div>
@stop
