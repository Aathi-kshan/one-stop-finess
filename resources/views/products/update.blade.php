<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
    <div class="container mx-auto p-6">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold">Edit Product</h1>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name" class="block text-gray-300">Product Name</label>
                    <input type="text" name="name" class="form-control border border-gray-600 rounded w-full py-3 px-4 bg-gray-700 text-white" value="{{ $product->name }}" required>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-gray-300">Description</label>
                    <textarea name="description" class="form-control border border-gray-600 rounded w-full py-3 px-4 bg-gray-700 text-white">{{ $product->description }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="price" class="block text-gray-300">Price</label>
                    <input type="number" name="price" class="form-control border border-gray-600 rounded w-full py-3 px-4 bg-gray-700 text-white" value="{{ $product->price }}" required>
                </div>
                
                <div class="mb-4">
                    <label for="categories" class="block text-gray-400">Categories</label>
                    <select name="categories" class="form-control border border-gray-700 rounded w-full py-2 px-3 bg-gray-900 text-white">
                        <option value="fitness_equipments">Fitness Equipments</option>
                        <option value="supplements">Supplements</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="stock_status" class="block text-gray-400">Stock Status</label>
                    <select name="stock_status" class="form-control border border-gray-700 rounded w-full py-2 px-3 bg-gray-900 text-white">
                        <option value="In-Stock" {{ $product->stock_status == 'In-Stock' ? 'selected' : '' }}>In-Stock</option>
                        <option value="Out of Stock" {{ $product->stock_status == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-gray-300">Product Image</label>
                    <input type="file" name="image" class="form-control border border-gray-600 rounded w-full py-3 px-4 bg-gray-700 text-white">
                    
                    @if($product->image)
                        <div class="mt-4">
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="max-w-xs mx-auto rounded-lg shadow-md">
                        </div>
                    @endif
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-6 rounded w-full sm:w-auto mx-auto block text-center">Update Product</button>
            </form>
        </div>
    </div>

</body>
</html>
