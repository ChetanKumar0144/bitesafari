<x-customer-layout>
    <x-slot name="header">
        My Cart
    </x-slot>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->count() > 0)
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">Food</th>
                        <th class="p-3">Price</th>
                        <th class="p-3">Qty</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp

                    @foreach($cartItems as $item)
                        @php
                            $total = $item['price'] * $item['qty'];
                            $grandTotal += $total;
                        @endphp
                        <tr class="border-t">
                            <td class="p-3">{{ $item['name'] }}</td>
                            <td class="p-3">₹{{ $item['price'] }}</td>
                            <td class="p-3">{{ $item['qty'] }}</td>
                            <td class="p-3 font-semibold">₹{{ $total }}</td>
                            <td class="p-3">
                                <form method="POST" action="{{ route('customer.cart.remove', $item['food_id']) }}">
                                    @csrf
                                    <button class="text-red-600 text-sm">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mt-6">
            <div class="text-lg font-bold">
                Grand Total: ₹{{ $grandTotal }}
            </div>

            <a href="{{ route('customer.checkout') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded">
                Checkout
            </a>
        </div>
    @else
        <div class="bg-white p-6 rounded shadow text-center">
            <p class="text-gray-600">Your cart is empty</p>
            <a href="{{ route('customer.menu') }}"
               class="text-green-600 mt-2 inline-block">
                Browse Menu
            </a>
        </div>
    @endif
</x-customer-layout>
