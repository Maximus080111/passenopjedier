<x-app-layout>
    <h1 class="text-white text-3xl text-center p-6">All current users</h1>
    <div class="flex justify-center items-center">
        @foreach($users as $user)
            <div class="card p-6 bg-white shadow-md rounded-lg">
                <div class="card-body">
                    <h5 class="card-title text-xl font-bold">{{ $user->name }}</h5>
                    <p class="card-text text-gray-600">{{ $user->email }}</p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>