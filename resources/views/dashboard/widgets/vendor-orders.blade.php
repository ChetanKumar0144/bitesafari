<div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
    <h3 class="text-lg font-semibold mb-4">📦 My Orders</h3>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50">
            <p class="text-sm">Total Orders</p>
            <p class="text-2xl font-bold">{{ $vendorTotalOrders ?? 0 }}</p>
        </div>

        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50">
            <p class="text-sm">Pending Orders</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $vendorPendingOrders ?? 0 }}</p>
        </div>

        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50">
            <p class="text-sm">Completed Orders</p>
            <p class="text-2xl font-bold text-green-600">{{ $vendorCompletedOrders ?? 0 }}</p>
        </div>
    </div>
</div>
