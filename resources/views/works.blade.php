@extends('layouts.app')

@section('content')
    @include('partials.header')

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
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent group-hover:opacity-0 transition-opacity duration-300"></div>
                        <!-- Title and Location Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white group-hover:bg-white group-hover:text-[#1b304e] transition-all duration-300">
                            <h3 class="text-xl font-bold mb-1">{{ $project->title }}</h3>
                            @if($project->location)
                                <p class="text-gray-300 text-sm group-hover:text-gray-600">{{ strtoupper($project->location) }}</p>
                            @elseif($project->category)
                                <p class="text-gray-300 text-sm group-hover:text-gray-600">{{ strtoupper($project->category->name) }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.footer')

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

            // Apply filter from query param (?category=ID)
            const params = new URLSearchParams(window.location.search);
            const initialCategoryId = params.get('category');
            if (initialCategoryId) {
                const initialBtn = document.querySelector(`.category-filter[data-category="${initialCategoryId}"]`);
                if (initialBtn) {
                    initialBtn.click();
                }
            }
        });
    </script>
@endsection
