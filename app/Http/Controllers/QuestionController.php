<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionStoreRequest;
use App\Models\{Question};
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    /**
     * Lista perguntas do usuário logado
     *
     * @return void
     */
    public function index()
    {
        return view('question.index', [
            'questions' => auth()->user()->questions,
        ]);
    }

    /**
     * Salva novas perguntas
     *
     * @return void
     */
    public function store(QuestionStoreRequest $request)
    {
        $attributes = $request->validated();

        auth()->user()->questions()->create(array_merge($attributes, ['draft' => true]));

        return back();
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
        Gate::authorize('publish', $question);

        $question->update(['draft' => false]);

        return back();
    }

    public function destroy(Question $question)
    {
        Gate::authorize('destroy', $question);

        $question->delete();

        return back();
    }
}
