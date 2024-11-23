<div x-data>
    <div class="flex justify-between items-center mb-5">
        <div class="flex space-x-3 items-center">
            <x-datetime-picker wire:model.live="date_from" label="Date From" without-time without-timezone />
            <x-datetime-picker wire:model.live="date_to" label="Date To" without-time without-timezone />
        </div>
        <x-button @click="printOut($refs.printContainer.outerHTML);" class="font-semibold" icon="printer" slate
            label="Print Report" />
    </div>

    <div class="flex space-x-3 mb-5">
        <button wire:click="set('type', 1)" @class([
            'px-6 py-2 border-2 text-sm font-semibold rounded-full hover:bg-gray-600 hover:text-white',
            'bg-gray-600 text-white' => $type == 1,
            'text-gray-600 border-gray-500' => $type != 1,
        ])>
            This Day
        </button>
        <button wire:click="set('type', 2)" @class([
            'px-6 py-2 border-2 text-sm font-semibold rounded-full hover:bg-gray-600 hover:text-white',
            'bg-gray-600 text-white' => $type == 2,
            'text-gray-600 border-gray-500' => $type != 2,
        ])>
            Last 7 Days
        </button>
        <button wire:click="set('type', 3)" @class([
            'px-6 py-2 border-2 text-sm font-semibold rounded-full hover:bg-gray-600 hover:text-white',
            'bg-gray-600 text-white' => $type == 3,
            'text-gray-600 border-gray-500' => $type != 3,
        ])>
            This Month
        </button>
    </div>

    <div class="bg-white p-5" x-ref="printContainer">
        <table id="example" class="w-full border-collapse border">
            <thead>
                <tr>
                    <th class="border border-gray-500 px-2 py-2 text-left text-sm font-bold text-gray-700">TRANSACTION
                        NUMBER</th>
                    <th class="border border-gray-500 px-2 py-2 text-left text-sm font-bold text-gray-700">PAYMENT
                        METHOD</th>
                    <th class="border border-gray-500 px-2 py-2 text-left text-sm font-bold text-gray-700">USER</th>
                    <th class="border border-gray-500 px-2 py-2 text-left text-sm font-bold text-gray-700">PRODUCT</th>
                    <th class="border border-gray-500 px-2 py-2 text-left text-sm font-bold text-gray-700">COST</th>
                    <th class="border border-gray-500 px-2 py-2 text-left text-sm font-bold text-gray-700">PROFIT</th>
                    <th class="border border-gray-500 px-2 py-2 text-left text-sm font-bold text-gray-700">AMOUNT</th>
                    <th class="border border-gray-500 px-2 py-2 text-left text-sm font-bold text-gray-700">DATE</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grand_total_cost = 0;
                    $grand_total_profit = 0;
                @endphp
                @forelse ($reports as $item)
                    @php
                        $total_cost = $item->transactionOrders->sum(
                            fn($order) => $order->product->cost * $order->quantity,
                        );
                        $total_profit = $item->transactionOrders->sum(
                            fn($order) => $order->product->profit * $order->quantity,
                        );

                        $grand_total_cost += $total_cost;
                        $grand_total_profit += $total_profit;
                    @endphp
                    <tr>
                        <td class="border border-gray-500 px-3 py-1 text-gray-700 text-sm">
                            {{ $item->transaction_number }}</td>
                        <td class="border border-gray-500 px-3 py-1 text-gray-700 text-sm">{{ $item->transaction_type }}
                        </td>
                        <td class="border border-gray-500 px-3 py-1 text-gray-700 text-sm">{{ $item->username }}
                        </td>
                        <td class="border border-gray-500 px-3 py-1 text-gray-700 text-sm">
                            <ul>
                                @foreach ($item->transactionOrders as $product)
                                    <li>{{ $product->product->name }} x {{ $product->quantity }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="border border-gray-500 px-3 py-1 text-gray-700 text-sm">
                            &#8369;{{ number_format($total_cost, 2) }}
                        </td>
                        <td class="border border-gray-500 px-3 py-1 text-gray-700 text-sm">
                            &#8369;{{ number_format($total_profit, 2) }}
                        </td>
                        <td class="border border-gray-500 px-3 py-1 text-gray-700 text-sm">
                            &#8369;{{ number_format($item->total_amount, 2) }}
                        </td>
                        <td class="border border-gray-500 px-3 py-1 text-gray-700 text-sm">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border border-gray-500 px-3 py-1 text-center text-gray-700 text-sm">
                            No Transaction Found!
                        </td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="4"
                        class="border border-gray-500 text-right font-semibold text-gray-700 text-sm px-3 py-1">
                        TOTAL:
                    </td>
                    <td class="border border-gray-500 text-gray-700 font-semibold text-sm px-3 py-1">
                        &#8369;{{ number_format($grand_total_cost, 2) }}
                    </td>
                    <td class="border border-gray-500 text-gray-700 font-semibold text-sm px-3 py-1">
                        &#8369;{{ number_format($grand_total_profit, 2) }}
                    </td>
                    <td class="border border-gray-500 text-gray-700 font-semibold text-sm px-3 py-1">
                        &#8369;{{ number_format($reports->sum('total_amount'), 2) }}
                    </td>
                    <td class="border border-gray-500"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
