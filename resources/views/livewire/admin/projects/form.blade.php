<div>
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800">
                {{ $projectId ? 'Edit Project' : 'Create New Project' }}
            </h2>
        </div>

        <form wire:submit="save" class="space-y-6">
            <div class="bg-white rounded-lg shadow p-6 space-y-6">
                <!-- Main Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Main Image</label>
                    @if($mainImagePath)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $mainImagePath) }}" alt="Main image" class="h-32 w-auto rounded">
                        </div>
                    @endif
                    <input type="file" wire:model="mainImage" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('mainImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" wire:model="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Short Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                    <div id="shortDescriptionEditor" style="height: 200px;" class="mb-2"></div>
                    <textarea wire:model="shortDescription" id="shortDescription" style="display: none;"></textarea>
                    @error('shortDescription') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Sector, Client, Location, Year -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sector</label>
                        <input type="text" wire:model="sector" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                        <input type="text" wire:model="client" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" wire:model="location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                        <input type="number" wire:model="year" min="1900" max="{{ date('Y') + 10 }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Quote -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quote</label>
                    <textarea wire:model="quote" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <div id="descriptionEditor" style="height: 400px;" class="mb-2"></div>
                    <textarea wire:model="description" id="description" style="display: none;"></textarea>
                </div>

                <!-- Selected Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Selected Image</label>
                    @if($selectedImagePath)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $selectedImagePath) }}" alt="Selected image" class="h-32 w-auto rounded">
                        </div>
                    @endif
                    <input type="file" wire:model="selectedImage" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
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
                </div>

                <!-- Team Members (Dynamic) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-4">Team Members</label>
                    @foreach($teamMembers as $index => $member)
                        <div class="border border-gray-300 rounded-lg p-4 mb-4 bg-gray-50">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-semibold text-gray-700">Team Member #{{ $index + 1 }}</h4>
                                @if(count($teamMembers) > 1)
                                    <button type="button" wire:click="removeTeamMember({{ $index }})" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 text-sm">Remove</button>
                                @endif
                            </div>
                            
                            <!-- Name and Surname -->
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Name *</label>
                                    <input type="text" wire:model="teamMembers.{{ $index }}.name" placeholder="Name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Surname</label>
                                    <input type="text" wire:model="teamMembers.{{ $index }}.surname" placeholder="Surname" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            
                            <!-- Role and Email -->
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Role</label>
                                    <input type="text" wire:model="teamMembers.{{ $index }}.role" placeholder="Role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Email</label>
                                    <input type="email" wire:model="teamMembers.{{ $index }}.email" placeholder="email@example.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            
                            <!-- Photo -->
                            <div class="mb-4">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Photo</label>
                                @if(isset($member['photo']) && $member['photo'])
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $member['photo']) }}" alt="Team member photo" class="h-24 w-24 object-cover rounded">
                                    </div>
                                @endif
                                <input type="file" wire:model="teamMemberPhotos.{{ $index }}" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                            
                            <!-- Description with Editor -->
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                                <div id="teamMemberDescriptionEditor{{ $index }}" style="height: 200px;" class="mb-2"></div>
                                <textarea wire:model="teamMembers.{{ $index }}.description" id="teamMemberDescription{{ $index }}" style="display: none;"></textarea>
                            </div>
                        </div>
                    @endforeach
                    <button type="button" wire:click="addTeamMember" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Add Team Member</button>
                </div>

                <!-- INTRAstudio Team Leads (Multiselect) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">INTRAstudio Team Leads</label>
                    <select wire:model="teamLeads" multiple class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" size="5">
                        @foreach($allTeams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }} @if($team->role) - {{ $team->role }} @endif</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Hold Ctrl (Cmd on Mac) to select multiple</p>
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

                <!-- Order, Published and In Hero -->
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                        <input type="number" wire:model="order" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" wire:model="isPublished" id="isPublished" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="isPublished" class="ml-2 block text-sm text-gray-700">Published</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" wire:model="inHero" id="inHero" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="inHero" class="ml-2 block text-sm text-gray-700">Show in Hero</label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end gap-4 pt-4 border-t">
                    <a href="{{ route('admin.projects.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        {{ $projectId ? 'Update Project' : 'Create Project' }}
                    </button>
                </div>
            </div>
        </form>
</div>

<script>
    let shortDescriptionQuill = null;
    let descriptionQuill = null;
    let teamMemberQuills = {};

    function initEditors() {
        // Initialize Quill for Short Description if not already initialized
        if (!shortDescriptionQuill && document.getElementById('shortDescriptionEditor')) {
            shortDescriptionQuill = new Quill('#shortDescriptionEditor', {
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

            // Set initial content
            const shortDescContent = @this.shortDescription || '';
            if (shortDescContent) {
                shortDescriptionQuill.root.innerHTML = shortDescContent;
            }

            // Update Livewire on text change
            shortDescriptionQuill.on('text-change', function() {
                const content = shortDescriptionQuill.root.innerHTML;
                document.getElementById('shortDescription').value = content;
                @this.set('shortDescription', content);
            });
        }

        // Initialize Quill for Description if not already initialized
        if (!descriptionQuill && document.getElementById('descriptionEditor')) {
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

            // Set initial content
            const descContent = @this.description || '';
            if (descContent) {
                descriptionQuill.root.innerHTML = descContent;
            }

            // Update Livewire on text change
            descriptionQuill.on('text-change', function() {
                const content = descriptionQuill.root.innerHTML;
                document.getElementById('description').value = content;
                @this.set('description', content);
            });
        }
    }

    function initTeamMemberEditors() {
        const teamMembers = @this.teamMembers || [];
        teamMembers.forEach((member, index) => {
            const editorId = `teamMemberDescriptionEditor${index}`;
            const textareaId = `teamMemberDescription${index}`;
            
            if (!teamMemberQuills[index] && document.getElementById(editorId)) {
                teamMemberQuills[index] = new Quill(`#${editorId}`, {
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

                const descContent = member.description || '';
                if (descContent) {
                    teamMemberQuills[index].root.innerHTML = descContent;
                }

                teamMemberQuills[index].on('text-change', function() {
                    const content = teamMemberQuills[index].root.innerHTML;
                    document.getElementById(textareaId).value = content;
                    @this.set(`teamMembers.${index}.description`, content);
                });
            }
        });
    }

    document.addEventListener('livewire:init', () => {
        setTimeout(() => {
            initEditors();
            initTeamMemberEditors();
        }, 100);
    });

    document.addEventListener('livewire:load', () => {
        setTimeout(() => {
            initEditors();
            initTeamMemberEditors();
        }, 100);
    });

    // Reinitialize after Livewire updates
    document.addEventListener('livewire:update', () => {
        setTimeout(() => {
            if (shortDescriptionQuill && @this.shortDescription) {
                const currentContent = shortDescriptionQuill.root.innerHTML;
                const livewireContent = @this.shortDescription;
                if (currentContent !== livewireContent) {
                    shortDescriptionQuill.root.innerHTML = livewireContent;
                }
            }
            if (descriptionQuill && @this.description) {
                const currentContent = descriptionQuill.root.innerHTML;
                const livewireContent = @this.description;
                if (currentContent !== livewireContent) {
                    descriptionQuill.root.innerHTML = livewireContent;
                }
            }
            initTeamMemberEditors();
        }, 100);
    });
</script>
