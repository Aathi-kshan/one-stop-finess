<nav class="bg-black border-b border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{ route('home') }}" class="self-center">
            <img src="{{ asset('images/logo.png') }}" alt="One-stop-fitness logo" class="h-24 w-auto">
        </a>
        <button id="menu-toggle" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-white rounded-lg md:hidden hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600">
            <span class="sr-only">menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div id="navbar" class="hidden w-full md:block md:w-auto">
            <ul class="font-medium flex flex-col p-4 mt-4 bg-black rounded-lg md:flex-row md:space-x-8 md:mt-0">
            <li><a href="{{ route('home') }}" class="py-2 px-4 text-white hover:bg-gray-800 rounded transition-all">HOME</a></li>
                <li><a href="{{ route('coach.classes') }}" class="py-2 px-4 text-white hover:bg-gray-800 rounded transition-all">BOOKINGS</a></li>
                <li><a href="{{ route('products.userproducts') }}" class="py-2 px-4 text-white hover:bg-gray-800 rounded transition-all">PRODUCTS</a></li>
                <li><a href="{{ route('cart.show') }}" class="py-2 px-4 text-white hover:bg-gray-800 rounded transition-all">CART</a></li>
                <li><a href="{{ route('orders.dashboard') }}" class="py-2 px-4 text-white hover:bg-gray-800 rounded transition-all">MY ORDERS</a></li>
                <li><a href="{{ route('profile.edit') }}" class="py-2 px-4 text-white hover:bg-gray-800 rounded transition-all">PROFILE</a></li>
            </ul>
        </div>
    </div>
</nav>
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const navbar = document.getElementById('navbar');
    menuToggle.addEventListener('click', () => {
        navbar.classList.toggle('hidden');
        navbar.classList.toggle('block');
    });
</script>