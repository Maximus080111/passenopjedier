<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('posts.store') }}">
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
            <input type="number" step="0.01" name="price" placeholder="{{ __('Price') }}" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent">
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <select name=species id="species">
                @foreach ($species as $kind)
                    <option value="{{ $kind->animal_species }}">{{ $kind->animal_species }}</option>
                @endforeach
            </select>
            <x-primary-button class="mt-4 w-full py-4 flex items-center justify-center bg-blue-500">{{ __('Post') }}</x-primary-button>
        </form>

        <div class="mt-6">
            @foreach ($posts as $post)
                <div class="bg-white shadow-sm rounded-lg p-6 mb-4">
                    <div class="flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $post->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small>
                                    @unless ($post->created_at->eq($post->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                {{-- @if ($post->user->is(auth()->user()))
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('posts.edit', $post)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link :href="route('posts.destroy', $post)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @endif --}}
                            </div>
                            <p class="mt-4 text-lg text-gray-900">{{$post->dog_name}}</p>
                            <p class="mt-4 text-lg text-gray-900">{{ $post->message }}</p>
                            <p class="mt-4 text-lg text-gray-900">{{$post->species}}</p>
                            <p>&euro;{{ number_format($post->price, 2, ',', '.') }}</p>
                            <p class="mt-4 text-lg text-gray-900">
                                {{ \Carbon\Carbon::parse($post->start_date)->format('j F Y') }}
                                &middot;
                                {{ \Carbon\Carbon::parse($post->end_date)->format('j F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>