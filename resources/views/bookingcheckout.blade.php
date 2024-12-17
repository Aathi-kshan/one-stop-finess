<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    @include('layouts.navbarbooking')
    <div class="max-w-6xl mx-auto mt-10 p-6 rounded-lg shadow-lg card">
        <h1 class="text-4xl font-semibold text-center mb-6">{{ $class->name }}</h1>
       
        <div class="mb-4">
            <p class="flex items-center mb-2">
                📅 <span class="ml-1 font-medium">Date: {{ $class->date }}</span>
            </p>
            <p class="flex items-center mb-2">
                ⏰ <span class="ml-1 font-medium">Time: {{ $class->time }}</span>
            </p>
            <p class="flex items-center mb-2">
                📍 <span class="ml-1 font-medium">Location: {{ $class->location }}</span>
            </p>
            <p class="flex items-center mb-4">
                💵 <span class="ml-1 font-medium">Price: RS.{{ $class->price }}</span>
            </p>
        </div>

<div class="mt-6 p-4 bg-gray-800 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Coach Details</h2>
    @if($class->coach && $class->coach->user)
        <p class="flex items-center mb-2">
            🧑‍🏫 <span class="ml-1 font-medium">Name: {{ $class->coach->user->name }}</span>
        </p>
        <p class="flex items-center mb-2">
            📧 <span class="ml-1 font-medium">Email: {{ $class->coach->user->email }}</span>
        </p>
        <p class="flex items-center mb-2">
            📞 <span class="ml-1 font-medium">Phone: {{ $class->coach->user->mobile_number }}</span>
        </p>
        <p class="flex items-center mb-2">
            🏅 <span class="ml-1 font-medium">Specialization: {{ $class->coach->specialization }}</span>
        </p>
        <p class="flex items-center mb-2">
            📜 <span class="ml-1 font-medium">Bio: {{ $class->coach->bio }}</span>
        </p>
        <p class="flex items-center mb-2">
            📆 <span class="ml-1 font-medium">Experience: {{ $class->coach->experience }} years</span>
        </p>
    @else
        <p class="flex items-center mb-2">Coach details are not available.</p>
    @endif
</div>

        <div class="mt-4 text-center">
            <form method="POST" action="{{ route('sessions.book', $class->id) }}">
            @csrf
            <button type="submit" class="w-full px-8 py-3 rounded-full bg-blue-500 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-colors">
                Book Now
            </button>
            </form>
        </div>
    </div>
</body>
</html>

