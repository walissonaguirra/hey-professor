<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-8">
        <form action="{{ route('question.store') }}" method="post">
            @csrf
            <label for="about" class="block text-sm/6 font-medium text-gray-800">Questão</label>
            <div class="mt-2">
                <textarea
                    id="question"
                    name="question"
                    rows="3"
                    class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                            focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">{{ old('question') }}</textarea>
            </div>

            @error('question')
                <p class="mt-3 text-sm/6 text-red-600">{{ $message }}</p>
            @enderror

            <button type="submit" class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Salva
            </button>
        </form>

        <hr class="my-4 border-gray-700 border-dashed"/>

        <div class="text-gray-700 uppercase font-bold mb-2">Perguntas Rascunho</div>

        <ul class="text-gray-700">
            @foreach ($questions->where('draft', true) as $question)
            <li>
                {{ $question->question }}

                <form action="{{ route('question.publish', $question) }}" method="post">
                    @method('put')
                    @csrf
                    <button class="text-blue-500" type="submit">
                        Publicar
                    </button>
                </form>

                <form action="{{ route('question.destroy', $question) }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="text-red-500" type="submit">
                        Apagar
                    </button>
                </form>

                <form action="{{ route('question.archive', $question) }}" method="post">
                    @method('patch')
                    @csrf
                    <button class="text-red-500" type="submit">
                        Arquivar
                    </button>
                </form>

                <a href="{{ route('question.edit', $question) }}">Editar</a>
            </li>
            @endforeach
        </ul>

        <br/>
        <br/>
        <br/>
        <div class="text-gray-700 uppercase font-bold mb-2">Perguntas Arquivadas</div>
        <ul class="text-gray-700">
            @foreach ($archivedQuestions as $question)
            <li>
                {{ $question->question }}

                <form action="{{ route('question.restore', $question) }}" method="post">
                    @method('patch')
                    @csrf
                    <button class="text-red-500" type="submit">
                        Des arquivar
                    </button>
                </form>
            </li>
            @endforeach
        </ul>

        <br/>
        <br/>
        <br/>
        <div class="text-gray-700 uppercase font-bold mb-2">Perguntas Publicas</div>

        <ul class="text-gray-700">
            @foreach ($questions->where('draft', false) as $question)
            <li>{{ $question->question }}</li>
            @endforeach
        </ul>

    </div>
</x-app-layout>
