<x-app-layout>
        <img class="h-96 object-cover object-center w-full" src="{{asset('storage/images/' . $post->image)}}" alt="">
        <div class=" mx-10">
                <h1 class="text-center text-white text-4xl font-bold my-8">{{$post->pet_name}}</h1>
                <div class="flex flex-col justify-center mb-6">
                        <a class="text-center mb-4 dark:text-white text-gray-900 underline" href="/user/{{$post->user_id}}">Owner: {{$user->name}}</a>
                        <div class="flex flex-col items-center mb-4">
                                <h2 class="dark:text-white text-gray-900 text-2xl font-semibold">Description</h2>
                                <p class=" dark:text-white text-gray-900">{{$post->message}}</p>
                        </div>
                        <div class="flex flex-col items-center mb-4">
                                <h2 class=" dark:text-white text-gray-900 text-2xl font-semibold">Price</h2>
                                <p class=" dark:text-white text-gray-900">&euro;{{ number_format($post->price, 2, ','  ,   '.') }}</p>
                        </div>
                        <div class="flex flex-col items-center">
                                <h2 class=" dark:text-white text-gray-900 text-2xl font-semibold">date</h2>
                                <p class="dark:text-white text-gray-900">
                                        {{ \Carbon\Carbon::parse($post->start_date)->format('j F Y') }}
                                        &middot;
                                        {{ \Carbon\Carbon::parse($post->end_date)->format('j F Y') }}
                                </p>
                        </div>
                </div>
                <div>
                        <h2 class="text-center mb-4 dark:text-white text-gray-900 text-2xl font-semibold">images and videos of {{$post->pet_name}}</h2>
                        <div class="flex gap-8 justify-center flex-wrap">
                                <img class="h-56 w-92" src="{{asset('storage/images/' . $post->image)}}" alt="">
                                @if($post->video !== NULL) {
                                        <video class="h-56 w-auto" controls src="{{ asset('storage/videos/' . $post->video)}}"></video>
                                }
                                @endif
                        </div>
                </div>
        </div>
</x-app-layout>