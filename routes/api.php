<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\postsController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use \App\Http\Controllers\Api\userController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiresource('posts', PostsController::class);


##########  token routes ####################

Route::post('/sanctum/token', [userController::class, 'login']);


//This guard will ensure that incoming requests are authenticated
//as either stateful, cookie authenticated requests or contain
//a valid API token header if the request is from a third party.

use Illuminate\Support\Facades\Auth;

Route::post('/sanctum/logout/thisDevice',
    [userController::class, 'logoutFromOneDevice'])
    ->middleware('auth:sanctum');


Route::post('/sanctum/logout/allDevices',
    [userController::class, 'logoutFromAllDevices'])
    ->middleware('auth:sanctum');




// used for testing
Route::post('/hooome', function (){
    return response()->json(["message"=>"welcome hhooooome",
        "user",Auth::user()]);
})
    ->middleware('auth:sanctum');
