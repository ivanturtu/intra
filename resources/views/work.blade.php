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
                <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-full">
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a href="/" class="hover:text-gray-300 transition">WORK</a>
                <a href="#expertise" class="hover:text-gray-300 transition">EXPERTISE</a>
                <a href="#story" class="hover:text-gray-300 transition">OUR STORY</a>
                <a href="#mag" class="hover:text-gray-300 transition">MAG</a>
                <a href="#contact" class="hover:text-gray-300 transition">CONTACT</a>
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
            
            <!-- Main Image - Full Width -->
            <div class="mb-8 h-[600px] overflow-hidden">
                @if($project->main_image)
                    <img src="{{ asset('storage/' . $project->main_image) }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-full object-cover object-center">
                @else
                    <img src="https://via.placeholder.com/1200x600/87CEEB/FFFFFF?text={{ urlencode($project->title) }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-full object-cover object-center">
                @endif
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl font-bold mb-8 text-[#1b304e] leading-tight">{{ $project->title }}</h1>
            
            <!-- Content Grid: Description Left, Metadata Right -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Description - Left Side (2/3) -->
                <div class="lg:col-span-2">
                    @if($project->short_description)
                        <div class="text-gray-700 mb-6 prose max-w-none text-base leading-relaxed">
                            {!! $project->short_description !!}
                        </div>
                    @endif
                    <a href="#workflow" class="text-[#d3924f] font-semibold hover:underline inline-flex items-center gap-2">
                        GO TO
                        <span>Project Workflow</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
                
                <!-- Project Metadata - Right Side (1/3) -->
                <div class="space-y-4">
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
                    <p class="text-lg md:text-xl text-[#1b304e] leading-relaxed">
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
                                        <img src="{{ asset('storage/' . $project->image_gallery[$i]) }}" 
                                             alt="Gallery Image {{ $i + 1 }}" 
                                             class="w-full h-auto">
                                    @endif
                                    @if(isset($project->image_gallery[$i + 1]))
                                        <img src="{{ asset('storage/' . $project->image_gallery[$i + 1]) }}" 
                                             alt="Gallery Image {{ $i + 2 }}" 
                                             class="w-full h-auto">
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
        <section class="py-12 px-8 bg-white">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold mb-8">Project development</h2>
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
                            <h3 class="font-semibold mb-4 text-gray-900">Team</h3>
                            <ul class="space-y-3 text-sm">
                                @foreach($project->projectTeamMembers as $member)
                                    <li class="text-gray-700">
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
                            <h3 class="font-semibold mb-4 text-gray-900">INTRAstudio Team Leads</h3>
                            <ul class="space-y-2 text-sm text-gray-700">
                                @foreach($project->intraStudioTeamLeads as $lead)
                                    <li>{{ $lead->name }}@if($lead->surname) {{ $lead->surname }}@endif</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Project Details -->
                    <div>
                        <h3 class="font-semibold mb-4 text-gray-900">Project Details</h3>
                        <ul class="space-y-3 text-sm">
                            @if($project->sector)
                                <li>
                                    <span class="text-gray-500">Sector:</span>
                                    <span class="font-medium text-gray-900">{{ $project->sector }}</span>
                                </li>
                            @endif
                            @if($project->client)
                                <li>
                                    <span class="text-gray-500">Client:</span>
                                    <span class="font-medium text-gray-900">{{ $project->client }}</span>
                                </li>
                            @endif
                            @if($project->location)
                                <li>
                                    <span class="text-gray-500">Location:</span>
                                    <span class="font-medium text-gray-900">{{ $project->location }}</span>
                                </li>
                            @endif
                            @if($project->year)
                                <li>
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

    <!-- Footer -->
    <footer>
        <!-- Workflow Section -->
        <div class="bg-[#d3924f] text-white py-16 px-8">
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
                            <li class="px-4 py-3">Restoration Execution</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="bg-[#1b304e] text-white py-12 px-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-8">
                    <!-- Company Info -->
                    <div>
                        <div class="flex items-center mb-4">
                            <div class="text-white">
                                <div class="text-xl font-bold">INTRA</div>
                                <div class="text-xs font-light">studio</div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-400 mb-4">
                            1505 Barrington Street, Suite 100 - M03, Halifax, Nova Scotia, B3J 2A4 CANADA
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                                <span class="text-sm">f</span>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                                <span class="text-sm">in</span>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                                <span class="text-sm">📞</span>
                            </a>
                        </div>
                    </div>

                    <!-- Menu -->
                    <div>
                        <h5 class="font-semibold mb-4">Menu</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="/" class="hover:text-white transition">Works</a></li>
                            <li><a href="#expertise" class="hover:text-white transition">Expertise</a></li>
                            <li><a href="#story" class="hover:text-white transition">Our Story</a></li>
                            <li><a href="#mag" class="hover:text-white transition">MAG</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div>
                        <h5 class="font-semibold mb-4">Services</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-white transition">Heritage</a></li>
                            <li><a href="#" class="hover:text-white transition">Conservation</a></li>
                            <li><a href="#" class="hover:text-white transition">Research</a></li>
                            <li><a href="#" class="hover:text-white transition">Project management</a></li>
                        </ul>
                    </div>

                    <!-- Resources -->
                    <div>
                        <h5 class="font-semibold mb-4">Resources</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#contact" class="hover:text-white transition">Contact</a></li>
                            <li><a href="#mag" class="hover:text-white transition">MAG</a></li>
                            <li><a href="#" class="hover:text-white transition">Videos</a></li>
                            <li><a href="#" class="hover:text-white transition">FAQs</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-400">© {{ date('Y') }} INTRA studio - All Rights Reserved.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a href="#" class="text-sm text-gray-400 hover:text-white transition">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-white transition">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
