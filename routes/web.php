<?php

// Home
Route::get('/', 'HomeController')->name('home');

// Language
Route::get('language/{lang}', 'LanguageController')
    ->where('lang', implode('|', config('app.languages')));

// Admin
Route::get('admin', 'AdminController')->name('admin');

// Medias
Route::get('medias', 'FilemanagerController')->name('medias');



// Comment
Route::resource('comment', 'CommentController', [
    'except' => ['create', 'show', 'update']
]);
Route::put('comment/{comment}', 'CommentAjaxController@update')->name('comment.update');
Route::put('commentseen/{id}', 'CommentAjaxController@updateSeen');

// Contact
Route::resource('contact', 'ContactController', ['except' => ['show', 'edit']]);

// Roles
Route::get('roles', 'RoleController@edit');
Route::post('roles', 'RoleController@update');

// Users
Route::get('user/sort/{role?}', 'UserController@index');
Route::resource('user', 'UserController', ['except' => 'index']);
Route::put('uservalid/{id}', 'UserAjaxController@valid');
Route::put('userseen/{user}', 'UserAjaxController@updateSeen');

// Authentication 
Auth::routes();

// Email confirmation 
Route::get('resend', 'Auth\RegisterController@resend');
Route::get('confirm/{token}', 'Auth\RegisterController@confirm');

// Notifications
Route::get('notifications/{user}', 'NotificationController@index');
Route::put('notifications/{notification}', 'NotificationController@update');



Route::resource('admin/nodes', 'Admin\\NodesController');

