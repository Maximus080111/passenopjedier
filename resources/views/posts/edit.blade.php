<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8" x-data="picturePreview()">
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('patch')
            <textarea
            name="dog_name"
            placeholder="{{ __('What\'s dogs name?') }}"
            class="block w-full border-gray-300 mb-4 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent dark:text-white"
            >{{ old('dog_name', $post->dog_name) }}</textarea>
            <textarea
                name="message"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message', $post->message) }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <div class="date-picker flex justify- justify-center space-x-2 my-4">
                    <input type="date" id="start-date" name="start_date" placeholder="Start Date" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent dark:text-white" value="{{ old('start_date', $post->start_date) }}">
                    <input type="date" id="end-date" name="end_date" placeholder="End Date" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent dark:text-white" value="{{ old('end_date', $post->end_date) }}">
                </div>
                <div class="my-4 w-full">
                    {{-- <label for="file" class="block text-sm text-gray-500 dark:text-gray-300">File</label> --}}
                
                    <label for="photo-animal" class="flex flex-col items-center w-full p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                        <div id="oldimagepreview">
                            @if($post->image)
                                <h1 class="text-white font-bold ">your current picture</h1>
                                <img src="{{ asset('storage/images/' . $post->image) }}" class="max-h-56 my-4">
                            @endif
                        </div>
                        <img :src="imageUrl" onerror="" class="max-h-56">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500 dark:text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                
                        <h2 class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">Animal photo file</h2>
                
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
    
                        <h2 class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">Animal video file</h2>
    
                        <p class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">Upload your file MP4, OVI or MOVI</p>
    
                        <input id="videoUpload" name="video" type="file" class="mt-4 hidden" accept="video/*">
                    </label>
                    <script>
                        document.getElementById("videoUpload").onchange = function(event) {
                            let file = event.target.files[0];
                            let blobURL = URL.createObjectURL(file);
                            document.querySelector("video").style.display = 'block';
                            document.querySelector("video").src = blobURL;
                            document.getElementById('oldvideopreview').classList.add('hidden');
                        }
                    </script>
                    <script>
                        function picturePreview() {
                            
                            return {
                                imageUrl: "",
            
                                fileChosen(event) {
                                    this.fileToDataUrl(event, (src) => (this.imageUrl = src));
                                    document.getElementById('oldimagepreview').classList.add('hidden');
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
                <input type="number" step="0.01" name="price" placeholder="{{ __('Price') }}" required class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent">
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <select name=species id="species">
                    @foreach ($species as $kind)
                        <option value="{{ $kind->animal_species }}">{{ $kind->animal_species }}</option>
                    @endforeach
                </select>
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('posts.index') }}">{{ __('Cancel') }}</a>
            </div>

        </form>
    </div>
</x-app-layout>