<?php

use App\Http\Controllers\UploadVideoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VoteController;

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
Route::resource('channels', 'ChannelController');

Route::get('videos/{video}/comments', 'CommentController@index');
Route::get('videos/{video}', 'VideoController@show');
Route::put('videos/{video}', 'VideoController@updateViews');
Route::put('videos/{video}/update', 'VideoController@update')->middleware(['auth'])->name('videos.update');

Route::middleware(['auth'])->group(function () {
    Route::post('votes/{video}/{type}', [VoteController::class, 'vote']);

    Route::post('channels/{channel}/videos', [UploadVideoController::class, 'store']);
    Route::get('channels/{channel}/videos', [UploadVideoController::class, 'index'])->name('channel.upload');
    Route::resource('channels/{channel}/subscriptions', 'SubscriptionController')->only(['store', 'destroy'])->middleware(['auth']);
});
