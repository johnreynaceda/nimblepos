<x-main-layout>
    <div class="px-4 mx-auto 2xl:max-w-7xl sm:px-6 md:px-8">
        <!-- === Remove and replace with your own content... === -->
        <div class="py-4">
            <h1 class="text-4xl font-bold text-gray-700">Welcome to Nimble POS</h1>

            <div class="mt-10 grid grid-cols-4 gap-5">
                <div class=" bg-white p-5  overflow-hidden rounded-2xl">
                    <div class="flex justify-between text-gray-700 items-end">
                        <h3 class="font-bold uppercase">Products</h3>
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
                    </div>
                    <div class="">
                        <span class="text-3xl font-semibold text-gray-800 font-poppins">
                            {{ \App\Models\Product::count() }}
                        </span>
                    </div>
                </div>
                <div class=" bg-white p-5  overflow-hidden rounded-2xl">
                    <div class="flex justify-between text-gray-700 items-end">
                        <h3 class="font-bold uppercase">SALES</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-timeline">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 16l6 -7l5 5l5 -6" />
                            <path d="M15 14m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M10 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M4 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M20 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        </svg>
                    </div>
                    <div class="">
                        <span
                            class="text-3xl font-semibold text-gray-800 font-poppins">&#8369;{{ number_format(\App\Models\Transaction::sum('total_amount'), 2) }}</span>
                    </div>
                </div>
                <div class=" bg-white p-5  overflow-hidden rounded-2xl">
                    <div class="flex justify-between text-gray-700 items-end">
                        <h3 class="font-bold uppercase">ORDER'S TODAY</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-transition-bottom">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M21 18a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3" />
                            <path d="M3 3m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v0a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                            <path d="M12 9v8" />
                            <path d="M9 14l3 3l3 -3" />
                        </svg>
                    </div>
                    <div class="">
                        <span
                            class="text-3xl font-semibold text-gray-800 font-poppins">{{ \App\Models\Transaction::whereDate('created_at', now())->count() }}</span>
                    </div>
                </div>

            </div>
            <livewire:admin-dashboard />
        </div>
        <!-- === End ===  -->
    </div>
</x-main-layout>
