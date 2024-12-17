<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
<nav class="bg-gray-800 p-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
            <div class="text-3xl font-semibold mb-4 md:mb-0">Order Management Dashboard</div>
            <div class="flex space-x-4">
                <a href="{{ route('admin.users') }}" class="text-lg text-blue-500 hover:text-blue-300">Users</a>
                <a href="{{ route('products.index') }}" class="text-lg text-blue-500 hover:text-blue-300">Products</a>
                <a href="{{ route('admin.orders') }}" class="text-lg text-blue-500 hover:text-blue-300">Orders</a>
                
                <form method="POST" action="{{ route('logout') }}" class="ml-auto inline-block">
                    @csrf
                    <button type="submit" class="text-lg text-blue-500 hover:text-blue-300">
                        Log-Out
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mx-auto p-6">
        <table class="table-auto w-full text-center text-sm">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2">Order ID</th>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Total Amount</th>
                    <th class="px-4 py-2">Payment Status</th>
                    <th class="px-4 py-2">Shipping Name</th>
                    <th class="px-4 py-2">Shipping Phone</th>
                    <th class="px-4 py-2">Shipping Address</th>
                    <th class="px-4 py-2">Items</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="bg-gray-800 hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $order->id }}</td>
                        <td class="px-4 py-2">{{ $order->user->name ?? 'Unknown User' }}</td>
                        <td class="px-4 py-2">Rs:{{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-4 py-2">{{ $order->payment_status }}</td>
                        <td class="px-4 py-2">{{ $order->shipping_name }}</td>
                        <td class="px-4 py-2">{{ $order->shipping_phone }}</td>
                        <td class="px-4 py-2">{{ $order->shipping_address }}, {{ $order->shipping_city }} - {{ $order->shipping_postal_code }}</td>
                        <td class="px-4 py-2">
                            @foreach($order->orderItems as $item)
                                {{ $item->product->name }} ({{ $item->quantity }})<br>
                            @endforeach
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex flex-col space-y-2">
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" name="status" value="Delivered" 
                                        class="w-full bg-green-600 hover:bg-green-500 text-white px-2 py-1 rounded-lg {{ $order->order_status == 'Delivered' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $order->order_status == 'Delivered' ? 'disabled' : '' }}>
                                        Delivered
                                    </button>
                                </form>
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" name="status" value="Cancelled" 
                                        class="w-full bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded-lg {{ $order->order_status == 'Cancelled' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $order->order_status == 'Cancelled' ? 'disabled' : '' }}>
                                        Cancelled
                                    </button>
                                </form>
                                <span class="text-sm text-gray-400">Current: {{ $order->order_status }}</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
