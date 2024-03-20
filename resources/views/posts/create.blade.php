<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <textarea
            name="dog_name"
            placeholder="{{ __('What\'s dogs name?') }}"
            class="block w-full border-gray-300 mb-4 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent"
            >{{ old('dog_name') }}</textarea>
            <textarea
            name="message"
            placeholder="{{ __('What\'s on your mind?') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent"
            >{{ old('message') }}</textarea>
            <div class="date-picker flex justify- justify-center space-x-2 my-4">
                <input type="date" id="start-date" name="start_date" placeholder="Start Date" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent">
                <input type="date" id="end-date" name="end_date" placeholder="End Date" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent">
            </div>
            <input name="image" type="file" class="mt-4" accept="jpeg,png,gif">
            <input type="number" step="0.01" name="price" placeholder="{{ __('Price') }}" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent">
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <select name=species id="species">
                @foreach ($species as $kind)
                    <option value="{{ $kind->animal_species }}">{{ $kind->animal_species }}</option>
                @endforeach
            </select>
            <x-primary-button class="mt-4 w-full py-4 flex items-center justify-center bg-blue-500">{{ __('Post') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>