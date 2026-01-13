<div>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">
            {{ $teamLeadId ? 'Edit INTRAstudio Team Lead' : 'Create New INTRAstudio Team Lead' }}
        </h2>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <!-- Photo -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                @if($photoPath)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $photoPath) }}" alt="Team lead photo" class="h-32 w-32 object-cover rounded-full">
                    </div>
                @endif
                <input type="file" wire:model="photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Name and Surname -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input type="text" wire:model="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Surname</label>
                    <input type="text" wire:model="surname" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <!-- Role and Email -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <input type="text" wire:model="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" wire:model="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Description with Editor -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <div id="teamLeadDescriptionEditor" style="height: 300px;" class="mb-2"></div>
                <textarea wire:model="description" id="teamLeadDescription" style="display: none;"></textarea>
            </div>

            <!-- Order -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <input type="number" wire:model="order" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('admin.intra-studio-team-leads.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    {{ $teamLeadId ? 'Update Team Lead' : 'Create Team Lead' }}
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let teamLeadDescriptionQuill = null;

    function initTeamLeadEditor() {
        if (!teamLeadDescriptionQuill && document.getElementById('teamLeadDescriptionEditor')) {
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

            const descContent = @this.description || '';
            if (descContent) {
                teamLeadDescriptionQuill.root.innerHTML = descContent;
            }

            teamLeadDescriptionQuill.on('text-change', function() {
                const content = teamLeadDescriptionQuill.root.innerHTML;
                document.getElementById('teamLeadDescription').value = content;
                @this.set('description', content);
            });
        }
    }

    document.addEventListener('livewire:init', () => {
        setTimeout(initTeamLeadEditor, 100);
    });

    document.addEventListener('livewire:load', () => {
        setTimeout(initTeamLeadEditor, 100);
    });

    document.addEventListener('livewire:update', () => {
        setTimeout(() => {
            if (teamLeadDescriptionQuill && @this.description) {
                const currentContent = teamLeadDescriptionQuill.root.innerHTML;
                const livewireContent = @this.description;
                if (currentContent !== livewireContent) {
                    teamLeadDescriptionQuill.root.innerHTML = livewireContent;
                }
            }
        }, 100);
    });
</script>
