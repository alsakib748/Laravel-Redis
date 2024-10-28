<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\BlogController;

Route::get('/', function () {

    dispatch(new \App\Jobs\SendEmailJob());

    return view('welcome');

});

Route::controller(BlogController::class)->group(function(){

    Route::get('/blogs','blogs')->name('blogs');
    Route::get('/blogs/edit/{id}','blogsEdit')->name('blogs.edit');
    Route::post('/blogs/update','blogsUpdate')->name('blogs.update');
    Route::get('/blogs/delete/{id}','blogsDelete')->name('blogs.delete');

});


Route::get('/test-redis', function () {
    try {
        Redis::set('test_key', 'test_value');
        $value = Redis::get('test_key');
        return $value;
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});
