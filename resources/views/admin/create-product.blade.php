<x-main-layout>
    <div class="px-4 mx-auto 2xl:max-w-7xl sm:px-6 md:px-8">
        <!-- === Remove and replace with your own content... === -->
        <div class="py-4">
            <div class="flex space-x-3 items-end">
                <x-button label="BACK" rounded="lg" href="{{ route('admin.products') }}" icon="arrow-uturn-left"
                    class="font-bold" slate sm />
                <h1 class="text-3xl font-bold text-gray-700">Add New Product</h1>
            </div>
            <div class="mt-10 bg-white p-10 rounded-xl">
                <livewire:admin.create-product />
            </div>
        </div>
        <!-- === End ===  -->
    </div>
</x-main-layout>
