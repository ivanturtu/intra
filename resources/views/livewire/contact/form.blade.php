@php
    $field = 'w-full px-[1rem] bg-white text-[1rem] font-medium text-primary placeholder:text-primary border-0 focus:outline-none focus:ring-2 focus:ring-tertiary';
@endphp
<div>
    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <!-- Fields on a 6-column grid (columns 4-9 of the page) -->
    <form wire:submit="submit" class="grid grid-cols-6 gap-x-[1rem]">
        <!-- Name -->
        <div class="col-span-6 md:col-span-3">
            <label for="name" class="sr-only">Name</label>
            <input type="text"
                   id="name"
                   wire:model="name"
                   class="{{ $field }} h-[3rem]"
                   placeholder="Name">
            @error('name')
                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="col-span-6 md:col-span-3 mt-4 md:mt-0">
            <label for="email" class="sr-only">Email Address</label>
            <input type="email"
                   id="email"
                   wire:model="email"
                   class="{{ $field }} h-[3rem]"
                   placeholder="Email Address">
            @error('email')
                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Message -->
        <div class="col-span-6 mt-[2.1875rem]">
            <label for="message" class="sr-only">Write your message here</label>
            <textarea id="message"
                      wire:model="message"
                      class="{{ $field }} block h-[10.625rem] py-[1rem] resize-none"
                      placeholder="Write your message here"></textarea>
            @error('message')
                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button (columns 7-9) -->
        <div class="col-span-6 md:col-start-4 md:col-span-3 mt-[2.3125rem]">
            <button type="submit"
                    class="w-full h-[3rem] bg-primary text-white text-[1rem] font-medium hover:bg-primary/90 transition cursor-pointer">
                Send
            </button>
        </div>
    </form>
</div>
