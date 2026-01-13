<div>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Settings</h2>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <!-- Site Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Site Title</label>
                <input type="text" wire:model="siteTitle" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('siteTitle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Site Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Brief Description</label>
                <textarea wire:model="siteDescription" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                @error('siteDescription') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Logo -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                @if($logoPath)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo" class="h-32 w-auto rounded">
                    </div>
                @endif
                <input type="file" wire:model="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Favicon -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Favicon</label>
                @if($faviconPath)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $faviconPath) }}" alt="Favicon" class="h-16 w-16 rounded">
                    </div>
                @endif
                <input type="file" wire:model="favicon" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="mt-1 text-xs text-gray-500">Recommended size: 32x32px or 16x16px</p>
                @error('favicon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Social Media Links -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Social Media Links</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                        <input type="url" wire:model="facebookUrl" placeholder="https://facebook.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('facebookUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                        <input type="url" wire:model="linkedinUrl" placeholder="https://linkedin.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('linkedinUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                        <input type="url" wire:model="instagramUrl" placeholder="https://instagram.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('instagramUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Contact Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea wire:model="address" rows="3" placeholder="1505 Barrington Street, Suite 100 - M03, Halifax, Nova Scotia, B3J 2A4 CANADA" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" wire:model="phone" placeholder="+1 (902) 123-4567" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" wire:model="email" placeholder="info@intrastudio.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</div>
