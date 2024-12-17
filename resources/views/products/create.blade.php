<!-- resources/views/products/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
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
        <h1 class="text-3xl font-bold mb-6 text-center">Create Product</h1>
        
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg shadow-lg">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-400">Name</label>
                <input type="text" name="name" class="form-control border border-gray-700 rounded w-full py-2 px-3 bg-gray-900 text-white" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-400">Description</label>
                <textarea name="description" class="form-control border border-gray-700 rounded w-full py-2 px-3 bg-gray-900 text-white"></textarea>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-400">Price</label>
                <input type="number" name="price" class="form-control border border-gray-700 rounded w-full py-2 px-3 bg-gray-900 text-white" required>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-400">Image</label>
                <input type="file" name="image" class="form-control border border-gray-700 rounded w-full py-2 px-3 bg-gray-900 text-white">
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
                    <option value="In-Stock">In-Stock</option>
                    <option value="Out of Stock">Out of Stock</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded w-full">Create</button>
        </form>
    </div>

</body>
</html>
