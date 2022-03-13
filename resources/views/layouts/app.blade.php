<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-gray-200">

        {{-- Navbar --}}
        <nav class="p-6 bg-white flex justify-between mb-6">

            {{-- LHS Links --}}
            <ul class="flex items-center">
                <li><a href="/" class="p-3">Home</a></li>
                <li><a href="/" class="p-3">Dashboard</a></li>
                <li><a href="/" class="p-3">Post</a></li>
            </ul>

            {{-- RHS Links --}}
            <ul class="flex items-center">
                @auth
                    <li><a href="/" class="p-3">Kiran Anand</a></li>
                    <li><a href="/" class="p-3">Login</a></li>
                @endauth

                @guest
                    <li><a href="{{ route('register') }}" class="p-3">Regsiter</a></li>
                    <li><a href="/" class="p-3">Logout</a></li>
                @endguest
            </ul>

        </nav>

        {{-- Content --}}
        @yield('content')

    </body>

</html>
