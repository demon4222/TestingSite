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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth', 'namespace' => 'Admin'],function (){
    Route::resource('tests', 'TestController');
    Route::resource('questions', 'QuestionController', [
        'except' => ['create', 'store']
    ]);
    Route::resource('answers','AnswerController',[
       'except' => ['store']
    ]);
    Route::get('/questions/create/{test}', 'QuestionController@create');
    Route::post('/questions/store/{test}','QuestionController@store');

    Route::post('/answers/store/{question}', 'AnswerController@store');

});
