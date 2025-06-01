<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Admin Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="font-semibold text-gray-700">Total Revenue</h3>
            <p class="text-xl text-green-600 font-bold">Rs {{ number_format($totalRevenue, 2) }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="font-semibold text-gray-700">Pending Orders</h3>
            <p class="text-xl font-bold">{{ $pendingOrders }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="font-semibold text-gray-700">Total Users</h3>
            <p class="text-xl font-bold">{{ $totalUsers }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="font-semibold text-gray-700">Most Popular Pizza</h3>
            <p class="text-xl font-bold">{{ $popularPizza }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="font-semibold text-gray-700">Most Popular Drink</h3>
            <p class="text-xl font-bold">{{ $popularDrink }}</p>
        </div>
    </div>
</div>
