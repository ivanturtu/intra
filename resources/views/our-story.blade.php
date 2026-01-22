@extends('layouts.app')

@section('content')
    @include('partials.header')

    <!-- Our Story Section -->
    <section class="bg-white py-20 px-8">
        <div class="container mx-auto">
            <!-- Top Section: Main Team Lead + Intro/Description -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
                <!-- Main Team Lead (Left) -->
                @if($mainTeamLead)
                <div class="md:col-span-3">
                    @if($mainTeamLead->photo)
                        <img src="{{ asset('storage/' . $mainTeamLead->photo) }}" 
                             alt="{{ $mainTeamLead->name }} {{ $mainTeamLead->surname }}" 
                             class="w-48 h-48 object-cover rounded-full mb-6">
                    @else
                        <div class="w-48 h-48 bg-gray-200 rounded-full mb-6 flex items-center justify-center text-gray-400">
                            No Photo
                        </div>
                    @endif
                    <h3 class="text-2xl font-bold text-[#d3924f] mb-2">
                        {{ $mainTeamLead->name }} {{ $mainTeamLead->surname }}
                    </h3>
                    @if($mainTeamLead->role)
                        <p class="text-lg text-[#1b304e] mb-2">{{ $mainTeamLead->role }}</p>
                    @endif
                    @if($mainTeamLead->qualification)
                        <p class="text-sm text-[#1b304e]/70 mb-4">{{ $mainTeamLead->qualification }}</p>
                    @endif
                    @if($mainTeamLead->email)
                        <p class="text-sm text-[#1b304e] mb-4">
                            <a href="mailto:{{ $mainTeamLead->email }}" class="hover:underline">{{ $mainTeamLead->email }}</a>
                        </p>
                    @endif
                    @if($mainTeamLead)
                        <a href="{{ route('rosa-profile') }}" 
                           class="inline-flex items-center text-[#1b304e] hover:text-[#d3924f] transition">
                            <span class="mr-2">GO TO {{ strtoupper($mainTeamLead->name) }}'S PROFILE</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endif
                </div>
                @endif

                <!-- Intro and Description (Right) -->
                <div class="md:col-span-9 space-y-6">
                    @if($ourStory->intro)
                        <div class="prose prose-lg max-w-none text-[#d3924f]" style="font-size: clamp(1.5rem, 3vw, 2.5rem);">
                            {!! $ourStory->intro !!}
                        </div>
                    @endif
                    @if($mainTeamLead && $mainTeamLead->incipit)
                        <div class="prose prose-lg max-w-none text-[#dfdfbb]" style="font-size: clamp(1.5rem, 3vw, 2.5rem);">
                            {!! $mainTeamLead->incipit !!}
                        </div>
                    @endif
                    @if($ourStory->description)
                        <div class="prose prose-lg max-w-none">
                            {!! $ourStory->description !!}
                        </div>
                    @endif
                    <div>
                        <a href="{{ route('works.index') }}" class="inline-block bg-[#1b304e] text-white px-6 py-3 font-semibold hover:bg-[#1b304e]/90 transition">
                            VIEW OUR WORKS
                        </a>
                    </div>
                </div>
            </div>

            <!-- Highlight Section (Orange Background) -->
            @if($ourStory->highlight)
            <div class="bg-[#d3924f] text-white py-12 px-8 mb-16 flex items-center justify-center min-h-[200px]">
                <div class="container mx-auto">
                    <div class="prose prose-lg max-w-none text-white text-center" style="font-size: clamp(1.5rem, 3vw, 2.5rem);">
                        {!! $ourStory->highlight !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Other Team Leads (Grid) -->
            @if($otherTeamLeads->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($otherTeamLeads as $teamLead)
                <div>
                    @if($teamLead->photo)
                        <img src="{{ asset('storage/' . $teamLead->photo) }}" 
                             alt="{{ $teamLead->name }} {{ $teamLead->surname }}" 
                             class="w-32 h-32 object-cover rounded-full mb-4">
                    @else
                        <div class="w-32 h-32 bg-gray-200 rounded-full mb-4 flex items-center justify-center text-gray-400 text-xs">
                            No Photo
                        </div>
                    @endif
                    <h4 class="text-xl font-bold text-[#d3924f] mb-2">
                        {{ $teamLead->name }} {{ $teamLead->surname }}
                    </h4>
                    @if($teamLead->role)
                        <p class="text-base text-[#1b304e] mb-2">{{ $teamLead->role }}</p>
                    @endif
                    @if($teamLead->qualification)
                        <p class="text-sm text-[#1b304e]/70 mb-2">{{ $teamLead->qualification }}</p>
                    @endif
                    @if($teamLead->email)
                        <p class="text-sm text-[#1b304e] mb-4">
                            <a href="mailto:{{ $teamLead->email }}" class="hover:underline">{{ $teamLead->email }}</a>
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
