<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->namespace('Admin')
//    ->middleware('auth')
    ->group(function (){

        /**
         * Routes Permissions
         */
        Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
        Route::resource('permissions', 'ACL\PermissionController');

        /**
         *  Rotas de Profiles
         */
        Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
        Route::resource('profiles', 'ACL\ProfileController');

        /**
         *  Rotas de Detalhes do Plano
         */
        Route::resource('plans/{url}/details', 'DetailPlanController');

        /**
         *  Rotas de Planos
         */
        Route::any('plans/search', 'PlanController@search')->name('plans.search');
        Route::resource('plans', 'PlanController');

        /**
         * Home Dashborad
         */
        Route::get('/', 'DashboardController@home')->name('admin.index');
    });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
