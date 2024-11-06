<?php

use App\Models\User;

test('cria uma nova pergunta com até 255 caractéries', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $request = $this->post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?'
    ]);

    $request->assertRedirect(route('dashboard'));
    $this->assertDatabaseCount('questions', 1);
    $this->assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);

});
