<div>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-[#1b304e]">
            {{ $userId ? 'Edit User' : 'Create New User' }}
        </h2>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Name *</label>
                <input type="text" wire:model="name" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Email *</label>
                <input type="email" wire:model="email" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">
                    Password {{ $userId ? '(leave empty to keep current)' : '*' }}
                </label>
                <input type="password" wire:model="password" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Password Confirmation -->
            @if(!$userId || !empty($password))
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Confirm Password *</label>
                <input type="password" wire:model="passwordConfirmation" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                @error('passwordConfirmation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            @endif

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-2 border border-[#1b304e]/20 rounded-lg text-[#1b304e] hover:bg-[#dfdfbb]/20 transition">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-[#d3924f] text-white rounded-lg hover:bg-[#d3924f]/90 transition">
                    {{ $userId ? 'Update User' : 'Create User' }}
                </button>
            </div>
        </div>
    </form>
</div>
