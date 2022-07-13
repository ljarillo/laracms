<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->namespace('Admin')
//    ->middleware('auth')
    ->group(function (){

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
