<x-app-layout>
        <p>{{$post->dog_name}}</p>
        <img class="h-56 w-auto" src="{{asset('storage/images/' . $post->image)}}" alt="">
        <video class="h-56 w-auto" src="{{ asset('storage/videos/' . $post->video)}}"></video>
</x-app-layout>