@extends('layouts.app')

@section('content')
    @include('partials.header')

    @php
        $details = array_filter([
            'Sector' => $project->sector,
            'Client' => $project->client,
            'Location' => $project->location,
            'Year' => $project->year,
        ]);
        $gallery = $project->image_gallery ?? [];
        $listHeading = 'text-[1.125rem] leading-[1.5rem] font-medium text-tertiary mb-[0.75rem]';
        $listItem = 'py-[0.5rem] border-b border-secondary last:border-b-0 text-[1.125rem] leading-[1.5rem] font-light text-primary';
    @endphp

    <!-- Project Overview Section: content on columns 2-11 -->
    <section class="bg-white pt-[4.2rem]">
        <div class="site-container site-grid">
            <!-- Top Bar -->
            <div class="col-span-12 md:col-start-2 md:col-span-10 flex justify-between items-center pb-[0.9375rem] border-b border-secondary">
                <a href="{{ route('works.index') }}" class="text-[1.125rem] leading-[1.5rem] font-light text-primary hover:text-tertiary transition cursor-pointer">Projects</a>
                @if($project->category)
                    <a href="/work?category={{ $project->category->id }}" class="bg-tertiary text-white px-[0.5rem] text-[0.875rem] leading-[1.5625rem] uppercase hover:bg-tertiary/85 transition cursor-pointer">
                        {{ $project->category->name }}
                    </a>
                @endif
            </div>

            <!-- Main Image: the bottom-left corner (columns 2-6) is cut out in white to host the title -->
            <div class="col-span-12 md:col-start-2 md:col-span-10 mt-[3.875rem] relative h-[22rem] md:h-[37.8rem] overflow-hidden">
                @if($project->main_image)
                    <img src="{{ asset('storage/' . $project->main_image) }}"
                         alt="{{ $project->title }}"
                         class="w-full h-full object-cover object-center">
                @else
                    <img src="https://via.placeholder.com/1400x600/87CEEB/FFFFFF?text={{ urlencode($project->title) }}"
                         alt="{{ $project->title }}"
                         class="w-full h-full object-cover object-center">
                @endif
                <div class="hidden md:block absolute bottom-0 left-0 bg-white h-[8.5625rem] w-[calc((100%-9rem)/10*5+5rem)]"></div>
            </div>

            <!-- Title (columns 2-6), pulled up into the white cut-out -->
            <h1 class="col-span-12 md:col-start-2 md:col-span-5 relative z-10 mt-6 md:-mt-[6.3125rem] text-[2rem] leading-[2.5rem] md:text-[2.75rem] md:leading-[3.4375rem] font-medium text-primary">
                {{ $project->title }}
            </h1>

            <!-- Description (columns 2-6) -->
            <div class="col-span-12 md:col-start-2 md:col-span-5 mt-[1.875rem]">
                @if($project->short_description)
                    <div class="text-[1.125rem] leading-[1.625rem] font-light text-primary [&_p]:mb-[1rem] [&_p:last-child]:mb-0">
                        {!! $project->short_description !!}
                    </div>
                @endif
            </div>

            <!-- GO TO Project Development (columns 7-9) -->
            <div class="col-span-12 md:col-span-3 mt-8 md:mt-[1.875rem]">
                @if($project->description)
                    <a href="#development" class="inline-flex items-end gap-[0.375rem] text-primary hover:text-tertiary transition cursor-pointer">
                        <span class="text-[0.875rem] leading-[1.0625rem]">
                            <span class="block font-medium uppercase">Go to</span>
                            Project Development
                        </span>
                        <svg class="w-[1rem] h-[1rem] text-tertiary" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M7 17L17 7M8 7h9v9"/></svg>
                    </a>
                @endif
            </div>

            <!-- Project Metadata (columns 10-11) -->
            <dl class="col-span-12 md:col-span-2 mt-8 md:mt-[1.875rem]">
                @foreach($details as $label => $value)
                    <div class="py-[0.9375rem] first:pt-0 border-b border-secondary last:border-b-0">
                        <dt class="text-[1.125rem] leading-[1.5rem] font-medium text-primary">{{ $label }}</dt>
                        <dd class="text-[1.125rem] leading-[1.5rem] font-light text-primary">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    <!-- Quote Section: beige box on columns 2-11, text on columns 3-10 -->
    @if($project->quote)
        <section class="bg-white pt-[3.25rem]">
            <div class="site-container site-grid">
                <div class="col-span-12 md:col-start-2 md:col-span-10 bg-secondary py-[3rem] md:py-[6rem] px-6 md:px-0 grid grid-cols-10 gap-x-[1rem]">
                    <p class="col-span-10 md:col-start-2 md:col-span-8 text-[1.75rem] leading-[2.25rem] md:text-[2.5rem] md:leading-[3.125rem] text-primary">
                        {{ $project->quote }}
                    </p>
                </div>
            </div>
        </section>
    @endif

    <!-- Image Gallery (columns 2-11): fixed height, the next image peeks on the right -->
    @if(count($gallery) > 0)
        <section class="bg-white pt-[3.875rem]">
            <div class="site-container site-grid">
                <div class="col-span-12 md:col-start-2 md:col-span-10"
                     x-data="{
                         currentIndex: 0,
                         total: {{ count($gallery) }},
                         offset: 0,
                         go(i) {
                             this.currentIndex = Math.max(0, Math.min(this.total - 1, i));
                             this.offset = this.$refs.track.children[this.currentIndex].offsetLeft;
                         }
                     }">
                    <div class="overflow-hidden">
                        <div x-ref="track" class="flex gap-[1rem] h-[18rem] md:h-[30.5rem] transition-transform duration-500 ease-in-out"
                             :style="`transform: translateX(-${offset}px)`">
                            @foreach($gallery as $i => $image)
                                <img src="{{ asset('storage/' . $image) }}"
                                     alt="{{ $project->title }} – {{ $i + 1 }}"
                                     class="h-full w-auto max-w-none flex-none object-cover">
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex items-center gap-[1.25rem] mt-[1.25rem] text-primary">
                        @if(count($gallery) > 1)
                            <button @click="go(currentIndex - 1)" :disabled="currentIndex === 0"
                                    class="text-primary/60 hover:text-primary disabled:opacity-30 disabled:cursor-not-allowed transition cursor-pointer" aria-label="Previous image">
                                <svg class="w-[1.5rem] h-[0.75rem]" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 32 16"><path d="M31 8H1M8 1L1 8l7 7"/></svg>
                            </button>
                            <button @click="go(currentIndex + 1)" :disabled="currentIndex === total - 1"
                                    class="text-primary/60 hover:text-primary disabled:opacity-30 disabled:cursor-not-allowed transition cursor-pointer" aria-label="Next image">
                                <svg class="w-[1.5rem] h-[0.75rem]" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 32 16"><path d="M1 8h30M24 1l7 7-7 7"/></svg>
                            </button>
                        @endif
                        <span class="text-[1rem] leading-[1.5rem]"><span x-text="currentIndex + 1">1</span>/{{ count($gallery) }}</span>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Project Development Section (columns 2-11) -->
    @if($project->description)
        <section id="development" class="bg-white pt-[4.5rem] scroll-mt-[8.125rem]">
            <div class="site-container site-grid">
                <div class="col-span-12 md:col-start-2 md:col-span-10">
                    <h2 class="text-[1.875rem] leading-[2.25rem] font-medium text-primary pb-[0.5rem] border-b border-secondary">Project development</h2>
                    <div class="mt-[1.4375rem] md:columns-2 md:gap-x-[5.5rem] text-[1.125rem] leading-[1.625rem] font-light text-primary [&_p]:mb-[1rem] [&_p:last-child]:mb-0">
                        {!! $project->description !!}
                    </div>

                    <!-- Selected Image (Map/Drawings) -->
                    @if($project->selected_image)
                        <img src="{{ asset('storage/' . $project->selected_image) }}"
                             alt="Project Map"
                             class="mt-[5rem] w-full h-auto">
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Team Section (columns 2-11) -->
    @if($project->projectTeamMembers->count() > 0 || $project->intraStudioTeamLeads->count() > 0)
        <section class="bg-white pt-[5rem]">
            <div class="site-container site-grid gap-y-10">
                @if($project->projectTeamMembers->count() > 0)
                    <div class="col-span-12 md:col-start-2 md:col-span-4">
                        <h3 class="{{ $listHeading }}">Team</h3>
                        <ul>
                            @foreach($project->projectTeamMembers as $member)
                                <li class="{{ $listItem }}">
                                    @if($member->name && $member->role)
                                        <span class="font-medium">{{ $member->name }}:</span> {{ $member->role }}
                                    @else
                                        {{ $member->name ?: $member->role }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($project->intraStudioTeamLeads->count() > 0)
                    <div class="col-span-12 md:col-span-3 {{ $project->projectTeamMembers->count() > 0 ? 'md:col-start-7' : 'md:col-start-2' }}">
                        <h3 class="{{ $listHeading }}">INTRAstudio Team Leads</h3>
                        <ul>
                            @foreach($project->intraStudioTeamLeads as $lead)
                                <li class="{{ $listItem }}">{{ $lead->name }}@if($lead->surname) {{ $lead->surname }}@endif</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <div class="bg-white pb-[7.5rem]"></div>

    @include('partials.footer')
@endsection
