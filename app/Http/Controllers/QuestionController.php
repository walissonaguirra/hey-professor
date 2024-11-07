<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionStoreRequest;
use App\Models\{Question};

class QuestionController extends Controller
{
    /**
     * Salva novas perguntas
     *
     * @return void
     */
    public function store(QuestionStoreRequest $request)
    {
        $attributes = $request->validated();

        Question::create($attributes);

        return redirect('dashboard');
    }

    /**
     * Salva 'likes' do usuario logado em um pergunta
     *
     * @return void
     */
    public function like(Question $question)
    {
        auth()->user()->like($question);

        return back();
    }

    /**
     * Salva 'deslikes' do usuario logado em um pergunta
     *
     * @return void
     */
    public function unlike(Question $question)
    {
        auth()->user()->unlike($question);

        return back();
    }
}
