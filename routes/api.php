<?php


use Illuminate\Support\Facades\Route;
use Module\Card\Handlers\{CreateCardHandler, DeleteCardHandler, UpdateCardHandler};
use Module\User\Handlers\{LoginHandler,CreateUserHandler};

Route::group(['excluded_middleware' => 'auth:sanctum'], function (){
    Route::post('/login', LoginHandler::class);
});

Route::group(['prefix' => 'users'], function (){
    Route::post('/', CreateUserHandler::class);
});

Route::group(['prefix' => 'cards'], function (){
    Route::post('/', CreateCardHandler::class);
    Route::put('/{id}', UpdateCardHandler::class);
    Route::delete('/{id}', DeleteCardHandler::class);
});
