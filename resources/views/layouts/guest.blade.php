<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased h-screen bg-gradient-to-tl from-gray-300 to-gray-100">
    <img src="{{ asset('images/logo.jpg') }}" class="absolute bottom-0 object-cover w-full opacity-5 rounded-3xl"
        alt="">
    <section class="relative">
        <div class="px-8 py-40 mx-auto md:px-12 lg:px-32 max-w-7xl">
            <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-24">
                <div class="">
                    <img src="{{ asset('images/logo.jpg') }}" class="h-36 rounded-2xl flex-shrink-0" alt="">
                    <h1 class="text-4xl mt-5 font-poppins font-black tracking-tighter text-gray-700 lg:text-5xl">
                        Nimble POS
                    </h1>
                    <h1 class="text-sm">Since 2024</h1>

                </div>
                <div class="p-2 border bg-gray-600 shadow-xl rounded-3xl">
                    <div class="p-10 bg-white border shadow-lg rounded-2xl">
                        {{-- <div>
                            <button
                                class="inline-flex items-center justify-center w-full h-12 gap-3 px-5 py-3 font-medium duration-200 bg-gray-100 rounded-xl hover:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                type="button" aria-label="Sign in with Google">
                                <ion-icon name="logo-google" role="img" class="md hydrated"
                                    aria-label="logo google"></ion-icon>
                                <span>Sign in with Google</span>
                            </button>
                            <div class="relative py-3">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center">
                                    <span class="px-2 text-sm text-black bg-white">Or continue with</span>
                                </div>
                            </div>
                        </div> --}}
                        <div class="mb-5">
                            <h1 class="text-lg font-semibold"> Welcome.</h1>
                            <p class="text-sm">Please enter your credentials.</p>
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
