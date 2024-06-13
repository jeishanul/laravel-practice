<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex gap-2">
            <div>{{ __('Orders') }}</div>
            <div class="text-green-500">#&nbsp;{{ $order->invoice_number }}</div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-2 md:grid-cols-2 bg-gray-500 dark:bg-gray-800 p-4 rounded-md">
                <div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Customer Name: ') }}</div>
                        <div class="text-gray-700">{{ $order->user->name }}</div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Email: ') }}</div>
                        <div class="text-gray-700">{{ $order->user->email }}</div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Phone: ') }}</div>
                        <div class="text-gray-700">{{ $order->user->details->phone }}</div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Address: ') }}</div>
                        <div class="text-gray-700">
                            <div>
                                {{ $order->user->details->decodeAddress()->street . ', ' . $order->user->details->decodeAddress()->city . ', #' . $order->user->details->decodeAddress()->postcode . ', ' . $order->user->details->decodeAddress()->country }}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Invoice Number: ') }}</div>
                        <div class="text-gray-700">{{ $order->invoice_number }}</div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Order Date: ') }}</div>
                        <div class="text-gray-700">{{ $order->created_at }}</div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Order Status: ') }}</div>
                        @if ($order->status->value == 'pending')
                            <div
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-300 text-blue-800">
                                {{ ucfirst($order->status->value) }}
                            </div>
                        @elseif ($order->status->value == 'accepted')
                            <div
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                {{ ucfirst($order->status->value) }}
                            </div>
                        @else
                            <div
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                                {{ ucfirst($order->status->value) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Payment Status: ') }}</div>
                        @if ($order->payment_status->value == 'paid')
                            <div
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                {{ ucfirst($order->payment_status->value) }}
                            </div>
                        @else
                            <div
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                                {{ ucfirst($order->payment_status->value) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('SL') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Product Name') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Quantity') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Price') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200">
                        @foreach ($order->details as $key => $details)
                            <tr>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    {{ $key + 1 }}
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                    {{ $details->product->name }}
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                    {{ $details->quantity }}
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                    {{ $details->price }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
