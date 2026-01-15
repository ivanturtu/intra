<!-- Header -->
<header class="bg-[#1b304e] text-white px-8 sticky top-0 z-50 py-0">
    <div class="container mx-auto flex items-center justify-between header-logo-container">
        <div class="flex items-center h-full">
            <a href="/" class="h-full flex items-center">
                <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-full">
            </a>
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a href="/work" class="text-[#dfdfbb] transition hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]">WORKS</a>
            <div class="relative group h-full flex items-center" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a href="#expertise" class="text-[#dfdfbb] transition cursor-pointer hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]">EXPERTISE</a>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform translate-y-2"
                     class="fixed left-auto top-[100px] bg-white shadow-lg min-w-[260px] py-1 z-50">
                    @foreach($categories as $category)
                        <a href="/work?category={{ $category->id }}" class="block px-4 py-1.5 text-[#1b304e] hover:bg-gray-100 transition whitespace-nowrap text-xs uppercase tracking-wider">
                            | {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <a href="#story" class="text-[#dfdfbb] transition hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]">OUR STORY</a>
            <a href="#mag" class="text-[#dfdfbb] transition hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]">MAG</a>
            <a href="#contact" class="text-[#dfdfbb] transition hover:[text-shadow:0.03em_0_0_currentColor,-0.03em_0_0_currentColor]">CONTACT</a>
        </nav>
        <div class="text-white">
            <span>ENG</span>
        </div>
    </div>
</header>
