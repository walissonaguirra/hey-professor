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

        <form action="{{ route('dashboard') }}" method="get">
            @csrf
            <label for="about" class="block text-sm/6 font-medium text-gray-800">Pesquisa Questão</label>
            <div class="mt-2">
                <input
                    name="search"
                    value="{{ request()->input('search') }}"
                    class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                            focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"/>
            </div>

            @error('search')
                <p class="mt-3 text-sm/6 text-red-600">{{ $message }}</p>
            @enderror

            <button type="submit" class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Buscar
            </button>
        </form>

        <br>
        <br>
        <br>
        <br>

        <div class="text-gray-700 uppercase font-bold mb-2">Lista de questões</div>

        <ul class="text-gray-700">
            @foreach ($questions as $question)
            <li>
                {{ $question->question }}

                <form action="{{ route('question.like', $question) }}" method="post">
                    @csrf
                    <button class="text-blue-500" type="submit">
                        Like ({{ $question->votes_sum_like ?: 0 }})
                    </button>
                </form>

                <form action="{{ route('question.unlike', $question) }}" method="post">
                    @csrf
                    <button class="text-red-500" type="submit">
                        Deslike ({{ $question->votes_sum_unlike ?: 0 }})
                    </button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
