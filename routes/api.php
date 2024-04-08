<?php

use Illuminate\Support\Facades\Route;
use Module\Card\Handlers\{card\CreateCardHandler, card\DeleteCardHandler, card\GetCardsHandler, card\UpdateCardHandler};
use Module\Card\Handlers\expense\CreateExpenseHandler;
use Module\User\Handlers\{CreateUserHandler, DeleteUserHandler, LoginHandler, UpdateUserHandler};

Route::group(['excluded_middleware' => 'auth:sanctum'], function (){
    Route::post('/login', LoginHandler::class);
});

Route::group(['prefix' => 'users'], function (){
    Route::post('/', CreateUserHandler::class);
    Route::put('/{id}', UpdateUserHandler::class);
    Route::delete('/{id}', DeleteUserHandler::class);
});

Route::group(['prefix' => 'cards'], function (){
    Route::get('/', GetCardsHandler::class);
    Route::post('/', CreateCardHandler::class);
    Route::put('/{id}', UpdateCardHandler::class);
    Route::delete('/{id}', DeleteCardHandler::class);
});

Route::group(['prefix' => 'expenses'], function (){
    Route::post('/', CreateExpenseHandler::class);
});
