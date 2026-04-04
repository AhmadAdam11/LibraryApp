<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-white flex items-center justify-center px-8">

    <div class="w-full max-w-4xl flex items-center gap-16">

        <div class="flex-1 max-w-sm">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">
                Create your account 
            </h1>
            <p class="text-sm text-gray-500 mb-6">
                Register to start using the Perpus App
            </p>

            @if ($errors->any())
                <div class="mb-4 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-red-600 text-sm">
                    <ul class="list-disc ml-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5 ml-1">Nama</label>
                    <div class="flex items-center border border-gray-200 rounded-full px-4 py-2.5 focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100">
                        <input
                            type="text"
                            name="name"
                            required
                            class="w-full text-sm text-gray-500 placeholder-gray-400 outline-none bg-transparent"
                            placeholder="Name"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5 ml-1">Email</label>
                    <div class="flex items-center border border-gray-200 rounded-full px-4 py-2.5 focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100">
                        <input
                            type="email"
                            name="email"
                            required
                            class="w-full text-sm text-gray-500 placeholder-gray-400 outline-none bg-transparent"
                            placeholder="emailexample@gmail.com"
                        >
                    </div>
                </div>

                <div>
                <label class="block text-sm font-bold text-gray-800 mb-1.5 ml-1">NISN</label>
                <div class="flex items-center border border-gray-200 rounded-full px-4 py-2.5 focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100">
                    <input
                    type="text"
                    name="nisn"
                    required
                    pattern="[0-9]{10}"
                    maxlength="10"
                    class="w-full text-sm text-gray-500 placeholder-gray-400 outline-none bg-transparent"
                    placeholder="10 digit"
                    >
                </div>
            </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5 ml-1">Password</label>
                    <div class="flex items-center border border-gray-200 rounded-full px-4 py-2.5 focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100">
                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full text-sm text-gray-500 outline-none bg-transparent"
                            placeholder="Minimum 6 characters"
                        >
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-b from-gray-900 to-gray-800 hover:bg-slate-600 text-white font-bold py-3 rounded-full transition-colors">
                    Sign Up
                </button>

                <p class="text-center text-sm text-gray-500">or</p>
            </form>

            <p class="mt-8 text-sm text-gray-600">
                Already have an account?
                <a href="/login" class="text-blue-500 font-bold hover:underline ml-1">Login</a>
            </p>
        </div>

        <div class="flex-1 flex justify-center items-center">
            <div class="w-80 h-80 rounded-full bg-blue-50 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/iconlogreg.png') }}" alt="Illustration" class="w-full h-full object-contain">
            </div>
        </div>

    </div>

</body>
</html>