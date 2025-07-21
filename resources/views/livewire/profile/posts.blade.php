<div class="space-y-4">
    @forelse($posts as $post)
        <div class="bg-purple-950 rounded-lg p-4 shadow">
            <div class="flex items-center mb-2">
                <img src="{{ $post->user->avatar_url ?? asset('images/logo.png') }}" class="w-8 h-8 rounded-full mr-2">
                <span class="text-white font-semibold">{{ $post->user->name }}</span>
                <span class="text-gray-400 ml-2 text-xs">{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <div class="text-white">{{ $post->content }}</div>
            @if($post->media_url)
                <img src="{{ asset($post->media_url) }}" class="mt-2 rounded-lg max-h-64">
            @elseif($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="mt-2 rounded-lg max-h-64">
            @endif
        </div>
    @empty
        <div class="text-purple-300">No posts yet.</div>
    @endforelse
</div>
