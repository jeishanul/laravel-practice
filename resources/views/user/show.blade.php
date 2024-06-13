<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-2 md:grid-cols-2 bg-gray-500 dark:bg-gray-800 p-4 rounded-md">
                <div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Customer Name: ') }}</div>
                        <div class="text-gray-700">{{ $user->name }}</div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Email: ') }}</div>
                        <div class="text-gray-700">{{ $user->email }}</div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Phone: ') }}</div>
                        <div class="text-gray-700">{{ $user->details->phone }}</div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Address: ') }}</div>
                        <div class="text-gray-700">
                            <div>
                                {{ $user->details->decodeAddress()->street . ', ' . $user->details->decodeAddress()->city . ', #' . $user->details->decodeAddress()->postcode . ', ' . $user->details->decodeAddress()->country }}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex gap-4 mb-4">
                        <div class="font-bold">{{ __('Total Amount: ') }}</div>
                        <div class="text-gray-700">{{ $orders->sum('total') }}</div>
                    </div>

                    <div class="flex gap-3 mb-4">
                        <div class="flex gap-2">
                            <div class="font-bold">{{ __('Total Pending Orders: ') }}</div>
                            <div class="text-gray-700">{{ $orders->where('status', 'pending')->count() }},</div>
                        </div>
                        <div class="flex gap-2">
                            <div class="font-bold">{{ __('Total Accepted Orders: ') }}</div>
                            <div class="text-gray-700">{{ $orders->where('status', 'accepted')->count() }},</div>
                        </div>
                        <div class="flex gap-2">
                            <div class="font-bold">{{ __('Total Rejected Orders: ') }}</div>
                            <div class="text-gray-700">{{ $orders->where('status', 'rejected')->count() }}</div>
                        </div>
                    </div>

                    <div class="flex gap-3 mb-4">
                        <div class="flex gap-2">
                            <div class="font-bold">{{ __('Total Paid Orders: ') }}</div>
                            <div class="text-gray-700">{{ $orders->where('payment_status', 'paid')->count() }},</div>
                        </div>
                        <div class="flex gap-2">
                            <div class="font-bold">{{ __('Total Unpaid Orders: ') }}</div>
                            <div class="text-gray-700">{{ $orders->where('payment_status', 'unpaid')->count() }}</div>
                        </div>
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
                                {{ __('Invoice No') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Total') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Status') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Payment Status') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Order Date') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                    {{ $order->invoice_number }}
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                    {{ $order->total }}
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                    @if ($order->status == 'pending')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-300 text-blue-800">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @elseif ($order->status == 'accepted')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                    @if ($order->payment_status == 'paid')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                    {{ $order->created_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex items-center justify-center gap-2">
                                    <a href="{{ route('orders.show', $order) }}"
                                        class="text-blue-600 hover:text-blue-900">{{ __('Show') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <td class="px-6 py-4 text-center" colspan="8">
                                {{ $orders->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
