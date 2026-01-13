<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - {{ config('app.name', 'INTRA studio') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=ubuntu:300,400,500,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <!-- Quill Editor -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">INTRA Studio</h1>
                <p class="text-gray-400 text-sm mt-1">Admin Panel</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-700">
                <div class="text-sm text-gray-400 mb-2">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-500 mb-3">{{ Auth::user()->email }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 rounded">
                        Logout
                    </button>
                </form>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.projects.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.projects.*') ? 'bg-gray-700' : '' }}">
                    Projects
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700' : '' }}">
                    Categories
                </a>
                <a href="{{ route('admin.intra-studio-team-leads.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.intra-studio-team-leads.*') ? 'bg-gray-700' : '' }}">
                    Team Leads
                </a>
                <a href="{{ route('admin.magazine.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.magazine.*') ? 'bg-gray-700' : '' }}">
                    Magazine
                </a>
                <a href="{{ route('admin.magazine-categories.index') }}" class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.magazine-categories.*') ? 'bg-gray-700' : '' }}">
                    Magazine Categories
                </a>
                <a href="/" class="block px-6 py-3 hover:bg-gray-700" target="_blank">
                    View Site
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden">
            <div class="p-8">
                @if (session()->has('message'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
