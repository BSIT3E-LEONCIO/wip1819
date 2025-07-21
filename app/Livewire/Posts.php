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
    public $image;
    public $comment = '';
    public $postId;
    public $feeling = '';

    protected $rules = [
        'content' => 'required|string|max:1000',
        'image' => 'nullable|image|max:2048',
        'feeling' => 'nullable|string|max:10',
    ];

    public function submit()
    {
        $this->validate();
        $imagePath = $this->image ? $this->image->store('posts', 'public') : null;
        
        Post::create([
            'user_id' => Auth::id(),
            'content' => $this->content,
            'image' => $imagePath,
            'feeling' => $this->feeling,
        ]);
        
        $this->reset(['content', 'image', 'feeling']);
        
        // Add success message or notification here if needed
        session()->flash('message', 'Post created successfully!');
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
        if (empty($this->comment)) {
            return;
        }
        
        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $id,
            'comment' => $this->comment,
        ]);
        
        $this->reset('comment');
    }

    public function setFeeling($emoji)
    {
        $this->feeling = $emoji;
    }

    public function render()
    {
        $posts = Post::with(['user', 'comments.user', 'likes'])->latest()->get();
        return view('livewire.posts', compact('posts'));
    }
}
