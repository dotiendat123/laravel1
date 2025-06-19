<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/home', function () {
//     return view('home');
// });
// Route::get('/home', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/sendmail', function () {
    try {
        Mail::raw('Đây là mail test gửi từ Laravel x Mailtrap ', function ($message) {
            $message->to('example@gmail.com')
                ->subject(' Laravel Mailtrap Test');
        });

        return 'Gửi mail thành công!';
    } catch (\Exception $e) {
        return 'Gửi mail thất bại: ' . $e->getMessage();
    }
});
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
