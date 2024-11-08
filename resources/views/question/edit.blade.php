<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar pergunta :: {{ $question->id }}
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
        <form action="{{ route('question.update', $question) }}" method="post">
            @method('put')
            @csrf
            <label for="about" class="block text-sm/6 font-medium text-gray-800">Questão</label>
            <div class="mt-2">
                <textarea
                    id="question"
                    name="question"
                    rows="3"
                    class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                            focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">{{ old('question', $question->question) }}</textarea>
            </div>

            @error('question')
                <p class="mt-3 text-sm/6 text-red-600">{{ $message }}</p>
            @enderror

            <button type="submit" class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Salva
            </button>
        </form>
    </div>
</x-app-layout>
