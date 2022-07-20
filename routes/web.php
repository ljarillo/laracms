<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->namespace('Admin')
//    ->middleware('auth')
    ->group(function (){

        /**
         * Plans x Profile
         */
        Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilesPlan')
            ->name('plans.profiles.detach');
        Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')
            ->name('plans.profiles.attach');
        Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')
            ->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')
            ->name('plans.profiles');
        Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')
            ->name('profiles.plans');

        /**
         * Profiles x Permissions
         */
        Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionsProfile')
            ->name('profiles.profiles.detach');
        Route::post('profiles/{id}/profiles', 'ACL\PermissionProfileController@attachPermissionsProfile')
            ->name('profiles.profiles.attach');
        Route::any('profiles/{id}/profiles/create', 'ACL\PermissionProfileController@permissionsAvailable')
            ->name('profiles.profiles.available');
        Route::get('profiles/{id}/profiles', 'ACL\PermissionProfileController@profiles')
            ->name('profiles.profiles');
        Route::get('profiles/{id}/profile', 'ACL\PermissionProfileController@profiles')
            ->name('profiles.profiles');

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
