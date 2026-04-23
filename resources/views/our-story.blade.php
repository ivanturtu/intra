@extends('layouts.app')

@section('content')
    @include('partials.header')

    <!-- Our Story Section -->
    <section class="our-story bg-white py-20 px-8">
        <div class="container mx-auto">
            <!-- Top Section: Main Team Lead + Intro/Description -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
                <!-- Main Team Lead (Left) -->
                @if($mainTeamLead)
                <div class="md:col-span-3">
                    @if($mainTeamLead->photo)
                        <img src="{{ asset('storage/' . $mainTeamLead->photo) }}" 
                             alt="{{ $mainTeamLead->name }} {{ $mainTeamLead->surname }}" 
                             class="w-full aspect-square object-cover mb-8">
                    @else
                        <div class="w-full aspect-square bg-gray-200 mb-8 flex items-center justify-center text-gray-400">
                            No Photo
                        </div>
                    @endif
                    <h3 class="text-[clamp(44px,4.2vw,52px)] leading-[0.95] font-bold text-secondary/60 mb-3">
                        {{ $mainTeamLead->name }} {{ $mainTeamLead->surname }}
                    </h3>
                    @if($mainTeamLead->role)
                        <p class="text-lg font-semibold text-[#1b304e] mb-3">{{ $mainTeamLead->role }}</p>
                    @endif
                    @if($mainTeamLead->qualification)
                        <p class="text-sm leading-relaxed text-[#1b304e]/65 mb-6">{{ $mainTeamLead->qualification }}</p>
                    @endif
                    @if($mainTeamLead->email)
                        <p class="text-sm text-[#1b304e] mb-8">
                            <a href="mailto:{{ $mainTeamLead->email }}" class="hover:underline cursor-pointer">{{ $mainTeamLead->email }}</a>
                        </p>
                    @endif
                    @if($mainTeamLead)
                        <a href="{{ route('rosa-profile') }}" 
                           class="inline-flex items-center text-[#d3924f] hover:text-[#d3924f]/80 transition cursor-pointer text-sm font-semibold tracking-wide uppercase">
                            <span class="mr-3">GO TO {{ strtoupper($mainTeamLead->name) }}'S PROFILE</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endif
                </div>
                @endif

                <!-- Intro and Description (Right) -->
                <div class="md:col-span-7 md:col-start-5 space-y-6">
                    @if($ourStory->intro)
                        <div class="our-story-intro max-w-none text-[#d3924f] font-light leading-tight" style="font-size: clamp(1.75rem, 3vw, 2.75rem);">
                            {!! $ourStory->intro !!}
                        </div>
                    @endif
                    @if($ourStory->description)
                        <div class="our-story-body max-w-none text-lg md:text-xl leading-relaxed text-[#1b304e]/80 [&_p]:mb-6 [&_p:last-child]:mb-0 [&_strong]:font-bold [&_strong]:text-[#1b304e]">
                            {!! $ourStory->description !!}
                        </div>
                    @endif
                    <div class="pt-2 mt-8">
                        <a href="{{ route('works.index') }}" class="inline-flex items-center justify-center bg-[#1b304e] text-white px-10 py-4 font-semibold tracking-wide uppercase hover:bg-[#1b304e]/90 transition cursor-pointer">
                            VIEW OUR WORKS
                        </a>
                    </div>
                </div>
            </div>

            <!-- Highlight Section (Orange Background) -->
            @if($ourStory->highlight)
            <div class="bg-[#d3924f] text-white p-20 mb-16 flex items-center justify-center min-h-[240px]">
                <div class="container mx-auto flex items-center justify-center">
                    <div class="prose prose-lg max-w-none text-white text-center [&>*:last-child]:mb-0" style="font-size: clamp(1.5rem, 3vw, 2.5rem);">
                        {!! $ourStory->highlight !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Other Team Leads (Grid) -->
            @if($otherTeamLeads->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                @foreach($otherTeamLeads as $index => $teamLead)
                <div class="md:col-span-3 {{ $index === 0 ? 'md:col-start-1' : ($index === 1 ? 'md:col-start-5' : 'md:col-start-9') }}">
                    @if($teamLead->photo)
                        <img src="{{ asset('storage/' . $teamLead->photo) }}" 
                             alt="{{ $teamLead->name }} {{ $teamLead->surname }}" 
                             class="w-full aspect-square object-cover mb-4">
                    @else
                        <div class="w-full aspect-square bg-gray-200 mb-4 flex items-center justify-center text-gray-400 text-xs">
                            No Photo
                        </div>
                    @endif
                    <h4 class="text-[clamp(24px,2.2vw,34px)] leading-[0.95] font-bold text-secondary/60 mb-2">
                        {{ $teamLead->name }} {{ $teamLead->surname }}
                    </h4>
                    @if($teamLead->role)
                        <p class="text-base text-[#1b304e] mb-2 font-bold">{{ $teamLead->role }}</p>
                    @endif
                    @if($teamLead->qualification)
                        <p class="text-sm text-[#1b304e]/70 mb-2">{{ $teamLead->qualification }}</p>
                    @endif
                    @if($teamLead->email)
                        <p class="text-sm text-[#1b304e] mb-4">
                            <a href="mailto:{{ $teamLead->email }}" class="hover:underline cursor-pointer">{{ $teamLead->email }}</a>
                        </p>
                    @endif
                    @if($teamLead->description)
                        <div class="prose prose-sm max-w-none text-[#1b304e]">
                            {!! $teamLead->description !!}
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    @include('partials.footer')
@endsection
