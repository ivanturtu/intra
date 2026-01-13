@extends('layouts.app')

@section('content')
<style>
    @media (min-width: 768px) {
        .description-column {
            column-count: 2;
            column-gap: 2rem;
        }
        .description-column p {
            margin-bottom: 1rem;
            break-inside: avoid;
        }
        .description-column p:last-child {
            margin-bottom: 0;
        }
        .description-column h1,
        .description-column h2,
        .description-column h3,
        .description-column h4,
        .description-column h5,
        .description-column h6 {
            break-after: avoid;
        }
    }
</style>
    <!-- Header -->
    <header class="bg-[#1b304e] text-white px-8 py-0">
        <div class="container mx-auto flex items-center justify-between header-logo-container">
            <div class="flex items-center h-full">
                <a href="/" class="h-full flex items-center">
                    <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-full">
                </a>
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a href="/" class="text-[#dfdfbb] hover:font-bold transition">WORKS</a>
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="#expertise" class="text-[#dfdfbb] hover:font-bold transition cursor-pointer">EXPERTISE</a>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform translate-y-2"
                         class="absolute top-full left-0 mt-2 bg-white shadow-lg min-w-[200px] py-2 z-50">
                        @foreach($categories as $category)
                            <a href="/work?category={{ $category->id }}" class="block px-4 py-2 text-[#1b304e] hover:bg-gray-100 transition">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <a href="#story" class="text-[#dfdfbb] hover:font-bold transition">OUR STORY</a>
                <a href="#mag" class="text-[#dfdfbb] hover:font-bold transition">MAG</a>
                <a href="#contact" class="text-[#dfdfbb] hover:font-bold transition">CONTACT</a>
            </nav>
            <button class="bg-[#d3924f] px-4 py-2 rounded hover:bg-[#d3924f]/90 transition">
                SEE MORE
            </button>
        </div>
    </header>

    <!-- Project Overview Section -->
    <section class="bg-white py-8 px-8">
        <div class="container mx-auto">
            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-8">
                <div class="text-sm text-gray-500">Projects</div>
                @if($project->category)
                    <button class="bg-[#d3924f] text-white px-4 py-2 text-sm font-medium">
                        {{ strtoupper($project->category->name) }}
                    </button>
                @endif
            </div>
            
            <!-- Main Image - Full Width with Overlay Title -->
            <div class="mb-8 h-[600px] overflow-hidden relative">
                @if($project->main_image)
                    <img src="{{ asset('storage/' . $project->main_image) }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-full object-cover object-center">
                @else
                    <img src="https://via.placeholder.com/1200x600/87CEEB/FFFFFF?text={{ urlencode($project->title) }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-full object-cover object-center">
                @endif
                <!-- Title Overlay - Bottom Left -->
                <div class="absolute bottom-0 left-0 bg-white px-6 py-4 w-1/2">
                    <h1 class="text-4xl font-bold text-[#1b304e] leading-tight">{{ $project->title }}</h1>
                </div>
            </div>
            
            <!-- Content Grid: Description Left, Metadata Right -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Description - Left Side (6 columns / 50%) -->
                <div class="lg:col-span-6">
                    @if($project->short_description)
                        <div class="text-gray-700 mb-6 prose max-w-none text-base leading-relaxed">
                            {!! $project->short_description !!}
                        </div>
                    @endif
                </div>
                
                <!-- Right Side - Split into 2 sections of 3 columns each -->
                <!-- First section (3 columns) - GO TO Project Development -->
                <div class="lg:col-span-3">
                    <a href="#development" class="text-[#1b304e] hover:opacity-80 transition inline-block">
                        <div class="text-lg font-bold">GO TO</div>
                        <div class="flex items-center gap-2">
                            <span class="text-base font-normal">Project Development</span>
                            <svg class="w-5 h-5 text-[#d3924f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </div>
                    </a>
                </div>
                
                <!-- Second section (3 columns) - Project Metadata -->
                <div class="lg:col-span-3 space-y-4">
                    @if($project->sector)
                        <div>
                            <span class="text-sm text-gray-500">Sector:</span>
                            <p class="font-medium text-gray-900">{{ $project->sector }}</p>
                        </div>
                    @endif
                    @if($project->client)
                        <div>
                            <span class="text-sm text-gray-500">Client:</span>
                            <p class="font-medium text-gray-900">{{ $project->client }}</p>
                        </div>
                    @endif
                    @if($project->location)
                        <div>
                            <span class="text-sm text-gray-500">Location:</span>
                            <p class="font-medium text-gray-900">{{ $project->location }}</p>
                        </div>
                    @endif
                    @if($project->year)
                        <div>
                            <span class="text-sm text-gray-500">Year:</span>
                            <p class="font-medium text-gray-900">{{ $project->year }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Quote Section -->
    @if($project->quote)
        <section class="bg-[#dfdfbb] py-12 px-8">
            <div class="container mx-auto">
                <div class="bg-[#dfdfbb] p-8">
                    <p class="text-4xl text-[#1b304e] leading-tight text-center">
                        {{ $project->quote }}
                    </p>
                </div>
            </div>
        </section>
    @endif

    <!-- Image Gallery - Horizontal Scroll -->
    @if($project->image_gallery && count($project->image_gallery) > 0)
        <section class="py-12 px-8 bg-white">
            <div class="container mx-auto">
                <div class="relative" 
                     x-data="{ 
                         currentIndex: 0,
                         totalSlides: {{ ceil(count($project->image_gallery) / 2) }},
                         images: @js($project->image_gallery),
                         nextSlide() {
                             if (this.currentIndex < this.totalSlides - 1) {
                                 this.currentIndex++;
                             }
                         },
                         prevSlide() {
                             if (this.currentIndex > 0) {
                                 this.currentIndex--;
                             }
                         }
                     }">
                    <!-- Gallery Container -->
                    <div class="overflow-hidden">
                        <div class="flex transition-transform duration-500 ease-in-out" 
                             :style="`transform: translateX(-${currentIndex * 100}%)`">
                            @for($i = 0; $i < count($project->image_gallery); $i += 2)
                                <div class="w-full flex-shrink-0 grid grid-cols-1 md:grid-cols-2 gap-8">
                                    @if(isset($project->image_gallery[$i]))
                                        <div class="h-[600px] overflow-hidden">
                                            <img src="{{ asset('storage/' . $project->image_gallery[$i]) }}" 
                                                 alt="Gallery Image {{ $i + 1 }}" 
                                                 class="w-full h-full object-cover object-center">
                                        </div>
                                    @endif
                                    @if(isset($project->image_gallery[$i + 1]))
                                        <div class="h-[600px] overflow-hidden">
                                            <img src="{{ asset('storage/' . $project->image_gallery[$i + 1]) }}" 
                                                 alt="Gallery Image {{ $i + 2 }}" 
                                                 class="w-full h-full object-cover object-center">
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                    
                    <!-- Navigation Buttons -->
                    @if(count($project->image_gallery) > 2)
                        <div class="flex justify-between items-center mt-8">
                            <button @click="prevSlide()" 
                                    :disabled="currentIndex === 0"
                                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded disabled:opacity-50 disabled:cursor-not-allowed transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            
                            <div class="text-sm text-gray-500">
                                <span x-text="currentIndex + 1"></span>/<span x-text="totalSlides"></span>
                            </div>
                            
                            <button @click="nextSlide()" 
                                    :disabled="currentIndex === totalSlides - 1"
                                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded disabled:opacity-50 disabled:cursor-not-allowed transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    @else
                        <div class="text-left text-sm text-gray-500 mt-4">
                            1/{{ ceil(count($project->image_gallery) / 2) }}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Project Development Section -->
    @if($project->description)
        <section id="development" class="py-12 px-8 bg-white border-b" style="border-bottom-color: #dfdfbb;">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold mb-8 border-b" style="border-bottom-color: #dfdfbb; padding-bottom: 1.5rem;">Project development</h2>
                <div class="mb-12">
                    <div class="description-column text-gray-700 text-base leading-relaxed">
                        {!! $project->description !!}
                    </div>
                </div>
                
                <!-- Selected Image (Map/Drawings) -->
                @if($project->selected_image)
                    <div class="mb-12">
                        <img src="{{ asset('storage/' . $project->selected_image) }}" 
                             alt="Project Map" 
                             class="w-full h-auto">
                    </div>
                @endif

                <!-- Team Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <!-- Team Members -->
                    @if($project->projectTeamMembers->count() > 0)
                        <div>
                            <h3 class="font-semibold mb-4 text-[#d3924f]">Team</h3>
                            <ul class="space-y-0 text-sm">
                                @foreach($project->projectTeamMembers as $member)
                                    <li class="text-gray-700 border-b py-2 last:border-b-0" style="border-bottom-color: #dfdfbb;">
                                        @if($member->name && $member->role)
                                            <span class="font-medium">{{ $member->name }}:</span> {{ $member->role }}
                                        @elseif($member->name)
                                            {{ $member->name }}
                                        @elseif($member->role)
                                            {{ $member->role }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- INTRAstudio Team Leads -->
                    @if($project->intraStudioTeamLeads->count() > 0)
                        <div>
                            <h3 class="font-semibold mb-4 text-[#d3924f]">INTRAstudio Team Leads</h3>
                            <ul class="space-y-0 text-sm text-gray-700">
                                @foreach($project->intraStudioTeamLeads as $lead)
                                    <li class="border-b py-2 last:border-b-0" style="border-bottom-color: #dfdfbb;">{{ $lead->name }}@if($lead->surname) {{ $lead->surname }}@endif</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Project Details -->
                    <div>
                        <h3 class="font-semibold mb-4 text-[#d3924f]">Project Details</h3>
                        <ul class="space-y-0 text-sm">
                            @if($project->sector)
                                <li class="border-b py-2 last:border-b-0" style="border-bottom-color: #dfdfbb;">
                                    <span class="text-gray-500">Sector:</span>
                                    <span class="font-medium text-gray-900">{{ $project->sector }}</span>
                                </li>
                            @endif
                            @if($project->client)
                                <li class="border-b py-2 last:border-b-0" style="border-bottom-color: #dfdfbb;">
                                    <span class="text-gray-500">Client:</span>
                                    <span class="font-medium text-gray-900">{{ $project->client }}</span>
                                </li>
                            @endif
                            @if($project->location)
                                <li class="border-b py-2 last:border-b-0" style="border-bottom-color: #dfdfbb;">
                                    <span class="text-gray-500">Location:</span>
                                    <span class="font-medium text-gray-900">{{ $project->location }}</span>
                                </li>
                            @endif
                            @if($project->year)
                                <li class="border-b py-2 last:border-b-0" style="border-bottom-color: #dfdfbb;">
                                    <span class="text-gray-500">Year:</span>
                                    <span class="font-medium text-gray-900">{{ $project->year }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include('partials.footer')
@endsection
