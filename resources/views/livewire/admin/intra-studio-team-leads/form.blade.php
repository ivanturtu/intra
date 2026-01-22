<div>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-[#1b304e]">
            {{ $teamLeadId ? 'Edit INTRAstudio Team Lead' : 'Create New INTRAstudio Team Lead' }}
        </h2>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <!-- Photo -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Photo</label>
                @if($photoPath)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $photoPath) }}" alt="Team lead photo" class="h-32 w-32 object-cover rounded-full">
                    </div>
                @endif
                <input type="file" wire:model="photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#d3924f]/20 file:text-[#d3924f] hover:file:bg-[#d3924f]/30">
                @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Name and Surname -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#1b304e] mb-2">Name *</label>
                    <input type="text" wire:model="name" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#1b304e] mb-2">Surname</label>
                    <input type="text" wire:model="surname" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                </div>
            </div>

            <!-- Role and Qualification -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#1b304e] mb-2">Role</label>
                    <input type="text" wire:model="role" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#1b304e] mb-2">Qualification</label>
                    <input type="text" wire:model="qualification" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                    @error('qualification') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Incipit -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Incipit</label>
                <textarea wire:model="incipit" rows="3" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white"></textarea>
                @error('incipit') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Vision Phrase -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Vision Phrase</label>
                <input type="text" wire:model="visionPhrase" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                @error('visionPhrase') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Quote -->
            <div wire:ignore>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Quote</label>
                <div id="quoteEditor" style="height: 150px;" class="mb-2"></div>
                <textarea wire:model="quote" id="quote" style="display: none;"></textarea>
                @error('quote') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Resume Link -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Resume Link</label>
                <input type="url" wire:model="resumeLink" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white" placeholder="https://...">
                @error('resumeLink') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Email</label>
                <input type="email" wire:model="email" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Description with Editor -->
            <div wire:ignore>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Description</label>
                <div id="teamLeadDescriptionEditor" style="height: 300px;" class="mb-2"></div>
                <textarea wire:model="description" id="teamLeadDescription" style="display: none;"></textarea>
            </div>

            <!-- Order -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Order</label>
                <input type="number" wire:model="order" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('admin.intra-studio-team-leads.index') }}" class="px-6 py-2 border border-[#1b304e]/20 rounded-lg text-[#1b304e] hover:bg-[#dfdfbb]/20 transition">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-[#d3924f] text-white rounded-lg hover:bg-[#d3924f]/90 transition">
                    {{ $teamLeadId ? 'Update Team Lead' : 'Create Team Lead' }}
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let teamLeadDescriptionQuill = null;
    let teamLeadDescriptionQuillInitialized = false;
    let quoteQuill = null;
    let quoteQuillInitialized = false;

    function initTeamLeadEditor() {
        // Initialize Quill for Description if not already initialized
        const descEl = document.getElementById('teamLeadDescriptionEditor');
        if (descEl && !descEl.querySelector('.ql-container') && !teamLeadDescriptionQuillInitialized) {
            teamLeadDescriptionQuillInitialized = true;
            // Destroy existing instance if any
            if (teamLeadDescriptionQuill) {
                try {
                    teamLeadDescriptionQuill = null;
                } catch(e) {}
            }
            teamLeadDescriptionQuill = new Quill('#teamLeadDescriptionEditor', {
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
                        ['link', 'image'],
                        ['clean'],
                        ['code-block']
                    ]
                }
            });

            // Set initial content
            const descContent = @this.description || '';
            if (descContent) {
                teamLeadDescriptionQuill.root.innerHTML = descContent;
            }

            // Update Livewire on text change (debounced to avoid too many updates)
            let descTimeout;
            teamLeadDescriptionQuill.on('text-change', function() {
                clearTimeout(descTimeout);
                descTimeout = setTimeout(() => {
                    const content = teamLeadDescriptionQuill.root.innerHTML;
                    document.getElementById('teamLeadDescription').value = content;
                    @this.set('description', content, false); // false = don't update wire:model immediately
                }, 300);
            });
        }

        // Initialize Quill for Quote if not already initialized
        const quoteEl = document.getElementById('quoteEditor');
        if (quoteEl && !quoteEl.querySelector('.ql-container') && !quoteQuillInitialized) {
            quoteQuillInitialized = true;
            if (quoteQuill) {
                try {
                    quoteQuill = null;
                } catch(e) {}
            }
            quoteQuill = new Quill('#quoteEditor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link'],
                        ['clean']
                    ]
                }
            });

            const quoteContent = @this.quote || '';
            if (quoteContent) {
                quoteQuill.root.innerHTML = quoteContent;
            }

            let quoteTimeout;
            quoteQuill.on('text-change', function() {
                clearTimeout(quoteTimeout);
                quoteTimeout = setTimeout(() => {
                    const content = quoteQuill.root.innerHTML;
                    document.getElementById('quote').value = content;
                    @this.set('quote', content, false);
                }, 300);
            });
        }
    }

    // Use Livewire hooks to properly initialize editors
    document.addEventListener('livewire:init', () => {
        // Initialize editors once when Livewire is ready
        setTimeout(() => {
            initTeamLeadEditor();
        }, 300);
    });

    // Initialize editors when component is loaded
    document.addEventListener('livewire:load', () => {
        setTimeout(() => {
            initTeamLeadEditor();
        }, 200);
    });

    // Also initialize on initial page load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                initTeamLeadEditor();
            }, 200);
        });
    } else {
        setTimeout(() => {
            initTeamLeadEditor();
        }, 200);
    }

    // With wire:ignore, Livewire won't touch the editor container
    // So we don't need to worry about it being destroyed
    // Just sync content when needed (but not during typing)
    document.addEventListener('livewire:update', () => {
        // Only sync if editor exists and is not focused
        setTimeout(() => {
            if (teamLeadDescriptionQuill && teamLeadDescriptionQuill.root && !teamLeadDescriptionQuill.hasFocus() && @this.description) {
                const currentContent = teamLeadDescriptionQuill.root.innerHTML;
                const livewireContent = @this.description;
                if (currentContent !== livewireContent && livewireContent !== '') {
                    teamLeadDescriptionQuill.root.innerHTML = livewireContent;
                }
            }
            if (quoteQuill && quoteQuill.root && !quoteQuill.hasFocus() && @this.quote) {
                const currentContent = quoteQuill.root.innerHTML;
                const livewireContent = @this.quote;
                if (currentContent !== livewireContent && livewireContent !== '') {
                    quoteQuill.root.innerHTML = livewireContent;
                }
            }
        }, 100);
    });
</script>
