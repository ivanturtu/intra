@extends('layouts.app')

@section('content')
    @include('partials.header')

    @php
        // Address lines: line breaks entered in the admin textarea win, commas are the fallback
        $address = trim((string) $settings->address);
        $addressLines = $address === '' ? [] : (str_contains($address, "\n") ? preg_split('/\R/', $address) : explode(', ', $address));
        $contactIcon = 'w-[1.6875rem] h-[1.6875rem] text-primary shrink-0';
    @endphp

    <!-- Get In Touch Section with Background -->
    <section class="relative md:h-[59.375rem] py-16 md:py-0 md:pt-[15.625rem]"
             style="background-image: url('{{ asset('images/contact-bg.jpg') }}'); background-size: cover; background-position: center;">
        <div class="site-container site-grid">
            <!-- Card: content from column 4, blue panel on columns 7-9 -->
            <div class="col-span-12 md:col-start-4 md:col-span-6 relative">
                <div class="absolute inset-y-0 -left-[2.5rem] -right-[1rem] bg-white hidden md:block"></div>
                <div class="relative grid grid-cols-6 gap-x-[1rem] bg-white md:bg-transparent md:h-[37.125rem]">
                    <!-- Contact info (columns 4-6) -->
                    <div class="col-span-6 md:col-span-3 flex flex-col justify-center p-8 md:p-0">
                        <h2 class="text-[2.25rem] leading-[2.75rem] font-medium text-primary pl-[2.5rem]">Get In Touch</h2>

                        <div class="mt-[1.875rem] space-y-[1.25rem] text-[1.125rem] leading-[1.75rem] text-primary">
                            @if($addressLines)
                            <div class="flex items-start gap-[0.8125rem]">
                                <svg class="{{ $contactIcon }}" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <p>
                                    @foreach($addressLines as $line)
                                        {{ trim($line) }}@if(!$loop->last)<br>@endif
                                    @endforeach
                                </p>
                            </div>
                            @endif

                            @if($settings->phone)
                            <div class="flex items-center gap-[0.8125rem]">
                                <svg class="{{ $contactIcon }}" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                <a href="tel:{{ $settings->phone }}" class="hover:text-tertiary transition cursor-pointer">{{ $settings->phone }}</a>
                            </div>
                            @endif

                            @if($settings->email)
                            <div class="flex items-center gap-[0.8125rem]">
                                <svg class="{{ $contactIcon }}" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
                                <a href="mailto:{{ $settings->email }}" class="hover:text-tertiary transition cursor-pointer">{{ $settings->email }}</a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Icon panel (columns 7-9), framed by 1rem of white -->
                    <div class="hidden md:flex col-span-3 my-[1rem] bg-primary items-center justify-center">
                        <svg class="w-[5rem] h-[5rem] text-secondary" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section (columns 4-9) -->
    <section class="bg-secondary pt-[5.75rem] pb-[5.6875rem]">
        <div class="site-container site-grid">
            <div class="col-span-12 md:col-start-4 md:col-span-6">
                <h3 class="text-[2rem] md:text-[2.5rem] leading-[3rem] font-medium text-primary">Every project begins with dialogue.</h3>
                <p class="mt-[1.9375rem] text-[1.125rem] leading-[1.875rem] font-light text-primary">
                    Contact us to tell us about your project or to learn more about a topic related to the protection and enhancement of architectural heritage. Discussion is the first step in any informed intervention.
                </p>

                <div class="mt-[4.375rem]">
                    @livewire('contact.form')
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
@endsection
