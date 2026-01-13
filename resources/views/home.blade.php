@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="bg-[#1b304e] text-white px-8 sticky top-0 z-50 py-0">
        <div class="container mx-auto flex items-center justify-between header-logo-container">
            <div class="flex items-center h-full">
                <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-full">
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a href="/work" class="text-[#dfdfbb] hover:font-bold transition">WORKS</a>
                <a href="#expertise" class="text-[#dfdfbb] hover:font-bold transition">EXPERTISE</a>
                <a href="#story" class="text-[#dfdfbb] hover:font-bold transition">OUR STORY</a>
                <a href="#mag" class="text-[#dfdfbb] hover:font-bold transition">MAG</a>
                <a href="#contact" class="text-[#dfdfbb] hover:font-bold transition">CONTACT</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    @if($heroProjects->count() > 0)
        <section class="relative h-[80vh] min-h-[600px]" 
                 x-data="{ 
                     currentSlide: 0, 
                     slides: {{ $heroProjects->count() }},
                     init() {
                         if (this.slides > 1) {
                             setInterval(() => {
                                 this.currentSlide = (this.currentSlide + 1) % this.slides;
                             }, 5000);
                         }
                     }
                 }">
            @foreach($heroProjects as $index => $project)
                <div x-show="currentSlide === {{ $index }}" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 flex items-center justify-center">
                    <div class="absolute inset-0 z-0">
                        @if($project->main_image)
                            <img src="{{ asset('storage/' . $project->main_image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <img src="https://via.placeholder.com/1920x1080/87CEEB/FFFFFF?text={{ urlencode($project->title) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover">
                        @endif
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                    <div class="relative z-10 text-center text-white px-8">
                        <h2 class="text-4xl md:text-6xl font-bold mb-8 max-w-4xl mx-auto">
                            {{ $project->title }}
                        </h2>
                        @if($project->short_description)
                            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                                {{ $project->short_description }}
                            </p>
                        @endif
                        @if($project->slug)
                            <a href="{{ route('work.show', $project->slug) }}" class="inline-block border-2 border-white px-8 py-3 rounded hover:bg-white hover:text-[#1b304e] transition">
                                VIEW PROJECT
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
            
            @if($heroProjects->count() > 1)
                <!-- Navigation Buttons -->
                <button @click="currentSlide = (currentSlide - 1 + slides) % slides" 
                        class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button @click="currentSlide = (currentSlide + 1) % slides" 
                        class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <!-- Dots Indicator -->
                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-2">
                    @foreach($heroProjects as $index => $project)
                        <button @click="currentSlide = {{ $index }}" 
                                :class="currentSlide === {{ $index }} ? 'bg-white' : 'bg-white/50'"
                                class="w-3 h-3 rounded-full transition"></button>
                    @endforeach
                </div>
            @endif
        </section>
    @else
        <section class="relative h-[80vh] min-h-[600px] flex items-center justify-center">
            <div class="absolute inset-0 z-0">
                <img src="https://via.placeholder.com/1920x1080/87CEEB/FFFFFF?text=Ornate+Interior+Design" 
                     alt="Hero Background" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="relative z-10 text-center text-white px-8">
                <h2 class="text-4xl md:text-6xl font-bold mb-8 max-w-4xl mx-auto">
                    The Delight Factor. A New Metric of Your Workplace.
                </h2>
                <a href="/work" class="inline-block border-2 border-white px-8 py-3 rounded hover:bg-white hover:text-[#1b304e] transition">
                    TAG WORK
                </a>
            </div>
        </section>
    @endif

    <!-- Project Showcase -->
    <section class="py-16 px-8 bg-white">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Project Card 1 -->
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://via.placeholder.com/600x800/CCCCCC/FFFFFF?text=Palazzo+Staircase" 
                             alt="Palazzo Visconte Rinascimentale" 
                             class="w-full h-[500px] object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold text-sm uppercase mb-1">PALAZZO VISCONTE RINASCIMENTALE</h3>
                            <p class="text-xs text-gray-600 uppercase">VERONA</p>
                        </div>
                        <span class="text-xs text-gray-500 uppercase">RESTAURO ARTISTICO</span>
                    </div>
                </div>

                <!-- Project Card 2 -->
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://via.placeholder.com/600x800/DDDDDD/FFFFFF?text=Heritage+Building" 
                             alt="Project 2" 
                             class="w-full h-[500px] object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold text-sm uppercase mb-1">PROJECT TITLE</h3>
                            <p class="text-xs text-gray-600 uppercase">LOCATION</p>
                        </div>
                        <span class="text-xs text-gray-500 uppercase">TAG</span>
                    </div>
                </div>

                <!-- Project Card 3 -->
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://via.placeholder.com/600x800/FFA500/FFFFFF?text=Historic+Facade" 
                             alt="Palazzo Visconte Rinascimentale" 
                             class="w-full h-[500px] object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold text-sm uppercase mb-1">PALAZZO VISCONTE RINASCIMEN</h3>
                            <p class="text-xs text-gray-600 uppercase">VERONA</p>
                        </div>
                        <span class="text-xs text-gray-500 uppercase">TAG</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="bg-[#1b304e] text-white py-20 px-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-[#d3924f] mb-8">Our Services</h2>
                </div>
                <div>
                    <ul class="space-y-0">
                        <li class="py-4 border-b border-white/10">
                            <span class="text-lg">Restauro Conservativo</span>
                        </li>
                        <li class="py-4 border-b border-white/10">
                            <span class="text-lg">Ristrutturazioni e Riqualificazioni</span>
                        </li>
                        <li class="py-4 border-b border-white/10">
                            <span class="text-lg">Analisi e Diagnosi Strutturale</span>
                        </li>
                        <li class="py-4 border-b border-white/10">
                            <span class="text-lg">Restauro Artistico</span>
                        </li>
                        <li class="py-4 border-b border-white/10">
                            <span class="text-lg">Consulenza per Vincoli Architettonici e Paesaggistici</span>
                        </li>
                        <li class="py-4 border-b border-white/10">
                            <span class="text-lg">Progettazione Integrata</span>
                        </li>
                        <li class="py-4 border-b border-white/10">
                            <span class="text-lg">Restauro Urbano</span>
                        </li>
                        <li class="py-4">
                            <span class="text-lg">Sostenibilità nei Restauri</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Intra Mag Section -->
    <section id="mag" class="bg-[#d3924f] text-white py-20 px-8">
        <div class="container mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold mb-12">Intra Mag</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://via.placeholder.com/800x600/8B7355/FFFFFF?text=Parthenon+Ruins" 
                             alt="L'antico tempio della Grecia" 
                             class="w-full h-[400px] object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute top-0 right-0 bg-[#1b304e] px-4 py-2">
                            <span class="text-xs uppercase">BENI CULTURALI</span>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium">L'antico tempio della Grecia</h3>
                </div>

                <!-- Card 2 -->
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://via.placeholder.com/800x600/2C2C2C/FFFFFF?text=Giovanni+Muzio+Book" 
                             alt="Giovanni Muzio" 
                             class="w-full h-[400px] object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute top-0 right-0 bg-[#1b304e] px-4 py-2">
                            <span class="text-xs uppercase">SOSTENIBILITÀ</span>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium">Giovanni Muzio, Casa dei giornalisti (Milano 1936).</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#1b304e] text-white py-12 px-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-8">
                    </div>
                    <p class="text-sm text-gray-400 mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1b304e] transition">
                            <span class="text-sm">f</span>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1b304e] transition">
                            <span class="text-sm">in</span>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1b304e] transition">
                            <span class="text-sm">ig</span>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1b304e] transition">
                            <span class="text-sm">📞</span>
                        </a>
                    </div>
                </div>

                <!-- Products -->
                <div>
                    <h5 class="font-semibold mb-4">Products</h5>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Product 1</a></li>
                        <li><a href="#" class="hover:text-white transition">Product 2</a></li>
                        <li><a href="#" class="hover:text-white transition">Product 3</a></li>
                        <li><a href="#" class="hover:text-white transition">Product 4</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h5 class="font-semibold mb-4">Services</h5>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Service 1</a></li>
                        <li><a href="#" class="hover:text-white transition">Service 2</a></li>
                        <li><a href="#" class="hover:text-white transition">Service 3</a></li>
                        <li><a href="#" class="hover:text-white transition">Service 4</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h5 class="font-semibold mb-4">Resources</h5>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">News</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Videos</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQs</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-400">© 2019 IntraPlus. All Rights Reserved.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <span class="text-sm text-gray-400">|</span>
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition">Privacy Policy</a>
                    <span class="text-sm text-gray-400">|</span>
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition">Terms of Service</a>
                    <span class="text-sm text-gray-400">|</span>
                </div>
            </div>
        </div>
    </footer>
@endsection
