<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AdviceController;
use App\Http\Controllers\AusbildungController;

/*
|--------------------------------------------------------------------------
| Page d'accueil — accessible à tous
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pages.home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Auth — Login / Register / Logout
|--------------------------------------------------------------------------
*/
Route::get('/login',    [AuthController::class, 'login'])->name('login');
Route::post('/login',   [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class, 'registerPost'])->name('register.post');

Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard & CV — protégé par auth
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [CVController::class, 'index'])->name('dashboard');

    // CV CRUD
    Route::get('/cv/create',        [CVController::class, 'create'])->name('cv.create');
    Route::post('/cv/store',        [CVController::class, 'store'])->name('cv.store');
    Route::get('/cv/edit/{id}',     [CVController::class, 'edit'])->name('cv.edit');
    Route::post('/cv/update/{id}',  [CVController::class, 'update'])->name('cv.update');
    Route::delete('/cv/delete/{id}',[CVController::class, 'destroy'])->name('cv.delete');
    Route::get('/cv/download/{id}', [CVController::class, 'downloadPDF'])->name('cv.download');

    // Chatbot
    Route::get('/chatbot',      [ChatbotController::class, 'logs'])->name('chatbot.logs');
    Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');
});

/*
|--------------------------------------------------------------------------
| Pages publiques
|--------------------------------------------------------------------------
*/
Route::get('/advices',   [AdviceController::class,   'index'])->name('advices.index');
Route::get('/ausbildung',[AusbildungController::class,'index'])->name('ausbildung.index');