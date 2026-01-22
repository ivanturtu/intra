<div>
    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit="submit" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-[#1b304e] mb-2">Name</label>
                <input type="text" 
                       id="name"
                       wire:model="name" 
                       class="w-full px-4 py-3 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white text-[#1b304e]"
                       placeholder="Your name">
                @error('name') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-[#1b304e] mb-2">Email Address</label>
                <input type="email" 
                       id="email"
                       wire:model="email" 
                       class="w-full px-4 py-3 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white text-[#1b304e]"
                       placeholder="your.email@example.com">
                @error('email') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                @enderror
            </div>
        </div>

        <!-- Message -->
        <div>
            <label for="message" class="block text-sm font-medium text-[#1b304e] mb-2">Write your message here</label>
            <textarea id="message"
                      wire:model="message" 
                      rows="6"
                      class="w-full px-4 py-3 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white text-[#1b304e]"
                      placeholder="Your message..."></textarea>
            @error('message') 
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" 
                    class="bg-[#1b304e] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#1b304e]/90 transition">
                Send
            </button>
        </div>
    </form>
</div>
