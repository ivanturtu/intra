@extends('layouts.app')

@section('content')
    @include('partials.header')

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
                     class="absolute inset-0 flex items-center">
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
                    <div class="relative z-10 text-left text-white px-8 container mx-auto">
                        @if($project->slug)
                            <a href="{{ route('work.show', $project->slug) }}" class="block">
                                <h2 class="font-light leading-[1.05]" style="font-size: clamp(3rem, 6vw, 6rem);">
                                    {{ $project->title }}
                                </h2>
                            </a>
                        @else
                            <h2 class="font-light leading-[1.05]" style="font-size: clamp(3rem, 6vw, 6rem);">
                                {{ $project->title }}
                            </h2>
                        @endif
                    </div>
                </div>
            @endforeach
            
            @if($heroProjects->count() > 1)
                <!-- Navigation Buttons -->
                <button @click="currentSlide = (currentSlide - 1 + slides) % slides" 
                        class="absolute left-4 top-1/2 -translate-y-1/2 z-20 text-white/90 hover:text-white transition">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button @click="currentSlide = (currentSlide + 1) % slides" 
                        class="absolute right-4 top-1/2 -translate-y-1/2 z-20 text-white/90 hover:text-white transition">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <!-- Dots Indicator -->
                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3">
                    @foreach($heroProjects as $index => $project)
                        <button @click="currentSlide = {{ $index }}" 
                                :class="currentSlide === {{ $index }} ? 'bg-white' : 'bg-white/40'"
                                class="h-px w-16 transition"></button>
                    @endforeach
                </div>
            @endif
        </section>
    @else
        <section class="relative h-[80vh] min-h-[600px] flex items-center">
        <div class="absolute inset-0 z-0">
            <img src="https://via.placeholder.com/1920x1080/87CEEB/FFFFFF?text=Ornate+Interior+Design" 
                 alt="Hero Background" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
            <div class="relative z-10 text-left text-white px-8 container mx-auto">
                <h2 class="font-light leading-[1.05]" style="font-size: clamp(3rem, 6vw, 6rem);">
                The Delight Factor. A New Metric of Your Workplace.
            </h2>
        </div>
    </section>
    @endif

    <!-- Project Showcase Slider -->
    @if(isset($sliderProjects) && $sliderProjects && $sliderProjects->count() > 0)
    <section class="py-16 px-8 bg-white">
        <div class="container mx-auto">
                <div class="relative" 
                     x-data="{ 
                         currentIndex: 0,
                         totalProjects: {{ $sliderProjects->count() }},
                         get totalSlides() {
                             return Math.ceil(this.totalProjects / 2);
                         },
                         nextSlide() {
                             if (this.currentIndex < this.totalSlides - 1) {
                                 this.currentIndex++;
                             } else {
                                 this.currentIndex = 0;
                             }
                         },
                         prevSlide() {
                             if (this.currentIndex > 0) {
                                 this.currentIndex--;
                             } else {
                                 this.currentIndex = this.totalSlides - 1;
                             }
                         }
                     }">
                    <!-- Slider Container -->
                    <div class="overflow-hidden">
                        <div class="flex transition-transform duration-500 ease-in-out" 
                             :style="`transform: translateX(-${currentIndex * 100}%)`">
                            @for($i = 0; $i < $sliderProjects->count(); $i += 2)
                                <div class="w-full flex-shrink-0 flex gap-4">
                                    @if(isset($sliderProjects[$i]))
                                        <div class="w-1/2">
                                            <a href="{{ route('work.show', $sliderProjects[$i]->slug) }}" class="group cursor-pointer block">
                                                <div class="relative overflow-hidden mb-4">
                                                    @if($sliderProjects[$i]->main_image)
                                                        <img src="{{ asset('storage/' . $sliderProjects[$i]->main_image) }}" 
                                                             alt="{{ $sliderProjects[$i]->title }}" 
                                                             class="w-full h-[500px] object-cover group-hover:scale-105 transition duration-300">
                                                    @else
                                                        <img src="https://via.placeholder.com/600x800/CCCCCC/FFFFFF?text={{ urlencode($sliderProjects[$i]->title) }}" 
                                                             alt="{{ $sliderProjects[$i]->title }}" 
                             class="w-full h-[500px] object-cover group-hover:scale-105 transition duration-300">
                                                    @endif
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                                                        <h3 class="font-semibold text-sm uppercase mb-1">{{ strtoupper($sliderProjects[$i]->title) }}</h3>
                                                        @if($sliderProjects[$i]->location)
                                                            <p class="text-xs text-gray-600 uppercase">{{ strtoupper($sliderProjects[$i]->location) }}</p>
                                                        @endif
                        </div>
                                                    @if($sliderProjects[$i]->category)
                                                        <span class="text-xs text-gray-500 uppercase">{{ strtoupper($sliderProjects[$i]->category->name) }}</span>
                                                    @endif
                    </div>
                                            </a>
                </div>
                                    @endif
                                    @if(isset($sliderProjects[$i + 1]))
                                        <div class="w-1/2">
                                            <a href="{{ route('work.show', $sliderProjects[$i + 1]->slug) }}" class="group cursor-pointer block">
                                                <div class="relative overflow-hidden mb-4">
                                                    @if($sliderProjects[$i + 1]->main_image)
                                                        <img src="{{ asset('storage/' . $sliderProjects[$i + 1]->main_image) }}" 
                                                             alt="{{ $sliderProjects[$i + 1]->title }}" 
                                                             class="w-full h-[500px] object-cover group-hover:scale-105 transition duration-300">
                                                    @else
                                                        <img src="https://via.placeholder.com/600x800/CCCCCC/FFFFFF?text={{ urlencode($sliderProjects[$i + 1]->title) }}" 
                                                             alt="{{ $sliderProjects[$i + 1]->title }}" 
                             class="w-full h-[500px] object-cover group-hover:scale-105 transition duration-300">
                                                    @endif
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                                                        <h3 class="font-semibold text-sm uppercase mb-1">{{ strtoupper($sliderProjects[$i + 1]->title) }}</h3>
                                                        @if($sliderProjects[$i + 1]->location)
                                                            <p class="text-xs text-gray-600 uppercase">{{ strtoupper($sliderProjects[$i + 1]->location) }}</p>
                                                        @endif
                        </div>
                                                    @if($sliderProjects[$i + 1]->category)
                                                        <span class="text-xs text-gray-500 uppercase">{{ strtoupper($sliderProjects[$i + 1]->category->name) }}</span>
                                                    @endif
                    </div>
                                            </a>
                </div>
                                    @endif
                    </div>
                            @endfor
                        </div>
                    </div>
                    
                    <!-- Navigation Buttons -->
                    @if($sliderProjects->count() > 2)
                        <button @click="prevSlide()" 
                                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-[#1b304e] p-3 rounded-full shadow-lg transition z-10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="nextSlide()" 
                                class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-[#1b304e] p-3 rounded-full shadow-lg transition z-10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endif
            </div>
        </div>
    </section>
    @endif

    <!-- Expertise Section -->
    <section id="expertise" class="bg-[#1b304e] text-white py-20 px-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-16">
                <div class="md:col-span-3">
                    <h2 class="text-4xl md:text-5xl font-bold text-[#d3924f] mb-8">Expertise</h2>
                </div>
                <div class="md:col-span-9">
                    <ul class="space-y-0" x-data="{ openId: null }">
                        @foreach($categories as $index => $category)
                            <li class="py-8 {{ $index < $categories->count() - 1 ? 'border-b border-white/10' : '' }}">
                                <button
                                    type="button"
                                    class="w-full text-left leading-tight flex items-center justify-between gap-6 cursor-pointer group"
                                    @click="openId === {{ $category->id }} ? openId = null : openId = {{ $category->id }}"
                                    :aria-expanded="openId === {{ $category->id }}"
                                >
                                    <span class="text-3xl md:text-4xl font-light group-hover:text-[#d3924f] transition-colors">{{ $category->name }}</span>
                                </button>
                                @if(!empty($category->subtitle))
                                    <div
                                        x-show="openId === {{ $category->id }}"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 -translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 -translate-y-1"
                                        class="mt-2 text-lg md:text-xl text-[#dfdfbb]"
                                        style="display: none;"
                                    >
                                        <a href="/work?category={{ $category->id }}" class="inline-flex items-baseline hover:underline">
                                            <span class="opacity-80">›</span>
                                            <span class="ml-2">{{ $category->subtitle }}</span>
                                        </a>
                                    </div>
                                @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Intra Mag Section -->
    <section id="mag" class="relative py-20 px-8 overflow-hidden">
        <!-- Background: Tertiary color covering 4/5 (80%) of section -->
        <div class="absolute inset-0 bg-[#d3924f] z-0" style="height: 80%;"></div>
        <!-- Background: White covering remaining 1/5 (20%) -->
        <div class="absolute bottom-0 left-0 right-0 bg-white z-0" style="height: 20%;"></div>
        
        <div class="container mx-auto relative z-10">
            <h2 class="text-4xl md:text-5xl mb-12 text-[#1b304e]">
                <span class="font-normal">Intra</span> <span class="font-bold">Mag</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @if(isset($magazineArticles) && $magazineArticles->count() > 0)
                    @foreach($magazineArticles as $article)
                    <a href="#" class="group cursor-pointer">
                        <div class="relative overflow-hidden mb-4 h-[500px]">
                            <!-- Background color extending 9/10 of image height (90%) -->
                            <div class="absolute inset-0 bg-[#d3924f] z-0" style="height: 90%;"></div>
                            <!-- Image -->
                            <div class="relative z-10 h-full">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" 
                                         alt="{{ $article->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <img src="https://via.placeholder.com/800x600/8B7355/FFFFFF?text={{ urlencode($article->title) }}" 
                                         alt="{{ $article->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @endif
                            </div>
                            @if($article->category)
                                <div class="absolute bottom-0 left-0 bg-[#1b304e] px-4 py-2 z-20">
                                    <span class="text-xs uppercase text-white">{{ strtoupper($article->category->name) }}</span>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-lg font-light text-[#1b304e]">{{ $article->title }}</h3>
                    </a>
                    @endforeach
                @else
                    <!-- Fallback static content if no articles -->
                <div class="group cursor-pointer">
                        <div class="relative overflow-hidden mb-4 h-[500px]">
                            <!-- Background color extending 9/10 of image height (90%) -->
                            <div class="absolute inset-0 bg-[#d3924f] z-0" style="height: 90%;"></div>
                            <!-- Image -->
                            <div class="relative z-10 h-full">
                        <img src="https://via.placeholder.com/800x600/8B7355/FFFFFF?text=Parthenon+Ruins" 
                             alt="L'antico tempio della Grecia" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            </div>
                            <div class="absolute bottom-0 left-0 bg-[#1b304e] px-4 py-2 z-20">
                                <span class="text-xs uppercase text-white">BENI CULTURALI</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-light text-[#1b304e]">L'antico tempio della Grecia</h3>
                    </div>
                <div class="group cursor-pointer">
                        <div class="relative overflow-hidden mb-4 h-[500px]">
                            <!-- Background color extending 9/10 of image height (90%) -->
                            <div class="absolute inset-0 bg-[#d3924f] z-0" style="height: 90%;"></div>
                            <!-- Image -->
                            <div class="relative z-10 h-full">
                        <img src="https://via.placeholder.com/800x600/2C2C2C/FFFFFF?text=Giovanni+Muzio+Book" 
                             alt="Giovanni Muzio" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            </div>
                            <div class="absolute bottom-0 left-0 bg-[#1b304e] px-4 py-2 z-20">
                                <span class="text-xs uppercase text-white">SOSTENIBILITÀ</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-light text-[#1b304e]">Giovanni Muzio, Casa dei giornalisti (Milano 1936).</h3>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('partials.footer')
@endsection
