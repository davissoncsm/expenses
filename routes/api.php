<?php

use Illuminate\Support\Facades\Route;
use Module\Card\Handlers\{card\CreateCardHandler, card\DeleteCardHandler, card\GetCardsHandler, card\UpdateCardHandler};
use Module\Card\Handlers\expense\CreateExpenseHandler;
use Module\User\Handlers\{CreateUserHandler, DeleteUserHandler, LoginHandler, UpdateUserHandler};

Route::group(['excluded_middleware' => 'auth:sanctum'], function (){
    Route::post('/login', LoginHandler::class)->name('login');
});

Route::group(['prefix' => 'users'], function (){
    Route::post('/', CreateUserHandler::class)->name('users.store');
    Route::put('/{id}', UpdateUserHandler::class)->name('users.update');
    Route::delete('/{id}', DeleteUserHandler::class)->name('users.delete');
});

Route::group(['prefix' => 'cards'], function (){
    Route::get('/', GetCardsHandler::class)->name('cards.index');
    Route::post('/', CreateCardHandler::class)->name('cards.store');
    Route::put('/{id}', UpdateCardHandler::class)->name('cards.update');
    Route::delete('/{id}', DeleteCardHandler::class)->name('cards.delete');
});

Route::group(['prefix' => 'expenses'], function (){
    Route::post('/', CreateExpenseHandler::class)->name('expenses.store');
});
