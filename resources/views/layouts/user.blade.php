<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PerpusApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-gray-100 min-h-screen flex bg-gray-950">

    {{-- SIDEBAR --}}
    <aside class="w-52 min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 border-r border-white/5 flex flex-col sticky top-0 h-screen">

        {{-- Branding --}}
        <div class="flex items-center gap-2.5 px-4 py-4 border-b border-white/5">
            <div class="w-7 h-7 rounded-lg bg-white flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 stroke-[#111110]" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="flex flex-col leading-tight">
                <span class="text-[13px] font-semibold text-white tracking-wide">PerpusApp</span>
                <span class="text-[10px] text-white/30 font-normal">Library System</span>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-2.5 py-3 flex flex-col gap-0.5">

            <span class="text-[9px] font-medium text-white/20 uppercase tracking-widest px-2.5 pt-1 pb-2">Menu</span>

            <a href="{{ route('user.home') }}"
               class="flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-xs font-medium transition-all
               {{ request()->routeIs('user.home') ? 'bg-white/10 text-white' : 'text-white/40 hover:bg-white/5 hover:text-white/80' }}">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 12l9-9 9 9M5 10v9a1 1 0 001 1h4v-5h4v5h4a1 1 0 001-1v-9"/>
                </svg>
                Home
            </a>

            <a href="{{ route('user.loans') }}"
               class="flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-xs font-medium transition-all
               {{ request()->routeIs('user.loans') ? 'bg-white/10 text-white' : 'text-white/40 hover:bg-white/5 hover:text-white/80' }}">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 6.25v13M12 6.25C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.25v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.25M12 6.25C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.25v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.25"/>
                </svg>
                My Loans
            </a>

            <a href="{{ route('user.favorite') }}"
               class="flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-xs font-medium transition-all
               {{ request()->routeIs('user.favorite') ? 'bg-white/10 text-white' : 'text-white/40 hover:bg-white/5 hover:text-white/80' }}">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                Favorites
            </a>

            <a href="{{ route('user.profile.show') }}"
               class="flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-xs font-medium transition-all
               {{ request()->routeIs('user.profile.*') ? 'bg-white/10 text-white' : 'text-white/40 hover:bg-white/5 hover:text-white/80' }}">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
                Profile
            </a>
        </nav>

        {{-- User + Logout --}}
        <div class="px-2.5 py-3 border-t border-white/5">
            <div class="flex items-center gap-2.5 px-2.5 py-2 mb-1">
                <div class="w-6 h-6 rounded-full bg-white/10 border border-white/10 flex items-center justify-center text-[10px] font-semibold text-white/60 flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                </div>
                <span class="text-xs text-white/50 font-medium truncate">{{ auth()->user()->name ?? 'User' }}</span>
            </div>

            <form action="/logout" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-xs font-medium text-white/30 hover:bg-red-500/10 hover:text-red-400/80 transition-all">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col min-h-screen bg-gray-50">

        <header class="sticky top-0 z-40 bg-white border-b border-gray-100 px-6 h-12 flex items-center justify-end">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-600 text-xs font-semibold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                </div>
                <span class="text-sm text-gray-700 font-medium">{{ auth()->user()->name ?? 'User' }}</span>
            </div>
        </header>

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>