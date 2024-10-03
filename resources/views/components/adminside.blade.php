<div>
    <ul class="space-y-3 ">
        @if (auth()->user()->user_type != 'cashier')
            <li class=" grid place-content-center">
                <a href="{{ auth()->user()->user_type == 'admin' ? route('admin.dashboard') : route('manager.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') || request()->routeIs('manager.dashboard') ? 'text-gray-900 bg-gray-300' : 'text-gray-700' }}  hover:bg-gray-300 p-1.5 rounded-full transition duration-200 ease-in-out transform hover:text-gray-900 focus:shadow-outline hover:scale-95">
                    <p class="mx-auto text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg>
                        <span class="sr-only"> home </span>
                    </p>
                </a>
            </li>
        @endif
        @if (auth()->user()->user_type == 'admin')
            <li class=" grid place-content-center">
                <a href="{{ route('admin.category') }}"
                    class="{{ request()->routeIs('admin.category') ? 'text-gray-900 bg-gray-300' : 'text-gray-700' }}  hover:bg-gray-300 p-1.5 rounded-full transition duration-200 ease-in-out transform hover:text-gray-900 focus:shadow-outline hover:scale-95">
                    <p class="mx-auto text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-category-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 4h6v6h-6z" />
                            <path d="M4 14h6v6h-6z" />
                            <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        </svg>
                        <span class="sr-only"> category </span>
                    </p>
                </a>
            </li>
            <li class=" grid place-content-center">
                <a href="{{ route('admin.products') }}"
                    class="{{ request()->routeIs('admin.products') ? 'text-gray-900 bg-gray-300' : 'text-gray-700' }}  hover:bg-gray-300 p-1.5 rounded-full transition duration-200 ease-in-out transform hover:text-gray-900 focus:shadow-outline hover:scale-95">
                    <p class="mx-auto text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-salad">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M4 11h16a1 1 0 0 1 1 1v.5c0 1.5 -2.517 5.573 -4 6.5v1a1 1 0 0 1 -1 1h-8a1 1 0 0 1 -1 -1v-1c-1.687 -1.054 -4 -5 -4 -6.5v-.5a1 1 0 0 1 1 -1z" />
                            <path
                                d="M18.5 11c.351 -1.017 .426 -2.236 .5 -3.714v-1.286h-2.256c-2.83 0 -4.616 .804 -5.64 2.076" />
                            <path
                                d="M5.255 11.008a12.204 12.204 0 0 1 -.255 -2.008v-1h1.755c.98 0 1.801 .124 2.479 .35" />
                            <path d="M8 8l1 -4l4 2.5" />
                            <path d="M13 11v-.5a2.5 2.5 0 1 0 -5 0v.5" />
                        </svg>
                        <span class="sr-only"> products </span>
                    </p>
                </a>
            </li>
        @endif
        @if (auth()->user()->user_type == 'cashier')
            <li class=" grid place-content-center">
                <a href="{{ route('cashier.dashboard') }}"
                    class="{{ request()->routeIs('cashier.dashboard') ? 'text-gray-900 bg-gray-300' : 'text-gray-700' }}  hover:bg-gray-300 p-1.5 rounded-full transition duration-200 ease-in-out transform hover:text-gray-900 focus:shadow-outline hover:scale-95">
                    <p class="mx-auto text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-http-post">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 12h2a2 2 0 1 0 0 -4h-2v8" />
                            <path d="M12 8a2 2 0 0 1 2 2v4a2 2 0 1 1 -4 0v-4a2 2 0 0 1 2 -2z" />
                            <path
                                d="M17 15a1 1 0 0 0 1 1h2a1 1 0 0 0 1 -1v-2a1 1 0 0 0 -1 -1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1" />
                        </svg>
                        <span class="sr-only"> pos </span>
                    </p>
                </a>
            </li>
        @else
            <li class=" grid place-content-center">
                <a href="{{ auth()->user()->user_type == 'admin' ? route('admin.inventory') : route('manager.inventory') }}"
                    class="{{ request()->routeIs('admin.inventory') || request()->routeIs('manager.inventory') ? 'text-gray-900 bg-gray-300' : 'text-gray-700' }}  hover:bg-gray-300 p-1.5 rounded-full transition duration-200 ease-in-out transform hover:text-gray-900 focus:shadow-outline hover:scale-95">
                    <p class="mx-auto text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-analytics">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <path d="M9 17l0 -5" />
                            <path d="M12 17l0 -1" />
                            <path d="M15 17l0 -3" />
                        </svg>
                        <span class="sr-only"> inventory </span>
                    </p>
                </a>
            </li>
        @endif
    </ul>
    @if (auth()->user()->user_type == 'admin')
        <ul class="space-y-3 mt-10">
            <li class=" grid place-content-center">
                <a href="{{ route('admin.pos') }}"
                    class="{{ request()->routeIs('admin.pos') ? 'text-gray-900 bg-gray-300' : 'text-gray-700' }}  hover:bg-gray-300 p-1.5 rounded-full transition duration-200 ease-in-out transform hover:text-gray-900 focus:shadow-outline hover:scale-95">
                    <p class="mx-auto text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-http-post">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 12h2a2 2 0 1 0 0 -4h-2v8" />
                            <path d="M12 8a2 2 0 0 1 2 2v4a2 2 0 1 1 -4 0v-4a2 2 0 0 1 2 -2z" />
                            <path
                                d="M17 15a1 1 0 0 0 1 1h2a1 1 0 0 0 1 -1v-2a1 1 0 0 0 -1 -1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1" />
                        </svg>
                        <span class="sr-only"> pos </span>
                    </p>
                </a>
            </li>
            <li class=" grid place-content-center">
                <a href="{{ route('admin.report') }}"
                    class="{{ request()->routeIs('admin.report') ? 'text-gray-900 bg-gray-300' : 'text-gray-700' }}  hover:bg-gray-300 p-1.5 rounded-full transition duration-200 ease-in-out transform hover:text-gray-900 focus:shadow-outline hover:scale-95">
                    <p class="mx-auto text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-report">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M17 17m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M17 13v4h4" />
                            <path d="M12 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4" />
                        </svg>
                        <span class="sr-only"> report </span>
                    </p>
                </a>
            </li>
            <li class=" grid place-content-center">
                <a href="{{ route('admin.users') }}"
                    class=" {{ request()->routeIs('admin.users') ? 'text-gray-900 bg-gray-300' : 'text-gray-700' }}  hover:bg-gray-300 p-1.5 rounded-full transition duration-200 ease-in-out transform hover:text-gray-900 focus:shadow-outline hover:scale-95">
                    <p class="mx-auto text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                        <span class="sr-only"> user </span>
                    </p>
                </a>
            </li>
        </ul>
    @else
    @endif
</div>
