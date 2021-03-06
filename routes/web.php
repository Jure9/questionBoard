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

Route::get('/', 'QuestionsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('questions', 'QuestionsController')->except('show');

Route::get('questions/{question}/answers', 'AnswersController@index');

Route::post('questions/{question}/answers', 'AnswersController@store');

Route::get('questions/{question}/answers/{answer}/edit', 'AnswersController@edit')->name('questions.answers.edit');

Route::patch('questions/{question}/answers/{answer}', 'AnswersController@update');

Route::delete('questions/{question}/answers/{answer}', 'AnswersController@destroy')->name('questions.answers.destroy');

Route::get('questions/{slug}', 'QuestionsController@show')->name('questions.show');

Route::post('/answers/{answer}/accept', 'AcceptAnswerController');

Route::post('questions/{question}/favourites', 'FavouritesController@store')->name('questions.favourite');

Route::delete('questions/{question}/favourites', 'FavouritesController@destroy')->name('questions.unfavourite');

Route::post('questions/{question}/vote', 'VoteQuestionController');

Route::post('answers/{answer}/vote', 'VoteAnswerController');