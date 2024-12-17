<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    @include('layouts.navbarbookdash')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black text-white min-h-screen">
                <div class="container mx-auto p-6">
                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-3xl font-bold">Shopping Cart</h1>
                        <a href="{{ route('products.userproducts') }}" class="text-blue-400 hover:text-blue-300">
                            Continue Shopping
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-900 border border-green-700 text-green-100 px-4 py-3 rounded-lg mb-6" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(count($cart->items) > 0)
                        <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden">
                            <div class="p-6">
                                @foreach($cart->items as $item)
                                    <div id="cart-item-{{ $item->product->id }}" 
                                         class="flex flex-col md:flex-row justify-between items-center border-b border-gray-700 py-4 {{ !$loop->last ? 'mb-4' : '' }} transition-all duration-500">
                                        <div class="flex items-center mb-4 md:mb-0">
                                            @if($item->product->image)
                                                <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}" 
                                                        class="w-20 h-20 object-cover rounded-lg">
                                            @endif
                                            <div class="ml-4">
                                                <h3 class="text-lg font-semibold">{{ $item->product->name }}</h3>
                                                <p class="text-gray-400">Rs:{{ number_format($item->product->price, 2) }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-6">
                                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                                <div class="flex items-center bg-gray-800 rounded-lg">
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                                            class="w-16 bg-gray-800 text-center border-none focus:ring-0 text-white">
                                                </div>
                                                <button type="submit" class="ml-2 text-sm text-blue-400 hover:text-blue-300">
                                                    Update
                                                </button>
                                            </form>
                                            
                                            <div class="text-right">
                                                <p class="text-lg font-semibold">Rs:{{ number_format($item->quantity * $item->product->price, 2) }}</p>
                                            </div>

                                            <form action="{{ route('cart.remove') }}" method="POST" class="inline" onsubmit="return confirmDelete(event, '{{ $item->product->name }}')">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                                <button type="submit" class="text-red-500 hover:text-red-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="bg-gray-800 p-6">
                                <div class="mb-6">
                                    <h2 class="text-xl font-bold mb-4">Shipping Information</h2>
                                    <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
                                        @csrf
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                                                <input type="text" id="name" name="customer_name" required 
                                                       class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500" 
                                                       placeholder="Enter your full name">
                                            </div>
                                            <div>
                                                <label for="mobile" class="block text-sm font-medium text-gray-300 mb-1">Mobile Number</label>
                                                <input type="tel" id="mobile" name="mobile_number" required 
                                                       class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500" 
                                                       placeholder="Enter your mobile number">
                                            </div>
                                            <div>
                                                <label for="address" class="block text-sm font-medium text-gray-300 mb-1">Address</label>
                                                <input type="text" id="address" name="address" required 
                                                       class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500" 
                                                       placeholder="Street address">
                                            </div>
                                            <div>
                                                <label for="city" class="block text-sm font-medium text-gray-300 mb-1">City</label>
                                                <input type="text" id="city" name="city" required 
                                                       class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500" 
                                                       placeholder="Enter your city">
                                            </div>
                                            <div>
                                                <label for="postal_code" class="block text-sm font-medium text-gray-300 mb-1">Postal Code</label>
                                                <input type="text" id="postal_code" name="postal_code" required 
                                                       class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500" 
                                                       placeholder="Enter postal code">
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center mt-6">
                                            <div>
                                                <p class="text-lg text-gray-400">Total</p>
                                                <p class="text-2xl font-bold">Rs:{{ number_format($total, 2) }}</p>
                                            </div>
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                                                Proceed to Checkout with Stripe
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-900 rounded-lg shadow-lg p-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <p class="text-xl text-gray-400 mb-6">Your cart is empty</p>
                            <a href="{{ route('products.userproducts') }}" 
                                class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-lg inline-block transition duration-200">
                                Start Shopping
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(event, productName) {
            event.preventDefault();
            
            if (confirm(`Are you sure you want to remove ${productName} from your cart?`)) {
                // Add fade out animation
                const form = event.target;
                const cartItem = form.closest(`[id^="cart-item-"]`);
                
                cartItem.style.opacity = '0';
                cartItem.style.transform = 'translateX(100px)';
                
                // Submit the form after animation
                setTimeout(() => {
                    form.submit();
                }, 300);
            }
            
            return false;
        }
    </script>

</body>
</html>
