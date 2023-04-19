<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.2/dist/flowbite.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-12 pt-6 px-4 sm:px-12 lg:px-8 relative">
                    {{ $header }}
                </div>
                @if(session()->has('success'))
                    <div class="mb-4 max-w-7xl mx-auto py-12 pt-6 px-4 sm:px-12 lg:px-8 relative">
                        <ul class="text-green-500">
                            <li>{{ session()->get('success') }}</li>
                        </ul>
                    </div>
                @endif
                
                <x-auth-validation-errors class="mb-4 max-w-7xl mx-auto py-12 pt-6 px-4 sm:px-12 lg:px-8 relative" :errors="$errors" />
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @php
            if(isset($script)){
                echo $script;
            }
        @endphp
        <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>

    </body>
</html>
