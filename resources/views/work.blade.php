@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="bg-[#1a304f] text-white px-8 py-0">
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
            <button class="bg-[#d39250] px-4 py-2 rounded hover:bg-[#c08545] transition">
                SEE MORE
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-16 px-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Image -->
                <div class="lg:col-span-2">
                    @if($project->main_image)
                        <img src="{{ asset('storage/' . $project->main_image) }}" 
                             alt="{{ $project->title }}" 
                             class="w-full h-auto rounded-lg">
                    @else
                        <img src="https://via.placeholder.com/800x600/87CEEB/FFFFFF?text={{ urlencode($project->title) }}" 
                             alt="{{ $project->title }}" 
                             class="w-full h-auto rounded-lg">
                    @endif
                </div>
                
                <!-- Project Details -->
                <div class="space-y-6">
                    <div>
                        <h2 class="text-3xl font-bold mb-4">{{ $project->title }}</h2>
                        @if($project->short_description)
                            <div class="text-gray-700 mb-4 prose max-w-none">
                                {!! $project->short_description !!}
                            </div>
                        @endif
                        <a href="#workflow" class="text-[#d39250] font-semibold hover:underline inline-flex items-center gap-2">
                            GO TO Project Workflow
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Project Metadata -->
                    <div class="border-t pt-6 space-y-3">
                        @if($project->sector)
                            <div>
                                <span class="text-sm text-gray-500">Sector:</span>
                                <p class="font-medium">{{ $project->sector }}</p>
                            </div>
                        @endif
                        @if($project->client)
                            <div>
                                <span class="text-sm text-gray-500">Client:</span>
                                <p class="font-medium">{{ $project->client }}</p>
                            </div>
                        @endif
                        @if($project->location)
                            <div>
                                <span class="text-sm text-gray-500">Location:</span>
                                <p class="font-medium">{{ $project->location }}</p>
                            </div>
                        @endif
                        @if($project->year)
                            <div>
                                <span class="text-sm text-gray-500">Year:</span>
                                <p class="font-medium">{{ $project->year }}</p>
                            </div>
                        @endif
                        @if($project->category)
                            <div>
                                <span class="text-sm text-gray-500">Category:</span>
                                <p class="font-medium">{{ $project->category->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quote Section -->
    @if($project->quote)
        <section class="bg-[#f5e6d3] py-16 px-8">
            <div class="container mx-auto max-w-4xl">
                <blockquote class="text-2xl md:text-3xl font-medium text-center text-gray-800">
                    "{{ $project->quote }}"
                </blockquote>
            </div>
        </section>
    @endif

    <!-- Image Gallery -->
    @if($project->image_gallery && count($project->image_gallery) > 0)
        <section class="py-16 px-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    @foreach($project->image_gallery as $index => $image)
                        <img src="{{ asset('storage/' . $image) }}" 
                             alt="Gallery Image {{ $index + 1 }}" 
                             class="w-full h-auto rounded-lg">
                    @endforeach
                </div>
                @if(count($project->image_gallery) > 1)
                    <div class="text-center text-sm text-gray-500">
                        1/{{ count($project->image_gallery) }}
                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- Project Development Section -->
    @if($project->description)
        <section class="py-16 px-8 bg-white">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold mb-8">Project development</h2>
                <div class="prose max-w-none mb-12">
                    {!! $project->description !!}
                </div>
                
                <!-- Selected Image (Map) -->
                @if($project->selected_image)
                    <div class="mb-12">
                        <img src="{{ asset('storage/' . $project->selected_image) }}" 
                             alt="Project Map" 
                             class="w-full h-auto rounded-lg">
                    </div>
                @endif

                <!-- Team Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <!-- Team Members -->
                    @if($project->projectTeamMembers->count() > 0)
                        <div>
                            <h3 class="font-semibold mb-4">Team</h3>
                            <ul class="space-y-3 text-sm">
                                @foreach($project->projectTeamMembers as $member)
                                    <li>
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
                            <h3 class="font-semibold mb-4">INTRAstudio Team Leads</h3>
                            <ul class="space-y-2 text-sm">
                                @foreach($project->intraStudioTeamLeads as $lead)
                                    <li>{{ $lead->name }} @if($lead->surname) {{ $lead->surname }} @endif</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Project Details -->
                    <div>
                        <h3 class="font-semibold mb-4">Project Details</h3>
                        <ul class="space-y-3 text-sm">
                            @if($project->sector)
                                <li>
                                    <span class="text-gray-500">Sector:</span>
                                    <span class="font-medium">{{ $project->sector }}</span>
                                </li>
                            @endif
                            @if($project->client)
                                <li>
                                    <span class="text-gray-500">Client:</span>
                                    <span class="font-medium">{{ $project->client }}</span>
                                </li>
                            @endif
                            @if($project->location)
                                <li>
                                    <span class="text-gray-500">Location:</span>
                                    <span class="font-medium">{{ $project->location }}</span>
                                </li>
                            @endif
                            @if($project->year)
                                <li>
                                    <span class="text-gray-500">Year:</span>
                                    <span class="font-medium">{{ $project->year }}</span>
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
        <div class="bg-[#d39250] text-white py-16 px-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <h3 class="text-2xl font-bold mb-8">Project Workflow</h3>
                    </div>
                    <div>
                        <ul class="space-y-4">
                            <li class="bg-[#d68f75] px-4 py-3 rounded">
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
        <div class="bg-[#1a304f] text-white py-12 px-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-8">
                    <!-- Company Info -->
                    <div>
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-8">
                        </div>
                        <p class="text-sm text-gray-400 mb-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                                <span class="text-sm">f</span>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                                <span class="text-sm">in</span>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                                <span class="text-sm">ig</span>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
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
                    <p class="text-sm text-gray-400">© 2023 Mockup. All Rights Reserved.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a href="#" class="text-sm text-gray-400 hover:text-white transition">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-white transition">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection

