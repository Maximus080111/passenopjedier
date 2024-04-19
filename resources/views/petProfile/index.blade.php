<x-app-layout>
        <img class="h-96 object-cover object-center w-full" src="{{asset('storage/images/' . $post->image)}}" alt="">
        <p class="text-center text-white text-4xl my-8">{{$post->dog_name}}</p>
        <video class="h-56 w-auto" src="{{ asset('storage/videos/' . $post->video)}}"></video>
        <a href="/user/{{$post->user_id}}">View {{$user->name}}</a>
</x-app-layout>