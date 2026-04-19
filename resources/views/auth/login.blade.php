<!DOCTYPE html>
<html>
<head>
    <title>Login — PerpusApp</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-white flex">

    <div class="w-full max-w-md min-h-screen bg-white border-r border-gray-100 flex flex-col px-10 py-9 ml-10">

        <div class="flex items-center gap-2.5 mb-14">
            <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <span class="text-base font-semibold text-gray-900">Perpus<span class="font-normal text-gray-400">App</span></span>
        </div>

        <div class="flex-1 flex flex-col justify-center">

            <h1 class="text-xl font-semibold text-gray-900 mb-1.5">Welcome back</h1>
            <p class="text-sm text-gray-500 mb-8 leading-relaxed">Sign in to your account to continue.</p>

            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-medium text-gray-800 mb-1.5">Email</label>
                    <div class="flex items-center gap-2.5 border border-gray-200 rounded-xl px-3.5 py-2.5 focus-within:border-gray-400 transition-colors">
                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <rect x="2" y="4" width="20" height="16" rx="2"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                        <input
                            type="email"
                            name="email"
                            placeholder="you@example.com"
                            value="{{ old('email') }}"
                            required
                            class="flex-1 text-sm text-gray-800 placeholder-gray-400 bg-transparent border-none outline-none"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-800 mb-1.5">Password</label>
                    <div class="flex items-center gap-2.5 border border-gray-200 rounded-xl px-3.5 py-2.5 focus-within:border-gray-400 transition-colors">
                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            class="flex-1 text-sm text-gray-800 bg-transparent border-none outline-none"
                        >
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-b from-gray-900 to-gray-800 hover:opacity-90 text-white text-sm font-medium py-2.5 rounded-xl transition-opacity mb-10 ">
                    Sign In
                </button>

            </form>
        </div>

    </div>

    <div class="flex-1 bg-gray-50 hidden md:flex flex-col items-center justify-center gap-5">
        <div class="w-72 h-72 rounded-full bg-white border border-gray-100 flex items-center justify-center overflow-hidden">
            <img src="{{ asset('images/iconlogreg.png') }}" alt="Illustration" class="w-full h-full object-contain">
        </div>
        <div class="text-center">
            <p class="text-sm font-medium text-gray-800">Your library, anytime.</p>
            <p class="text-xs text-gray-400 mt-1">Discover and borrow books from our growing collection.</p>
        </div>
    </div>

</body>
</html>