<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8" x-data="picturePreview()">
        <h1 class="text-center my-4 font-semibold text-white text-2xl">Een aanvraag maken</h1>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <textarea
            name="pet_name"
            placeholder="{{ __('What\'s the pets name?') }}"
            class="block w-full border-gray-300 text-gray-900 dark:text-white mb-4 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent"
            >{{ old('pet_name') }}</textarea>
            <textarea
            name="message"
            placeholder="{{ __('Place the desciption of your pet here') }}"
            class="block w-full border-gray-300 text-gray-900 dark:text-white focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent"
            >{{ old('message') }}</textarea>
            <div class="date-picker flex justify- justify-center space-x-2 my-4">
                <input type="date" id="start-date" name="start_date" placeholder="Start Date" required class="border-gray-300 mx-2 text-gray-900 dark:text-white focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent">
                <input type="date" id="end-date" name="end_date" placeholder="End Date" required class="border-gray-300 mx-2 text-gray-900 dark:text-white focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent">
            </div>
            {{-- <label for="photo-animal" class="flex items-center px-3 py-3 mx-auto mt-6 text-center bg-white border-2 border-dashed rounded-lg cursor-pointer dark:border-gray-600 dark:bg-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                
                <h2 class="mx-3 text-gray-400">Photo of your animal</h2>
                
                <input id="dropzone-file" type="file" class="hidden" />
                <input @change="fileChosen(event)" id="photo-animal" name="image" type="file" class="mt-4 hidden" accept="jpeg,png,gif">
            </label> --}}
            {{-- <span class="text-xs text-center text-gray-500">
                <img src="imageUrl" :src="imageUrl" alt="photo of your animal" class="w-full object-cover object-center border-dashed h-52 border-2 rounded-lg dark:border-gray-600 dark:bg-gray-900 bg-white text-center">
            </span> --}}
            <div class="my-4 w-full">
                {{-- <label for="file" class="block text-sm text-gray-500 dark:text-gray-300">File</label> --}}
            
                <label for="photo-animal" class="flex flex-col items-center w-full p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                    <img :src="imageUrl" onerror="" class="max-h-56">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500 dark:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
            
                    <h2 class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">Pet photo file</h2>
            
                    <p class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">Upload your file JPEG, PNG or JPG</p>
            
                    {{-- <input @change="fileChosen(event)" id="photo-animal" type="file" class="hidden" /> --}}
                    <input @change="fileChosen(event)""  id="photo-animal" name="image" type="file" class="mt-4 hidden" accept="jpeg,png,gif">
                </label>
            </div>
            <div class="my-4 w-full">
                {{-- <label for="file" class="block text-sm text-gray-500 dark:text-gray-300">File</label> --}}
            
                <label for="videoUpload" class="flex flex-col items-center w-full p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                    <video :src="videoUrl" style="display:none" controls autoplay class="max-h-56"></video>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500 dark:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>

                    <h2 class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">Pet video file</h2>

                    <p class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">Upload your file MP4, OVI or MOVI</p>

                    <input id="videoUpload" name="video" type="file" class="mt-4 hidden" accept="video/*">
                </label>
                <script>
                    document.getElementById("videoUpload").onchange = function(event) {
                        let file = event.target.files[0];
                        let blobURL = URL.createObjectURL(file);
                        document.querySelector("video").style.display = 'block';
                        document.querySelector("video").src = blobURL;
                    }
                </script>
            </div>
            <div class="flex flex-wrap justify-around items-center my-6">
                <div class="flex flex-col">
                    <label class="text-white" for="price">Price per hour</label>
                    <input type="number" step="0.01" name="price" placeholder="{{ __('Price') }}" required class="border-gray-300 max-w-60 text-gray-900 dark:text-white focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent">
                </div>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <div class="flex flex-col">
                    <label class="text-white" for="species">Type of pet</label>
                    <select class="max-w-60" name=species id="species">
                        @foreach ($species as $kind)
                            <option value="{{ $kind->animal_species }}">{{ $kind->animal_species }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <x-primary-button class="mt-4 w-full py-4 flex items-center justify-center bg-blue-500">{{ __('Post') }}</x-primary-button>
        </form>
        <script>
            function picturePreview() {
                
                return {
                    imageUrl: "",

                    fileChosen(event) {
                        this.fileToDataUrl(event, (src) => (this.imageUrl = src));
                    },

                    fileToDataUrl(event, callback) {
                        if (!event.target.files.length) return;

                        let file = event.target.files[0],
                            reader = new FileReader();

                        reader.readAsDataURL(file);
                        reader.onload = (e) => callback(e.target.result);
                    },
                };
            }
        </script>

    </div>
</x-app-layout>