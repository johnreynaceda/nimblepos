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
    <script src="https://cdn.jsdelivr.net/npm/@marcreichel/alpine-auto-animate@latest/dist/alpine-auto-animate.min.js"
        defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @wireUiScripts
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 6px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">
    <x-dialog z-index="z-50" blur="md" align="center" />
    <div class="flex h-screen overflow-hidden bg-gradient-to-tl from-gray-300 to-gray-100">
        <nav class="flex flex-col justify-between w-20 bg-white border-r">
            <div class="mt-5 mb-10">
                <a href="#">
                    <img src="{{ asset('images/logo.jpg') }}" class="object-cover w-10 h-10 mx-auto mb-3 rounded-xl">
                </a>
                <div class="mt-10">
                    <x-adminside />
                </div>
            </div>
            <div class="mb-4 ">
                <ul class="space-y-3">
                    {{-- <li class="grid place-content-center">
                        <a href="#"
                            class="text-gray-700 hover:bg-gray-300 p-1.5 rounded-full transition duration-200 ease-in-out transform hover:text-gray-900 focus:shadow-outline hover:scale-95">
                            <p class="mx-auto text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                </svg>
                                <span class="sr-only"> home </span>
                            </p>
                        </a>
                    </li> --}}
                    <livewire:logout />
                </ul>

            </div>
        </nav>
        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            <main class="relative flex-1 overflow-y-auto focus:outline-none">
                <div class="bg-white py-3 sticky top-0 z-10 flex items-center justify-between px-10">
                    <div class="">
                        <span class="font-black text-xl font-poppins text-gray-700">Nimble POS</span>
                        <span class="text-xs">2024</span>
                    </div>
                    <div class="flex space-x-3 items-center border py-1 px-4 rounded-xl">
                        <div class="border rounded-full overflow-hidden"><img src="{{ asset('images/sample.png') }}"
                                class="h-12 w-12 object-cover" alt="">
                        </div>
                        <div class="text-gray-700">
                            <h1 class="uppercase font-bold  font-poppins underline">
                                {{ auth()->user()->name }}</h1>
                            <h1 class="leading-3 text-sm ">{{ ucfirst(auth()->user()->user_type) }}</h1>

                        </div>
                    </div>
                </div>
                <div class="py-6">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
