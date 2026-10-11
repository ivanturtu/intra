@extends('layouts.app')

@section('content')
    @include('partials.header')

    @php
        $heroArrow = 'absolute top-1/2 -translate-y-1/2 z-20 w-[3rem] h-[3rem] flex items-center justify-center transition cursor-pointer';
        $arrowIcon = 'w-[1.75rem] h-[3.5rem]';
    @endphp

    <!-- Hero Section -->
    @if($heroProjects->count() > 0)
        <section class="relative h-[37.5rem] md:h-[59.375rem] overflow-hidden"
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
                     class="absolute inset-0">
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
                        <div class="absolute inset-0 bg-black/20"></div>
                    </div>
                    <div class="relative z-10 site-container pt-[12rem] md:pt-[23.2rem] text-white">
                        <a href="{{ $project->slug ? route('work.show', $project->slug) : '#' }}" class="block cursor-pointer md:w-3/4">
                            <h2 class="font-light text-[3rem] leading-[1.07] md:text-[5.5rem] md:leading-[5.875rem]">
                                {{ $project->title }}
                            </h2>
                        </a>
                        @if($project->category)
                            <p class="mt-[1.75rem] text-[1.5rem] leading-[1.875rem] uppercase text-secondary">{{ $project->category->name }}</p>
                        @endif
                    </div>
                </div>
            @endforeach

            @if($heroProjects->count() > 1)
                <!-- Navigation Buttons -->
                <button @click="currentSlide = (currentSlide - 1 + slides) % slides"
                        class="{{ $heroArrow }} left-2 md:left-[3.2rem] text-white/90 hover:text-white" aria-label="Previous">
                    <svg class="{{ $arrowIcon }}" fill="none" stroke="currentColor" viewBox="0 0 16 32">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14 2L2 16l12 14"></path>
                    </svg>
                </button>
                <button @click="currentSlide = (currentSlide + 1) % slides"
                        class="{{ $heroArrow }} right-2 md:right-[3.2rem] text-white/90 hover:text-white" aria-label="Next">
                    <svg class="{{ $arrowIcon }}" fill="none" stroke="currentColor" viewBox="0 0 16 32">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2 2l12 14L2 30"></path>
                    </svg>
                </button>

                <!-- Slide indicators: one bar per slide across the content width -->
                <div class="absolute bottom-[3.25rem] inset-x-0 z-20">
                    <div class="site-container flex gap-[1rem]">
                        @foreach($heroProjects as $index => $project)
                            <button @click="currentSlide = {{ $index }}"
                                    :class="currentSlide === {{ $index }} ? 'bg-white' : 'bg-white/50'"
                                    class="flex-1 h-[2px] transition cursor-pointer" aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
    @else
        <section class="relative h-[37.5rem] md:h-[59.375rem] overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://via.placeholder.com/1920x1080/87CEEB/FFFFFF?text=Ornate+Interior+Design"
                     alt="Hero Background"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/20"></div>
            </div>
            <div class="relative z-10 site-container pt-[12rem] md:pt-[23.2rem] text-white">
                <h2 class="font-light text-[3rem] leading-[1.07] md:text-[5.5rem] md:leading-[5.875rem] md:w-3/4">
                    The Delight Factor. A New Metric of Your Workplace.
                </h2>
            </div>
        </section>
    @endif

    <!-- Project Showcase Slider: one project on 10 columns, the next one peeking from the right edge -->
    @if(isset($sliderProjects) && $sliderProjects && $sliderProjects->count() > 0)
    <section class="relative bg-white overflow-hidden pt-[4rem] md:pt-[7.4375rem] pb-[3.75rem]"
             x-data="{
                 currentIndex: 0,
                 maxIndex: {{ $sliderProjects->count() - 1 }},
                 next() { this.currentIndex = this.currentIndex < this.maxIndex ? this.currentIndex + 1 : 0 },
                 prev() { this.currentIndex = this.currentIndex > 0 ? this.currentIndex - 1 : this.maxIndex }
             }">
        <div class="site-container">
            <div class="[clip-path:inset(0_-100vw_0_0)]">
                <div class="flex gap-[3rem] transition-transform duration-500 ease-in-out [--slide-w:85%] md:[--slide-w:calc((100%-11rem)/12*10+9rem)]"
                     :style="`transform: translateX(calc(${currentIndex} * -1 * (var(--slide-w) + 3rem)))`">
                    @foreach($sliderProjects as $project)
                        <a href="{{ route('work.show', $project->slug) }}" class="group block flex-none w-[var(--slide-w)] cursor-pointer text-primary">
                            <div class="overflow-hidden h-[20rem] md:h-[48rem]">
                                @if($project->main_image)
                                    <img src="{{ asset('storage/' . $project->main_image) }}"
                                         alt="{{ $project->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <img src="https://via.placeholder.com/1400x800/CCCCCC/FFFFFF?text={{ urlencode($project->title) }}"
                                         alt="{{ $project->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @endif
                            </div>
                            <div class="grid grid-cols-10 gap-x-[1rem] mt-[0.5625rem]">
                                <div class="col-span-10 md:col-span-5">
                                    <h3 class="text-[1.5rem] leading-[1.75rem] font-light uppercase">{{ $project->title }}</h3>
                                    @if($project->location)
                                        <p class="mt-[0.27rem] text-[1.125rem] leading-[1.5rem] uppercase">{{ $project->location }}</p>
                                    @endif
                                </div>
                                @if($project->category)
                                    <p class="hidden md:block md:col-span-5 text-[1.5rem] leading-[1.75rem] font-light">{{ $project->category->name }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Navigation Buttons (centered on the image, in the side margins) -->
        @if($sliderProjects->count() > 1)
            <button @click="prev()"
                    class="{{ $heroArrow }} !top-[calc(4rem+10rem)] md:!top-[calc(7.4375rem+24rem)] left-2 md:left-[3.2rem] text-primary/90 hover:text-primary" aria-label="Previous">
                <svg class="{{ $arrowIcon }}" fill="none" stroke="currentColor" viewBox="0 0 16 32">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14 2L2 16l12 14"></path>
                </svg>
            </button>
            <button @click="next()"
                    class="{{ $heroArrow }} !top-[calc(4rem+10rem)] md:!top-[calc(7.4375rem+24rem)] right-2 md:right-[3.2rem] text-white/90 hover:text-white" aria-label="Next">
                <svg class="{{ $arrowIcon }}" fill="none" stroke="currentColor" viewBox="0 0 16 32">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2 2l12 14L2 30"></path>
                </svg>
            </button>
        @endif
    </section>
    @endif

    <!-- Expertise Section -->
    <section id="expertise" class="bg-primary text-white pt-[4rem] md:pt-[11.8rem] pb-[4rem] md:pb-[9.5rem]">
        <div class="site-container site-grid">
            <div class="col-span-12 md:col-span-3 md:pt-[0.825rem]">
                <h2 class="text-[2.25rem] md:text-[3rem] leading-[3.5rem] font-medium text-tertiary">Expertise</h2>
            </div>
            <ul class="col-span-12 md:col-span-9">
                @foreach($categories as $category)
                    <li class="group pt-[0.825rem] pb-[calc(2.7rem-2px)] border-b-2 border-sky">
                        <a href="/work?category={{ $category->id }}" class="block cursor-pointer">
                            <span class="block text-[2.25rem] md:text-[3rem] leading-[3.5rem] font-light text-sky group-hover:text-tertiary transition-colors">{{ $category->name }}</span>
                        </a>
                        <div class="mt-[1.975rem] flex flex-col md:flex-row md:items-baseline md:justify-between gap-4">
                            @if(!empty($category->subtitle))
                                <a href="/work?category={{ $category->id }}" class="text-[1.5rem] md:text-[1.875rem] leading-[2.25rem] font-light text-secondary cursor-pointer">
                                    ›&nbsp;&nbsp;{{ $category->subtitle }}
                                </a>
                            @else
                                <span></span>
                            @endif
                            <a href="/work?category={{ $category->id }}" class="shrink-0 inline-flex items-center gap-[0.5rem] text-[1.125rem] uppercase text-white hover:text-tertiary transition cursor-pointer">
                                <span><span class="font-medium">Go to the</span> Projects</span>
                                <svg class="w-[0.9rem] h-[0.9rem]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M7 17L17 7M8 7h9v9"/></svg>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <!-- Intra Mag Section: orange background stops 34px above the bottom of the images -->
    <section id="mag" class="relative bg-white border-t-[0.5625rem] border-white pt-[3.875rem] pb-[6.1875rem]">
        <div class="absolute inset-x-0 top-0 bottom-[10.625rem] bg-tertiary z-0"></div>

        <div class="site-container relative z-10">
            <h2 class="text-[2.25rem] md:text-[3rem] leading-[3.5rem] text-primary">
                <span class="font-light">Intra</span> <span class="font-medium">Mag</span>
            </h2>
            <div class="site-grid gap-y-8 mt-[2.4375rem]">
                @if(isset($magazineArticles) && $magazineArticles->count() > 0)
                    @foreach($magazineArticles as $article)
                    <a href="#" class="group cursor-pointer block col-span-12 md:col-span-6">
                        <div class="relative overflow-hidden h-[20rem] md:h-[31.6875rem]">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}"
                                     alt="{{ $article->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <img src="https://via.placeholder.com/800x600/8B7355/FFFFFF?text={{ urlencode($article->title) }}"
                                     alt="{{ $article->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @endif
                            @if($article->category)
                                <div class="absolute bottom-0 left-0 bg-primary px-[0.5rem]">
                                    <span class="block text-[1rem] leading-[2rem] uppercase text-white">{{ $article->category->name }}</span>
                                </div>
                            @endif
                        </div>
                        <h3 class="mt-[0.5625rem] text-[1.5rem] leading-[1.75rem] font-light text-primary">{{ $article->title }}</h3>
                    </a>
                    @endforeach
                @else
                    <!-- Fallback static content if no articles -->
                    @foreach([['L\'antico tempio della Grecia', 'Beni culturali', 'Parthenon+Ruins'], ['Giovanni Muzio. Casa dei giornalisti (Milano 1936).', 'Sostenibilità', 'Giovanni+Muzio']] as [$title, $tag, $img])
                    <div class="group cursor-pointer col-span-12 md:col-span-6">
                        <div class="relative overflow-hidden h-[20rem] md:h-[31.6875rem]">
                            <img src="https://via.placeholder.com/800x600/8B7355/FFFFFF?text={{ $img }}"
                                 alt="{{ $title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div class="absolute bottom-0 left-0 bg-primary px-[0.5rem]">
                                <span class="block text-[1rem] leading-[2rem] uppercase text-white">{{ $tag }}</span>
                            </div>
                        </div>
                        <h3 class="mt-[0.5625rem] text-[1.5rem] leading-[1.75rem] font-light text-primary">{{ $title }}</h3>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    @include('partials.footer')
@endsection
