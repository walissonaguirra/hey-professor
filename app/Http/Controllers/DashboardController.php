<?php

namespace App\Http\Controllers;

use App\Models\Question;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $questions = Question::query()
            ->withSum('votes', 'like')
            ->withSum('votes', 'unlike')
            ->where('draft', false)
            ->orderByDesc('created_at')
            ->get();

        return view('dashboard', compact('questions'));
    }
}
