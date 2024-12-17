<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body class="bg-black text-white font-sans">
    @include('layouts.navbarshop')

    <div class="container mx-auto p-6">
        <!-- Product Details Section -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg flex flex-col md:flex-row items-center md:items-start">
            <!-- Product Image -->
            @if($product->image)
                <div class="flex-shrink-0 w-full md:w-1/2">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                        class="rounded-lg shadow-md w-full h-auto object-cover">
                </div>
            @endif

            <!-- Product Info -->
            <div class="mt-6 md:mt-0 md:ml-10 flex flex-col justify-between w-full md:w-1/2">
                <h1 class="text-4xl font-extrabold mb-4">{{ $product->name }}</h1>
                <p class="text-gray-400 text-lg mb-4 leading-relaxed">{{ $product->description }}</p>
                <p class="text-2xl font-bold mb-6">Price: LKR {{ $product->price }}</p>
                
                <!-- Stock Status -->
                <div class="mb-6">
                    @if($product->stock_status == 'In-Stock')
                        <span class="text-green-500 font-semibold">
                            <i class="fas fa-check-circle mr-2"></i>In Stock
                        </span>
                    @else
                        <span class="text-red-500 font-semibold">
                            <i class="fas fa-times-circle mr-2"></i>Out of Stock
                        </span>
                    @endif
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <form action="{{ route('cart.add') }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center gap-4">
                            <label for="quantity" class="text-sm font-medium text-gray-400">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" 
                                class="w-20 p-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <button type="submit" 
                            class="mt-4 bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-6 rounded-lg w-full sm:w-auto {{ $product->stock_status == 'Out of Stock' ? 'opacity-50 cursor-not-allowed' : '' }}"
                            {{ $product->stock_status == 'Out of Stock' ? 'disabled' : '' }}>
                            {{ $product->stock_status == 'Out of Stock' ? 'Out of Stock' : 'Add to Cart' }}
                        </button>
                    </form>
                </div>
                <br>
                    <a href="{{ route('products.userproducts') }}" >
                        <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-3 px-6 rounded-lg w-full sm:w-auto">
                            Continue Shopping
                        </button>
                    </a>
            </div>
        </div>
    </div>

</body>
</html>
