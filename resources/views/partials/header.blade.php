<!-- Header -->
<header class="bg-[#1b304e] text-white px-8 sticky top-0 z-50 py-0" x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto flex items-center justify-between header-logo-container">
        <div class="flex items-center h-full">
            <a href="/" class="h-full flex items-center -ml-[20px]">
                <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-full">
            </a>
        </div>
        
        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center gap-8 absolute left-1/2 transform -translate-x-1/2 h-full">
            <a href="/work" class="text-[#dfdfbb] transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]">WORKS</a>
            <div class="relative group h-full flex items-center" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a href="#expertise" class="text-[#dfdfbb] transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor] uppercase tracking-wider">EXPERTISE</a>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform translate-y-2"
                     class="absolute -left-[10px] top-full mt-0 bg-[#dfdfbb] shadow-lg min-w-[260px] py-1 z-50">
                    @foreach($categories as $category)
                        <a href="/work?category={{ $category->id }}" class="block px-4 py-5 text-[#1b304e] hover:bg-[#d3924f]/20 hover:font-bold transition cursor-pointer whitespace-nowrap text-xs uppercase tracking-wider">
                            | {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <a href="{{ route('our-story') }}" class="text-[#dfdfbb] transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]">OUR STORY</a>
            <a href="{{ url('/#mag') }}" class="text-[#dfdfbb] transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]">MAG</a>
            <a href="{{ route('contact') }}" class="text-[#dfdfbb] transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]">CONTACT</a>
        </nav>

        <!-- Mobile Menu Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-[#dfdfbb] focus:outline-none cursor-pointer" aria-label="Toggle menu">
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         class="md:hidden bg-[#1b304e] border-t border-white/10 py-4">
        <nav class="container mx-auto px-8 space-y-4">
            <a href="/work" class="block text-[#dfdfbb] py-2 transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]" @click="mobileMenuOpen = false">WORKS</a>
            
            <div x-data="{ expertiseOpen: false }" class="space-y-2">
                <button @click="expertiseOpen = !expertiseOpen" class="w-full text-left text-[#dfdfbb] py-2 flex items-center justify-between transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]">
                    <span>EXPERTISE</span>
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
                        <a href="/work?category={{ $category->id }}" class="block text-[#dfdfbb]/80 py-2 text-sm transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]" @click="mobileMenuOpen = false">
                            | {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <a href="{{ route('our-story') }}" class="block text-[#dfdfbb] py-2 transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]" @click="mobileMenuOpen = false">OUR STORY</a>
            <a href="{{ url('/#mag') }}" class="block text-[#dfdfbb] py-2 transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]" @click="mobileMenuOpen = false">MAG</a>
            <a href="{{ route('contact') }}" class="block text-[#dfdfbb] py-2 transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]" @click="mobileMenuOpen = false">CONTACT</a>
        </nav>
    </div>
</header>
