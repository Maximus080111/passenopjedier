<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <div class="py-12 px-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-600 rounded-lg p-6 mb-4 text-center flex items-center flex-col">
                <h3 class="text-xl text-white font-semibold mb-4">Your profile</h3>
                @if(auth()->user()->image)
                    <div class="rounded-full h-20 w-20 bg-gray-300 mb-4">
                        <img src="{{ auth()->user()->image }}" alt="User Image" class="rounded-full h-20 w-20 mb-4">
                    </div>
                @else
                    <div class="rounded-full h-20 w-20 bg-gray-300 mb-4"></div>
                @endif
                <h3 class="text-xl text-white font-semibold mb-2">{{ auth()->user()->name }}</h3>
                <p class="text-gray-200 mb-4">{{ auth()->user()->email }}</p>
                <a href="{{ route('profile.edit') }}" class="bg-white text-gray-900 px-4 py-2 rounded-lg mt-4">Edit Profile</a>
            </div>
            
            <div class="bg-gray-600 rounded-lg p-6 mb-4 flex flex-col items-center">
                <h3 class="text-xl font-semibold mb-4 text-white">My Pets</h3>
                <div class="flex gap-4 justify-around w-full flex-wrap">
                    @foreach($posts as $post)
                        <x-animal-card-dashboard :post="$post" :aanvragen="$aanvragen" :users="$users" />
                    @endforeach
                </div>
                <a href="{{ route('posts.create') }}" class="bg-white text-bg-gray-900 font-extrabold px-4 py-4 text-center rounded-lg w-full">Create post</a>
            </div>
        </div>
    </div>
</x-app-layout>
