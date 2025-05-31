<div class="container mx-auto px-4 mt-6">
    <h2 class="text-2xl font-bold text-secondary">Your Orders</h2>

    <div class="mt-6 space-y-4">
        @forelse ($orders as $order)
            <div
                x-data="{ expanded: false }"
                class="p-5 rounded-xl shadow-md border border-primary/10 {{ $loop->odd ? 'bg-primary/5' : 'bg-white' }} transition-all duration-300 ease-in-out"
            >
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <p class="text-sm font-semibold text-primary">Order #{{ $loop->iteration }}</p>
                        <p class="text-sm text-gray-600 mt-1">Total:
                            <span class="font-semibold text-secondary">Rs {{ number_format($order->total, 2) }}</span>
                        </p>
                        <p class="mt-1 text-sm font-bold
                            {{ strtolower($order->status ?? 'pending') === 'completed'
                                ? 'text-green-600'
                                : 'text-yellow-600' }}">
                            Status: {{ ucfirst($order->status ?? 'Pending') }}
                        </p>
                    </div>

                    <button
                        @click="expanded = !expanded"
                        class="text-sm text-white bg-primary px-4 py-1.5 rounded-md hover:bg-primary/90 transition"
                    >
                        <span x-text="expanded ? 'Hide Details' : 'View Details'"></span>
                    </button>
                </div>

                <!-- Expandable Section -->
                <div x-show="expanded" x-collapse class="mt-4 border-t border-gray-200 pt-4">
                    <h3 class="text-sm font-semibold text-secondary mb-2">Products Ordered:</h3>
                    <ul class="list-disc list-inside text-sm text-gray-700">
                        @foreach ($order->items as $item)
                            <li>{{ $item['name'] }} — Qty: {{ $item['quantity'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-6">
                No orders found.
            </div>
        @endforelse
    </div>
</div>
