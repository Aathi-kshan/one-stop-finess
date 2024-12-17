<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
<nav class="bg-gray-800 p-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
            <div class="text-3xl font-semibold mb-4 md:mb-0">Product Management Dashboard</div>
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

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Products</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('products.create') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create New Product</a>

        <div class="overflow-x-auto shadow-lg rounded-lg bg-gray-800">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-400">Image</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-400">Name</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-400">Description</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-400">Price</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-400">Categories</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-400">Stock Status</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($products as $product)
                        <tr class="border-b border-gray-700">
                            <td class="py-2 px-4">
                                @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded shadow-md mx-auto">
                                @endif
                            </td>
                            <td class="py-2 px-4">{{ $product->name }}</td>
                            <td class="py-2 px-4">{{ $product->description }}</td>
                            <td class="py-2 px-4">${{ number_format($product->price, 2) }}</td>
                            <td class="py-2 px-4">{{ $product->categories }}</td>
                            <td class="py-2 px-4">
                                @if($product->stock_status == 'In-Stock')
                                    <span class="text-green-500 font-semibold">In Stock</span>
                                @else
                                    <span class="text-red-500 font-semibold">Out of Stock</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 space-x-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-1 px-2 rounded">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-bold py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
