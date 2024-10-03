<div x-data="{
    netsales: @entangle('netsales'),
    lastYearSales: @entangle('lastYearSales'),
    grossSales: @entangle('grossSales'),
    lastYearGrossSales: @entangle('lastYearGrossSales'),
    categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    initNetSalesChart() {
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                    name: 'Net Sales (This Year)',
                    data: this.netsales
                },
                {
                    name: 'Net Sales (Last Year)',
                    data: this.lastYearSales
                }
            ],
            xaxis: {
                categories: this.categories
            }
        };
        var chart = new ApexCharts(document.querySelector('#net-sales-chart'), options);
        chart.render();
    },
    initGrossSalesChart() {
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                    name: 'Gross Sales (This Year)',
                    data: this.grossSales
                },
                {
                    name: 'Gross Sales (Last Year)',
                    data: this.lastYearGrossSales
                }
            ],
            xaxis: {
                categories: this.categories
            }
        };
        var chart = new ApexCharts(document.querySelector('#gross-sales-chart'), options);
        chart.render();
    }
}" x-init="initNetSalesChart();
initGrossSalesChart();">
    <div class="mt-10 grid grid-cols-2 gap-5">
        <!-- Net Sales Chart -->
        <div class="bg-white p-5 rounded-xl">
            <h2 class="text-lg font-bold">Net Sales Chart</h2>
            <div id="net-sales-chart"></div>
        </div>
        <div class="bg-white p-5 rounded-xl">
            <h2 class="text-lg font-bold">Gross Sales Chart</h2>
            <div id="gross-sales-chart"></div>
        </div>
        <div class="bg-white p-5 rounded-xl">
            <div>
                <h2 class="text-lg font-bold">Low Stock</h2>
                <div class="mt-5">
                    <table id="example" style="width:100%">
                        <thead class="font-normal">
                            <tr>
                                <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    NAME
                                </th>
                                <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    BATCH CODE
                                </th>
                                <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    REMAINING STOCK
                                </th>
                                <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    EXPIRATION DATE
                                </th>



                            </tr>
                        </thead>
                        <tbody class="">
                            @forelse ($lows as $item)
                                <tr>
                                    <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                                        {{ $item->inventoryStock->name }}
                                    </td>
                                    <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                                        {{ $item->batch_code }}
                                    </td>
                                    <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                                        {{ $item->stock_quantity }}
                                    </td>
                                    <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                                        {{ \Carbon\Carbon::parse($item->expiration_date)->format('F d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-1 border border-gray-500">
                                        No data Available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">

                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl">

            <div class="">
                <h2 class="text-lg font-bold">Expired Stocks</h2>
                <div class="mt-5">
                    <table id="example" style="width:100%">
                        <thead class="font-normal">
                            <tr>
                                <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    NAME
                                </th>
                                <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    BATCH CODE
                                </th>
                                <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    REMAINING STOCK
                                </th>
                                <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    EXPIRATION DATE
                                </th>
                                <th class="border border-gray-500  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    STATUS
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @forelse ($expires as $item)
                                <tr>
                                    <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                                        {{ $item->inventoryStock->name }}
                                    </td>
                                    <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                                        {{ $item->batch_code }}
                                    </td>
                                    <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                                        {{ $item->stock_quantity }}
                                    </td>
                                    <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                                        {{ \Carbon\Carbon::parse($item->expiration_date)->format('F d, Y') }}
                                    </td>
                                    <td class="border border-gray-500  text-gray-700 text-sm  px-3 py-1">
                                        @switch($item->is_active)
                                            @case(1)
                                                <span class="text-green-600">Active</span>
                                            @break

                                            @case(0)
                                                <span class="text-red-600">Inactive</span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-1 border border-gray-500">
                                            No data Available.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Gross Sales Chart inside a black div -->


    </div>
