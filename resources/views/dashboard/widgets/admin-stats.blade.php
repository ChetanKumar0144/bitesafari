<div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
    <h3 class="text-lg font-semibold mb-4">🛠 Admin Stats</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50">
            <p class="text-sm">Top Selling Food</p>
            <p class="text-2xl font-bold">{{ $topFood ?? 'N/A' }}</p>
        </div>

        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50">
            <p class="text-sm">Pending Deliveries</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $pendingDeliveries ?? 0 }}</p>
        </div>

        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50">
            <p class="text-sm">Revenue (This Month)</p>
            <p class="text-2xl font-bold text-green-600">₹ {{ number_format($monthlyRevenue ?? 0) }}</p>
        </div>

        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50">
            <p class="text-sm">New Customers</p>
            <p class="text-2xl font-bold">{{ $newCustomers ?? 0 }}</p>
        </div>
    </div>
</div>
