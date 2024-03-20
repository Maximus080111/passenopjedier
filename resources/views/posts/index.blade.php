<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 flex flex-col">
        <a href="{{ route('posts.create') }}" class="bg-mossgreen text-white my-4 font-extrabold px-4 py-4 text-center rounded-lg min-w-full">Create post</a>
        <div class="mt-3 flex flex-col sm:flex-row gap-4 flex-wrap justify-around">
            @foreach ($posts as $post)
                <div class="bg-white shadow-sm rounded-lg border-mossgreen h-80 w-full sm:w-2/5 border-4 mb-4 relative">
                    <p class="absolute top-4 right-4 bg-white rounded-full h-20 w-20 flex items-center justify-center text-mossgreen font-extrabold text-xl">&euro;{{ number_format($post->price, 2, ',', '.') }}</p>
                    @unless($post->image == null)
                        <img src="{{ asset('storage/images/' . $post->image) }}" alt="Dog" class="rounded-sm h-full w-full  object-cover object-center">
                    @endunless
                    <div class="bg-white h-1/2 absolute w-full bottom-0 rounded-t-md rounded-r-md text-center p-4">
                        <h1 class="text-mossgreen font-extrabold text-3xl">{{$post->dog_name}}</h1>
                        <p class="mt-2 text-lg text-gray-900">{{ $post->message }}</p>
                        <div class="flex mt-2 items-center justify-center mb-4">
                            <p class="text-lg mx-4 text-mossgreen">species: {{$post->species}}</p>
                            <p class="text-lg mx-4 text-mossgreen">
                                {{ \Carbon\Carbon::parse($post->start_date)->format('j M') }}
                                &mdash;
                                {{ \Carbon\Carbon::parse($post->end_date)->format('j M') }}
                            </p>
                        </div>
                        @unless (Auth()->user()->id == $post->user_id)
                            @if($aanvragen->isEmpty())
                                <a class="bg-mossgreen px-6 py-2 rounded-md text-white mt-4" href="/aanvraag/{{ $post->id }}"> Aanvraag doen</a>
                            @endif
                            @foreach($aanvragen as $aanvraag)
                                @if($post->id == $aanvraag->post_id && Auth()->user()->id == $aanvraag->user_id)
                                    <p>Je hebt al een aanvraag gedaan</p>
                                    @break
                                @else
                                    <a class="bg-mossgreen px-6 py-2 rounded-md text-white mt-4" href="/aanvraag/{{ $post->id }}"> Aanvraag doen</a>
                                @endif
                            @endforeach
                        @endunless
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>