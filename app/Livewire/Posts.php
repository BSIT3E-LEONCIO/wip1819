<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class Posts extends Component
{
    use WithFileUploads;

    public $content = '';
    public $media;
    public $comments = [];
    public $postId;
    public $feeling = '';
    public $editing = null;
    public $editContent = '';
    public $posts;

    protected $rules = [
        'content' => 'required|string|max:1000',
        'media' => 'nullable|file|max:10240', // 10MB max for image/video
        'feeling' => 'nullable|string|max:10',
    ];

    public function submit()
    {
        $this->validate();
        $mediaPath = $this->media ? $this->media->store('posts', 'public') : null;
        $mediaType = $this->media ? $this->media->getMimeType() : null;

        Post::create([
            'user_id' => Auth::id(),
            'content' => $this->content,
            'image' => $mediaPath, // reuse image column for both image/video
            'feeling' => $this->feeling,
            'media_type' => $mediaType,
        ]);

        $this->reset(['content', 'media', 'feeling']);

        session()->flash('message', 'Post created successfully!');
    }
    
    public function startEdit($postId)
    {
        $post = Post::findOrFail($postId);
        // Only allow editing own post
        if ($post->user_id !== Auth::id()) return;
        $this->editing = $postId;
        $this->editContent = $post->content;
    }

    public function updatePost($postId)
    {
        $post = Post::findOrFail($postId);
        if ($post->user_id !== Auth::id()) return;
        $this->validate([
            'editContent' => 'required|string|max:1000',
        ]);
        $post->content = $this->editContent;
        $post->save();
        $this->editing = null;
        $this->editContent = '';
        $this->refreshPosts();
    }

    public function cancelEdit()
    {
        $this->editing = null;
        $this->editContent = '';
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        if ($post->user_id !== Auth::id()) return;
        $post->delete();
        $this->refreshPosts();
    }

    public function refreshPosts()
    {
        $this->posts = Post::with(['user', 'comments.user', 'likes'])->latest()->get();
    }

    public function like($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->likes()->toggle(Auth::id());
        }
    }

    public function addComment($id)
    {
        if (empty($this->comments[$id])) {
            return;
        }
        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $id,
            'comment' => $this->comments[$id],
        ]);
        $this->comments[$id] = '';
    }

    public function setFeeling($emoji)
    {
        $this->feeling = $emoji;
    }

    public function render()
    {
        $this->posts = Post::with(['user', 'comments.user', 'likes'])->latest()->get();
        return view('livewire.posts', ['posts' => $this->posts]);
    }
}
