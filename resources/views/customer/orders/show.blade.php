<x-customer-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">
                🧾 Order {{ $order->order_no }}
            </h2>

            <a href="{{ route('customer.orders') }}"
               class="text-sm text-blue-600 hover:underline">
                ← My Orders
            </a>
        </div>
    </x-slot>

    <div class="p-6 space-y-6">

        {{-- Order Summary --}}
        <div class="bg-white rounded shadow p-5 grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-500">Order No</p>
                <p class="font-semibold">{{ $order->order_no }}</p>
            </div>

            <div>
                <p class="text-gray-500">Total Amount</p>
                <p class="font-semibold">₹{{ number_format($order->total_amount,2) }}</p>
            </div>

            <div>
                <p class="text-gray-500">Order Date</p>
                <p class="font-semibold">
                    {{ $order->created_at->format('d M Y, h:i A') }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Status</p>
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                    @if($order->status==='pending') bg-yellow-100 text-yellow-700
                    @elseif($order->status==='accepted') bg-blue-100 text-blue-700
                    @elseif($order->status==='preparing') bg-indigo-100 text-indigo-700
                    @elseif($order->status==='delivered') bg-green-100 text-green-700
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        {{-- Order Timeline --}}
        <div class="bg-white rounded shadow p-5">
            <h3 class="font-semibold mb-4">📦 Order Progress</h3>

            @php
                $steps = ['pending', 'accepted', 'preparing', 'delivered'];
            @endphp

            <div class="flex items-center justify-between">
                @foreach($steps as $step)
                    <div class="flex-1 text-center">
                        <div class="mx-auto w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold
                            {{ $order->status === $step
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-200 text-gray-500' }}">
                            {{ $loop->iteration }}
                        </div>

                        <p class="mt-2 text-xs font-semibold capitalize
                            {{ $order->status === $step ? 'text-blue-600' : 'text-gray-400' }}">
                            {{ $step }}
                        </p>
                    </div>

                    @if(!$loop->last)
                        <div class="flex-1 h-1
                            {{ array_search($order->status, $steps) > array_search($step, $steps)
                                ? 'bg-blue-600'
                                : 'bg-gray-200' }}">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Ordered Items --}}
        <div class="bg-white rounded shadow p-5">
            <h3 class="font-semibold mb-4">🍽 Ordered Items</h3>

            <div class="space-y-3">
                @foreach($order->items as $item)
                    <div class="flex justify-between items-center border-b pb-2">
                        <div>
                            <p class="font-medium">{{ $item->food_name }}</p>
                            <p class="text-xs text-gray-500">
                                Qty: {{ $item->quantity }}
                            </p>
                        </div>

                        <p class="font-semibold">
                            ₹{{ number_format($item->price * $item->quantity,2) }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-customer-layout>
