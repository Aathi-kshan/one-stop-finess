<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coach Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">
    <header class="px-6 py-4 bg-gray-900 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold">create class</h1>
            <div>
                <a href="{{ route('home') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 mr-2">
                    Home
                </a>
                <a href="{{ route('coach.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">
                    create class
                </a>
            </div>
        </div>
    </header>

    <main class="container mx-auto mt-6 px-4">
        @if(isset($classes) && $classes->isNotEmpty())
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="min-w-full table-auto border-collapse border border-gray-700 bg-gray-800 text-gray-200">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium">Class Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Time</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Location</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Price (RS.)</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                    <tr class="border-t border-gray-700 hover:bg-gray-600">
                        <td class="px-6 py-3">{{ $class->name }}</td>
                        <td class="px-6 py-3">{{ $class->date }}</td>
                        <td class="px-6 py-3">{{ $class->time }}</td>
                        <td class="px-6 py-3">{{ $class->location }}</td>
                        <td class="px-6 py-3">{{ $class->price }}</td>
                        <td class="px-6 py-3">
                            <form method="POST" action="{{ route('classes.destroy', $class->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-500">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="mt-6 p-4 bg-red-500 text-white rounded-lg text-center">
            <p>No classes available.</p>
        </div>
        @endif
    </main>

    <footer class="px-6 py-4 bg-gray-900 mt-8 text-center text-sm text-gray-500">
        © {{ date('Y') }} Coach Dashboard. All rights reserved.
    </footer>
</body>
</html>
