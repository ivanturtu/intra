<div>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-[#1b304e]">
            {{ $categoryId ? 'Edit Magazine Category' : 'Create New Magazine Category' }}
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

            <!-- Slug -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Slug</label>
                <input type="text" wire:model="slug" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
                <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate from name</p>
                @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div wire:ignore>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Description</label>
                <div id="magazineCategoryDescriptionEditor" style="height: 300px;" class="mb-2"></div>
                <textarea wire:model="description" id="magazineCategoryDescription" style="display: none;"></textarea>
            </div>

            <!-- Order -->
            <div>
                <label class="block text-sm font-medium text-[#1b304e] mb-2">Order</label>
                <input type="number" wire:model="order" class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white">
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('admin.magazine-categories.index') }}" class="px-6 py-2 border border-[#1b304e]/20 rounded-lg text-[#1b304e] hover:bg-[#dfdfbb]/20 transition">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-[#d3924f] text-white rounded-lg hover:bg-[#d3924f]/90 transition">
                    {{ $categoryId ? 'Update Category' : 'Create Category' }}
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let magazineCategoryDescriptionQuill = null;

    function initMagazineCategoryEditor() {
        const descEl = document.getElementById('magazineCategoryDescriptionEditor');
        if (descEl && !descEl.querySelector('.ql-container')) {
            if (magazineCategoryDescriptionQuill) {
                try {
                    magazineCategoryDescriptionQuill = null;
                } catch(e) {}
            }
            magazineCategoryDescriptionQuill = new Quill('#magazineCategoryDescriptionEditor', {
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
                magazineCategoryDescriptionQuill.root.innerHTML = descContent;
            }

            let descTimeout;
            magazineCategoryDescriptionQuill.on('text-change', function() {
                clearTimeout(descTimeout);
                descTimeout = setTimeout(() => {
                    const content = magazineCategoryDescriptionQuill.root.innerHTML;
                    document.getElementById('magazineCategoryDescription').value = content;
                    @this.set('description', content, false);
                }, 300);
            });
        }
    }

    document.addEventListener('livewire:init', () => {
        setTimeout(initMagazineCategoryEditor, 300);
    });

    document.addEventListener('livewire:load', () => {
        setTimeout(initMagazineCategoryEditor, 200);
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(initMagazineCategoryEditor, 200);
        });
    } else {
        setTimeout(initMagazineCategoryEditor, 200);
    }

    document.addEventListener('livewire:update', () => {
        setTimeout(() => {
            if (magazineCategoryDescriptionQuill && magazineCategoryDescriptionQuill.root && !magazineCategoryDescriptionQuill.hasFocus() && @this.description) {
                const currentContent = magazineCategoryDescriptionQuill.root.innerHTML;
                const livewireContent = @this.description;
                if (currentContent !== livewireContent && livewireContent !== '') {
                    magazineCategoryDescriptionQuill.root.innerHTML = livewireContent;
                }
            }
        }, 100);
    });
</script>
