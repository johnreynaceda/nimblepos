<div x-data="{ modalIsOpen: @entangle('modal') }">
    <li class="grid place-content-center">
        <button wire:click="set('modal', true)"
            class="text-red-700 hover:bg-red-300 p-1.5 rounded-full transition duration-200 ease-in-out transform hover:text-red-900 focus:shadow-outline hover:scale-95">
            <p class="mx-auto text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                    <path d="M15 12h-12l3 -3" />
                    <path d="M6 15l-3 -3" />
                </svg>
                <span class="sr-only"> home </span>
            </p>
        </button>
    </li>
    <div>

        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
            class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-sm sm:items-center lg:p-8"
            role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
            <!-- Modal Dialog -->
            <div x-show="modalIsOpen"
                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:enter-start="scale-0" x-transition:enter-end="scale-100"
                class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-2xl border border-slate-300 bg-white text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                <!-- Dialog Header -->
                <div
                    class="flex items-center justify-between border-b border-slate-300 bg-slate-100/60 px-4 py-2 dark:border-slate-700 dark:bg-slate-900/20">
                    <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-red-600 dark:text-white">Logout?
                    </h3>
                    <button @click="modalIsOpen = false" aria-label="close modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Dialog Body -->
                <div class="px-4 py-8">
                    <p>You are attempting to logout of Nimble POS.</p>
                    <p class="text-center">Are you Sure?</p>
                </div>
                <!-- Dialog Footer -->
                <div
                    class="flex flex-col-reverse justify-between gap-2 border-t border-slate-300 bg-slate-100/60 p-4 dark:border-slate-700 dark:bg-slate-900/20 sm:flex-row sm:items-center md:justify-end">

                    {{-- <button type="button" wire:click="confirmLogout"
                        class="cursor-pointer whitespace-nowrap rounded-2xl bg-green-700 px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Log
                        Out</button> --}}
                    <x-button label="Log Out" negative rounded="xl" class="font-semibold" wire:click="confirmLogout"
                        spinner="confirmLogout" right-icon="arrow-left-end-on-rectangle" />
                </div>
            </div>
        </div>
    </div>

</div>
