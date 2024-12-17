
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coach - Create Session</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <div class="flex items-center justify-center min-h-screen">
        <form method="POST" action="{{ route('coach.sessions.store') }}" class="bg-gray-900 p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Create a New Session</h2>
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-2">Session Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    placeholder="Enter session name" 
                    class="w-full p-3 rounded-md bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                    required>
            </div>
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium mb-2">Date</label>
                <input 
                    type="date" 
                    name="date" 
                    id="date" 
                    class="w-full p-3 rounded-md bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                    required>
            </div>
            <div class="mb-4">
                <label for="time" class="block text-sm font-medium mb-2">Time</label>
                <input 
                    type="time" 
                    name="time" 
                    id="time" 
                    class="w-full p-3 rounded-md bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                    required>
            </div>
            <div class="mb-4">
                <label for="max_participants" class="block text-sm font-medium mb-2">Max Participants</label>
                <input 
                    type="number" 
                    name="max_participants" 
                    id="max_participants" 
                    placeholder="Enter maximum participants" 
                    class="w-full p-3 rounded-md bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                    required>
            </div>
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium mb-2">Location</label>
                <input 
                    type="text" 
                    name="location" 
                    id="location" 
                    placeholder="Enter location" 
                    class="w-full p-3 rounded-md bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                    required>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium mb-2">Price</label>
                <input 
                    type="number" 
                    name="price" 
                    id="price" 
                    placeholder="Enter price" 
                    class="w-full p-3 rounded-md bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                    required>
            </div>
            <button 
                type="submit" 
                class="w-full py-3 bg-gray-700 text-white font-semibold rounded-md hover:bg-gray-600 transition-colors">
                Create Session
            </button>  
            <a href="{{ route('coach.dash') }}" class="mt-4 inline-block text-center w-full py-3 bg-gray-700 text-white font-semibold rounded-md hover:bg-gray-600 transition-colors">
            Back to Dashboard
        </a>
        </form>  
    </div>
</body>
</html>


