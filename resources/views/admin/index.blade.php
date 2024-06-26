<x-app-layout>
    @if (!auth()->user()->is_admin)
            @abort (403, 'You are not authorized to view this page')
    @else
        <h1 class="text-gray-200 text-3xl text-center p-6 pb-4">All current users</h1>
        <div class="flex justify-center items-center flex-col mx-10">
            @foreach($users as $user)
                <div class="card p-6 bg-gray-200 shadow-md rounded-lg w-full mt-4">
                    <div class="card-body">  
                        <h5 class="card-title text-xl font-bold text-gray-900">{{ $user->name }} </h5>
                        <p class="card-text text-gray-600">{{ $user->email }}</p>
                        @unless(Auth()->user()->id == $user->id)
                            <div class="mt-4 flex">
                                <div class="bg-gray-800 mx-4 px-4 py-2 text-white rounded-md">
                                    @if($user->is_blocked)
                                        <a href="/admin/{{$user->id}}/block">unblock user</a>
                                    @else
                                        <a href="/admin/{{$user->id}}/block">block user</a>
                                    @endif
                                </div>
                                <div class="bg-gray-800 mx-4 px-4 py-2 text-white rounded-md">
                                    @if($user->is_admin)
                                        <a href="/admin/{{$user->id}}/admin">remove admin</a>
                                    @else
                                        <a href="/admin/{{$user->id}}/admin">make admin</a>
                                    @endif
                                </div>
                            </div>
                        @endunless
                    </div>
                </div>
            @endforeach
        </div>

        <h1 class="text-gray-200 text-3xl text-center p-6 pb-4">All Posts</h1>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 justify-items-center gap-5 mx-10">
            @foreach($posts as $post)
                <x-animal-card-admin :post="$post"  />
            @endforeach
        </div>
    @endif
</x-app-layout>