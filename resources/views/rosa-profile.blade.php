@extends('layouts.app')

@section('content')
    @include('partials.header')

    <!-- Rosa's Profile Section -->
    <section class="bg-white pt-20 pb-8 px-8">
        <div class="container mx-auto">
            <!-- Top Header with Navigation and Quote -->
            <div class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-4 text-[#1b304e]">
                        <a href="{{ route('our-story') }}" class="text-sm hover:underline">| OUR STORY</a>
                        <a href="{{ route('rosa-profile') }}" class="text-sm font-bold">| ROSA'S PROFILE</a>
                    </div>
                </div>
                @if($rosa->quote)
                    <div class="text-[#d3924f] text-right" style="font-size: clamp(1.5rem, 3vw, 2.5rem); line-height: 1.3;">
                        {!! $rosa->quote !!}
                    </div>
                @endif
            </div>

            <!-- Main Content: Profile + Biography -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                <!-- Left Column: Rosa's Profile (3 columns) -->
                <div class="md:col-span-3">
                    @if($rosa->photo)
                        <img src="{{ asset('storage/' . $rosa->photo) }}" 
                             alt="{{ $rosa->name }} {{ $rosa->surname }}" 
                             class="w-48 h-48 object-cover rounded-full mb-6">
                    @else
                        <div class="w-48 h-48 bg-gray-200 rounded-full mb-6 flex items-center justify-center text-gray-400">
                            No Photo
                        </div>
                    @endif
                    <h1 class="text-3xl font-bold text-[#d3924f] mb-2">
                        {{ $rosa->name }} {{ $rosa->surname }}
                    </h1>
                    @if($rosa->role)
                        <p class="text-lg text-[#1b304e] mb-2">{{ $rosa->role }}</p>
                    @endif
                    @if($rosa->qualification)
                        <p class="text-sm text-[#1b304e]/70 mb-4 leading-relaxed">{{ $rosa->qualification }}</p>
                    @endif
                    @if($rosa->full_resume)
                        <div class="mb-6">
                            <a href="{{ asset('storage/' . $rosa->full_resume) }}" target="_blank" class="inline-flex items-center text-[#1b304e] hover:text-[#d3924f] transition text-sm">
                                <span class="mr-2">DOWNLOAD<br>complete Resume</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                    @if($rosa->email)
                        <p class="text-sm text-[#1b304e] mb-6">
                            <a href="mailto:{{ $rosa->email }}" class="hover:underline">{{ $rosa->email }}</a>
                        </p>
                    @endif
                    <a href="#young-works" class="inline-flex items-center text-[#d3924f] hover:text-[#d3924f]/80 transition">
                        <span class="mr-2">YOUNG WORKS</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Right Column: Biography and Projects (9 columns) -->
                <div class="md:col-span-9 space-y-8">
                    @if($rosa->incipit)
                        <div class="prose prose-lg max-w-none text-[#dfdfbb]" style="font-size: clamp(1.5rem, 3vw, 2.5rem);">
                            {!! $rosa->incipit !!}
                        </div>
                    @endif
                    @if($rosa->description)
                        <div class="prose prose-lg max-w-none text-[#1b304e]">
                            {!! $rosa->description !!}
                        </div>
                    @endif

                    @if($rosa->resume_link)
                        <div class="text-right">
                            <a href="{{ $rosa->resume_link }}" target="_blank" class="inline-flex items-center text-[#1b304e] hover:text-[#d3924f] transition text-sm">
                                <span class="mr-2">DOWNLOAD complete Resume</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    @endif

                    @if($rosaProjects->count() > 0)
                        <div>
                            <h3 class="text-xl font-semibold text-[#1b304e] mb-4">Her recent relevant projects include:</h3>
                            <ul class="space-y-4 text-[#1b304e]">
                                @foreach($rosaProjects as $project)
                                <li class="flex flex-col">
                                    <div class="font-semibold">{{ $project->title }}{!! $project->location ? ', ' . $project->location : '' !!}</div>
                                    @if($project->short_description)
                                        <div class="text-sm mt-1">{!! strip_tags($project->short_description) !!}</div>
                                    @endif
                                    <div class="text-sm mt-1">
                                        @if($project->year)
                                            {{ $project->year }}
                                        @endif
                                        @if($project->year && $project->sector)
                                            -
                                        @endif
                                        @if($project->sector)
                                            {{ $project->sector }}
                                        @endif
                                        @if($project->intraStudioTeamLeads->count() > 0)
                                            . Role: {{ $project->intraStudioTeamLeads->pluck('role')->filter()->first() ?? 'Team Lead' }}
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Young Works Title -->
                    @if($youngWorks && $youngWorks->count() > 0)
                    <div class="mt-8">
                        <h2 class="text-xl md:text-2xl font-bold text-[#d3924f] inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                            YOUNG WORKS
                        </h2>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Young Works Section - Full Width -->
    @if($youngWorks && $youngWorks->count() > 0)
    <section id="young-works" class="bg-[#dfdfbb] py-12 px-8 w-full">
        <div class="container mx-auto">
            <div class="space-y-0">
                @foreach($youngWorks as $index => $youngWork)
                <div class="{{ $index > 0 ? 'border-t border-[#d3924f] pt-8 mt-8' : '' }}">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                        <!-- Image (Left) -->
                        <div class="md:col-span-5">
                            @if($youngWork->main_image)
                                <img src="{{ asset('storage/' . $youngWork->main_image) }}" 
                                     alt="{{ $youngWork->title }}" 
                                     class="w-full h-[400px] object-cover">
                            @else
                                <div class="w-full h-[400px] bg-gray-200 flex items-center justify-center text-gray-400">
                                    No Image
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content (Right) -->
                        <div class="md:col-span-7 flex flex-col">
                            <div class="mb-4">
                                <h3 class="text-lg font-bold text-[#1b304e] mb-2">{{ $youngWork->title }}</h3>
                                <p class="text-xs text-[#1b304e] mb-2">Short description</p>
                                @if($youngWork->short_description)
                                    <div class="prose prose-sm max-w-none text-[#1b304e] mb-3 text-sm">
                                        {!! $youngWork->short_description !!}
                                    </div>
                                @endif
                                @if($youngWork->client)
                                    <p class="text-xs text-[#1b304e] mb-4">Courtesy {{ $youngWork->client }}©</p>
                                @endif
                            </div>
                            <div class="mt-auto">
                                <div class="flex justify-end">
                                    <a href="{{ route('work.show', $youngWork->slug) }}" class="inline-flex items-center text-[#1b304e] hover:text-[#d3924f] transition">
                                        <span class="mr-2">GO TO THE PROJECT</span>
                                        <svg class="w-4 h-4 text-[#d3924f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="border-b border-[#d3924f] mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @include('partials.footer')
@endsection
