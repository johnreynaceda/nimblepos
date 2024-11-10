<div x-data="{ modalIsOpen: @entangle('receipt'), changeIsOpen: @entangle('change_modal') }">

    <div class="mx-10 relative">
        <div class="mr-[30rem]   ">
            <div class="px-5">
                <h1 class="font-bold text-xl font-poppins text-gray-700">POINT OF SALES</h1>
                <div class="mt-10">
                    <h1 class="text-sm text-gray-500">Menu Items({{ $products->count() }})</h1>
                    <div class="mt-4 flex space-x-3">

                        <button wire:click="$set('selected_category', '')"
                            class="{{ $selected_category == null ? 'bg-gray-500 text-white' : '' }} border hover:text-white hover:bg-gray-500 hover:scale-95 border-gray-400 rounded-full px-2 flex space-x-1 text-gray-800 py-1 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-package">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                <path d="M12 12l8 -4.5" />
                                <path d="M12 12l0 9" />
                                <path d="M12 12l-8 -4.5" />
                                <path d="M16 5.25l-8 4.5" />
                            </svg>
                            <span class="text-sm font-medium">All Menu</span>
                        </button>
                        @foreach ($categories as $category)
                            <button wire:click="$set('selected_category', {{ $category->id }})"
                                class="{{ $selected_category == $category->id ? 'bg-gray-500 text-white' : '' }} border hover:text-white hover:bg-gray-500 hover:scale-95 border-gray-400 rounded-full px-2 flex space-x-1 text-gray-800 py-1 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-package">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                    <path d="M12 12l8 -4.5" />
                                    <path d="M12 12l0 9" />
                                    <path d="M12 12l-8 -4.5" />
                                    <path d="M16 5.25l-8 4.5" />
                                </svg>
                                <span class="text-sm font-medium">{{ $category->name }}</span>
                            </button>
                        @endforeach

                    </div>
                </div>

                <div class="mt-10 grid grid-cols-5 gap-5 " x-auto-animate.linear>
                    @forelse ($products as $product)
                        <div wire:click="getProduct({{ $product->id }})"
                            class="bg-white cursor-pointer relative overflow-hidden hover:shadow-2xl hover:shadow-green-700  p-2 rounded-2xl">
                            <div class="absolute -right-2 -bottom-10">
                                <svg class="w-40 h-40 opacity-40 text-gray-200" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512" fill="currentColor">
                                    <path
                                        d="M384,352H184.36l-41,35-41-35H16v24c0,30.59,21.13,55.51,47.26,56,2.43,15.12,8.31,28.78,17.16,39.47C93.51,487.28,112.54,496,134,496H266c21.46,0,40.49-8.72,53.58-24.55,8.85-10.69,14.73-24.35,17.16-39.47,13.88-.25,26.35-7.4,35-18.63A61.26,61.26,0,0,0,384,376Z">
                                    </path>
                                    <path
                                        d="M105,320h0l38.33,28.19L182,320H384v-8a40.07,40.07,0,0,0-32-39.2c-.82-29.69-13-54.54-35.51-72C295.67,184.56,267.85,176,236,176H164c-68.22,0-114.43,38.77-116,96.8A40.07,40.07,0,0,0,16,312v8h89Z">
                                    </path>
                                    <path
                                        d="M463.08,96H388.49l8.92-35.66L442,45,432,16,370,36,355.51,96H208v32h18.75l1.86,16H236c39,0,73.66,10.9,100.12,31.52A121.9,121.9,0,0,1,371,218.07a124.16,124.16,0,0,1,10.73,32.65,72,72,0,0,1,27.89,90.9A96,96,0,0,1,416,376c0,22.34-7.6,43.63-21.4,59.95a80,80,0,0,1-31.83,22.95,109.21,109.21,0,0,1-18.53,33c-1.18,1.42-2.39,2.81-3.63,4.15H416c16,0,23-8,25-23l36.4-345H496V96Z">
                                    </path>
                                </svg>
                            </div>
                            <img src="{{ Storage::url($product->image_path) }}"
                                class="h-28 w-full object-cover rounded-xl relative" alt="">
                            <div class="mt-2 px-2 relative">
                                <h1 class="text-gray-700 font-semibold uppercase">{{ $product->name }}</h1>
                                <h1 class="text-sm font-medium text-gray-500">
                                    &#8369;{{ number_format($product->price, 2) }}</h1>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-5">
                            <span>No Products Available...</span>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
        <div class="fixed top-24 w-[28rem] right-16   rounded-xl   bg-white">
            <div class="p-5 px-6 border-b">
                <h1 class="font-medium text-gray-700">Order's Summary</h1>
                {{-- <h1 class="text-xs">#0823-0001</h1> --}}
                <h1 class="text-xs">{{ $transaction_number }}</h1>
            </div>
            <div class="p-5 px-6 flex flex-col h-full">
                <div class="flex justify-between items-center">
                    <div class="flex">
                        <span class="text-sm font-semibold">Total Items</span><span
                            class="font-poppins">({{ count($product_items) }})</span>
                    </div>
                    <div>
                        <x-button label="Clear All" xs negative wire:click="$set('product_items', [])" />
                    </div>
                </div>
                <div class="mt-10 lg:mt-0">
                    <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
                        <h3 class="sr-only">Items in your cart</h3>
                        {{-- <ul role="list" class="divide-y divide-gray-200 h-80 overflow-y-auto" x-auto-animate.linear>
                            @forelse ($product_items as $key => $item)
                                <li class="flex px-4 py-3 sm:px-6">
                                    <div class="flex-shrink-0">
                                        <img src="{{ Storage::url($item['image']) }}"
                                            class="h-20 w-20 object-cover rounded-md">
                                    </div>

                                    <div class="ml-2 flex flex-1 flex-col">
                                        <div class="flex">
                                            <div class="min-w-0 flex-1">
                                                <h4 class="text-sm">
                                                    <a href="#"
                                                        class="font-semibold text-gray-700 hover:text-gray-800 uppercase">{{ $item['name'] }}</a>
                                                </h4>
                                            </div>

                                            <div class="ml-4 flow-root flex-shrink-0">
                                                <button type="button" wire:click="removeProduct({{ $key }})"
                                                    class="-m-2.5 flex items-center justify-center bg-white p-2.5 text-red-400 hover:text-red-500">
                                                    <span class="sr-only">Remove</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-backspace">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M20 6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-11l-5 -5a1.5 1.5 0 0 1 0 -2l5 -5z" />
                                                        <path d="M12 10l4 4m0 -4l-4 4" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="flex flex-1 items-end justify-between pt-2">
                                            <div>
                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                    &#8369;{{ number_format($item['price'], 2) }}
                                                </p>
                                                <div class="">
                                                    <label for="quantity" class="sr-only">Quantity</label>
                                                    <span class="text-sm">Qty: {{ $item['quantity'] }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div
                                                    class="flex justify-between rounded-full border-2 border-gray-400 space-x-4 font-bold px-2 text-gray-500 ">
                                                    <button class="hover:text-red-500">-</button>
                                                    <span>0</span>
                                                    <button class="hover:text-green-500">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="px-4 py-3 sm:px-6 text-center text-gray-500">
                                    <div class="grid place-content-center mt-10 space-y-5">

                                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" class="h-40"
                                            viewBox="0 0 647.63626 632.17383"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <path
                                                d="M687.3279,276.08691H512.81813a15.01828,15.01828,0,0,0-15,15v387.85l-2,.61005-42.81006,13.11a8.00676,8.00676,0,0,1-9.98974-5.31L315.678,271.39691a8.00313,8.00313,0,0,1,5.31006-9.99l65.97022-20.2,191.25-58.54,65.96972-20.2a7.98927,7.98927,0,0,1,9.99024,5.3l32.5498,106.32Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#f2f2f2" />
                                            <path
                                                d="M725.408,274.08691l-39.23-128.14a16.99368,16.99368,0,0,0-21.23-11.28l-92.75,28.39L380.95827,221.60693l-92.75,28.4a17.0152,17.0152,0,0,0-11.28028,21.23l134.08008,437.93a17.02661,17.02661,0,0,0,16.26026,12.03,16.78926,16.78926,0,0,0,4.96972-.75l63.58008-19.46,2-.62v-2.09l-2,.61-64.16992,19.65a15.01489,15.01489,0,0,1-18.73-9.95l-134.06983-437.94a14.97935,14.97935,0,0,1,9.94971-18.73l92.75-28.4,191.24024-58.54,92.75-28.4a15.15551,15.15551,0,0,1,4.40966-.66,15.01461,15.01461,0,0,1,14.32032,10.61l39.0498,127.56.62012,2h2.08008Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#3f3d56" />
                                            <path
                                                d="M398.86279,261.73389a9.0157,9.0157,0,0,1-8.61133-6.3667l-12.88037-42.07178a8.99884,8.99884,0,0,1,5.9712-11.24023l175.939-53.86377a9.00867,9.00867,0,0,1,11.24072,5.9707l12.88037,42.07227a9.01029,9.01029,0,0,1-5.9707,11.24072L401.49219,261.33887A8.976,8.976,0,0,1,398.86279,261.73389Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#777777" />
                                            <circle cx="190.15351" cy="24.95465" r="20" fill="#777777" />
                                            <circle cx="190.15351" cy="24.95465" r="12.66462" fill="#fff" />
                                            <path
                                                d="M878.81836,716.08691h-338a8.50981,8.50981,0,0,1-8.5-8.5v-405a8.50951,8.50951,0,0,1,8.5-8.5h338a8.50982,8.50982,0,0,1,8.5,8.5v405A8.51013,8.51013,0,0,1,878.81836,716.08691Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#e6e6e6" />
                                            <path
                                                d="M723.31813,274.08691h-210.5a17.02411,17.02411,0,0,0-17,17v407.8l2-.61v-407.19a15.01828,15.01828,0,0,1,15-15H723.93825Zm183.5,0h-394a17.02411,17.02411,0,0,0-17,17v458a17.0241,17.0241,0,0,0,17,17h394a17.0241,17.0241,0,0,0,17-17v-458A17.02411,17.02411,0,0,0,906.81813,274.08691Zm15,475a15.01828,15.01828,0,0,1-15,15h-394a15.01828,15.01828,0,0,1-15-15v-458a15.01828,15.01828,0,0,1,15-15h394a15.01828,15.01828,0,0,1,15,15Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#3f3d56" />
                                            <path
                                                d="M801.81836,318.08691h-184a9.01015,9.01015,0,0,1-9-9v-44a9.01016,9.01016,0,0,1,9-9h184a9.01016,9.01016,0,0,1,9,9v44A9.01015,9.01015,0,0,1,801.81836,318.08691Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#777777" />
                                            <circle cx="433.63626" cy="105.17383" r="20" fill="#777777" />
                                            <circle cx="433.63626" cy="105.17383" r="12.18187" fill="#fff" />
                                        </svg>
                                        <p>No items
                                        <p>
                                    </div>
                                </li>
                            @endforelse
                        </ul> --}}
                        <ul role="list" class="divide-y divide-gray-200 h-80 overflow-y-auto" x-data>
                            @forelse ($product_items as $key => $item)
                                <li class="flex px-4 py-3 sm:px-6">
                                    <div class="flex-shrink-0">
                                        <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }} image"
                                            class="h-20 w-20 object-cover rounded-md">
                                    </div>

                                    <div class="ml-2 flex flex-1 flex-col">
                                        <div class="flex">
                                            <div class="min-w-0 flex-1">
                                                <h4 class="text-sm">
                                                    <a href="#"
                                                        class="font-semibold text-gray-700 hover:text-gray-800 uppercase">{{ $item['name'] }}</a>
                                                </h4>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <button type="button" wire:click="removeProduct({{ $key }})"
                                                    class="-m-2.5 flex items-center justify-center bg-white p-2.5 text-red-400 hover:text-red-500">
                                                    <span class="sr-only">Remove</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icon-tabler-backspace">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M20 6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-11l-5 -5a1.5 1.5 0 0 1 0 -2l5 -5z" />
                                                        <path d="M12 10l4 4m0 -4l-4 4" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="flex flex-1 items-end justify-between pt-2">
                                            <div>
                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                    &#8369;{{ number_format($item['price'], 2) }}
                                                </p>
                                                <div>
                                                    <label for="quantity" class="sr-only">Quantity</label>
                                                    <span class="text-sm">Qty: {{ $item['quantity'] }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div
                                                    class="flex justify-between rounded-full border-2 border-gray-400 space-x-2  px-4 text-gray-500">
                                                    <button wire:click="minusQty({{ $key }})"
                                                        class="hover:text-red-500 font-semibold">-</button>
                                                    <input type="text"
                                                        wire:model.live="product_items.{{ $key }}.quantity"
                                                        class="w-14 h-6 text-center border-0 focus:border-0 outline-none focus:outline-none" />
                                                    <button wire:click="addQty({{ $key }})"
                                                        class="hover:text-green-500 font-semibold">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="px-4 py-3 sm:px-6 text-center text-gray-500">
                                    <div class="grid place-content-center mt-10 space-y-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" class="h-40"
                                            viewBox="0 0 647.63626 632.17383"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <path
                                                d="M687.3279,276.08691H512.81813a15.01828,15.01828,0,0,0-15,15v387.85l-2,.61005-42.81006,13.11a8.00676,8.00676,0,0,1-9.98974-5.31L315.678,271.39691a8.00313,8.00313,0,0,1,5.31006-9.99l65.97022-20.2,191.25-58.54,65.96972-20.2a7.98927,7.98927,0,0,1,9.99024,5.3l32.5498,106.32Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#f2f2f2" />
                                            <path
                                                d="M725.408,274.08691l-39.23-128.14a16.99368,16.99368,0,0,0-21.23-11.28l-92.75,28.39L380.95827,221.60693l-92.75,28.4a17.0152,17.0152,0,0,0-11.28028,21.23l134.08008,437.93a17.02661,17.02661,0,0,0,16.26026,12.03,16.78926,16.78926,0,0,0,4.96972-.75l63.58008-19.46,2-.62v-2.09l-2,.61-64.16992,19.65a15.01489,15.01489,0,0,1-18.73-9.95l-134.06983-437.94a14.97935,14.97935,0,0,1,9.94971-18.73l92.75-28.4,191.24024-58.54,92.75-28.4a15.15551,15.15551,0,0,1,4.40966-.66,15.01461,15.01461,0,0,1,14.32032,10.61l39.0498,127.56.62012,2h2.08008Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#3f3d56" />
                                            <path
                                                d="M398.86279,261.73389a9.0157,9.0157,0,0,1-8.61133-6.3667l-12.88037-42.07178a8.99884,8.99884,0,0,1,5.9712-11.24023l175.939-53.86377a9.00867,9.00867,0,0,1,11.24072,5.9707l12.88037,42.07227a9.01029,9.01029,0,0,1-5.9707,11.24072L401.49219,261.33887A8.976,8.976,0,0,1,398.86279,261.73389Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#777777" />
                                            <circle cx="190.15351" cy="24.95465" r="20" fill="#777777" />
                                            <circle cx="190.15351" cy="24.95465" r="12.66462" fill="#fff" />
                                            <path
                                                d="M878.81836,716.08691h-338a8.50981,8.50981,0,0,1-8.5-8.5v-405a8.50951,8.50951,0,0,1,8.5-8.5h338a8.50982,8.50982,0,0,1,8.5,8.5v405A8.51013,8.51013,0,0,1,878.81836,716.08691Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#e6e6e6" />
                                            <path
                                                d="M723.31813,274.08691h-210.5a17.02411,17.02411,0,0,0-17,17v407.8l2-.61v-407.19a15.01828,15.01828,0,0,1,15-15H723.93825Zm183.5,0h-394a17.02411,17.02411,0,0,0-17,17v458a17.0241,17.0241,0,0,0,17,17h394a17.0241,17.0241,0,0,0,17-17v-458A17.02411,17.02411,0,0,0,906.81813,274.08691Zm15,475a15.01828,15.01828,0,0,1-15,15h-394a15.01828,15.01828,0,0,1-15-15v-458a15.01828,15.01828,0,0,1,15-15h394a15.01828,15.01828,0,0,1,15,15Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#3f3d56" />
                                            <path
                                                d="M801.81836,318.08691h-184a9.01015,9.01015,0,0,1-9-9v-44a9.01016,9.01016,0,0,1,9-9h184a9.01016,9.01016,0,0,1,9,9v44A9.01015,9.01015,0,0,1,801.81836,318.08691Z"
                                                transform="translate(-276.18187 -133.91309)" fill="#777777" />
                                            <circle cx="433.63626" cy="105.17383" r="20" fill="#777777" />
                                            <circle cx="433.63626" cy="105.17383" r="12.18187" fill="#fff" />
                                        </svg>
                                        <p>No items</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>


                        <div>

                            <dl class="space-y-2 border-t border-gray-200 px-4 py-6 sm:px-6">
                                <div class="border-y py-2">
                                    <x-toggle id="color-positive" wire:model.live="discountToogle" name="toggle"
                                        label="PWD/Senior Citizen Discount" positive xl />
                                </div>
                                <div class="flex items-center justify-between mt-5">
                                    <dt class="text-sm">Subtotal</dt>
                                    <dd class="text-sm font-medium text-gray-900">
                                        &#8369;{{ number_format($subtotal, 2) }}
                                    </dd>
                                </div>
                                <div class="flex items-center justify-between">
                                    <dt class="text-sm">Discount</dt>
                                    <dd class="text-sm font-medium text-gray-900">
                                        &#8369;{{ number_format($discount, 2) }}
                                    </dd>
                                </div>
                                <div class="flex items-center justify-between">
                                    <dt class="text-sm">VAT</dt>
                                    <dd class="text-sm font-medium text-gray-900">
                                        &#8369;{{ number_format($vat, 2) }}
                                    </dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                                    <dt class="text-base font-medium">Total</dt>
                                    <dd class="text-base font-medium text-gray-900">
                                        &#8369;{{ number_format($total, 2) }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div class="border-t border-gray-200 px-2 py-3 sm:px-2">
                            <x-button label="CONFIRM ORDER" wire:click="confirmOrder" spinner="confirmOrder" positive
                                class="w-full font-bold" right-icon="check-circle" lg />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- <div class="border hidden bg-white">
        <div id="printable-div" class=" print-content w-6/12">
            <div class="text-center">
                <h1>Garage91</h1>
                <h1>COMPANYNAME</h1>
                <h1>VAT Reg TIN:</h1>
                <h1>Nimble POS</h1>
            </div>
            <div class="mt-10">
                <h1>Official Receipt No. </h1>
                <h1>TXN Number:</h1>
                <h1>Cashier:</h1>
            </div>
            <div class="border-4 mt-5 border-gray-700"></div>
            <div class="mt-5">
                @foreach ($product_items as $key => $item)
                    <div class="grid grid-cols-4">
                        <div class="col-span-2">
                            {{ $item['name'] }}
                        </div>
                        <div>{{ $item['quantity'] }}x</div>
                        <div class="text-right">&#8369;{{ number_format($item['price'] * $item['quantity'], 2) }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-5">
                <div class="grid grid-cols-2">
                    <div class="font-bold text-right">SUBTOTAL:</div>
                    <div class="text-right">&#8369;{{ number_format($subtotal, 2) }}</div>
                </div>
            </div>
            <div class="mt-5">
                <div class="grid grid-cols-2">

                    <div class="">Vat Amount</div>
                    <div class="text-right">&#8369;{{ number_format($vat, 2) }}</div>
                    <div class="">Discount</div>
                    <div class="text-right">&#8369;{{ number_format($discount, 2) }}</div>
                    <div class="font-bold">TOTAL</div>
                    <div class="text-right">&#8369;{{ number_format($total, 2) }}</div>
                </div>

            </div>
            <div class="border-4 my-5 border-gray-700"></div>
            <div class="mt-5">
                <div class="text-center">
                    <h1>Thank you for shopping with us!</h1>
                </div>

            </div>
        </div>

    </div> --}}
    <div>

        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
            class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
            role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
            <!-- Modal Dialog -->
            <div x-show="modalIsOpen"
                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100"
                class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-2xl border border-slate-300 bg-white text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                <!-- Dialog Header -->
                <div
                    class="flex items-center justify-between border-b border-slate-300 bg-slate-100/60 p-4 dark:border-slate-700 dark:bg-slate-900/20">
                    <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-black dark:text-white">
                        Transaction Receipt</h3>
                    <a href="{{ route('admin.pos') }}" aria-label="close modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <!-- Dialog Body -->
                <div class="px-4 py-8 w-96">
                    <div id="printable-div" x-ref="printContainer" class=" print-content ">
                        <div class="text-center">
                            <h1>Garage91</h1>
                            <h1>COMPANYNAME</h1>
                            <h1>VAT Reg TIN:</h1>
                            <h1>Nimble POS</h1>
                        </div>
                        <div class="mt-10">
                            <h1>Official Receipt No.: {{ $transaction_number ?? 's' }}</h1>
                            <h1>TXN Number:</h1>
                            <h1>Cashier: {{ auth()->user()->name }}</h1>
                            <h1>{{ now()->format('F d, Y') }}</h1>
                        </div>
                        <div class="border-4 mt-5 border-gray-700"></div>
                        <div class="mt-5">
                            <span class="text-lg font-medium">Payment Method: {{ $transaction_type ?? '' }}</span>
                        </div>
                        <div class="mt-5">
                            @foreach ($product_items as $key => $item)
                                <div class="grid grid-cols-4">
                                    <div class="col-span-2">
                                        {{ $item['name'] }}
                                    </div>
                                    <div>{{ $item['quantity'] }}x</div>
                                    <div class="text-right">
                                        &#8369;{{ number_format($item['price'] * (float) $item['quantity'], 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-5">
                            <div class="grid grid-cols-2">
                                <div class="font-bold text-right">SUBTOTAL:</div>
                                <div class="text-right">&#8369;{{ number_format($subtotal, 2) }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="font-bold text-right">CASH</div>
                                <div class="text-right">&#8369;{{ number_format($cash, 2) }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="font-bold text-right">CHANGE</div>
                                <div class="text-right">&#8369;{{ number_format($change, 2) }}</div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="grid grid-cols-2">

                                <div class="">Vat Amount</div>
                                <div class="text-right">&#8369;{{ number_format($vat, 2) }}</div>
                                <div class="">Discount</div>
                                <div class="text-right">&#8369;{{ number_format($discount, 2) }}</div>
                                <div class="font-bold">TOTAL</div>
                                <div class="text-right font-bold">&#8369;{{ number_format($total, 2) }}</div>
                            </div>

                        </div>
                        <div class="border-4 my-5 border-gray-700"></div>
                        <h1>Customer Name: {{ $customer ?? '' }}</h1>
                        <div class="mt-5">
                            <div class="text-center">
                                <h1>Thank you for shopping with us!</h1>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Dialog Footer -->
                <div
                    class="flex flex-col-reverse justify-between gap-2 border-t border-slate-300 bg-slate-100/60 p-4 dark:border-slate-700 dark:bg-slate-900/20 sm:flex-row sm:items-center md:justify-end">
                    {{-- <button @click="modalIsOpen = false" type="button"
                        class="cursor-pointer whitespace-nowrap rounded-2xl px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-700 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:text-slate-300 dark:focus-visible:outline-blue-600">Remind
                        me later</button> --}}
                    <button type="button" @click="printOut($refs.printContainer.outerHTML);"
                        class="cursor-pointer whitespace-nowrap rounded-2xl bg-gray-700 px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">
                        Print Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div x-cloak x-show="changeIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="changeIsOpen"
            class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
            role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
            <!-- Modal Dialog -->
            <div x-show="changeIsOpen"
                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100"
                class="flex max-w-96 flex-col gap-4 overflow-hidden rounded-2xl border border-slate-300 bg-white text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                <!-- Dialog Header -->
                <div
                    class="flex items-center justify-between border-b border-slate-300 bg-slate-100/60 p-4 dark:border-slate-700 dark:bg-slate-900/20">
                    <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-black dark:text-white"></h3>
                    <button @click="changeIsOpen = false" aria-label="close modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Dialog Body -->
                <div class="px-4 py-4 w-96">
                    <div>
                        <h1 class="mb-2">TOTAL AMOUNT: <span
                                class="font-semibold">&#8369;{{ number_format($total, 2) }}</span> </h1>
                        <x-input label="Cash Amount" type="number" wire:model.live="cash" />
                    </div>
                    <div class="mt-3">
                        <h1 class="text-gray-600 text-sm">Change Amount: </h1>
                        <h1 class="font-semibold text-red-600 text-lg">&#8369;{{ number_format($change, 2) }}</h1>
                    </div>
                    <div class="mt-5">
                        <x-input label="Customer Name" type="text" wire:model.live="customer" />
                    </div>
                    <div class="mt-5">
                        <div class="relative flex w-full flex-col gap-1 text-slate-700 dark:text-slate-300">
                            <label for="os" class="w-fit pl-0.5 text-sm">Payment Method</label>

                            <select id="os" name="os" wire:model.live="transaction_type"
                                class="w-full appearance-none rounded-lg border border-slate-300  px-4 py-2 text-sm focus-visible:outline  disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800/50 dark:focus-visible:outline-blue-600">
                                <option selected>Please Select</option>
                                <option value="Cash">Cash</option>
                                <option value="GCash">GCash</option>
                            </select>
                        </div>
                        @error('transaction_type')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror


                    </div>
                </div>
                <!-- Dialog Footer -->
                <div
                    class="flex flex-col-reverse justify-between gap-2 border-t border-slate-300 bg-slate-100/60 p-4 dark:border-slate-700 dark:bg-slate-900/20 sm:flex-row sm:items-center md:justify-end">

                    <x-button label="PROCEED" right-icon="arrow-right" wire:click="proceed" spinner="proceed"
                        positive class="font-semibold" />
                </div>
            </div>
        </div>
    </div>

</div>
