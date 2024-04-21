<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PassenOpJeDier.nl</title>

        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-800  h-screen">
            @if (Route::has('login'))
                <div class="sm:fixed text-gray-900 dark:text-white sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a class="mx-4" href="{{ route('login') }}">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="flex justify-center items-center h-full">
                <div class="text-center mx-10">
                    <h1 class="font-bold text-5xl md:text-6xl text-gray-900 dark:text-white">PassenOpJeDier</h1>
                    <h2 class="text-gray-700 dark:text-white text-xl md:text-2xl mt-4">Vind de perfecte oppas voor je huisdier, waar je ook bent!</h2>
                </div>
            </div>
    </body>
</html>
