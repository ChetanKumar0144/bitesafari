<aside class="w-64 bg-gray-900 text-white">
    <div class="p-4 text-xl font-bold border-b border-gray-700">
        🍔 BiteSafari Admin
    </div>

    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="block px-3 py-2 rounded hover:bg-gray-700
           {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
            Dashboard
        </a>

        <a href="#"
           class="block px-3 py-2 rounded hover:bg-gray-700">
            Foods
        </a>

        <a href="#"
           class="block px-3 py-2 rounded hover:bg-gray-700">
            Orders
        </a>
    </nav>
</aside>
