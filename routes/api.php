<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['api']], function (){

  Route::post('auth/login', 'api\AuthController@login');

  //authentication user
  Route::group(['middleware' => ['jwt.auth']], function (){
    //get user profile
    Route::get('/profile', 'api\UsersController@show');
  });
});
