<?php

use App\Http\Controllers\{DashboardController, ProfileController, QuestionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/question', [QuestionController::class, 'index'])->name('question.index');
    Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::post('/question/like/{question}', [QuestionController::class, 'like'])->name('question.like');
    Route::post('/question/unlike/{question}', [QuestionController::class, 'unlike'])->name('question.unlike');
    Route::put('/question/publish/{question}', [QuestionController::class, 'publish'])->name('question.publish');
    Route::delete('/question/delete/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::get('/question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
