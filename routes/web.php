<?php

use App\Http\Controllers\Auth\Github;
use App\Http\Controllers\{DashboardController, ProfileController, QuestionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    // if (app()->isLocal()) {
    //     auth()->loginUsingId(1);

    //     return to_route('dashboard');
    // }

    return view('welcome');
});

Route::get('/github/login', Github\RedirectController::class)->name('github.login');
Route::get('/github/callback', Github\CallbackController::class)->name('github.callback');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/question', [QuestionController::class, 'index'])->name('question.index');
    Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::post('/question/like/{question}', [QuestionController::class, 'like'])->name('question.like');
    Route::post('/question/unlike/{question}', [QuestionController::class, 'unlike'])->name('question.unlike');
    Route::put('/question/publish/{question}', [QuestionController::class, 'publish'])->name('question.publish');
    Route::delete('/question/delete/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::get('/question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/question/{question}', [QuestionController::class, 'update'])->name('question.update');
    Route::patch('/question/{question}/archive', [QuestionController::class, 'archive'])->name('question.archive');
    Route::patch('/question/{question}/restore', [QuestionController::class, 'restore'])->name('question.restore');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
