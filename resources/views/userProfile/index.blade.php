<x-app-layout>
    @if ($isCurrentUser)
    <h1 class="dark:text-white text-gray-900 font-bold text-center text-4xl my-6">Upload photo's of your home</h1>
    <div class="flex justify-center">
        <form class="mx-6" enctype="multipart/form-data" method="POST" action="{{{url('user/'. $user->id . '/upload')}}}">
            @csrf
            <div>
                <label for="image" class="block text-sm text-gray-500 dark:text-gray-300">Image</label>
                <input name="image_user" type="file" class="block w-full px-3 py-2 mt-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg file:bg-gray-200 file:text-gray-700 file:text-sm file:px-4 file:py-1 file:border-none file:rounded-full dark:file:bg-gray-800 dark:file:text-gray-200 dark:text-gray-300 placeholder-gray-400/70 dark:placeholder-gray-500 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:focus:border-blue-300"" accept="jpeg,png,gif">
            </div>
            <div>
                <label for="video" class="block text-sm text-gray-500 dark:text-gray-300">Video</label>
                <input name="video_user" type="file" class="block w-full px-3 py-2 mt-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg file:bg-gray-200 file:text-gray-700 file:text-sm file:px-4 file:py-1 file:border-none file:rounded-full dark:file:bg-gray-800 dark:file:text-gray-200 dark:text-gray-300 placeholder-gray-400/70 dark:placeholder-gray-500 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:focus:border-blue-300" accept="video/*">
            </div>
            <button type="submit" class="w-full mt-4 px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">submit</button>
        </form>
    </div>
    @endif
    <div class="my-4 mt-20 mx-6">
        <h1 class="dark:text-white text-gray-900 text-4xl text-center mt-6 font-bold">{{$user->name}}</h1>
        @if($hasImages)
            <h2 class="dark:text-white text-gray-900 font-semibold text-xl mt-4">Images user</h2>
            <div class="flex gap-5 overflow-x-auto">
                @foreach($images as $image)
                            <img src="{{ asset('storage/images_users/' . $image->image_user)}}" alt="User Image" class="h-60 w-80 object-cover object-center">
                @endforeach
            </div>
        @endif

        @if($hasVideos)
            <h2 class="dark:text-white text-gray-900 font-semibold text-xl mt-4">Videos user</h2>
            <div class="flex gap-5 overflow-x-auto">
                @foreach($images as $image)
                        <video class="w-90 h-60 object-cover object-center" src="{{ asset('storage/videos_users/' . $image->video_user)}}" controls></video>
                @endforeach
            </div>
        @endif
    </div>
    <div class="mx-6">
        <h1 class="dark:text-white text-gray-900 text-4xl text-center mt-6 font-bold ">users pets</h1>
        <div class="flex justify-around gap-2 flex-wrap">
            @foreach($petInfo as $pet)
                <x-animal-card-userprofile :post="$pet" />
            @endforeach
        </div>
    </div>

</x-app-layout>