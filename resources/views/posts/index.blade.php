<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 flex flex-col">
        <a href="{{ route('posts.create') }}" class="bg-gray-200 text-gray-900 my-4 font-extrabold px-4 py-4 text-center rounded-lg min-w-full">Create post</a>
        
        <div class="mt-3 flex flex-col sm:flex-row gap-4 flex-wrap justify-around">
            @foreach ($posts as $post)
                <x-animal-card-posts :post="$post" :aanvragen="$aanvragen" />
            @endforeach
        </div>
    </div>
</x-app-layout>