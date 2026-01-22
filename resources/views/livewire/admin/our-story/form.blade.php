<div>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-[#1b304e]">Our Story</h2>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <!-- Intro -->
            <div wire:ignore>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Intro</label>
                <div id="introEditor" style="height: 200px;" class="mb-2"></div>
                <textarea wire:model="intro" id="intro" style="display: none;"></textarea>
                @error('intro') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div wire:ignore>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Description</label>
                <div id="descriptionEditor" style="height: 400px;" class="mb-2"></div>
                <textarea wire:model="description" id="description" style="display: none;"></textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Highlight -->
            <div wire:ignore>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Highlight</label>
                <div id="highlightEditor" style="height: 200px;" class="mb-2"></div>
                <textarea wire:model="highlight" id="highlight" style="display: none;"></textarea>
                @error('highlight') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <button type="submit" class="px-6 py-2 bg-[#d3924f] text-white rounded-lg hover:bg-[#d3924f]/90 transition">
                    Save Our Story
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let introQuill = null;
    let descriptionQuill = null;
    let highlightQuill = null;
    let introQuillInitialized = false;
    let descriptionQuillInitialized = false;
    let highlightQuillInitialized = false;

    function initEditors() {
        // Initialize Quill for Intro if not already initialized
        const introEl = document.getElementById('introEditor');
        if (introEl && !introEl.querySelector('.ql-container') && !introQuillInitialized) {
            introQuillInitialized = true;
            if (introQuill) {
                try {
                    introQuill = null;
                } catch(e) {}
            }
            introQuill = new Quill('#introEditor', {
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

            const introContent = @this.intro || '';
            if (introContent) {
                introQuill.root.innerHTML = introContent;
            }

            let introTimeout;
            introQuill.on('text-change', function() {
                clearTimeout(introTimeout);
                introTimeout = setTimeout(() => {
                    const content = introQuill.root.innerHTML;
                    document.getElementById('intro').value = content;
                    @this.set('intro', content, false);
                }, 300);
            });
        }

        // Initialize Quill for Description if not already initialized
        const descEl = document.getElementById('descriptionEditor');
        if (descEl && !descEl.querySelector('.ql-container') && !descriptionQuillInitialized) {
            descriptionQuillInitialized = true;
            if (descriptionQuill) {
                try {
                    descriptionQuill = null;
                } catch(e) {}
            }
            descriptionQuill = new Quill('#descriptionEditor', {
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

            const descContent = @this.description || '';
            if (descContent) {
                descriptionQuill.root.innerHTML = descContent;
            }

            let descTimeout;
            descriptionQuill.on('text-change', function() {
                clearTimeout(descTimeout);
                descTimeout = setTimeout(() => {
                    const content = descriptionQuill.root.innerHTML;
                    document.getElementById('description').value = content;
                    @this.set('description', content, false);
                }, 300);
            });
        }

        // Initialize Quill for Highlight if not already initialized
        const highlightEl = document.getElementById('highlightEditor');
        if (highlightEl && !highlightEl.querySelector('.ql-container') && !highlightQuillInitialized) {
            highlightQuillInitialized = true;
            if (highlightQuill) {
                try {
                    highlightQuill = null;
                } catch(e) {}
            }
            highlightQuill = new Quill('#highlightEditor', {
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

            const highlightContent = @this.highlight || '';
            if (highlightContent) {
                highlightQuill.root.innerHTML = highlightContent;
            }

            let highlightTimeout;
            highlightQuill.on('text-change', function() {
                clearTimeout(highlightTimeout);
                highlightTimeout = setTimeout(() => {
                    const content = highlightQuill.root.innerHTML;
                    document.getElementById('highlight').value = content;
                    @this.set('highlight', content, false);
                }, 300);
            });
        }
    }

    // Use Livewire hooks to properly initialize editors
    document.addEventListener('livewire:init', () => {
        setTimeout(() => {
            initEditors();
        }, 300);
    });

    document.addEventListener('livewire:load', () => {
        setTimeout(() => {
            initEditors();
        }, 200);
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                initEditors();
            }, 200);
        });
    } else {
        setTimeout(() => {
            initEditors();
        }, 200);
    }

    // Sync content when needed (but not during typing)
    document.addEventListener('livewire:update', () => {
        setTimeout(() => {
            if (introQuill && introQuill.root && !introQuill.hasFocus() && @this.intro) {
                const currentContent = introQuill.root.innerHTML;
                const livewireContent = @this.intro;
                if (currentContent !== livewireContent && livewireContent !== '') {
                    introQuill.root.innerHTML = livewireContent;
                }
            }
            if (descriptionQuill && descriptionQuill.root && !descriptionQuill.hasFocus() && @this.description) {
                const currentContent = descriptionQuill.root.innerHTML;
                const livewireContent = @this.description;
                if (currentContent !== livewireContent && livewireContent !== '') {
                    descriptionQuill.root.innerHTML = livewireContent;
                }
            }
            if (highlightQuill && highlightQuill.root && !highlightQuill.hasFocus() && @this.highlight) {
                const currentContent = highlightQuill.root.innerHTML;
                const livewireContent = @this.highlight;
                if (currentContent !== livewireContent && livewireContent !== '') {
                    highlightQuill.root.innerHTML = livewireContent;
                }
            }
        }, 100);
    });
</script>
