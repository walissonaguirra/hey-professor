<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Rules\EndWithQuestionMarkRule;

class QuestionController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                new EndWithQuestionMarkRule
            ]
        ]);

        Question::create($attributes);

        return redirect('dashboard');
    }
}
