<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-8 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg p-6 mb-4 text-center flex items-center flex-col">
                <h3 class="text-xl font-semibold mb-4">Your profile</h3>
                @if(auth()->user()->image)
                    <div class="rounded-full h-20 w-20 bg-gray-300 mb-4">
                        <img src="{{ auth()->user()->image }}" alt="User Image" class="rounded-full h-20 w-20 mb-4">
                    </div>
                @else
                    <div class="rounded-full h-20 w-20 bg-gray-300 mb-4"></div>
                @endif
                <h3 class="text-xl font-semibold mb-2">{{ auth()->user()->name }}</h3>
                <p class="text-gray-600 mb-4">{{ auth()->user()->email }}</p>
                <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4">Edit Profile</a>
            </div>
            
            <div class="bg-white rounded-lg p-6 mb-4 flex flex-col items-center">
                <h3 class="text-xl font-semibold mb-4">My Posts</h3>
                @foreach(auth()->user()->posts->reverse() as $post)
                    <div class="bg-gray-100 rounded-lg p-4 mb-4 border-gray-900 border-2 flex items-center w-full">
                        <div>
                            <div class="flex items-center mb-2">
                                @if(auth()->user()->image)
                                    <div class="rounded-full h-8 w-8 bg-gray-300 mr-2">
                                        <img src="{{ auth()->user()->image }}" alt="User Image" class="rounded-full h-8 w-8">
                                    </div>
                                @else
                                    <div class="rounded-full h-8 w-8 bg-gray-300 mr-2"></div>
                                @endif
                                <h4 class="text-lg font-semibold">{{ $post->user->name }}</h4>
                                <span class="text-gray-400 text-sm mx-2">{{ $post->created_at->diffForHumans(['short' => true]) }}</span>
                                @if ($post->user->is(auth()->user()))
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
                                @endif
                            </div>
                            <p class="text-gray-600">{{ $post->message }}</p>
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('posts.index') }}" class="bg-blue-500 text-white px-4 py-4 text-center rounded-lg w-full">Create post</a>
            </div>
        </div>
    </div>
</x-app-layout>
