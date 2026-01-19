<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-[#1b304e]">INTRAstudio Team Leads</h2>
        <a href="{{ route('admin.intra-studio-team-leads.create') }}" class="bg-[#d3924f] hover:bg-[#d3924f]/90 text-white font-bold py-2 px-4 rounded transition">
            Create New Team Lead
        </a>
    </div>

    <!-- Search -->
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="search" 
            placeholder="Search team leads..." 
            class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white"
        >
    </div>

    <!-- Team Leads Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-[#dfdfbb]">
            <thead class="bg-[#1b304e]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Photo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-[#dfdfbb]">
                @forelse($teamLeads as $lead)
                    <tr class="hover:bg-[#dfdfbb]/20 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($lead->photo)
                                <img src="{{ asset('storage/' . $lead->photo) }}" alt="{{ $lead->name }}" class="h-16 w-16 object-cover rounded-full">
                            @else
                                <div class="h-16 w-16 bg-[#dfdfbb] rounded-full flex items-center justify-center text-[#1b304e]/50 text-xs">No Photo</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-[#1b304e]">{{ $lead->name }} {{ $lead->surname }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#1b304e]/70">{{ $lead->role ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#1b304e]/70">{{ $lead->email ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#1b304e]/70">{{ $lead->order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.intra-studio-team-leads.edit', $lead->id) }}" class="text-[#d3924f] hover:text-[#d3924f]/80 mr-3 transition">Edit</a>
                            <button wire:click="delete({{ $lead->id }})" 
                                    wire:confirm="Are you sure you want to delete this team lead?"
                                    class="text-red-600 hover:text-red-800 transition">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-[#1b304e]/70">No team leads found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $teamLeads->links() }}
    </div>
</div>
