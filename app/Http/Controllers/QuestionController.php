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

        Question::create(array_merge($attributes, ['draft' => true]));

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

    /**
     * Muda o estado de uma pergunta de rascunho para publico
     *
     * @param Question $question
     * @return void
     */
    public function publish(Question $question)
    {
        $this->authorize('publish', $question);

        $question->update(['draft' => false]);

        return back();
    }
}
