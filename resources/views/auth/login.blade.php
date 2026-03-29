<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="p-10 flex justify-center item-center mt-10">

    <div class="border p-4 w-72">
        <h2 class="mb-4">Login</h2>

        @if ($errors->any())
            <div class="border mb-3 p-2">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login" class="space-y-3">
            @csrf

            <div class="border p-2">
                <label class="block">Email</label>
                <input type="email" name="email" required class="w-full border mt-1">
            </div>

            <div class="border p-2">
                <label class="block">Password</label>
                <input type="password" name="password" required class="w-full border mt-1">
            </div>

            <button type="submit" class="border p-2 w-full">
                Login
            </button>
        </form>
    </div>

</body>
</html>