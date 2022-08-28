<?php

use Illuminate\Support\Facades\Route;

Route::get('/journal_call', "JournalCallController@index")->name("journal_call.list");
Route::get('/journal_call/create', "JournalCallController@create")->name("journal_call.create_view");
Route::post('/journal_call/save', "JournalCallController@save")->name("journal_call.create");

Route::get('/journal_call/all_time_call_user', "JournalCallController@all_time_call_user_view")->name("journal_call.all_time_user_stats");


Route::get('/users_list', "UsersController@index")->name("users.list");
Route::get('/users/create_view', "UsersController@create")->name("users.create_view");
Route::post('/users_create', "UsersController@save")->name("users.create");
Route::post('/users/save_phone', "UsersController@edit_phone")->name("users.edit_phone");


Route::get('/operators_list', "OperatorsController@index")->name("operators.list");
Route::get('/operators/create_view', "OperatorsController@create")->name("operators.create_view");
Route::post('/operators/create', "OperatorsController@save")->name("operators.create");


Route::get('/operator/{operator}/price', "OperatorsPriceController@index")->name("operators.price.list");
Route::post('/operator/save_price', "OperatorsPriceController@save")->name("operators.price.create");


Route::get('/operator/{operator}/phone_number', "OperatorsPhoneNumberController@index")->name("operators.phone_number.list");
Route::get('/operator/{operator}/phone_number/create_view', "OperatorsPhoneNumberController@create")->name("operators.phone_number.create_view");
Route::post('/operator/phone_number/create', "OperatorsPhoneNumberController@save")->name("operators.phone_number.create");



Route::get("/{page}", "IndexController")->where( 'page','.*');



