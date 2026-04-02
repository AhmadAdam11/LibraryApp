<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex">

    <div class="w-64 h-screen bg-gray-800 text-white p-5">
        <h2 class="text-2xl font-bold mb-6">Admin</h2>

        <nav class="space-y-2">
            <a href="/admin/dashboard" class="block px-3 py-2 rounded hover:bg-gray-700">
                Dashboard
            </a>
            <a href="/admin/users" class="block px-3 py-2 rounded hover:bg-gray-700">
                List User
            </a>
        </nav>
    </div>

    <div class="flex-1 p-6">

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </div>

</div>

</body>
</html>