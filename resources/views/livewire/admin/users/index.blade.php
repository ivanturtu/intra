<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-[#1b304e]">Admin Users</h2>
        <a href="{{ route('admin.users.create') }}" class="bg-[#d3924f] hover:bg-[#d3924f]/90 text-white font-bold py-2 px-4 rounded transition">
            Create New User
        </a>
    </div>

    <!-- Search -->
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="search" 
            placeholder="Search users..." 
            class="w-full px-4 py-2 border border-[#1b304e]/20 rounded-lg focus:ring-2 focus:ring-[#d3924f] focus:border-[#d3924f] bg-white"
        >
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-[#dfdfbb]">
            <thead class="bg-[#1b304e]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-[#dfdfbb]">
                @forelse($users as $user)
                    <tr class="hover:bg-[#dfdfbb]/20 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-[#1b304e]">{{ $user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#1b304e]/70">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-[#d3924f] hover:text-[#d3924f]/80 mr-3 transition">Edit</a>
                            @if($user->id != auth()->id())
                                <button wire:click="delete({{ $user->id }})" 
                                        wire:confirm="Are you sure you want to delete this user?"
                                        class="text-red-600 hover:text-red-800 transition">Delete</button>
                            @else
                                <span class="text-[#1b304e]/50">Current User</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-[#1b304e]/70">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
