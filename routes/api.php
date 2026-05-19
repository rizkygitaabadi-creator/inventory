<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource(
        'categories',
        'App\Http\Controllers\CategoryController'
    );
    Route::apiResource(
        'items',
        'App\Http\Controllers\ItemController'
    );
});

Route::get('test', function () {
    return response()->json(['message' => 'OK']);
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('items', ItemController::class);

Route::post(
    'register',
    'App\Http\Controllers\AuthController@register'
);
Route::post(
    'login',
    'App\Http\Controllers\AuthController@login'
);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource(
        'categories',
        'App\Http\Controllers\CategoryController'
    )
        ->except(['destroy']);
    Route::delete(
        'categories/{category}',
        'App\Http\Controllers\CategoryController@destroy'
    )
        ->middleware('role:admin');
    Route::apiResource(
        'items',
        'App\Http\Controllers\ItemController'
    )
        ->except(['destroy']);
    Route::delete(
        'items/{item}',
        'App\Http\Controllers\ItemController@destroy'
    )
        ->middleware('role:admin');
});
