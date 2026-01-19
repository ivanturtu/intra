<div>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-[#1b304e]">Settings</h2>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <!-- Site Title -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Site Title</label>
                <input type="text" wire:model="siteTitle" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                @error('siteTitle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Site Description -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Brief Description</label>
                <textarea wire:model="siteDescription" rows="3" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white"></textarea>
                @error('siteDescription') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Logo -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Logo</label>
                @if($logoPath)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo" class="h-32 w-auto rounded">
                    </div>
                @endif
                <input type="file" wire:model="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#d3924f]/20 file:text-[#d3924f] hover:file:bg-[#d3924f]/30">
                @error('logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Favicon -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Favicon</label>
                @if($faviconPath)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $faviconPath) }}" alt="Favicon" class="h-16 w-16 rounded">
                    </div>
                @endif
                <input type="file" wire:model="favicon" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#d3924f]/20 file:text-[#d3924f] hover:file:bg-[#d3924f]/30">
                <p class="mt-1 text-xs text-gray-500">Recommended size: 32x32px or 16x16px</p>
                @error('favicon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Social Media Links -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold text-[#1b304e] mb-4">Social Media Links</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[#1b304e] mb-2">Facebook URL</label>
                        <input type="url" wire:model="facebookUrl" placeholder="https://facebook.com/..." class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                        @error('facebookUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#1b304e] mb-2">LinkedIn URL</label>
                        <input type="url" wire:model="linkedinUrl" placeholder="https://linkedin.com/..." class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                        @error('linkedinUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#1b304e] mb-2">Instagram URL</label>
                        <input type="url" wire:model="instagramUrl" placeholder="https://instagram.com/..." class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                        @error('instagramUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold text-[#1b304e] mb-4">Contact Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[#1b304e] mb-2">Address</label>
                        <textarea wire:model="address" rows="3" placeholder="1505 Barrington Street, Suite 100 - M03, Halifax, Nova Scotia, B3J 2A4 CANADA" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white"></textarea>
                        @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#1b304e] mb-2">Phone</label>
                        <input type="text" wire:model="phone" placeholder="+1 (902) 123-4567" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#1b304e] mb-2">Email</label>
                        <input type="email" wire:model="email" placeholder="info@intrastudio.com" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold text-[#1b304e] mb-4">SEO Settings</h3>
                
                <div class="space-y-4">
                    <!-- Meta Tags -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-md font-semibold text-[#1b304e] mb-3">Meta Tags</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-[#1b304e] mb-2">Meta Title</label>
                                <input type="text" wire:model="metaTitle" placeholder="Page title for search engines" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                                <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters</p>
                                @error('metaTitle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-[#1b304e] mb-2">Meta Description</label>
                                <textarea wire:model="metaDescription" rows="3" placeholder="Brief description for search engines" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white"></textarea>
                                <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters</p>
                                @error('metaDescription') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-[#1b304e] mb-2">Meta Keywords</label>
                                <input type="text" wire:model="metaKeywords" placeholder="keyword1, keyword2, keyword3" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                                <p class="mt-1 text-xs text-gray-500">Comma-separated keywords</p>
                                @error('metaKeywords') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Open Graph -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-md font-semibold text-[#1b304e] mb-3">Open Graph (Facebook, LinkedIn)</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-[#1b304e] mb-2">OG Title</label>
                                <input type="text" wire:model="ogTitle" placeholder="Title for social media sharing" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                                @error('ogTitle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-[#1b304e] mb-2">OG Description</label>
                                <textarea wire:model="ogDescription" rows="3" placeholder="Description for social media sharing" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white"></textarea>
                                @error('ogDescription') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-[#1b304e] mb-2">OG Image</label>
                                @if($ogImagePath)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $ogImagePath) }}" alt="OG Image" class="h-32 w-auto rounded">
                                    </div>
                                @endif
                                <input type="file" wire:model="ogImage" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#d3924f]/20 file:text-[#d3924f] hover:file:bg-[#d3924f]/30">
                                <p class="mt-1 text-xs text-gray-500">Recommended: 1200x630px</p>
                                @error('ogImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Twitter Card -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-md font-semibold text-[#1b304e] mb-3">Twitter Card</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-[#1b304e] mb-2">Twitter Card Title</label>
                                <input type="text" wire:model="twitterCardTitle" placeholder="Title for Twitter sharing" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                                @error('twitterCardTitle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-[#1b304e] mb-2">Twitter Card Description</label>
                                <textarea wire:model="twitterCardDescription" rows="3" placeholder="Description for Twitter sharing" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white"></textarea>
                                @error('twitterCardDescription') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-[#1b304e] mb-2">Twitter Card Image</label>
                                @if($twitterCardImagePath)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $twitterCardImagePath) }}" alt="Twitter Card Image" class="h-32 w-auto rounded">
                                    </div>
                                @endif
                                <input type="file" wire:model="twitterCardImage" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#d3924f]/20 file:text-[#d3924f] hover:file:bg-[#d3924f]/30">
                                <p class="mt-1 text-xs text-gray-500">Recommended: 1200x675px</p>
                                @error('twitterCardImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Privacy Policy -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold text-[#1b304e] mb-4">Privacy Policy</h3>
                <div wire:ignore>
                    <label class="block text-sm font-medium text-[#1b304e] mb-2">Privacy Policy Text</label>
                    <div id="privacyPolicyEditor" style="height: 400px;" class="mb-2"></div>
                    <textarea wire:model="privacyPolicy" id="privacyPolicy" style="display: none;"></textarea>
                    @error('privacyPolicy') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <button type="submit" class="px-6 py-2 bg-[#d3924f] text-white rounded-lg hover:bg-[#d3924f]/90 transition">
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let privacyPolicyQuill = null;
    let privacyPolicyQuillInitialized = false;

    function initPrivacyPolicyEditor() {
        if (privacyPolicyQuillInitialized) {
            return;
        }

        const editorEl = document.getElementById('privacyPolicyEditor');
        if (!editorEl) {
            return;
        }

        if (editorEl.querySelector('.ql-container')) {
            privacyPolicyQuillInitialized = true;
            return;
        }

        privacyPolicyQuill = new Quill('#privacyPolicyEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    ['link'],
                    ['clean'],
                    ['code-block']
                ]
            }
        });

        privacyPolicyQuillInitialized = true;

        const content = @this.privacyPolicy || '';
        if (content) {
            privacyPolicyQuill.root.innerHTML = content;
        }

        let timeout;
        privacyPolicyQuill.on('text-change', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const content = privacyPolicyQuill.root.innerHTML;
                document.getElementById('privacyPolicy').value = content;
                @this.set('privacyPolicy', content, false);
            }, 300);
        });
    }

    document.addEventListener('livewire:init', () => {
        setTimeout(() => {
            initPrivacyPolicyEditor();
        }, 300);
    });

    document.addEventListener('livewire:update', () => {
        setTimeout(() => {
            if (privacyPolicyQuill && privacyPolicyQuill.root && !privacyPolicyQuill.hasFocus() && @this.privacyPolicy) {
                const currentContent = privacyPolicyQuill.root.innerHTML;
                const livewireContent = @this.privacyPolicy;
                if (currentContent !== livewireContent && livewireContent !== '') {
                    privacyPolicyQuill.root.innerHTML = livewireContent;
                }
            }
        }, 100);
    });
</script>
