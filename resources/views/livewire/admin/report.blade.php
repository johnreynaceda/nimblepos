<div>
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
            <x-button class="font-semibold" icon="printer" slate label="Print Report" />
        </div>
    </div>
    <div class="bg-white p-5">
        <table id="example" style="width:100%">
            <thead class="font-normal">
                <tr>
                    <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">TRANSACTION
                        NUMBER
                    </th>

                    <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                        TYPE
                    </th>
                    <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                        CUSTOMER
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

                @forelse ($reports as $item)
                    <tr>
                        <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                            {{ $item->transaction_number }}
                        </td>
                        <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                            {{ $item->transaction_type }}</td>
                        <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">{{ $item->customer_name }}
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
                    <td colspan="2" class=""></td>
                    <td class="border border-gray-500 text-right font-semibold  text-gray-700 text-sm  px-3 py-1">
                        TOTAL:
                    </td>
                    <td class="border border-gray-500 text-gray-700 font-semibold text-sm  px-3 py-1">
                        &#8369;{{ number_format($reports->sum('total_amount'), 2) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
