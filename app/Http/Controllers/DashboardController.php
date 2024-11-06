<?php

namespace App\Http\Controllers;

use App\Models\Question;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $questions = Question::query()->orderByDesc('created_at')->get();

        return view('dashboard', compact('questions'));
    }
}
