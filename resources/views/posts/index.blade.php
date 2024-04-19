<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 flex flex-col">
        <a href="{{ route('posts.create') }}" class="dark:bg-gray-200 bg-gray-800 dark:text-gray-900 text-white my-4 font-extrabold px-4 py-4 text-center rounded-lg min-w-full">Create post</a>
        <div>
            <form action="{{ route('posts.index') }}" method="get">
            <div class="w-full relative z-20 inline-block">
                <button type="button" class="bg-gray-800 dark:bg-gray-200 dark:text-gray-900 text-white my-4 font-extrabold px-4 py-4 text-center rounded-lg min-w-full" onclick="toggleDropdown()">Filter</button>
                <div id="dropdown" class="absolute hidden bg-white dark:bg-gray-700 border border-gray-300 rounded-md p-2 mt-2">
                    <label for="start date" class="font-bold dark:text-white text-gray-800">Start Date</label>
                    <input type="date" name="start_date" placeholder="Start date" class="border-gray-300 dark:bg-gray-900 bg-gray-300 placeholder-text-gray-800 dark:placeholder:text-white text-gray-800 dark:text-white  rounded-md p-2 w-full mb-4" value="{{ old('start_date') }}">
                    <label for="start date" class="font-bold dark:text-white text-gray-800">End Date</label>
                    <input type="date" name="end_date" placeholder="End date" class="border-gray-300 dark:bg-gray-900 bg-gray-300 placeholder-text-gray-800 dark:placeholder:text-white text-gray-800 dark:text-white  rounded-md p-2 w-full mb-4" value="{{ old('end_date') }}">
                    <label for="start date" class="font-bold dark:text-white text-gray-800">Maximum price</label>
                    <input type="number" name="price_max" placeholder="Max price" class="border-gray-300 dark:bg-gray-900 bg-gray-300 placeholder-text-gray-800 dark:placeholder:text-white text-gray-800 dark:text-white  rounded-md p-2 w-full mb-4" value="{{ old('price_max', 0) }}">
                    <label for="start date" class="font-bold dark:text-white text-gray-800">Species</label>
                    <select class="w-full rounded-md dark:bg-gray-900 dark:text-white" name="species">
                        <option value="">All species</option>
                        <option value="dog">Dog</option>
                        <option value="cat">Cat</option>
                        <option value="bird">Bird</option>
                        <option value="reptile">Reptile</option>
                    </select>
                    <x-primary-button class="mt-4 w-full" type="submit">Submit</x-primary-button>
                </div>
            </div>
            </form>
        </div>

        <script>
            function toggleDropdown() {
            var dropdown = document.getElementById("dropdown");
            dropdown.classList.toggle("hidden");
            }
        </script>
        <div class="mt-3 flex flex-col sm:flex-row gap-4 flex-wrap justify-around">
            @foreach ($posts as $post)
                <x-animal-card-posts :post="$post" :aanvragen="$aanvragen" />
            @endforeach
        </div>
    </div>
</x-app-layout>