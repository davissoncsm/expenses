<?php


use Illuminate\Support\Facades\Route;
use Module\User\Handlers\Auth\LoginHandler;
use Module\Card\Handlers\{CreateCardHandler, UpdateCardHandler};

Route::group(['excluded_middleware' => 'auth:sanctum'], function (){
    Route::post('/login', LoginHandler::class);
});


Route::group(['prefix' => 'cards'], function (){
    Route::post('/', CreateCardHandler::class);
    Route::put('/{id}', UpdateCardHandler::class);
});
