<x-main-layout>
    <div class="px-4 mx-auto 2xl:max-w-7xl sm:px-6 md:px-8">
        <!-- === Remove and replace with your own content... === -->
        <div class="py-4">
            <div class="flex space-x-3 items-end">

                <h1 class="text-3xl font-bold text-gray-700">Summary Report</h1>
            </div>
            <div class="mt-10 ">
                <livewire:admin.report />
                <script>
                    function printOut(data) {
                        var mywindow = window.open('', '', 'height=1000,width=1000');
                        mywindow.document.head.innerHTML =
                            '<title></title><link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}" />';
                        mywindow.document.body.innerHTML = '<div>' + data +
                            '</div><script src="{{ Vite::asset('resources/js/app.js') }}"/>';

                        mywindow.document.close();
                        mywindow.focus(); // necessary for IE >= 10

                        setTimeout(() => {
                            mywindow.print();
                            mywindow.onafterprint = function() {
                                mywindow.close();
                            };
                        }, 1000);
                    }
                </script>
            </div>
        </div>
        <!-- === End ===  -->
    </div>
</x-main-layout>
