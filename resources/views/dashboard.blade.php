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
