@extends('adminlte::page')

@section('title', "Perfis do Plano {$plan->name}")

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Perfis do Plano <strong>{{$plan->name}}</strong> <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-primary"><i class="fas fa-plus-square"></i></a></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
                <li class="breadcrumb-item active">Perfis do Plano</li>
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
                            <th style="width: 20%">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($profiles as $profile)
                            <tr>
                                <td>{{ $profile->name }}</td>
                                <td class="project-actions text-right">
                                    <a href="{{ route('plans.profiles.detach', [$plan->id, $profile->id]) }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i>
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
@stop
