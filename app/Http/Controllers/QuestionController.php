<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionStoreRequest;
use App\Models\{Question, Vote};

class QuestionController extends Controller
{
    public function store(QuestionStoreRequest $request)
    {
        $attributes = $request->validated();

        Question::create($attributes);

        return redirect('dashboard');
    }

    public function like(Question $question)
    {
        Vote::create([
            'question_id' => $question->id,
            'user_id'     => auth()->id,
            'like'        => 1,
            'unlike'      => 0,
        ]);

        return back();
    }
}
