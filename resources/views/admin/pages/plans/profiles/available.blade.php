@extends('adminlte::page')

@section('title', "Perfis disponíveis para o Plano {$plan->name}")

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Perfis disponíveis para o Plano <strong>{{$plan->name}}</strong></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('plans.profiles', $plan->id) }}">Perfis do Plano {{ $plan->name }}</a></li>
                <li class="breadcrumb-item active">Perfis disponíveis para o Plano</li>
                <li class="breadcrumb-item active">{{ $plan->name }}</li>
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
                                    A busca por <strong>{{ $filters['filter'] }}</strong> encontrou <strong>{{ $profiles->count() }}</strong> resultado{{ $profiles->count() == 1 ? '' : 's' }}. <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-default"><i class="fa fa-ban"></i></a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('plans.profiles.available', $plan->id) }}" method="POST" class="form form-inline float-right">
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
                        <form action="{{ route('plans.profiles.attach', $plan->id) }}" id="myForm" method="POST">
                            @csrf
                            @foreach($profiles as $profile)
                                <tr>
                                    <td class="project-actions text-center">
                                        <input type="checkbox" id="profile-{{ $profile->id }}" name="profiles[]" value="{{ $profile->id }}">
                                    </td>
                                    <td><label for="profile-{{ $profile->id }}">{{ $profile->name }}</label></td>
                                </tr>
                            @endforeach
                        </form>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                @if(isset($filters))
                                    {!! $profiles->appends($filters)->links() !!}
                                @else()
                                    {!! $profiles->links() !!}
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
            <a href="{{ route('plans.profiles', $plan->id) }}" class="btn btn-secondary"><i class="fa fa-times"></i> Fechar</a>
            <button type="button" class="btn btn-success float-right" onclick="document.getElementById('myForm').submit()">
                <i class="fa fa-save"></i> Gravar
            </button>
        </div>
    </div>
@stop
