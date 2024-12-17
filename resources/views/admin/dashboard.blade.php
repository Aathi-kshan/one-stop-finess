<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

    <!-- Navigation Bar -->
    <nav class="bg-gray-800 p-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
            <div class="text-3xl font-semibold mb-4 md:mb-0">User Management Dashboard</div>
            <div class="flex space-x-4">
                <a href="{{ route('admin.users') }}" class="text-lg text-blue-500 hover:text-blue-300">Users</a>
                <a href="{{ route('products.index') }}" class="text-lg text-blue-500 hover:text-blue-300">Products</a>
                <a href="{{ route('admin.orders') }}" class="text-lg text-blue-500 hover:text-blue-300">Orders</a>
                
                <form method="POST" action="{{ route('logout') }}" class="ml-auto inline-block">
                    @csrf
                    <button type="submit" class="text-lg text-blue-500 hover:text-blue-300">
                        Log-Out
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content: User Table -->
    <div class="container mx-auto p-6">
        <table class="table-auto w-full text-center text-sm">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Mobile Number</th>
                    <th class="px-4 py-2">Address</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="bg-gray-800 hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $user->user_id }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->mobile_number }}</td>
                        <td class="px-4 py-2">{{ $user->address }}</td>
                        <td class="px-4 py-2">{{ $user->role }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('admin.deleteUser', ['id' => $user->user_id]) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-lg" onclick="return confirm('Are you sure you want to delete this user?');">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
