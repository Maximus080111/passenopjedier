<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('patch')
            <textarea
            name="dog_name"
            placeholder="{{ __('What\'s dogs name?') }}"
            class="block w-full border-gray-300 mb-4 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent dark:text-white"
            >{{ old('dog_name', $post->dog_name) }}</textarea>
            <textarea
                name="message"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message', $post->message) }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <div class="date-picker flex justify- justify-center space-x-2 my-4">
                    <input type="date" id="start-date" name="start_date" placeholder="Start Date" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent dark:text-white" value="{{ old('start_date', $post->start_date) }}">
                    <input type="date" id="end-date" name="end_date" placeholder="End Date" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent dark:text-white" value="{{ old('end_date', $post->end_date) }}">
                </div>
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('posts.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>