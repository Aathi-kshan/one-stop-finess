<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coach</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #121212; /* Dark background */
            color: #E5E5E5; /* Light text */
        }
        input, textarea {
            background-color: #1E1E1E; /* Dark input background */
            color: #E5E5E5; /* Light text */
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #4CAF50; /* Subtle focus border */
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5); /* Focus shadow */
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    @include('layouts.navbarcoachsub')
    <div class="max-w-lg mx-auto mt-10 px-6 py-8 bg-gray-900 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold mb-6 text-gray-100">Add A New Coach</h1>

        @if(session('success'))
            <div class="bg-green-600 text-white p-4 mb-5 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('coach.store') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            <div>
                <label for="specialization" class="block text-sm font-medium text-gray-300">Specialization</label>
                <input type="text" name="specialization" id="specialization" class="block w-full border border-gray-700 rounded-md p-3 focus:ring focus:ring-blue-500">
                @error('specialization')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-300">Bio</label>
                <textarea name="bio" id="bio" rows="4" class="block w-full border border-gray-700 rounded-md p-3 focus:ring focus:ring-blue-500"></textarea>
                @error('bio')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="experience" class="block text-sm font-medium text-gray-300">Experience (years)</label>
                <input type="number" name="experience" id="experience" class="block w-full border border-gray-700 rounded-md p-3 focus:ring focus:ring-blue-500" min="0">
                @error('experience')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition duration-300">Add Coach</button>
        </form>

        <div class="mt-6">
            <a href="{{ route('coach.dash') }}" class="block text-center bg-gray-700 text-white py-3 rounded-md hover:bg-gray-600 transition duration-300">Go to Dashboard</a>
        </div>
    </div>
</body>
</html>
