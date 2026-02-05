<nav class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('customer.dashboard') }}"
           class="text-xl font-bold text-orange-600 flex items-center gap-1">
            🍔 BiteSafari
        </a>

        @if(auth()->guard('customer')->check())
            <div class="flex items-center gap-6 text-sm font-semibold">

                <a href="{{ route('customer.dashboard') }}"
                   class="text-gray-700 hover:text-blue-600">
                    Dashboard
                </a>

                <a href="{{ route('customer.menu') }}"
                   class="text-gray-600 hover:text-orange-600">
                    Menu
                </a>

                <a href="{{ route('customer.orders') }}"
                   class="text-gray-600 hover:text-orange-600">
                    My Orders
                </a>

                {{-- <a href="{{ route('customer.cart.index') }}"
                   class="text-gray-600 hover:text-orange-600">
                    My Cart
                </a> --}}

                <a href="{{ route('customer.profile') }}"
                   class="text-gray-600 hover:text-orange-600">
                    Profile
                </a>

                <form method="POST" action="{{ route('customer.logout') }}">
                    @csrf
                    <button class="text-red-500 hover:text-red-600">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <div class="flex items-center gap-6 text-sm font-semibold">
                <a href="{{ route('customer.login') }}" class="text-blue-600 hover:underline">
                    Login
                </a>
            </div>
        @endif

    </div>
</nav>
