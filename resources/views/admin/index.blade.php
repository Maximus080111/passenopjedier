<x-app-layout>
    @if (!auth()->user()->is_admin)
            @abort (403, 'You are not authorized to view this page')
    @else
        <h1 class="text-mossgreen text-3xl text-center p-6">All current users</h1>
        <div class="flex justify-center items-center flex-col mx-20">
            @foreach($users as $user)
                <div class="card p-6 bg-white shadow-md rounded-lg w-full mt-4 border-mossgreen border-2">
                    <div class="card-body">  
                        <h5 class="card-title text-xl font-bold">{{ $user->name }} </h5>
                        <p class="card-text text-gray-600">{{ $user->email }}</p>
                        <div class="mt-4 flex">
                            <div class="bg-mossgreen mx-4 px-4 py-2 text-white rounded-md">
                                @if($user->is_blocked)
                                    <a href="/admin/{{$user->id}}/block">unblock user</a>
                                @else
                                    <a href="/admin/{{$user->id}}/block">block user</a>
                                @endif
                            </div>
                            <div class="bg-mossgreen mx-4 px-4 py-2 text-white rounded-md">
                                @if($user->is_admin)
                                    <a href="/admin/{{$user->id}}/admin">remove admin</a>
                                @else
                                    <a href="/admin/{{$user->id}}/admin">make admin</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h1 class="text-mossgreen text-3xl text-center p-6">All Posts</h1>
        <div class="flex justify-center items-center flex-col mx-20">
            @foreach($posts as $post)
            <div class="bg-white rounded-lg p-4 mb-4 border-mossgreen shadow-md border-2 flex items-center w-full">
                <div>
                    <div class="flex items-center mb-2">
                        @if(auth()->user()->image)
                            <div class="rounded-full h-8 w-8 bg-gray-300 mr-2">
                                <img src="{{ auth()->user()->image }}" alt="User Image" class="rounded-full h-8 w-8">
                            </div>
                        @else
                            <div class="rounded-full h-8 w-8 bg-gray-300 mr-2"></div>
                        @endif
                        <h4 class="text-lg font-semibold">{{ $post->dog_name }}</h4>
                        <span class="text-gray-400 text-sm mx-2">{{ $post->created_at->diffForHumans(['short' => true]) }}</span>
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
                    </div>
                    <p class="text-gray-600">{{ $post->message }}</p>
                    <p>&euro;{{ number_format($post->price, 2, ','  ,   '.') }}</p>
                    <p>{{ $post->species }}</p>
                    <p class="mt-4 text-sm  text-gray-900">
                        {{ \Carbon\Carbon::parse($post->start_date)->format('j F Y') }}
                        &middot;
                        {{ \Carbon\Carbon::parse($post->end_date)->format('j F Y') }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</x-app-layout>