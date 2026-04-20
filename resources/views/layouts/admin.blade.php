<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">

    <aside class="sticky top-0 h-screen w-60 bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-xl flex flex-col">
        <!-- Header -->
        <div class="p-5 border-b border-gray-700">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Admin Panel
            </h2>
        </div>

        <nav class="flex-1 p-3 space-y-1 overflow-y-auto">

            <a href="/admin/dashboard" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm font-medium {{ request()->is('admin/dashboard') ? 'bg-white/10 text-white' : 'text-gray-300' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            
            <a href="/admin/users" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm font-medium {{ request()->is('admin/users*') ? 'bg-white/10 text-white' : 'text-gray-300' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Users
            </a>
            
            <a href="/admin/books" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm font-medium {{ request()->is('admin/books*') ? 'bg-white/10 text-white' : 'text-gray-300' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Books
            </a>
            <a href="{{ route('categories.index') }}" 
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm font-medium {{ request()->is('admin/categories*') ? 'bg-white/10 text-white' : 'text-gray-300' }}">
                
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>
                Category
            </a>
            <a href="{{ route('admin.loans') }}" 
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm font-medium {{ request()->is('admin/loans*') ? 'bg-white/10 text-white' : 'text-gray-300' }}">
                
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>

              Loans
            </a>

        </nav>

        <div class="p-3 border-t border-gray-700">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:text-red-400 hover:bg-white/10 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <main class="flex-1 overflow-y-auto">
        <header class="bg-white border-b border-gray-200 px-6 py-4 sticky top-0 z-10">
            <div class="flex items-center justify-end">
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-600">Welcome, <strong>Admin</strong></span>
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                        A
                    </div>
                </div>
            </div>
        </header>

        <div class="p-6">
            @yield('content')
        </div>
    </main>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>