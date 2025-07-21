<div>
    @if($show)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
            <div class="bg-purple-950 rounded-xl p-8 w-full max-w-md relative">
                <button class="absolute top-2 right-2 text-purple-300" wire:click="$set('show', false)">&times;</button>
                <h2 class="text-2xl font-bold text-white mb-4">Edit Profile</h2>
                @if(session('success'))
                    <div class="text-green-400 mb-2">{{ session('success') }}</div>
                @endif
                <form wire:submit.prevent="updateProfile">
                    <div class="mb-4">
                        <label class="block text-purple-300 mb-1">Name</label>
                        <input type="text" wire:model="name" class="w-full rounded-lg bg-black text-white border border-purple-600 p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-purple-300 mb-1">Email</label>
                        <input type="email" wire:model="user.email" class="w-full rounded-lg bg-black text-white border border-purple-600 p-2" disabled>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">Save</button>
                </form>
            </div>
        </div>
    @endif
</div>
