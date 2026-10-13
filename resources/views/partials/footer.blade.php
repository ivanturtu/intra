@php
    $settings = \App\Models\Setting::getSettings();
    // Address lines: line breaks entered in the admin textarea win, commas are the fallback
    $address = trim((string) $settings->address);
    $addressLines = $address === '' ? [] : (str_contains($address, "\n") ? preg_split('/\R/', $address) : explode(', ', $address));
    $mapsUrl = $addressLines ? 'https://www.google.com/maps/search/?api=1&query=' . urlencode(implode(', ', array_map('trim', $addressLines))) : null;
    $footerHeading = 'text-[1.375rem] leading-[2.1875rem] tracking-[0.016em] text-tertiary';
    $footerList = 'mt-[1.72rem] text-[1.125rem] leading-[2.3125rem] text-secondary';
    $footerLink = 'hover:text-white transition cursor-pointer';
    $socialButton = 'w-[3rem] h-[3rem] rounded-full bg-secondary text-primary flex items-center justify-center hover:bg-secondary/80 transition cursor-pointer';
@endphp
<!-- Footer -->
<footer class="mt-auto">
    <!-- Upper Section - Dark Blue -->
    <div class="bg-primary text-white">
        <div class="site-container site-grid gap-y-12 pb-[3.1875rem]">
            <!-- Left Column - Logo, Address, Social -->
            <div class="col-span-12 md:col-span-6">
                <!-- Logo: the vertical line of the logotype sits on the first grid column -->
                <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-[9.375rem] w-auto -ml-[2.27rem]">
                @if($settings->address)
                <a href="{{ $mapsUrl }}" target="_blank" rel="noopener noreferrer" class="block w-fit mt-[2.1rem] text-[1rem] leading-[1.625rem] tracking-[0.025em] text-white hover:text-secondary transition cursor-pointer">
                    @foreach($addressLines as $line)
                        <span class="block">{{ trim($line) }}</span>
                    @endforeach
                </a>
                @endif
                <div class="mt-[2.35rem] flex gap-[2.5rem]">
                    @if($settings->facebook_url)
                    <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener noreferrer" class="{{ $socialButton }}" aria-label="Facebook">
                        <svg class="w-[1.25rem] h-[1.25rem]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    @endif
                    @if($settings->linkedin_url)
                    <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="{{ $socialButton }}" aria-label="LinkedIn">
                        <svg class="w-[1.25rem] h-[1.25rem]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    @endif
                    @if($settings->phone)
                    <a href="tel:{{ $settings->phone }}" class="{{ $socialButton }}" aria-label="Phone">
                        <svg class="w-[1.25rem] h-[1.25rem]" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Menu Column (columns 7-8) -->
            <div class="col-span-12 md:col-span-2 md:pt-[7.4rem]">
                <h5 class="{{ $footerHeading }}">Menu</h5>
                <ul class="{{ $footerList }}">
                    <li><a href="{{ url('/work') }}" class="{{ $footerLink }}">Works</a></li>
                    <li><a href="{{ url('/#expertise') }}" class="{{ $footerLink }}">Expertise</a></li>
                    <li><a href="{{ route('our-story') }}" class="{{ $footerLink }}">Our Story</a></li>
                    <li><a href="{{ url('/#mag') }}" class="{{ $footerLink }}">MAG</a></li>
                </ul>
            </div>

            <!-- Expertise Column (columns 9-10) -->
            <div class="col-span-12 md:col-span-2 md:pt-[7.4rem]">
                <h5 class="{{ $footerHeading }}">Expertise</h5>
                <ul class="{{ $footerList }}">
                    @foreach(($categories ?? collect()) as $category)
                        <li>
                            <a href="{{ url('/work?category=' . $category->id) }}" class="{{ $footerLink }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Resources Column (columns 11-12) -->
            <div class="col-span-12 md:col-span-2 md:pt-[7.4rem]">
                <h5 class="{{ $footerHeading }}">Resources</h5>
                <ul class="{{ $footerList }}">
                    <li><a href="{{ route('contact') }}" class="{{ $footerLink }}">Contact</a></li>
                    <li><a href="{{ url('/#mag') }}" class="{{ $footerLink }}">MAG</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Lower Section - Orange Strip -->
    <div class="bg-tertiary text-[#f2f4f8]">
        <div class="site-container site-grid gap-y-2 py-6 md:py-0 md:h-[4.8125rem] items-center text-[0.8125rem] font-bold tracking-[0.03em]">
            <div class="col-span-12 md:col-span-6">
                © {{ date('Y') }} INTRA studio • All Rights Reserved.
            </div>
            <div class="col-span-12 md:col-span-4">
                <a href="#" class="hover:text-white transition cursor-pointer">Privacy Policy</a>
            </div>
            <div class="col-span-12 md:col-span-2">
                Designed by OHOHdesign.it
            </div>
        </div>
    </div>
</footer>
