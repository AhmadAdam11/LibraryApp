<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-white flex items-center justify-center px-8">

    <div class="w-full max-w-4xl flex items-center gap-16">

        <div class="flex-1 max-w-sm">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">
                Welcome back!
            </h1>
            <p class="text-sm text-gray-500 mb-6">
                Login to your Perpus App account to continue
            </p>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-red-600 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5 ml-1">Email</label>
                    <div class="flex items-center border border-gray-200 rounded-full px-4 py-2.5 focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100">
                        <svg class="w-4 h-4 text-gray-400 mr-3 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <rect x="2" y="4" width="20" height="16" rx="2"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                        <input
                            type="email"
                            name="email"
                            placeholder="emailexample@gmail.com"
                            value="{{ old('email') }}"
                            required
                            class="w-full text-sm text-gray-500 placeholder-gray-400 outline-none bg-transparent"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5 ml-1">Password</label>
                    <div class="flex items-center border border-gray-200 rounded-full px-4 py-2.5 focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100">
                        <svg class="w-4 h-4 text-gray-400 mr-3 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full text-sm text-gray-500 outline-none bg-transparent"
                        >
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-b from-gray-900 to-gray-800 hover:bg-slate-600 text-white font-bold py-3 rounded-full transition-colors">
                    Sign In
                </button>

                <p class="text-center text-sm text-gray-500">or</p>

            </form>

            <p class="mt-8 text-sm text-gray-600">
                Don't have an account?
                <a href="/register" class="text-blue-500 font-bold hover:underline ml-1">Sign Up</a>
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