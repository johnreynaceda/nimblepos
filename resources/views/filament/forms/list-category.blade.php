<div>
    <div class="overflow-hidden w-full overflow-x-auto  border border-slate-300 dark:border-slate-700">
        <table class="w-full text-left text-sm text-slate-700 dark:text-slate-300">
            <thead
                class="border-b border-slate-300 bg-gray-700 text-sm text-white dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                <tr>
                    <th scope="col" class="p-4">CATEGORY NAME</th>

                    <th scope="col" class="p-4">ACTION</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-300 dark:divide-slate-700">
                @foreach ($this->stock_categories as $item)
                    <tr>

                        <td class="p-4">{{ $item->name }}</td>

                        <td class="p-4"><button type="button"
                                class="cursor-pointer whitespace-nowrap rounded-2xl bg-transparent p-0.5 font-semibold text-blue-700 outline-blue-700 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 dark:text-blue-600 dark:outline-blue-600">Delete</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


</div>
