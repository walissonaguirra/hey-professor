<?php

namespace App\Http\Controllers;

use App\Models\Question;

class DashboardController extends Controller
{
    /**
     * Lista todas as perguntas publicadas
     *
     * @return void
     */
    public function __invoke()
    {
        $questions = Question::query()
            ->withSum('votes', 'like')
            ->withSum('votes', 'unlike')
            ->where('draft', false)
            ->orderByRaw('
                coalesce(votes_sum_like, 0) desc,
                coalesce(votes_sum_unlike, 0) asc
            ')
            ->get();

        return view('dashboard', compact('questions'));
    }
}
