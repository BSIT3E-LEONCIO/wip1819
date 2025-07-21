<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Playlist;

class MusicController extends Controller
{
    public function index()
    {
        $playlists = Playlist::with('user')->latest()->get();
        return view('music', compact('playlists'));
    }

    public function post(Request $request)
    {
        $request->validate([
            'spotify_link' => 'required|url',
        ]);
        $embed_url = $this->getSpotifyEmbedUrl($request->spotify_link);
        Playlist::create([
            'user_id' => Auth::id(),
            'link' => $request->spotify_link,
            'embed_url' => $embed_url,
        ]);
        return redirect()->route('music');
    }

    private function getSpotifyEmbedUrl($url)
    {
        // Convert Spotify playlist link to embed link
        if (preg_match('/spotify\.com\/playlist\/([a-zA-Z0-9]+)/', $url, $matches)) {
            return 'https://open.spotify.com/embed/playlist/' . $matches[1];
        }
        return $url;
    }

    public function delete(Playlist $playlist)
    {
        if ($playlist->user_id === Auth::id()) {
            $playlist->delete();
        }
        return redirect()->route('music');
    }
}
