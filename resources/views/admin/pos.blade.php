<x-main-layout>
    <div>
        <livewire:admin.point-of-sale />
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
</x-main-layout>
