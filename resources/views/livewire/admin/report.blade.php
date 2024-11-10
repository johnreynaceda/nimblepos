<div x-data>
    <div class="flex justify-between items-center">
        <div class="mb-5  flex space-x-3 items-center">
            <div>
                <x-datetime-picker wire:model.live="date_from" label="Date From" without-time without-timezone />
            </div>
            <div>
                <x-datetime-picker wire:model.live="date_to" label="Date To" without-time without-timezone />
            </div>
        </div>
        <div>
            <x-button @click="printOut($refs.printContainer.outerHTML);" class="font-semibold" icon="printer" slate
                label="Print Report" />
        </div>
    </div>
    <div class=" flex space-x-3 mb-5">
        <button wire:click="set('type', 1)"
            class="{{ $type == 1 ? 'bg-gray-600 text-white' : '' }} px-6 py-2 border-2 hover:bg-gray-600 hover:text-white text-sm border-gray-500 font-semibold text-gray-600 rounded-full">This
            Day</button>
        <button wire:click="set('type', 2)"
            class=" {{ $type == 2 ? 'bg-gray-600 text-white' : '' }} px-6 py-2 border-2 hover:bg-gray-600 hover:text-white text-sm border-gray-500 font-semibold text-gray-600 rounded-full">Last
            7 Days</button>
        <button wire:click="set('type', 3)"
            class=" {{ $type == 3 ? 'bg-gray-600 text-white' : '' }} px-6 py-2 border-2 hover:bg-gray-600 hover:text-white text-sm border-gray-500 font-semibold text-gray-600 rounded-full">This
            Month</button>
    </div>
    <div class="bg-white p-5" x-ref="printContainer">
        <table id="example" style="width:100%">
            <thead class="font-normal">
                <tr>
                    <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">TRANSACTION
                        NUMBER
                    </th>

                    <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                        PAYMENT METHOD
                    </th>
                    <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                        PRODUCT
                    </th>
                    <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                        COST
                    </th>
                    <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                        PROFIT
                    </th>

                    <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                        AMOUNT
                    </th>
                    <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                        DATE
                    </th>

                </tr>
            </thead>
            <tbody class="">
                @php
                    $grand_total_cost = 0;
                    $grand_total_profit = 0;
                @endphp
                @forelse ($reports as $item)
                    <tr>
                        <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                            {{ $item->transaction_number }}
                        </td>
                        <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                            {{ $item->transaction_type }}</td>
                        <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                            <ul>
                                @foreach ($item->transactionOrders as $product)
                                    <li>{{ $product->product->name }} x {{ $product->quantity }} </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                            @php
                                $total_cost = 0;
                                foreach ($item->transactionOrders as $key => $value) {
                                    $total_cost += $value->product->cost * $value->quantity;
                                }
                                $grand_total_cost += $total_cost;
                            @endphp
                            &#8369;{{ number_format($total_cost, 2) }}
                        </td>
                        <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                            @php
                                $total_profit = 0;
                                foreach ($item->transactionOrders as $key => $value) {
                                    $total_profit += $value->product->profit * $value->quantity;
                                }
                                $grand_total_profit += $total_profit;
                            @endphp
                            &#8369;{{ number_format($total_profit, 2) }}
                        </td>

                        <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                            &#8369;{{ number_format($item->total_amount, 2) }}
                        </td>
                        <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}
                        </td>
                    </tr>
                @empty
                    <td colspan="5" class="border border-gray-500  text-gray-700 text-sm text-center  px-3 py-1">
                        No Transaction found!
                    </td>
                @endforelse
                <tr>
                    <td colspan="2" class="border border-gray-500 "></td>
                    <td class="border border-gray-500 text-right font-semibold  text-gray-700 text-sm  px-3 py-1">
                        TOTAL:
                    </td>

                    <td class="border border-gray-500 text-gray-700 font-semibold text-sm  px-3 py-1">
                        &#8369;{{ number_format($grand_total_cost, 2) }}
                    </td>
                    <td class="border border-gray-500 text-gray-700 font-semibold text-sm  px-3 py-1">
                        &#8369;{{ number_format($grand_total_profit, 2) }}
                    </td>
                    <td class="border border-gray-500 text-gray-700 font-semibold text-sm  px-3 py-1">
                        &#8369;{{ number_format($reports->sum('total_amount'), 2) }}
                    </td>

                    <td colspan="2" class="border border-gray-500 "></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
