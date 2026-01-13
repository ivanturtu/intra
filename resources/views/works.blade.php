@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="bg-[#1b304e] text-white px-8 py-0">
        <div class="container mx-auto flex items-center justify-between header-logo-container">
            <div class="flex items-center h-full">
                <a href="/" class="h-full flex items-center">
                    <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-full">
                </a>
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a href="/work" class="text-[#dfdfbb] hover:font-bold transition">WORKS</a>
                <a href="#expertise" class="text-[#dfdfbb] hover:font-bold transition">EXPERTISE</a>
                <a href="#story" class="text-[#dfdfbb] hover:font-bold transition">OUR STORY</a>
                <a href="#mag" class="text-[#dfdfbb] hover:font-bold transition">MAG</a>
                <a href="#contact" class="text-[#dfdfbb] hover:font-bold transition">CONTACT</a>
            </nav>
            <div class="text-white">
                <span>ENG</span>
            </div>
        </div>
    </header>

    <!-- Selected Works Section -->
    <section class="bg-white py-16 px-8">
        <div class="container mx-auto">
            <!-- Title with vertical line -->
            <div class="flex items-center gap-4 mb-8">
                <div class="w-1 h-16 bg-[#1b304e]"></div>
                <h1 class="text-4xl md:text-5xl font-bold text-[#1b304e]">Selected Works</h1>
            </div>

            <!-- Category Filters -->
            <div class="flex flex-wrap gap-3 mb-8">
                @foreach($categories as $category)
                    <button 
                        class="category-filter bg-[#dfdfbb] text-[#1b304e] px-4 py-2 rounded hover:bg-[#d3924f] hover:text-white transition"
                        data-category="{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Introductory Text -->
            <div class="max-w-3xl mb-12">
                <p class="text-gray-700 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="projects-grid">
                @foreach($projects as $project)
                    <a href="{{ route('work.show', $project->slug) }}" 
                       class="project-card group relative overflow-hidden h-[400px]"
                       data-category="{{ $project->category_id ?? '' }}">
                        @if($project->main_image)
                            <img src="{{ asset('storage/' . $project->main_image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <img src="https://via.placeholder.com/600x400/87CEEB/FFFFFF?text={{ urlencode($project->title) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @endif
                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <!-- Title and Location Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold mb-1">{{ $project->title }}</h3>
                            @if($project->location)
                                <p class="text-gray-300 text-sm">{{ strtoupper($project->location) }}</p>
                            @elseif($project->category)
                                <p class="text-gray-300 text-sm">{{ strtoupper($project->category->name) }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <!-- Workflow Section -->
        <div id="workflow" class="bg-[#d3924f] text-white py-16 px-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <h3 class="text-2xl font-bold mb-8">Project Workflow</h3>
                    </div>
                    <div>
                        <ul class="space-y-4">
                            <li class="bg-[#d3924f]/80 px-4 py-3 rounded">
                                <span class="font-semibold">Preliminary Analysis and Research</span>
                            </li>
                            <li class="px-4 py-3">Assessment and Diagnosis</li>
                            <li class="px-4 py-3">Concept Design</li>
                            <li class="px-4 py-3">Design Development</li>
                            <li class="px-4 py-3">Construction Documentation</li>
                            <li class="px-4 py-3">Project Management</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Content -->
        <div class="bg-[#1b304e] text-white py-12 px-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-8">
                    <!-- Address Section -->
                    <div>
                        <h4 class="text-xl font-bold mb-4">INTRA studio</h4>
                        <p class="text-gray-300 mb-4">
                            1505 Barrington Street, Suite 100 - M03<br>
                            Halifax, Nova Scotia, B3J 2A4 CANADA
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="text-white hover:text-[#dfdfbb] transition">FB</a>
                            <a href="#" class="text-white hover:text-[#dfdfbb] transition">LI</a>
                            <a href="#" class="text-white hover:text-[#dfdfbb] transition">PH</a>
                        </div>
                    </div>

                    <!-- Menu Section -->
                    <div>
                        <h5 class="font-semibold mb-4">Menu</h5>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="/work" class="hover:text-white transition">Works</a></li>
                            <li><a href="#expertise" class="hover:text-white transition">Expertise</a></li>
                            <li><a href="#story" class="hover:text-white transition">Our Story</a></li>
                            <li><a href="#mag" class="hover:text-white transition">MAG</a></li>
                        </ul>
                    </div>

                    <!-- Services Section -->
                    <div>
                        <h5 class="font-semibold mb-4">Services</h5>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="#" class="hover:text-white transition">Heritage</a></li>
                            <li><a href="#" class="hover:text-white transition">Conservation</a></li>
                            <li><a href="#" class="hover:text-white transition">Research</a></li>
                            <li><a href="#" class="hover:text-white transition">Project management</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="bg-[#d3924f] text-white py-4 px-8">
            <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm mb-2 md:mb-0">© 2025 INTRA studio • All Rights Reserved.</p>
                <div class="flex gap-6 text-sm">
                    <a href="#" class="hover:underline">Privacy Policy</a>
                    <a href="#" class="hover:underline">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Category filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.category-filter');
            const projectCards = document.querySelectorAll('.project-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-category');
                    
                    // Toggle active state
                    filterButtons.forEach(btn => {
                        btn.classList.remove('bg-[#d3924f]', 'text-white');
                        btn.classList.add('bg-[#dfdfbb]', 'text-[#1b304e]');
                    });
                    
                    if (categoryId) {
                        this.classList.remove('bg-[#dfdfbb]', 'text-[#1b304e]');
                        this.classList.add('bg-[#d3924f]', 'text-white');
                    }

                    // Filter projects
                    projectCards.forEach(card => {
                        const cardCategory = card.getAttribute('data-category');
                        if (!categoryId || cardCategory === categoryId) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
@endsection
