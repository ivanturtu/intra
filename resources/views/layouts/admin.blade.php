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
<body class="font-sans antialiased bg-[#dfdfbb]">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#1b304e] text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">INTRA Studio</h1>
                <p class="text-[#dfdfbb] text-sm mt-1">Admin Panel</p>
            </div>
            <div class="px-6 py-4 border-t border-white/10">
                <div class="text-sm text-[#dfdfbb] mb-2">{{ Auth::user()->name }}</div>
                <div class="text-xs text-[#dfdfbb]/70 mb-3">{{ Auth::user()->email }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[#dfdfbb] hover:bg-white/10 rounded transition">
                        Logout
                    </button>
                </form>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.projects.index') }}" class="block px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.projects.*') ? 'bg-white/10' : '' }}">
                    Projects
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.categories.*') ? 'bg-white/10' : '' }}">
                    Categories
                </a>
                <a href="{{ route('admin.intra-studio-team-leads.index') }}" class="block px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.intra-studio-team-leads.*') ? 'bg-white/10' : '' }}">
                    Team Leads
                </a>
                <a href="{{ route('admin.magazine.index') }}" class="block px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.magazine.*') ? 'bg-white/10' : '' }}">
                    Magazine
                </a>
                <a href="{{ route('admin.magazine-categories.index') }}" class="block px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.magazine-categories.*') ? 'bg-white/10' : '' }}">
                    Magazine Categories
                </a>
                <a href="{{ route('admin.settings.index') }}" class="block px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.settings.*') ? 'bg-white/10' : '' }}">
                    Settings
                </a>
                <a href="{{ route('admin.our-story.index') }}" class="block px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.our-story.*') ? 'bg-white/10' : '' }}">
                    Our Story
                </a>
                <a href="{{ route('admin.users.index') }}" class="block px-6 py-3 hover:bg-white/10 transition {{ request()->routeIs('admin.users.*') ? 'bg-white/10' : '' }}">
                    Users
                </a>
                <a href="/" class="block px-6 py-3 hover:bg-white/10 transition" target="_blank">
                    View Site
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden">
            <div class="p-8">
                @if (session()->has('message'))
                    <div class="mb-4 bg-[#d3924f]/20 border border-[#d3924f] text-[#1b304e] px-4 py-3 rounded relative" role="alert">
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
