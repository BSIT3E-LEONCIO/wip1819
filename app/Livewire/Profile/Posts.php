<?php
namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;

class Posts extends Component
{
    public User $user;

    public function render()
    {
        $posts = $this->user->posts()->latest()->get();
        return view('livewire.profile.posts', compact('posts'));
    }
}
