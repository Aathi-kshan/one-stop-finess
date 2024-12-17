<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts.navbarbookdash')

    <div class="container mx-auto py-16 px-6">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Your Orders</h2>

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($orders as $order)
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-medium text-gray-800">Order #{{ $order->id }}</h3>
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                    'Delivered' => 'bg-green-100 text-green-800',
                                    'Cancelled' => 'bg-red-100 text-red-800'
                                ];
                                $statusColor = $statusColors[$order->order_status ?? 'Pending'];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                {{ $order->order_status ?? 'Pending' }}
                            </span>
                        </div>
                        <p class="mt-2 text-lg font-semibold text-gray-600">Total: LKR {{ number_format($order->total_amount, 2) }}</p>
                        <ul class="mt-4">
                            @foreach ($order->orderItems as $item)
                                <li class="text-gray-700">{{ $item->product->name }} - Quantity: {{ $item->quantity }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 col-span-3">No orders found.</p>
            @endforelse
        </div>
    </div>
</body>
</html>