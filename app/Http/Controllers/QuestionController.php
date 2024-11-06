<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionStoreRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    public function store(QuestionStoreRequest $request)
    {
        $attributes = $request->validated();

        Question::create($attributes);

        return redirect('dashboard');
    }
}
