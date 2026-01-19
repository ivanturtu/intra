<div>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-[#1b304e]">
            {{ $categoryId ? 'Edit Category' : 'Create New Category' }}
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

            <!-- Subtitle -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Subtitle</label>
                <input type="text" wire:model="subtitle" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                @error('subtitle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Slug -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Slug</label>
                <input type="text" wire:model="slug" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                <p class="mt-1 text-xs text-[#1b304e]/70">Leave empty to auto-generate from name</p>
                @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Cover Image -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Cover Image</label>
                @if($coverImagePath)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $coverImagePath) }}" alt="Cover image" class="h-32 w-auto rounded">
                    </div>
                @endif
                <input type="file" wire:model="coverImage" class="block w-full text-sm text-[#1b304e]/70 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#d3924f]/20 file:text-[#d3924f] hover:file:bg-[#d3924f]/30">
                @error('coverImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Description</label>
                <div id="categoryDescriptionEditor" style="height: 300px;" class="mb-2"></div>
                <textarea wire:model="description" id="categoryDescription" style="display: none;"></textarea>
            </div>

            <!-- Order -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Order</label>
                <input type="number" wire:model="order" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 border border-[#1b304e]/20 rounded-lg text-[#1b304e] hover:bg-[#dfdfbb]/20 transition">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-[#d3924f] text-white rounded-lg hover:bg-[#d3924f]/90 transition">
                    {{ $categoryId ? 'Update Category' : 'Create Category' }}
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let categoryDescriptionQuill = null;

    function initCategoryEditor() {
        // Initialize Quill for Category Description if not already initialized
        if (!categoryDescriptionQuill && document.getElementById('categoryDescriptionEditor')) {
            categoryDescriptionQuill = new Quill('#categoryDescriptionEditor', {
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
                categoryDescriptionQuill.root.innerHTML = descContent;
            }

            // Update Livewire on text change
            categoryDescriptionQuill.on('text-change', function() {
                const content = categoryDescriptionQuill.root.innerHTML;
                document.getElementById('categoryDescription').value = content;
                @this.set('description', content);
            });
        }
    }

    document.addEventListener('livewire:init', () => {
        setTimeout(initCategoryEditor, 100);
    });

    document.addEventListener('livewire:load', () => {
        setTimeout(initCategoryEditor, 100);
    });

    // Reinitialize after Livewire updates
    document.addEventListener('livewire:update', () => {
        setTimeout(() => {
            if (categoryDescriptionQuill && @this.description) {
                const currentContent = categoryDescriptionQuill.root.innerHTML;
                const livewireContent = @this.description;
                if (currentContent !== livewireContent) {
                    categoryDescriptionQuill.root.innerHTML = livewireContent;
                }
            }
        }, 100);
    });
</script>
