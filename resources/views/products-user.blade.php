<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Featured Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.7/flowbite.min.js"></script>
</head>
<body class="bg-black text-white">
    @include('layouts.navbarshop')

    <div class="max-w-6xl mx-auto mt-10 p-6 rounded-lg shadow-lg card">

    <div id="default-carousel" class="relative w-full" data-carousel="slide">
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="images/ban4.png" class="absolute block w-full object-cover" alt="Banner 4">
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="images/ban5.JPG" class="absolute block w-full object-cover" alt="Banner 5">
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="images/ban6.JPG" class="absolute block w-full object-cover" alt="Banner 6">
        </div>
    </div>
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full bg-gray-500" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-gray-500" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-gray-500" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
    </div>
</div>
<br>
        <h1 class="text-4xl font-semibold text-center mb-6">Featured Products</h1>
        <!-- Search Form -->
        <form action="{{ route('products.search') }}" method="GET" class="mb-6">
            <div class="flex justify-center space-x-4">
                <input type="text" 
                        name="name" 
                        placeholder="Search by product name" 
                        value="{{ request('name') }}"
                        class="w-full max-w-md p-2 rounded-lg border border-gray-700 bg-gray-800 text-white">
                <select name="categories" 
                        class="form-control border border-gray-700 rounded w-full py-2 px-3 bg-gray-900 text-white">
                    <option value="">All Categories</option>
                    <option value="fitness_equipments" {{ request('categories') == 'fitness_equipments' ? 'selected' : '' }}>Fitness Equipments</option>
                    <option value="supplements" {{ request('categories') == 'supplements' ? 'selected' : '' }}>Supplements</option>
                    <option value="others" {{ request('categories') == 'others' ? 'selected' : '' }}>Others</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Search</button>
            </div>
        </form>

        @if(session('error'))
            <div class="p-4 mb-5 rounded bg-red-600 text-white">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="p-4 mb-5 rounded bg-green-600 text-white">
                {{ session('success') }}
            </div>
        @endif

        @if($products->isEmpty())
            <p class="text-center text-gray-400">No products found matching your search criteria or currently out of stock.</p>
        @else
            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="p-6 bg-gray-800 border border-gray-700 rounded-lg shadow-lg hover:shadow-xl transition-shadow transform hover:scale-105">
                        <div class="relative mb-4">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-56 object-cover rounded-lg">
                        </div>
                        <h2 class="text-2xl font-bold mb-2">{{ $product->name }}</h2>
                        <p class="flex items-center mb-4">
                            💵 <span class="ml-1 font-medium">LKR {{ number_format($product->price, 2) }}</span>
                        </p>
                        <div class="mt-4 text-center">
                            <a href="{{ route('products.show', $product->id) }}" 
                                class="w-full inline-block px-8 py-3 rounded-full bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-colors">
                                View Product
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>