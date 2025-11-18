<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditalController;
use App\Http\Controllers\AgenteController;

Route::middleware('web')->group(function (){ 
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', function () {
        return view('login'); // login.blade.php
    });

    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // Route::get('/dashboard', function (){
    //     return 'Logado!';
    // })->middleware('auth');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

    // Rotas dos Editais (protegidas por autenticação)
    Route::middleware('auth')->group(function () {
        Route::resource('editais', EditalController::class);
        Route::resource('agentes', AgenteController::class)->middleware('auth');
    });

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});