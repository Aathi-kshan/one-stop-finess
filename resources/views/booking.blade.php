<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    @include('layouts.navbarbooking')

    <div class="max-w-6xl mx-auto mt-10 p-6 rounded-lg shadow-lg card">
        <h1 class="text-4xl font-semibold text-center mb-6">Classes</h1>
        
        <form method="GET" action="{{ route('classes.search') }}" class="mb-6">
            <div class="flex justify-center space-x-4">
                <input type="text" name="location" placeholder="Search by location" class="w-full max-w-md p-2 rounded-lg border border-gray-700 bg-gray-800 text-white">
                <input type="number" name="price" placeholder="Max price" class="w-full max-w-md p-2 rounded-lg border border-gray-700 bg-gray-800 text-white">
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

        @if($classes->isEmpty())
            <p class="text-center text-gray-400">No classes available at the moment. Please check back later.</p>
        @else
            <!-- Classes List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($classes as $class)
                    <div class="p-6 bg-gray-800 border border-gray-700 rounded-lg shadow-lg hover:shadow-xl transition-shadow transform hover:scale-105">
                        <h2 class="text-2xl font-bold mb-2">{{ $class->name }}</h2>
                        <p class="flex items-center mb-2">
                            📅 <span class="ml-1 font-medium">{{ $class->date }}</span>
                        </p>
                        <p class="flex items-center mb-2">
                            ⏰ <span class="ml-1 font-medium">{{ $class->time }}</span>
                        </p>
                        <p class="flex items-center mb-2">
                            👥 <span class="ml-1 font-medium">Max Participants: {{ $class->max_participants }}</span>
                        </p>
                        <p class="flex items-center mb-2">
                            📍 <span class="ml-1 font-medium">{{ $class->location }}</span>
                        </p>
                        <p class="flex items-center mb-4">
                            💵 <span class="ml-1 font-medium">RS.{{ $class->price }}</span>
                        </p>
                        <div class="mt-4 text-center">
                            <form method="GET" action="{{ route('classes.show', ['id' => $class->id]) }}">
                                <button type="submit" class="w-full px-8 py-3 rounded-full bg-blue-500 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-colors">
                                    Book Now
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
