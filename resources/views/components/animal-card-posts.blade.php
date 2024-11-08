@unless($post->is_review == 1)
<div class="w-full my-4 max-w-sm overflow-hidden bg-white border-2 dark:border-none border-gray-800 rounded-lg shadow-lg dark:bg-gray-800 relative">
    @if ($post->user->is(auth()->user()))
        <div class="absolute right-5 top-5 z-20 bg-gray-800 flex justify-center w-6 h-6 rounded-full">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('posts.edit', $post)">
                                {{ __('Edit') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                @csrf
                                @method('delete')
                                <x-dropdown-link :href="route('posts.destroy', $post)" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Delete') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
        @endif
    @unless($post->image == null)
        <img src="{{ asset('storage/images/' . $post->image) }}" alt="Dog" class="object-cover object-center w-full h-56">
    @endunless

    <div class="flex items-center justify-between px-6 py-3 bg-gray-900">
        <div class="flex">
            <svg class="w-6 h-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48.839 48.839">
                <g>
                    <path d="M39.041,36.843c2.054,3.234,3.022,4.951,3.022,6.742c0,3.537-2.627,5.252-6.166,5.252   c-1.56,0-2.567-0.002-5.112-1.326c0,0-1.649-1.509-5.508-1.354c-3.895-0.154-5.545,1.373-5.545,1.373   c-2.545,1.323-3.516,1.309-5.074,1.309c-3.539,0-6.168-1.713-6.168-5.252c0-1.791,0.971-3.506,3.024-6.742   c0,0,3.881-6.445,7.244-9.477c2.43-2.188,5.973-2.18,5.973-2.18h1.093v-0.001c0,0,3.698-0.009,5.976,2.181   C35.059,30.51,39.041,36.844,39.041,36.843z M16.631,20.878c3.7,0,6.699-4.674,6.699-10.439S20.331,0,16.631,0   S9.932,4.674,9.932,10.439S12.931,20.878,16.631,20.878z M10.211,30.988c2.727-1.259,3.349-5.723,1.388-9.971   s-5.761-6.672-8.488-5.414s-3.348,5.723-1.388,9.971C3.684,29.822,7.484,32.245,10.211,30.988z M32.206,20.878   c3.7,0,6.7-4.674,6.7-10.439S35.906,0,32.206,0s-6.699,4.674-6.699,10.439C25.507,16.204,28.506,20.878,32.206,20.878z    M45.727,15.602c-2.728-1.259-6.527,1.165-8.488,5.414s-1.339,8.713,1.389,9.972c2.728,1.258,6.527-1.166,8.488-5.414   S48.455,16.861,45.727,15.602z"/>
                </g>
                </svg>
    
            <h1 class="mx-3 text-lg font-semibold text-white">{{$post->species}}</h1>
        </div>
        <div class="flex items-center">
            @if(auth()->user()->image)
                    <div class="rounded-full h-4 w-4 bg-gray-300 mr-2">
                        <img src="{{ auth()->user()->image }}" alt="User Image" class="rounded-full h-20 w-20">
                    </div>
                @else
                    <div class="rounded-full h-4 w-4 bg-gray-300 mr-2"></div>
                @endif
            <a href="/user/{{$post->user_id}}" class="text-gray-900 dark:text-white">{{$post->user->name}}</a>
        </div>
    </div>

    <div class="px-6 py-4">
        <h1 class="text-xl font-semibold text-gray-800 dark:text-white">{{$post->pet_name}}</h1>

        <p class="py-2 text-gray-700 dark:text-gray-400">{{$post->message}}</p>

        <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
            <svg class="w-6 h-6 dark:text-white text-gray-800 fill-current" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24">
                <path d="M20.53 7.34822C20.0618 7.64077 19.4453 7.49865 19.1524 7.03084C19.0357 6.85333 18.905 6.68488 18.7695 6.52151C18.4985 6.1949 18.0945 5.76329 17.5678 5.34742C16.5152 4.51631 15.0206 3.78159 13.1104 3.99385C11.1002 4.21723 9.46561 5.10164 8.32821 6.45571C7.73245 7.16497 7.26033 8.0187 6.9452 8.99998H12C12.5523 8.99998 13 9.44769 13 9.99998C13 10.5523 12.5523 11 12 11H6.54506C6.51528 11.324 6.5 11.6576 6.5 12.0003C6.5 12.3428 6.51526 12.6761 6.545 13H12C12.5523 13 13 13.4477 13 14C13 14.5523 12.5523 15 12 15H6.945C7.26013 15.9815 7.73232 16.8353 8.32819 17.5447C9.46556 18.8986 11.1001 19.7829 13.1104 20.0063C15.0636 20.2233 16.5779 19.5773 17.6228 18.8624C18.1473 18.5035 18.5477 18.1306 18.8145 17.85C18.9457 17.7121 19.0755 17.5696 19.1884 17.4159C19.5101 16.9691 20.1328 16.8662 20.5812 17.1865C21.0257 17.504 21.1302 18.1392 20.8126 18.5831C20.648 18.8122 20.4577 19.0245 20.2636 19.2285C19.9211 19.5886 19.4152 20.0593 18.7522 20.513C17.4221 21.423 15.4364 22.277 12.8896 21.994C10.3999 21.7174 8.28443 20.602 6.79681 18.8311C5.89323 17.7554 5.23859 16.4592 4.86466 15H2C1.44771 15 1 14.5523 1 14C1 13.4477 1.44772 13 2 13H4.53804C4.51277 12.6724 4.5 12.339 4.5 12.0003C4.5 11.6614 4.51279 11.3277 4.53809 11H2C1.44771 11 1 10.5523 1 9.99998C1 9.44769 1.44772 8.99998 2 8.99998H4.86482C5.23877 7.54101 5.89335 6.24489 6.79679 5.16934C8.28439 3.39834 10.3998 2.28275 12.8896 2.00608C15.4794 1.71829 17.4848 2.73369 18.8072 3.7777C19.4679 4.2994 19.9703 4.83661 20.3086 5.24442C20.5005 5.47561 20.6854 5.715 20.847 5.96861C21.1364 6.43079 20.9927 7.05904 20.53 7.34822Z"/>
                </svg>

            <h1 class="px-2 text-sm">&euro;{{ number_format($post->price, 2, ','  ,   '.') }} per hour</h1>
        </div>

        <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
            <svg class="w-6 h-6 dark:text-white text-gray-800 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M19,4H17V3a1,1,0,0,0-2,0V4H9V3A1,1,0,0,0,7,3V4H5A3,3,0,0,0,2,7V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V7A3,3,0,0,0,19,4Zm1,15a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V12H20Zm0-9H4V7A1,1,0,0,1,5,6H7V7A1,1,0,0,0,9,7V6h6V7a1,1,0,0,0,2,0V6h2a1,1,0,0,1,1,1Z"/>
            </svg>

            <h1 class="px-2 text-sm">
                {{ \Carbon\Carbon::parse($post->start_date)->format('j F Y') }}
                &middot;
                {{ \Carbon\Carbon::parse($post->end_date)->format('j F Y') }}
            </h1>
        </div>

        <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
            @unless (Auth()->user()->id === $post->user_id)
                                @if ($aanvragen->isEmpty())
                                        <a class="bg-gray-200 text-gray-800 px-8 py-2 rounded-md font-semibold mb-4" href="/aanvraag/{{ $post->id }}">Aanvragen</a>
                                @else
                                    @php $heeftAangevraagd = false; @endphp
                                    @foreach ($aanvragen as $aanvraag)
                                        @if ($aanvraag->post_id === $post->id)
                                            @php $heeftAangevraagd = true; @endphp
                                            <p class="bg-gray-400 text-white px-6 py-2 rounded-md mb-4">je hebt al aangevraagd </p>
                                        @break
                                    @endif
                                @endforeach
                                @unless ($heeftAangevraagd)
                                    <a class="bg-gray-200 text-gray-800 px-8 py-2 rounded-md font-semibold mb-4" href="/aanvraag/{{ $post->id }}">Aanvragen</a>
                                @endunless
                            @endif
                        @endunless

        </div>
        <a href="/pet/{{$post->id}}" class="text-blue-500 mt-2 underline">see more</a>
    </div>
</div>
@endunless