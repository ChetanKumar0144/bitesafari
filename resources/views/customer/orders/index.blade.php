<x-customer-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">🧾 My Orders</h2>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Order No</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3 text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $key => $order)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $key + 1 }}</td>

                            <td class="px-4 py-2 font-medium">
                                {{ $order->order_no }}
                            </td>

                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    @if($order->status==='pending') bg-yellow-100 text-yellow-700
                                    @elseif($order->status==='accepted') bg-blue-100 text-blue-700
                                    @elseif($order->status==='preparing') bg-indigo-100 text-indigo-700
                                    @elseif($order->status==='delivered') bg-green-100 text-green-700
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-2 text-center font-semibold">
                                ₹{{ number_format($order->total_amount, 2) }}
                            </td>

                            <td class="px-4 py-2 text-right">
                                <a href="{{ route('customer.orders.show', $order->id) }}"
                                   class="text-blue-600 hover:underline">
                                    View →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                No orders found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
</x-customer-layout>
