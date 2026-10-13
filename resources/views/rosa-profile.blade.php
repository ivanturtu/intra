@extends('layouts.app')

@section('content')
    @include('partials.header')

    @php
        // Same type styles as the Rosa block on Our Story (1920px artboard)
        $nameLarge = 'text-[3.5rem] md:text-[5rem] leading-[1.175] font-medium text-secondary -ml-[0.5rem] md:whitespace-nowrap';
        $role = 'text-[1.5rem] md:text-[1.875rem] leading-[3rem] font-medium tracking-[0.006em] text-primary';
        $qualification = 'text-[1.25rem] md:text-[1.5rem] leading-[1.875rem] font-light text-primary';
        $email = 'text-[1.5rem] md:text-[1.875rem] leading-[3rem] tracking-[0.006em] text-primary';
        $arrowUpRight = '<svg class="w-[1rem] h-[1rem] text-tertiary shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M7 17L17 7M8 7h9v9"/></svg>';
        $youngWorksPerPage = 4;
        $youngWorksPages = $youngWorks ? (int) ceil($youngWorks->count() / $youngWorksPerPage) : 0;
    @endphp

    <!-- Rosa's Profile Section -->
    <section class="bg-white">
        <div class="site-container site-grid gap-y-12">
            <!-- Left Column: Rosa's Profile (columns 1-3) -->
            <div class="col-span-12 md:col-span-3 pt-[1.1875rem]">
                @if($rosa->photo)
                    <img src="{{ asset('storage/' . $rosa->photo) }}"
                         alt="{{ $rosa->name }} {{ $rosa->surname }}"
                         class="w-full aspect-[397/491] object-cover">
                @else
                    <div class="w-full aspect-[397/491] bg-gray-200 flex items-center justify-center text-gray-400">
                        No Photo
                    </div>
                @endif
                <h1 class="mt-[1.875rem] {{ $nameLarge }}">
                    {{ $rosa->name }} {{ $rosa->surname }}
                </h1>
                @if($rosa->role)
                    <p class="mt-[0.425rem] {{ $role }}">{{ $rosa->role }}</p>
                @endif
                @if($rosa->qualification)
                    <p class="mt-[0.45rem] {{ $qualification }}">{{ $rosa->qualification }}</p>
                @endif
                @if($rosa->email)
                    <p class="mt-[1.3rem] {{ $email }}">
                        <a href="mailto:{{ $rosa->email }}" class="hover:text-tertiary transition cursor-pointer">{{ $rosa->email }}</a>
                    </p>
                @endif
                @if($rosa->full_resume || $rosa->resume_link)
                    <a href="{{ $rosa->full_resume ? asset('storage/' . $rosa->full_resume) : $rosa->resume_link }}" target="_blank" rel="noopener"
                       class="mt-[1.3rem] flex w-fit items-end gap-[0.375rem] text-primary hover:text-tertiary transition cursor-pointer">
                        <span class="text-[0.875rem] leading-[1.0625rem] whitespace-nowrap">
                            <span class="block font-medium uppercase">Download</span>
                            complete Resume
                        </span>
                        {!! $arrowUpRight !!}
                    </a>
                @endif
                @if($youngWorks && $youngWorks->count() > 0)
                    <a href="#previous-works" class="mt-[2.27rem] inline-flex items-center gap-[0.625rem] text-[1.5rem] leading-[1.875rem] font-medium uppercase text-tertiary hover:text-primary transition cursor-pointer">
                        Previous works
                        <svg class="w-[1.125rem] h-[1.125rem]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M7 17L17 7M8 7h9v9"/></svg>
                    </a>
                @endif
            </div>

            <!-- Right Column: quote + biography (columns 5-11), resume link (column 12) -->
            <div class="col-span-12 md:col-start-5 md:col-span-8 md:pt-[12.4375rem] pb-[3.25rem]">
                <div class="grid grid-cols-8 gap-x-[1rem]">
                    @if($rosa->quote)
                        <div class="col-span-8 md:col-span-7 text-secondary text-[2.5rem] leading-[2.875rem] md:text-[3.5rem] md:leading-[4rem] [&_p]:m-0">
                            {!! $rosa->quote !!}
                        </div>
                    @endif
                    @if($rosa->incipit)
                        <div class="col-span-8 md:col-span-7 {{ $rosa->quote ? 'mt-[2rem]' : '' }} text-secondary text-[2.5rem] leading-[2.875rem] md:text-[3.5rem] md:leading-[4rem] [&_p]:m-0">
                            {!! $rosa->incipit !!}
                        </div>
                    @endif

                    @if($rosa->description)
                        <div class="col-span-8 md:col-span-7 mt-[2rem] text-[1.5rem] leading-[1.875rem] md:text-[1.875rem] md:leading-[2.25rem] font-light text-primary [overflow-wrap:anywhere] [&_p]:mb-[2.25rem] [&_p:last-child]:mb-0 [&_strong]:font-medium [&_b]:font-medium [&_em]:italic [&_ul]:my-[2.25rem] [&_ol]:my-[2.25rem]">
                            {!! $rosa->description !!}
                        </div>
                    @endif

                </div>

                <!-- Previous Works Title (arrow hangs in the gutter left of column 5) -->
                @if($youngWorks && $youngWorks->count() > 0)
                    <h2 class="relative mt-[4.8rem] text-[2.25rem] md:text-[3rem] leading-[3.5rem] uppercase text-tertiary">
                        <svg class="absolute -left-[3.25rem] top-1/2 -translate-y-1/2 w-[1.75rem] h-[1.75rem] hidden md:block" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 4v16M5 13l7 7 7-7"/></svg>
                        Previous works
                    </h2>
                @endif
            </div>
        </div>
    </section>

    <!-- Previous Works Section: image on columns 1-3, text on columns 5-12, 4 works per page -->
    @if($youngWorks && $youngWorks->count() > 0)
    <section id="previous-works" class="bg-[#f2f2e4] pt-[5.8125rem] pb-[3.75rem] scroll-mt-[8.125rem]"
             x-data="{ page: 0, pages: {{ $youngWorksPages }} }">
        <div class="site-container">
            @foreach($youngWorks as $index => $youngWork)
            <div x-show="page === {{ intdiv($index, $youngWorksPerPage) }}"
                 class="site-grid gap-y-6 pb-[2rem] mb-[2rem] border-b-2 border-tertiary">
                <!-- Image (columns 1-3) -->
                <div class="col-span-12 md:col-span-3 h-[16.9375rem]">
                    @if($youngWork->main_image)
                        <img src="{{ asset('storage/' . $youngWork->main_image) }}"
                             alt="{{ $youngWork->title }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- Content (columns 5-12) -->
                <div class="col-span-12 md:col-start-5 md:col-span-8 flex flex-col text-primary">
                    <h3 class="text-[2.25rem] leading-[2.75rem] font-medium">{{ $youngWork->title }}</h3>
                    @if($youngWork->short_description)
                        <div class="mt-[1.28rem] md:w-[calc((100%-7rem)/8*7+6rem)] text-[1.5rem] leading-[1.875rem] font-light [&_p]:m-0">
                            {!! $youngWork->short_description !!}
                        </div>
                    @endif
                    <div class="mt-6 md:mt-auto pt-4 flex items-end justify-between gap-6 text-[1.125rem] leading-[1.375rem]">
                        <p>
                            @if($youngWork->client)
                                Courtesy <span class="font-medium uppercase">{{ $youngWork->client }}©</span>
                            @endif
                        </p>
                        <a href="{{ route('work.show', $youngWork->slug) }}" class="shrink-0 inline-flex items-center gap-[0.5rem] uppercase hover:text-tertiary transition cursor-pointer">
                            <span><span class="font-medium">Go to the</span> Project</span>
                            {!! $arrowUpRight !!}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            @if($youngWorksPages > 1)
            <div class="flex items-center justify-center gap-[1.25rem] pt-[1rem] text-primary">
                <button @click="page = Math.max(0, page - 1)" :disabled="page === 0"
                        class="disabled:opacity-30 disabled:cursor-not-allowed hover:text-tertiary transition cursor-pointer" aria-label="Previous page">
                    <svg class="w-[2rem] h-[1rem]" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 32 16"><path d="M31 8H1M8 1L1 8l7 7"/></svg>
                </button>
                <div class="flex items-center gap-[0.5rem]">
                    @for($p = 0; $p < $youngWorksPages; $p++)
                        <button @click="page = {{ $p }}"
                                :class="page === {{ $p }} ? 'bg-primary' : 'bg-primary/30'"
                                class="w-[0.3125rem] h-[0.3125rem] rounded-full transition cursor-pointer" aria-label="Page {{ $p + 1 }}"></button>
                    @endfor
                </div>
                <button @click="page = Math.min(pages - 1, page + 1)" :disabled="page === pages - 1"
                        class="disabled:opacity-30 disabled:cursor-not-allowed hover:text-tertiary transition cursor-pointer" aria-label="Next page">
                    <svg class="w-[2rem] h-[1rem]" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 32 16"><path d="M1 8h30M24 1l7 7-7 7"/></svg>
                </button>
            </div>
            @endif
        </div>
    </section>
    @endif

    @include('partials.footer')
@endsection
