<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-[#1b304e]">Projects</h2>
        <a href="{{ route('admin.projects.create') }}" class="bg-[#d3924f] hover:bg-[#d3924f]/90 text-white font-bold py-2 px-4 rounded transition">
            Create New Project
        </a>
    </div>

    <!-- Search -->
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="search" 
            placeholder="Search projects..." 
            class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white"
        >
    </div>

    <!-- Projects Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-[#dfdfbb]">
            <thead class="bg-[#1b304e]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Year</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-[#dfdfbb]">
                @forelse($projects as $project)
                    <tr class="hover:bg-[#dfdfbb]/20 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($project->main_image)
                                <img src="{{ asset('storage/' . $project->main_image) }}" alt="{{ $project->title }}" class="h-16 w-16 object-cover rounded">
                            @else
                                <div class="h-16 w-16 bg-[#dfdfbb] rounded flex items-center justify-center text-[#1b304e]/50 text-xs">No Image</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-[#1b304e]">{{ $project->title }}</div>
                            @if($project->short_description)
                                <div class="text-sm text-[#1b304e]/70">{{ \Illuminate\Support\Str::limit($project->short_description, 50) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#1b304e]/70">{{ $project->client ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#1b304e]/70">{{ $project->year ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($project->is_published)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#d3924f]/20 text-[#1b304e]">Published</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#dfdfbb] text-[#1b304e]">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#1b304e]/70">{{ $project->order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="text-[#d3924f] hover:text-[#d3924f]/80 mr-3 transition">Edit</a>
                            <button wire:click="delete({{ $project->id }})" 
                                    wire:confirm="Are you sure you want to delete this project?"
                                    class="text-red-600 hover:text-red-800 transition">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-[#1b304e]/70">No projects found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $projects->links() }}
    </div>
</div>
