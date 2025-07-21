<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    @forelse($pictures as $post)
        <div class="bg-purple-950 rounded-lg p-2 shadow">
            @if($post->media_url)
                <img src="{{ asset($post->media_url) }}" class="rounded-lg w-full h-48 object-cover">
            @elseif($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="rounded-lg w-full h-48 object-cover">
            @endif
        </div>
    @empty
        <div class="text-purple-300 col-span-2">No pictures yet.</div>
    @endforelse
</div>
