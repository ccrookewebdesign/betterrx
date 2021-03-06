<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'ImageUploadController@index')->name('image-uploader');

Route::get('/uploaded-images', 'ImageUploadController@getUploadedImages')->name('get-uploaded-images');

Route::post('/upload-image', 'ImageUploadController@upload')->name('upload-image');
