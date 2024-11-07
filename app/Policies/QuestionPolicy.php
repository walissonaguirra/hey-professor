<?php

namespace App\Policies;

use App\Models\{Question, User};

class QuestionPolicy
{
    /**
     * Check se o usuário logado pode publicar á pergunta
     *
     * @param User $user
     * @param Question $question
     * @return boolean
     */
    public function publish(User $user, Question $question): bool
    {
        return $question->user->is($user);
    }

    /**
     * Check se o usuário logado pode apagar á pergunta
     *
     * @param User $user
     * @param Question $question
     * @return boolean
     */
    public function destroy(User $user, Question $question): bool
    {
        return $question->user->is($user);
    }
}
