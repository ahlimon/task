<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',function(){
  return view('index');
});
Route::name('crud.')->group( function(){
  Route::resource('/categories','CategoryController', ['only' => ['index','edit','update','destroy','store']]);
});
