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
        $listHeading = 'text-[1.5rem] leading-[1.75rem] font-medium text-tertiary pb-[0.5rem] border-b border-secondary';
        $listRow = 'min-h-[3.75rem] py-[0.5rem] items-center border-b border-secondary text-[1.125rem] leading-[1.6875rem] text-primary';
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
                        <svg class="w-[1rem] h-[1rem] text-tertiary" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3 21L21 3M7 3h14v14"/></svg>
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

    <!-- Image Gallery (columns 2-11): fixed height, the next image peeks on the right; loops and opens a lightbox -->
    @if(count($gallery) > 0)
        <section class="bg-white pt-[3.875rem]">
            <div class="site-container site-grid">
                <div class="col-span-12 md:col-start-2 md:col-span-10"
                     x-data="{
                         currentIndex: 0,
                         total: {{ count($gallery) }},
                         offset: 0,
                         images: @js(array_map(fn ($image) => asset('storage/' . $image), $gallery)),
                         lightbox: null,
                         go(i) {
                             this.currentIndex = (i + this.total) % this.total;
                             this.offset = this.$refs.track.children[this.currentIndex].offsetLeft;
                         },
                         open(i) { this.lightbox = i; document.body.classList.add('overflow-hidden'); },
                         close() { this.lightbox = null; document.body.classList.remove('overflow-hidden'); },
                         step(d) { this.lightbox = (this.lightbox + d + this.total) % this.total; }
                     }"
                     @keydown.window.escape="lightbox !== null && close()"
                     @keydown.window.arrow-left="lightbox !== null && step(-1)"
                     @keydown.window.arrow-right="lightbox !== null && step(1)">
                    <div class="overflow-hidden">
                        <div x-ref="track" class="flex gap-[1rem] h-[18rem] md:h-[30.5rem] transition-transform duration-500 ease-in-out"
                             :style="`transform: translateX(-${offset}px)`">
                            @foreach($gallery as $i => $image)
                                <button type="button" @click="open({{ $i }})" class="h-full flex-none cursor-zoom-in" aria-label="Open image {{ $i + 1 }}">
                                    <img src="{{ asset('storage/' . $image) }}"
                                         alt="{{ $project->title }} – {{ $i + 1 }}"
                                         class="h-full w-auto max-w-none object-cover">
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex items-center gap-[1.25rem] mt-[1.25rem] text-primary">
                        @if(count($gallery) > 1)
                            <button @click="go(currentIndex - 1)"
                                    class="text-primary/60 hover:text-primary transition cursor-pointer" aria-label="Previous image">
                                <svg class="w-[1.5rem] h-[0.75rem]" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 32 16"><path d="M31 8H1M8 1L1 8l7 7"/></svg>
                            </button>
                            <button @click="go(currentIndex + 1)"
                                    class="text-primary/60 hover:text-primary transition cursor-pointer" aria-label="Next image">
                                <svg class="w-[1.5rem] h-[0.75rem]" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 32 16"><path d="M1 8h30M24 1l7 7-7 7"/></svg>
                            </button>
                        @endif
                        <span class="text-[1rem] leading-[1.5rem]"><span x-text="currentIndex + 1">1</span>/{{ count($gallery) }}</span>
                    </div>

                    <!-- Lightbox -->
                    <div x-show="lightbox !== null" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         @click.self="close()"
                         class="fixed inset-0 z-[100] bg-primary/95 flex items-center justify-center"
                         role="dialog" aria-modal="true" aria-label="{{ $project->title }} gallery">
                        <img :src="lightbox !== null ? images[lightbox] : ''"
                             alt="{{ $project->title }}"
                             class="max-w-[85vw] max-h-[85vh] object-contain">

                        <button @click="close()" class="absolute top-6 right-6 text-secondary hover:text-white transition cursor-pointer" aria-label="Close">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18"/></svg>
                        </button>
                        @if(count($gallery) > 1)
                            <button @click="step(-1)" class="absolute left-4 md:left-[3.2rem] top-1/2 -translate-y-1/2 text-secondary hover:text-white transition cursor-pointer" aria-label="Previous image">
                                <svg class="w-[1.75rem] h-[3.5rem]" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 16 32"><path d="M14 2L2 16l12 14"/></svg>
                            </button>
                            <button @click="step(1)" class="absolute right-4 md:right-[3.2rem] top-1/2 -translate-y-1/2 text-secondary hover:text-white transition cursor-pointer" aria-label="Next image">
                                <svg class="w-[1.75rem] h-[3.5rem]" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 16 32"><path d="M2 2l12 14L2 30"/></svg>
                            </button>
                            <span class="absolute bottom-6 left-1/2 -translate-x-1/2 text-secondary text-[1rem]"><span x-text="lightbox + 1"></span>/{{ count($gallery) }}</span>
                        @endif
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

    <!-- Team / Team Leads / Details: three blocks of 3 columns spread across columns 2-11 -->
    @if($project->projectTeamMembers->count() > 0 || $project->intraStudioTeamLeads->count() > 0 || count($details) > 0)
        <section class="bg-white pt-[4.8rem]">
            <div class="site-container site-grid">
                <div class="col-span-12 md:col-start-2 md:col-span-10 grid gap-y-12 md:grid-cols-[repeat(3,calc((100%-9rem)/10*3+2rem))] md:justify-between items-start">
                    <!-- Team -->
                    <div>
                        @if($project->projectTeamMembers->count() > 0)
                            <h3 class="{{ $listHeading }}">Team</h3>
                            <ul>
                                @foreach($project->projectTeamMembers as $member)
                                    <li class="{{ $listRow }} grid grid-cols-[57%_minmax(0,1fr)] gap-x-[0.5rem]">
                                        {{-- Admin "Field 1" (name column) is the bold label, "Field 2" (role column) the value --}}
                                        <span class="font-medium">{{ $member->name }}</span>
                                        <span class="font-light">{{ $member->role }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- INTRAstudio Team Leads -->
                    <div>
                        @if($project->intraStudioTeamLeads->count() > 0)
                            <h3 class="{{ $listHeading }}">INTRAstudio Team Leads</h3>
                            <ul>
                                @foreach($project->intraStudioTeamLeads as $lead)
                                    <li class="{{ $listRow }} !min-h-[3.25rem] flex font-medium">{{ $lead->name }}@if($lead->surname) {{ $lead->surname }}@endif</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Project details -->
                    <dl>
                        @foreach($details as $label => $value)
                            <div class="py-[0.9375rem] first:pt-0 border-b border-secondary last:border-b-0 text-[1.125rem] leading-[1.5rem] text-primary">
                                <dt class="font-medium">{{ $label }}</dt>
                                <dd class="font-light">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </section>
    @endif

    <div class="bg-white pb-[7.5rem]"></div>

    @include('partials.footer')
@endsection
