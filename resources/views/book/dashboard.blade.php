<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-white">

    @include('layouts.navbarbookdash')

    <div class="max-w-6xl mx-auto mt-10 p-6 rounded-lg shadow-lg card">
        <h1 class="text-4xl font-semibold text-black text-center mb-6">My Bookings</h1>

        <!-- Error Message -->
        @if(session('error'))
            <div class="p-4 mb-5 rounded bg-red-600 text-white">
                {{ session('error') }}
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="p-4 mb-5 rounded bg-green-600 text-white">
                {{ session('success') }}
            </div>
        @endif

        <!-- No Bookings Message -->
        @if($bookings->isEmpty())
            <p class="text-center text-gray-500">You have no bookings at the moment.</p>
        @else
            <!-- Bookings List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($bookings as $booking)
                    <div class="p-6 bg-gray-800 borde border-gray-700 rounded-lg shadow-lg hover:shadow-xl transition-shadow transform hover:scale-105">
                        @if($booking->class)
                            <h2 class="text-2xl font-bold mb-2">{{ $booking->class->name }}</h2>
                            <p class="flex items-center mb-2">
                                📅 <span class="ml-1 font-medium">{{ $booking->class->date }}</span>
                            </p>
                            <p class="flex items-center mb-2">
                                ⏰ <span class="ml-1 font-medium">{{ $booking->class->time }}</span>
                            </p>
                            <p class="flex items-center mb-2">
                                👥 <span class="ml-1 font-medium">Max Participants: {{ $booking->class->max_participants }}</span>
                            </p>
                            <p class="flex items-center mb-2">
                                📍 <span class="ml-1 font-medium">{{ $booking->class->location }}</span>
                            </p>
                            <p class="flex items-center mb-4">
                                💵 <span class="ml-1 font-medium">RS.{{ $booking->class->price }}</span>
                            </p>
                        @else
                            <p class="text-red-500">Class details are not available.</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
