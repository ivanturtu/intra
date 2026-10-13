@extends('layouts.app')

@section('content')
    @include('partials.header')

    @php
        // Shared type styles from the Our Story artboard (1920px)
        $nameLarge = 'text-[3.5rem] md:text-[5rem] leading-[1.175] font-medium text-secondary -ml-[0.5rem] md:whitespace-nowrap';
        $nameSmall = 'text-[2.75rem] md:text-[3.75rem] leading-[1.5667] font-medium text-secondary -ml-[0.5rem] md:whitespace-nowrap';
        $role = 'text-[1.5rem] md:text-[1.875rem] leading-[3rem] font-medium tracking-[0.006em] text-primary';
        $qualification = 'text-[1.25rem] md:text-[1.5rem] leading-[1.875rem] font-light text-primary';
        $email = 'text-[1.5rem] md:text-[1.875rem] leading-[3rem] tracking-[0.006em] text-primary';
        $body = 'text-[1.5rem] leading-[1.875rem] md:text-[1.875rem] md:leading-[2.25rem] font-light text-primary [&_p]:mb-[2.25rem] [&_p:last-child]:mb-0 [&_strong]:font-medium [&_b]:font-medium';
    @endphp

    <!-- Our Story Section -->
    <section class="our-story bg-white pb-[12.5rem]">
        <div class="site-container">
            <!-- Top Section: Main Team Lead (columns 1-3) + Intro/Description (columns 5-11) -->
            <div class="site-grid gap-y-12">
                @if($mainTeamLead)
                <div class="col-span-12 md:col-span-3 pt-[1.1875rem]">
                    @if($mainTeamLead->photo)
                        <img src="{{ asset('storage/' . $mainTeamLead->photo) }}"
                             alt="{{ $mainTeamLead->name }} {{ $mainTeamLead->surname }}"
                             class="w-full aspect-[397/491] object-cover">
                    @else
                        <div class="w-full aspect-[397/491] bg-gray-200 flex items-center justify-center text-gray-400">
                            No Photo
                        </div>
                    @endif
                    <h3 class="mt-[1.875rem] {{ $nameLarge }}">
                        {{ $mainTeamLead->name }} {{ $mainTeamLead->surname }}
                    </h3>
                    @if($mainTeamLead->role)
                        <p class="mt-[0.425rem] {{ $role }}">{{ $mainTeamLead->role }}</p>
                    @endif
                    @if($mainTeamLead->qualification)
                        <p class="mt-[0.45rem] {{ $qualification }}">{{ $mainTeamLead->qualification }}</p>
                    @endif
                    @if($mainTeamLead->email)
                        <p class="mt-[1.3rem] {{ $email }}">
                            <a href="mailto:{{ $mainTeamLead->email }}" class="hover:text-tertiary transition cursor-pointer">{{ $mainTeamLead->email }}</a>
                        </p>
                    @endif
                    <a href="{{ route('rosa-profile') }}"
                       class="mt-[1.645rem] inline-flex items-center gap-[0.625rem] text-[1.5rem] leading-[1.875rem] font-medium uppercase text-tertiary hover:text-primary transition cursor-pointer">
                        Go to {{ $mainTeamLead->name }}’s profile
                        <svg class="w-[1.25rem] h-[1.25rem]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3 21L21 3M7 3h14v14"/></svg>
                    </a>
                </div>
                @endif

                <div class="col-span-12 md:col-start-5 md:col-span-7 md:pt-[12.4375rem]">
                    @if($ourStory->intro)
                        <div class="our-story-intro text-tertiary text-[2.5rem] leading-[2.875rem] md:text-[3.5rem] md:leading-[4rem]">
                            {!! $ourStory->intro !!}
                        </div>
                    @endif
                    @if($ourStory->description)
                        <div class="our-story-body mt-12 md:mt-[8rem] {{ $body }} [&_p]:!mb-0">
                            {!! $ourStory->description !!}
                        </div>
                    @endif
                    <a href="{{ route('works.index') }}"
                       class="mt-[5.2rem] flex items-center justify-center w-full md:w-[calc((100%-6rem)/7*4+3rem)] h-[3.125rem] bg-primary text-secondary text-[1.375rem] font-medium uppercase hover:bg-primary/90 transition cursor-pointer">
                        View our works
                    </a>
                </div>
            </div>

            <!-- Highlight Section: orange box on all 12 columns, text on columns 2-11 -->
            @if($ourStory->highlight)
            <div class="mt-[4.8125rem] bg-tertiary site-grid py-[3rem] px-6 md:px-0 md:py-[8.125rem]">
                <div class="col-span-12 md:col-start-2 md:col-span-10 text-white text-[1.75rem] leading-[2.25rem] md:text-[2.5rem] md:leading-[3.125rem] [&_p]:mb-0 [&_strong]:font-bold [&_b]:font-bold">
                    {!! $ourStory->highlight !!}
                </div>
            </div>
            @endif

            <!-- Other Team Leads: 3 cards of 3 columns, spread across the row -->
            @if($otherTeamLeads->count() > 0)
            <div class="mt-[4.25rem] grid gap-y-16 md:grid-cols-[repeat(3,calc((100%-11rem)/12*3+2rem))] md:justify-between">
                @foreach($otherTeamLeads as $teamLead)
                <div>
                    @if($teamLead->photo)
                        <img src="{{ asset('storage/' . $teamLead->photo) }}"
                             alt="{{ $teamLead->name }} {{ $teamLead->surname }}"
                             class="w-full aspect-square object-cover">
                    @else
                        <div class="w-full aspect-square bg-gray-200 flex items-center justify-center text-gray-400 text-xs">
                            No Photo
                        </div>
                    @endif
                    <h4 class="mt-[1.67rem] {{ $nameSmall }}">
                        {{ $teamLead->name }} {{ $teamLead->surname }}
                    </h4>
                    @if($teamLead->role)
                        <p class="{{ $role }}">{{ $teamLead->role }}</p>
                    @endif
                    @if($teamLead->qualification)
                        <p class="mt-[0.45rem] {{ $qualification }}">{{ $teamLead->qualification }}</p>
                    @endif
                    @if($teamLead->email)
                        <p class="mt-[1.425rem] {{ $email }}">
                            <a href="mailto:{{ $teamLead->email }}" class="hover:text-tertiary transition cursor-pointer">{{ $teamLead->email }}</a>
                        </p>
                    @endif
                    @if($teamLead->description)
                        <div class="mt-[2.375rem] {{ $body }} [&_strong]:!font-normal [&_b]:!font-normal">
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
