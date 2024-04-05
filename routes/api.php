<?php


use Illuminate\Support\Facades\Route;
use Module\User\Handlers\Auth\LoginHandler;

Route::group(['excluded_middleware' => 'auth:sanctum'], function (){
    Route::post('/login', LoginHandler::class);
});
