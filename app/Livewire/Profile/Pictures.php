<?php
namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;

class Pictures extends Component
{
    public User $user;

    public function render()
    {
        $pictures = $this->user->posts()
            ->where(function($query) {
                $query->whereNotNull('media_url')
                      ->orWhereNotNull('image');
            })
            ->latest()->get();
        return view('livewire.profile.pictures', compact('pictures'));
    }
}
