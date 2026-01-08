@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="bg-[#1a304f] text-white px-8 sticky top-0 z-50 py-0">
        <div class="container mx-auto flex items-center justify-between header-logo-container">
            <div class="flex items-center h-full">
                <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-full">
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a href="/work" class="hover:text-gray-300 transition">WORK</a>
                <a href="#expertise" class="hover:text-gray-300 transition">EXPERTISE</a>
                <a href="#story" class="hover:text-gray-300 transition">OUR STORY</a>
                <a href="#mag" class="hover:text-gray-300 transition">MAG</a>
                <a href="#contact" class="hover:text-gray-300 transition">CONTACT</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
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
            <a href="/work" class="inline-block border-2 border-white px-8 py-3 rounded hover:bg-white hover:text-[#1a304f] transition">
                TAG WORK
            </a>
        </div>
    </section>

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
    <section class="bg-[#1a304f] text-white py-20 px-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-[#d39250] mb-8">Our Services</h2>
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
    <section id="mag" class="bg-[#d39250] text-white py-20 px-8">
        <div class="container mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold mb-12">Intra Mag</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://via.placeholder.com/800x600/8B7355/FFFFFF?text=Parthenon+Ruins" 
                             alt="L'antico tempio della Grecia" 
                             class="w-full h-[400px] object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute top-0 right-0 bg-[#1a304f] px-4 py-2">
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
                        <div class="absolute top-0 right-0 bg-[#1a304f] px-4 py-2">
                            <span class="text-xs uppercase">SOSTENIBILITÀ</span>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium">Giovanni Muzio, Casa dei giornalisti (Milano 1936).</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#1a304f] text-white py-12 px-8">
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
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1a304f] transition">
                            <span class="text-sm">f</span>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1a304f] transition">
                            <span class="text-sm">in</span>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1a304f] transition">
                            <span class="text-sm">ig</span>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1a304f] transition">
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
