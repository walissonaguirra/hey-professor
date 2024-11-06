<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionStoreRequest;
use Closure;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Rules\EndWithQuestionMarkRule;

class QuestionController extends Controller
{
    public function store(QuestionStoreRequest $request)
    {
        $attributes = $request->validated();

        Question::create($attributes);

        return redirect('dashboard');
    }
}
