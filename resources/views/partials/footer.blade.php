@php
    $settings = \App\Models\Setting::getSettings();
    // Parse address into lines
    $addressLines = $settings->address ? explode(', ', $settings->address) : [];
@endphp
<!-- Footer -->
<footer class="mt-auto">
    <!-- Upper Section - Dark Blue -->
    <div class="bg-[#1b304e] text-white pb-12 pt-0 px-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                <!-- Left Column - Logo, Address, Social -->
                <div class="md:col-span-4">
                    <div class="mb-6 -ml-[20px]">
                        <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-8">
                    </div>
                    @if($settings->address)
                    <div class="text-sm text-white mb-6 space-y-1">
                        @foreach($addressLines as $line)
                            <div>{{ trim($line) }}</div>
                        @endforeach
                    </div>
                    @endif
                    <div class="flex gap-4">
                        @if($settings->linkedin_url)
                        <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#dfdfbb] flex items-center justify-center hover:bg-[#dfdfbb]/80 transition cursor-pointer">
                            <span class="text-sm text-[#1b304e] font-semibold">in</span>
                        </a>
                        @endif
                        @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#dfdfbb] flex items-center justify-center hover:bg-[#dfdfbb]/80 transition cursor-pointer">
                            <span class="text-sm text-[#1b304e] font-semibold">f</span>
                        </a>
                        @endif
                        @if($settings->phone)
                        <a href="tel:{{ $settings->phone }}" class="w-10 h-10 rounded-full bg-[#dfdfbb] flex items-center justify-center hover:bg-[#dfdfbb]/80 transition cursor-pointer">
                            <span class="text-sm text-[#1b304e]">📞</span>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Right Section - Navigation Columns -->
                <div class="md:col-span-8 pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                        <!-- Menu Column -->
                        <div>
                            <h5 class="font-semibold mb-4 text-[#d3924f] text-base">Menu</h5>
                            <ul class="space-y-2 text-sm text-white/80">
                                <li><a href="{{ url('/work') }}" class="hover:text-white transition cursor-pointer">Works</a></li>
                                <li><a href="{{ url('/#expertise') }}" class="hover:text-white transition cursor-pointer">Expertise</a></li>
                                <li><a href="{{ route('our-story') }}" class="hover:text-white transition cursor-pointer">Our Story</a></li>
                                <li><a href="{{ url('/#mag') }}" class="hover:text-white transition cursor-pointer">MAG</a></li>
                            </ul>
                        </div>

                        <!-- Expertise Column -->
                        <div>
                            <h5 class="font-semibold mb-4 text-[#d3924f] text-base">Expertise</h5>
                            <ul class="space-y-2 text-sm text-white/80">
                                @foreach(($categories ?? collect()) as $category)
                                    <li>
                                        <a href="{{ url('/work?category=' . $category->id) }}" class="hover:text-white transition cursor-pointer">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Resources Column -->
                        <div>
                            <h5 class="font-semibold mb-4 text-[#d3924f] text-base">Resources</h5>
                            <ul class="space-y-2 text-sm text-white/80">
                                <li><a href="{{ route('contact') }}" class="hover:text-white transition cursor-pointer">Contact</a></li>
                                <li><a href="{{ url('/#mag') }}" class="hover:text-white transition cursor-pointer">MAG</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lower Section - Orange Strip -->
    <div class="bg-[#d3924f] text-white/80 py-4 px-8">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <div class="text-left">
                    © {{ date('Y') }} INTRA studio • All Rights Reserved.
                </div>
                <div class="text-center">
                    <a href="#" class="hover:text-white transition cursor-pointer">Privacy Policy</a>
                </div>
                <div class="text-right">
                    Designed by OHOHdesign.it
                </div>
            </div>
        </div>
    </div>
</footer>
