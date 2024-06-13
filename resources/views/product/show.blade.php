<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-gray-300">{{ $product->name }}</h2>
                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                        class="w-full h-64 object-cover rounded-lg">
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">{{ 'Description' }}</h2>
                    <p class="text-gray-300">{{ $product->description }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">{{ 'Product Details' }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-10 gap-4">
                        <div class="sm:col-span-6">
                            <div class="flex gap-2">
                                <p>{{ __('Barcode:') }}</p>
                                <p class="text-gray-300">{{ $product->barcode }}</p>
                            </div>
                            <div class="flex gap-2">
                                <p>{{ __('Price:') }}</p>
                                <p class="text-gray-300">{{ $product->price }}</p>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <div class="flex gap-2">
                                <p>{{ __('Stock:') }}</p>
                                <p class="text-gray-300">{{ $product->stock }}</p>
                            </div>
                            <div class="flex gap-2">
                                <p>{{ __('Total Sale:') }}</p>
                                <p class="text-gray-300">{{ $product->orderDetails->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
