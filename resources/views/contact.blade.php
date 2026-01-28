@extends('layouts.app')

@section('content')
    @include('partials.header')

    <!-- Get In Touch Section with Background -->
    <section class="relative min-h-[500px] flex items-center justify-center py-20 px-8" style="background-image: linear-gradient(rgba(27, 48, 78, 0.3), rgba(27, 48, 78, 0.3)), url('{{ asset('images/contact-bg.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 max-w-4xl mx-auto">
                <!-- Left: Contact Info (White Background) -->
                <div class="bg-white p-12">
                    <h2 class="text-4xl font-bold text-[#1b304e] mb-8">Get In Touch</h2>
                    
                    <div class="space-y-6">
                        @if($settings->address)
                        <div class="flex items-start gap-4">
                            <svg class="w-6 h-6 text-[#1b304e] mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-[#1b304e]">{{ $settings->address }}</p>
                        </div>
                        @endif
                        
                        @if($settings->phone)
                        <div class="flex items-start gap-4">
                            <svg class="w-6 h-6 text-[#1b304e] mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <p class="text-[#1b304e]">{{ $settings->phone }}</p>
                        </div>
                        @endif
                        
                        @if($settings->email)
                        <div class="flex items-start gap-4">
                            <svg class="w-6 h-6 text-[#1b304e] mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:{{ $settings->email }}" class="text-[#1b304e] hover:text-[#d3924f] transition cursor-pointer">{{ $settings->email }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Right: Icon (Dark Blue Background) -->
                <div class="bg-[#1b304e] flex items-center justify-center p-12">
                    <svg class="w-32 h-32 text-[#dfdfbb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section (Beige Background) -->
    <section class="bg-[#dfdfbb] py-20 px-8">
        <div class="container mx-auto max-w-4xl">
            <!-- Motivational Text -->
            <div class="mb-12">
                <h3 class="text-3xl md:text-4xl font-bold text-[#1b304e] mb-4">Every project begins with dialogue.</h3>
                <p class="text-lg text-[#1b304e]">
                    Contact us to tell us about your project or to learn more about a topic related to the protection and enhancement of architectural heritage. Discussion is the first step in any informed intervention.
                </p>
            </div>
            
            <!-- Contact Form -->
            @livewire('contact.form')
        </div>
    </section>

    @include('partials.footer')
@endsection
