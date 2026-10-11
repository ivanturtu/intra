@extends('layouts.app')

@section('content')
    @include('partials.header')

    <!-- Selected Works Section -->
    <section class="bg-white pt-[4.375rem] pb-[7.5rem]">
        <div class="site-container">
            <!-- Title with vertical line on the first grid column -->
            <div class="flex items-center gap-[0.9375rem] h-[6.25rem] border-l-4 border-primary pl-[0.9375rem]">
                <h1 class="font-medium text-primary text-[2.5rem] md:text-[3.125rem] leading-none">Selected Works</h1>
            </div>

            <div class="pl-[1.1875rem]">
                <!-- Category Filters -->
                <div class="inline-flex flex-wrap gap-x-[1.6875rem] gap-y-2 mt-[2.25rem] border-b border-secondary">
                    <button
                        class="category-filter text-[1rem] leading-[2rem] text-tertiary border-b-2 border-tertiary -mb-px transition cursor-pointer"
                        data-category="">
                        All
                    </button>
                    @foreach($categories as $category)
                        <button
                            class="category-filter text-[1rem] leading-[2rem] text-tertiary border-b-2 border-transparent hover:border-tertiary -mb-px transition cursor-pointer"
                            data-category="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>

                <!-- Introductory Text -->
                <p class="mt-[2.75rem] text-primary font-light text-[1.5rem] leading-[1.875rem] md:text-[1.875rem] md:leading-[2.25rem]">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
            </div>

            <!-- Projects Grid: 3 cards of 4 columns -->
            <div class="site-grid gap-y-[1rem] mt-[4.25rem]" id="projects-grid">
                @foreach($projects as $project)
                    <a href="{{ route('work.show', $project->slug) }}"
                       class="project-card group relative overflow-hidden col-span-12 md:col-span-6 lg:col-span-4 h-[25rem] md:h-[31.25rem] transition-opacity duration-200 cursor-pointer"
                       data-category="{{ $project->category_id ?? '' }}">
                        @if($project->main_image)
                            <img src="{{ asset('storage/' . $project->main_image) }}"
                                 alt="{{ $project->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <img src="https://via.placeholder.com/600x560/87CEEB/FFFFFF?text={{ urlencode($project->title) }}"
                                 alt="{{ $project->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @endif
                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-black/5 to-transparent group-hover:opacity-0 transition-opacity duration-300"></div>
                        <!-- Title and Location Overlay -->
                        <div class="absolute bottom-0 inset-x-0 px-[1.875rem] pt-[1.25rem] pb-[1.625rem] text-white group-hover:bg-white group-hover:text-primary transition-all duration-300">
                            <h3 class="text-[1.5rem] leading-[1.75rem] font-medium uppercase">{{ $project->title }}</h3>
                            @if($project->location)
                                <p class="mt-[0.25rem] text-[1.125rem] leading-[1.5rem] uppercase">{{ $project->location }}</p>
                            @elseif($project->category)
                                <p class="mt-[0.25rem] text-[1.125rem] leading-[1.5rem] uppercase">{{ $project->category->name }}</p>
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
                        btn.classList.remove('border-tertiary');
                        btn.classList.add('border-transparent');
                    });
                    this.classList.remove('border-transparent');
                    this.classList.add('border-tertiary');

                    // Filter projects with simple fade
                    projectCards.forEach(card => {
                        const cardCategory = card.getAttribute('data-category');
                        const shouldShow = !categoryId || cardCategory === categoryId;

                        if (shouldShow) {
                            card.style.display = 'block';
                            requestAnimationFrame(() => {
                                card.style.opacity = '1';
                            });
                        } else {
                            card.style.opacity = '0';
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
