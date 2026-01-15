<!-- Footer -->
<footer class="bg-[#1b304e] text-white py-12 px-8 mt-auto">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-8">
            <!-- Company Info -->
            <div>
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/INTRAstudio-logotype-beige.png') }}" alt="INTRA studio" class="h-8">
                </div>
                <p class="text-sm text-gray-400 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1b304e] transition">
                        <span class="text-sm">f</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1b304e] transition">
                        <span class="text-sm">in</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1b304e] transition">
                        <span class="text-sm">ig</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#1b304e] transition">
                        <span class="text-sm">📞</span>
                    </a>
                </div>
            </div>

            <!-- Menu -->
            <div>
                <h5 class="font-semibold mb-4">Menu</h5>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ url('/work') }}" class="hover:text-white transition">Works</a></li>
                    <li><a href="{{ url('/#expertise') }}" class="hover:text-white transition">Expertise</a></li>
                    <li><a href="{{ url('/#story') }}" class="hover:text-white transition">Our story</a></li>
                    <li><a href="{{ url('/#mag') }}" class="hover:text-white transition">Mag</a></li>
                    <li><a href="{{ url('/#contact') }}" class="hover:text-white transition">Contact</a></li>
                </ul>
            </div>

            <!-- Expertise -->
            <div>
                <h5 class="font-semibold mb-4">Expertise</h5>
                <ul class="space-y-2 text-sm text-gray-400">
                    @foreach(($categories ?? collect()) as $category)
                        <li>
                            <a href="{{ url('/work?category=' . $category->id) }}" class="hover:text-white transition">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h5 class="font-semibold mb-4">Resources</h5>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ url('/#contact') }}" class="hover:text-white transition">Contact</a></li>
                    <li><a href="{{ url('/#mag') }}" class="hover:text-white transition">Mag</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-400">© 2019 IntraPlus. All Rights Reserved.</p>
            <div class="flex gap-6 mt-4 md:mt-0">
                <span class="text-sm text-gray-400">|</span>
                <a href="#" class="text-sm text-gray-400 hover:text-white transition">Privacy Policy</a>
                <span class="text-sm text-gray-400">|</span>
                <a href="#" class="text-sm text-gray-400 hover:text-white transition">Terms of Service</a>
                <span class="text-sm text-gray-400">|</span>
            </div>
        </div>
    </div>
</footer>
