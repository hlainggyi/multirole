<?php
use Illuminate\Support\Facades\Route;
// use \App\Http\Controllers\Auth;

Route::group(['prefix' => 'roles'], function () {
  Route::post('/store', [
    'uses' => '\App\Http\Controllers\Auth\RoleCtrl@store',
    'as' => 'roles.store'
  ]);
  Route::put('/{role}/update', [
    'uses' => '\App\Http\Controllers\Auth\RoleCtrl@update',
    'as' => 'roles.update'
  ]);
  Route::post('/assign', [
    'uses'=>'\App\Http\Controllers\Auth\RoleCtrl@UserAssignRoles',
    'as'=>'assign'
  ]);
});
