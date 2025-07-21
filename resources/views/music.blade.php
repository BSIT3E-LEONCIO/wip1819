@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto py-12">
    <h1 class="text-3xl font-bold text-purple-300 mb-8">Share Your Spotify Playlist</h1>
    <form method="POST" action="{{ route('music.post') }}" class="bg-black/40 backdrop-blur-xl border border-purple-500/20 rounded-3xl p-8 shadow-2xl mb-8">
        @csrf
        <div class="mb-6">
            <label for="spotify_link" class="block text-purple-200 font-semibold mb-2">Spotify Playlist Link</label>
            <input type="url" name="spotify_link" id="spotify_link" required class="w-full bg-gray-800/50 text-white rounded-2xl p-4 border border-purple-400/30 focus:ring-2 focus:ring-purple-400/50 focus:border-purple-400 transition-all duration-300 text-lg" placeholder="Paste your Spotify playlist link here...">
        </div>
        <button type="submit" class="bg-gradient-to-r from-purple-500 to-purple-700 hover:from-purple-600 hover:to-purple-800 text-white font-semibold py-3 px-8 rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">Post Playlist</button>
    </form>
    <div class="space-y-8">
        @foreach($playlists as $playlist)
            <div class="bg-black/40 border border-purple-500/20 rounded-3xl p-6 shadow-2xl">
                <div class="mb-4 flex items-center space-x-4 bg-gray-900 rounded-2xl p-4">
                    @php
                        // Try to get oEmbed data from Spotify
                        $oembed = null;
                        try {
                            $response = @file_get_contents('https://open.spotify.com/oembed?url=' . urlencode($playlist->link));
                            if ($response) $oembed = json_decode($response);
                        } catch (\Exception $e) {}
                    @endphp
                    @if($oembed && isset($oembed->thumbnail_url))
                        <img src="{{ $oembed->thumbnail_url }}" alt="Playlist cover" class="w-24 h-24 rounded-xl shadow-lg border border-purple-500/20 object-cover">
                    @else
                        <div class="w-24 h-24 bg-purple-900 rounded-xl flex items-center justify-center text-purple-300 text-4xl">🎵</div>
                    @endif
                    <div class="flex-1">
                        <div class="text-purple-200 font-bold text-lg mb-1">{{ $oembed->title ?? 'Spotify Playlist' }}</div>
                        <a href="{{ $playlist->link }}" target="_blank" class="text-purple-400 underline hover:text-purple-200">Open in Spotify</a>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-2">
                    <div class="text-purple-200 text-sm">Shared by: {{ $playlist->user->name }}</div>
                    @if($playlist->user_id === Auth::id())
                        <form method="POST" action="{{ route('music.delete', $playlist->id) }}" onsubmit="return confirm('Delete this playlist?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-200 px-3 py-1 rounded-xl bg-red-900/30 hover:bg-red-900/60 transition-all font-semibold">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
