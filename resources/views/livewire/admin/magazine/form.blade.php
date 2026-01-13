<div>
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800">
                {{ $articleId ? 'Edit Article' : 'Create New Article' }}
            </h2>
        </div>

        <form wire:submit="save" class="space-y-6">
            <div class="bg-white rounded-lg shadow p-6 space-y-6">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" wire:model="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date *</label>
                    <input type="date" wire:model="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Text -->
                <div wire:ignore>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Text</label>
                    <div id="textEditor" style="height: 400px;" class="mb-2"></div>
                    <textarea wire:model="text" id="text" style="display: none;"></textarea>
                    @error('text') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    @if($imagePath)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Article image" class="h-32 w-auto rounded">
                        </div>
                    @endif
                    <input type="file" wire:model="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Image Gallery -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image Gallery</label>
                    @if(count($imageGallery) > 0)
                        <div class="grid grid-cols-4 gap-4 mb-4">
                            @foreach($imageGallery as $index => $image)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Gallery image" class="w-full h-32 object-cover rounded">
                                    <button type="button" wire:click="removeGalleryImage({{ $index }})" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">×</button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <input type="file" wire:model="imageGalleryFiles" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('imageGalleryFiles.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select wire:model="categoryId" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select a category</option>
                        @foreach($allCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categoryId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Order and Published -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                        <input type="number" wire:model="order" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" wire:model="isPublished" id="isPublished" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="isPublished" class="ml-2 block text-sm text-gray-700">Published</label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end gap-4 pt-4 border-t">
                    <a href="{{ route('admin.magazine.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        {{ $articleId ? 'Update Article' : 'Create Article' }}
                    </button>
                </div>
            </div>
        </form>
</div>

<script>
    let textQuill = null;

    function initEditors() {
        // Initialize Quill for Text if not already initialized
        const textEl = document.getElementById('textEditor');
        if (textEl && !textEl.querySelector('.ql-container')) {
            // Destroy existing instance if any
            if (textQuill) {
                try {
                    textQuill = null;
                } catch(e) {}
            }
            textQuill = new Quill('#textEditor', {
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
            const textContent = @this.text || '';
            if (textContent) {
                textQuill.root.innerHTML = textContent;
            }

            // Update Livewire on text change (debounced to avoid too many updates)
            let textTimeout;
            textQuill.on('text-change', function() {
                clearTimeout(textTimeout);
                textTimeout = setTimeout(() => {
                    const content = textQuill.root.innerHTML;
                    document.getElementById('text').value = content;
                    @this.set('text', content, false); // false = don't update wire:model immediately
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

    document.addEventListener('livewire:update', () => {
        setTimeout(() => {
            if (textQuill && textQuill.root && !textQuill.hasFocus() && @this.text) {
                const currentContent = textQuill.root.innerHTML;
                const livewireContent = @this.text;
                if (currentContent !== livewireContent && livewireContent !== '') {
                    textQuill.root.innerHTML = livewireContent;
                }
            }
        }, 100);
    });
</script>
