@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="bg-[#1a304f] text-white px-8 py-0">
        <div class="container mx-auto flex items-center justify-between header-logo-container">
            <div class="flex items-center h-full">
                <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-full">
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a href="/" class="hover:text-gray-300 transition">WORK</a>
                <a href="#expertise" class="hover:text-gray-300 transition">EXPERTISE</a>
                <a href="#story" class="hover:text-gray-300 transition">OUR STORY</a>
                <a href="#mag" class="hover:text-gray-300 transition">MAG</a>
                <a href="#contact" class="hover:text-gray-300 transition">CONTACT</a>
            </nav>
            <button class="bg-[#d39250] px-4 py-2 rounded hover:bg-[#c08545] transition">
                SEE MORE
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-16 px-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Image -->
                <div class="lg:col-span-2">
                    <img src="https://via.placeholder.com/800x600/87CEEB/FFFFFF?text=Interior+Design" 
                         alt="Project Image" 
                         class="w-full h-auto rounded-lg">
                </div>
                
                <!-- Project Details -->
                <div class="space-y-6">
                    <div>
                        <h2 class="text-3xl font-bold mb-4">The Delight Factor. A New Metric of Your Workplace.</h2>
                        <p class="text-gray-700 mb-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
                        </p>
                        <p class="text-gray-700 mb-6">
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecati cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <a href="#workflow" class="text-[#d39250] font-semibold hover:underline inline-flex items-center gap-2">
                            GO TO Project Workflow
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Project Metadata -->
                    <div class="border-t pt-6 space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Sector:</span>
                            <p class="font-medium">Heritage & Conservation</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Client:</span>
                            <p class="font-medium">Zio Paperone City</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Location:</span>
                            <p class="font-medium">Topolinia Walt Disney (USA)</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Year:</span>
                            <p class="font-medium">2000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quote Section -->
    <section class="bg-[#f5e6d3] py-16 px-8">
        <div class="container mx-auto max-w-4xl">
            <blockquote class="text-2xl md:text-3xl font-medium text-center text-gray-800">
                "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum atque corrupti quos dolores et quas molestias excepturi sint occaecati, similique sunt in culpa qui officia deserunt mollitia animi, id est fuga"
            </blockquote>
        </div>
    </section>

    <!-- Image Gallery -->
    <section class="py-16 px-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <img src="https://via.placeholder.com/600x400/CCCCCC/FFFFFF?text=Building" 
                     alt="Gallery Image 1" 
                     class="w-full h-auto rounded-lg">
                <img src="https://via.placeholder.com/600x400/FFA500/FFFFFF?text=Heritage" 
                     alt="Gallery Image 2" 
                     class="w-full h-auto rounded-lg">
            </div>
            <div class="text-center text-sm text-gray-500">
                1/6
            </div>
        </div>
    </section>

    <!-- Project Development Section -->
    <section class="py-16 px-8 bg-white">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-8">Project development</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div>
                    <p class="text-gray-700 mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <p class="text-gray-700">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecati cupidatat non proident.
                    </p>
                </div>
                <div>
                    <p class="text-gray-700 mb-4">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    </p>
                    <p class="text-gray-700">
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                    </p>
                </div>
            </div>
            
            <!-- Map Image -->
            <div class="mb-12">
                <img src="https://via.placeholder.com/1200x600/8B7355/FFFFFF?text=Map+of+SINOPE" 
                     alt="Project Map" 
                     class="w-full h-auto rounded-lg">
            </div>

            <!-- Team Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Team Roles -->
                <div>
                    <h3 class="font-semibold mb-4">Team</h3>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <span class="font-medium">Architect, Canada:</span> Rosa Milito
                        </li>
                        <li>
                            <span class="font-medium">Civil Engineering, UK:</span> Tizio Caio
                        </li>
                        <li>
                            <span class="font-medium">Landscape Architect, UK:</span> Tizio Caio
                        </li>
                        <li>
                            <span class="font-medium">Main Contractor:</span> Pablo Picasso
                        </li>
                        <li>
                            <span class="font-medium">Photographer:</span> Altan ISO
                        </li>
                    </ul>
                </div>

                <!-- INTRAstudio Team Leads -->
                <div>
                    <h3 class="font-semibold mb-4">INTRAstudio Team Leads</h3>
                    <ul class="space-y-2 text-sm">
                        <li>Rosa Milito</li>
                        <li>Zio Paperino</li>
                        <li>Paperoga</li>
                    </ul>
                </div>

                <!-- Project Details -->
                <div>
                    <h3 class="font-semibold mb-4">Project Details</h3>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <span class="text-gray-500">Sector:</span>
                            <span class="font-medium">Heritage & Conservation</span>
                        </li>
                        <li>
                            <span class="text-gray-500">Client:</span>
                            <span class="font-medium">Zio Paperone City</span>
                        </li>
                        <li>
                            <span class="text-gray-500">Location:</span>
                            <span class="font-medium">Topolinia Walt Disney (USA)</span>
                        </li>
                        <li>
                            <span class="text-gray-500">Year:</span>
                            <span class="font-medium">0000</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <!-- Workflow Section -->
        <div class="bg-[#d39250] text-white py-16 px-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <h3 class="text-2xl font-bold mb-8">Project Workflow</h3>
                    </div>
                    <div>
                        <ul class="space-y-4">
                            <li class="bg-[#d68f75] px-4 py-3 rounded">
                                <span class="font-semibold">Preliminary Analysis and Research</span>
                            </li>
                            <li class="px-4 py-3">Assessment and Diagnosis</li>
                            <li class="px-4 py-3">Concept Design</li>
                            <li class="px-4 py-3">Design Development</li>
                            <li class="px-4 py-3">Construction Documentation</li>
                            <li class="px-4 py-3">Restoration Execution</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="bg-[#1a304f] text-white py-12 px-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-8">
                    <!-- Company Info -->
                    <div>
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-8">
                        </div>
                        <p class="text-sm text-gray-400 mb-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                                <span class="text-sm">f</span>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                                <span class="text-sm">in</span>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                                <span class="text-sm">ig</span>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                                <span class="text-sm">📞</span>
                            </a>
                        </div>
                    </div>

                    <!-- Products -->
                    <div>
                        <h5 class="font-semibold mb-4">Products</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-white transition">Product 1</a></li>
                            <li><a href="#" class="hover:text-white transition">Product 2</a></li>
                            <li><a href="#" class="hover:text-white transition">Product 3</a></li>
                            <li><a href="#" class="hover:text-white transition">Product 4</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div>
                        <h5 class="font-semibold mb-4">Services</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-white transition">Service 1</a></li>
                            <li><a href="#" class="hover:text-white transition">Service 2</a></li>
                            <li><a href="#" class="hover:text-white transition">Service 3</a></li>
                            <li><a href="#" class="hover:text-white transition">Service 4</a></li>
                        </ul>
                    </div>

                    <!-- Resources -->
                    <div>
                        <h5 class="font-semibold mb-4">Resources</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-white transition">News</a></li>
                            <li><a href="#" class="hover:text-white transition">Blog</a></li>
                            <li><a href="#" class="hover:text-white transition">Videos</a></li>
                            <li><a href="#" class="hover:text-white transition">FAQs</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-400">© 2023 Mockup. All Rights Reserved.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a href="#" class="text-sm text-gray-400 hover:text-white transition">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-white transition">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection

