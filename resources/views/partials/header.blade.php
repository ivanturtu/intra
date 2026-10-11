@php
    $navLink = 'text-secondary transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]';
    $navActive = fn (bool $active) => $active ? 'font-medium' : 'font-light';
    $isWorks = request()->is('work') || request()->is('work/*');
    $isStory = request()->routeIs('our-story') || request()->routeIs('rosa-profile');
    $isContact = request()->routeIs('contact');
    // Dropdown: box starts 2.375rem left of the parent label so the item text lines up with it
    $dropdownBox = 'absolute -left-[2.375rem] top-full w-[24.875rem] bg-secondary py-[2.0625rem] z-50';
    $dropdownItem = 'flex items-center h-[4.125rem] pl-[1.4375rem] text-[1.3125rem] font-light uppercase text-primary hover:font-normal transition cursor-pointer whitespace-nowrap';
@endphp
<!-- Header -->
<header class="bg-primary text-white sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="site-container relative flex items-center justify-between h-[5rem] md:h-[8.125rem]">
        <!-- Logo: the vertical line of the logotype sits on the first grid column -->
        <a href="/" class="h-full flex items-center -ml-[1.25rem] md:-ml-[1.96rem]">
            <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-full w-auto">
        </a>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center gap-[4.4375rem] absolute left-1/2 -translate-x-1/2 h-full text-[1.5rem] uppercase">
            <a href="/work" class="{{ $navLink }} {{ $navActive($isWorks) }}">Works</a>
            <div class="relative h-full flex items-center" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a href="{{ url('/#expertise') }}" class="{{ $navLink }} font-light">Expertise</a>
                <div x-show="open" x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="{{ $dropdownBox }}">
                    @foreach($categories as $category)
                        <a href="/work?category={{ $category->id }}" class="{{ $dropdownItem }} {{ request('category') == $category->id ? '!font-normal' : '' }}">
                            |&nbsp;&nbsp;{{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="relative h-full flex items-center" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a href="{{ route('our-story') }}" class="{{ $navLink }} {{ $navActive($isStory) }}">Our Story</a>
                <div x-show="open" x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="{{ $dropdownBox }}">
                    <a href="{{ route('our-story') }}" class="{{ $dropdownItem }} {{ request()->routeIs('our-story') ? '!font-normal' : '' }}">|&nbsp;&nbsp;Our Story</a>
                    <a href="{{ route('rosa-profile') }}" class="{{ $dropdownItem }} {{ request()->routeIs('rosa-profile') ? '!font-normal' : '' }}">|&nbsp;&nbsp;Rosa’s Profile</a>
                </div>
            </div>
            <a href="{{ url('/#mag') }}" class="{{ $navLink }} font-light">Mag</a>
            <a href="{{ route('contact') }}" class="{{ $navLink }} {{ $navActive($isContact) }}">Contact</a>
        </nav>

        <!-- Mobile Menu Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-secondary focus:outline-none cursor-pointer" aria-label="Toggle menu">
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         class="md:hidden bg-primary border-t border-white/10 py-4">
        <nav class="site-container space-y-4 text-base uppercase">
            <a href="/work" class="block py-2 {{ $navLink }} {{ $navActive($isWorks) }}" @click="mobileMenuOpen = false">Works</a>

            <div x-data="{ expertiseOpen: false }" class="space-y-2">
                <button @click="expertiseOpen = !expertiseOpen" class="w-full text-left py-2 flex items-center justify-between uppercase {{ $navLink }} font-light">
                    <span>Expertise</span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': expertiseOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="expertiseOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 max-h-0"
                     x-transition:enter-end="opacity-100 max-h-96"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 max-h-96"
                     x-transition:leave-end="opacity-0 max-h-0"
                     class="pl-4 space-y-2 overflow-hidden">
                    @foreach($categories as $category)
                        <a href="/work?category={{ $category->id }}" class="block py-2 text-sm font-light {{ $navLink }} !text-secondary/80" @click="mobileMenuOpen = false">
                            |&nbsp;&nbsp;{{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('our-story') }}" class="block py-2 {{ $navLink }} {{ $navActive(request()->routeIs('our-story')) }}" @click="mobileMenuOpen = false">Our Story</a>
            <a href="{{ route('rosa-profile') }}" class="block py-2 pl-4 text-sm {{ $navLink }} {{ $navActive(request()->routeIs('rosa-profile')) }}" @click="mobileMenuOpen = false">|&nbsp;&nbsp;Rosa’s Profile</a>
            <a href="{{ url('/#mag') }}" class="block py-2 {{ $navLink }} font-light" @click="mobileMenuOpen = false">Mag</a>
            <a href="{{ route('contact') }}" class="block py-2 {{ $navLink }} {{ $navActive($isContact) }}" @click="mobileMenuOpen = false">Contact</a>
        </nav>
    </div>
</header>
