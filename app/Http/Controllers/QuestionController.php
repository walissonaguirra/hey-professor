<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store()
    {
        Question::create(
            request()->validate([
                'question' => 'required'
            ])
        );

        return redirect('dashboard');
    }
}
