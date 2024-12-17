<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.7/flowbite.min.js"></script>
    <style>
        body { background-color: #000000; color: #ffffff; }
        .hidden { display: none; }
        .block { display: block; }
    </style>
</head>
<body class="bg-black text-white">

@include('layouts.navbarhome2')

<div id="default-carousel" class="relative w-full" data-carousel="slide">
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="images/ban1.JPG" class="absolute block w-full object-cover" alt="Banner 1">
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="images/ban2.JPG" class="absolute block w-full object-cover" alt="Banner 2">
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="images/ban3.JPG" class="absolute block w-full object-cover" alt="Banner 3">
        </div>
    </div>
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full bg-gray-500" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-gray-500" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-gray-500" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
    </div>
</div>

<section class="text-gray-300 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap -mx-4 -mb-10 text-center">
            <div class="sm:w-1/2 w-full mb-10 px-4">
                <div class="rounded-lg overflow-hidden">
                    <img alt="Product" class="object-cover object-center w-full h-auto max-h-96" src="images/products.png">
                </div>
                <h2 class="text-2xl font-medium text-white mt-6 mb-3">Products</h2>
                <p class="leading-relaxed">Find the right fitness equipment and supplements to enhance your fitness journey</p>
                <button class="mt-6 text-black bg-white hover:bg-gray-200 border-0 py-2 px-5 rounded"><a href="{{ route('products.userproducts')}}">Explore</a></button>
            </div>
            <div class="sm:w-1/2 w-full mb-10 px-4">
                <div class="rounded-lg overflow-hidden">
                    <img alt="Booking" class="object-cover object-center w-full h-auto max-h-96" src="images/booking.JPG">
                </div>
                <h2 class="text-2xl font-medium text-white mt-6 mb-3">Fitness Sessions</h2>
                <p class="leading-relaxed">Book sessions with expert trainers for personalized guidance.</p>
                <button class="mt-6 text-black bg-white hover:bg-gray-200 border-0 py-2 px-5 rounded"><a href="{{ route('coach.classes') }}">Book Now</a></button>
            </div>
        </div>
    </div>
</section>

<footer class="bg-gray-900 text-gray-400 py-6">
    <div class="container mx-auto text-center">
        <p>© 2024 One-stop-fitness. All rights reserved.</p>
    </div>
</footer>



</body>
</html>
