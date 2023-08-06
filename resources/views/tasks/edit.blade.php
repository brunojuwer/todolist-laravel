<x-app-layout>
    <div class="max-w-2xl mx-auto pt-12">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('patch')
            <div class="w-[90%] text-gray-900 dark:text-gray-100">
                <x-text-input 
                  name="title" 
                  type="text"
                  class="mt-1 block w-full"
                  autocomplete="add-task"
                  autofocus
                  value="{{$task['title']}}"
                />
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
            </div>
            <div class="mt-4 space-x-2">
                <x-primary-button 
                  type="submit"
                >{{ __('Save') }}</x-primary-button>
                <x-danger-button>
                  <a href="{{ route('tasks.index') }}">{{ __('Cancel') }}</a>
                </x-danger-button>
            </div>
        </form>
    </div>
</x-app-layout>