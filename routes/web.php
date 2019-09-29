<?php
use Illuminate\Support\Facades\Redis;
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

Route::get('/1', function () {
    return view('welcome');
});
Route::get('/2', function () {
    return view('welcome2');
});

Route::get('publish', function () {
    // 路由邏輯...

    Redis::publish('test-channel', json_encode(['foo' => 'bar']));
});

//web.php
Route::get('/post/{id}', 'PostController@index');