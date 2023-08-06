<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('TODO LIST') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Tasks') }}
                </h2>
            </x-slot>

            <form method="POST" action="{{ route('tasks.store') }}" class="pt-12 pb-3">
                @csrf
                <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="pl-6 w-[90%] text-gray-900 dark:text-gray-100">
                            <x-text-input id="add_task" name="title" type="text" class="mt-1 block w-full" autocomplete="add-task" />
                            <x-input-error :messages="$errors->updatePassword->get('add_task')" class="mt-2" />
                        </div>
                        <div class="p-6">
                            <x-primary-button type="submit">
                                {{ __('Add') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="py-1">
                <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                    <ul class="flex flex-col items-center bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        @foreach($tasks as $task)
                        <li class="p-6 flex gap-1 w-full justify-between">
                            <p class="text-gray-200 w-[90%]">
                                {{ $task->title }}
                            </p>
                                <x-dropdown-link 
                                    :href="route('tasks.edit', $task)" 
                                    class="w-[4rem] h-8 py-4 inline-flex text-center items-center bg-gray-600 border 
                                        border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest
                                      dark:hover:bg-blue-500 focus:outline-none focus:ring-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                > 
                                    {{ __('Edit') }}    
                                </x-dropdown-link>
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                @csrf
                                @method('delete')
                                <x-danger-button>
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </x-app-layout>
    </body>
</html>
