<?php
namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;

class EditProfileModal extends Component
{
    use WithFileUploads;

    public User $user;
    public $show = false;
    public $name;
    public $bio;
    public $avatar;
    public $cover_photo;

    protected $listeners = ['openEditProfile' => 'showModal'];

    public function mount(User $user)
    {
        $this->name = $user->name;
        $this->bio = $user->bio;
    }

    public function showModal()
    {
        $this->show = true;
    }

    public function updateProfile()
    {
        $this->user->name = $this->name;
        $this->user->bio = $this->bio;
        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
            $this->user->avatar_url = '/storage/' . $avatarPath;
        }
        if ($this->cover_photo) {
            $coverPath = $this->cover_photo->store('covers', 'public');
            $this->user->cover_photo_url = '/storage/' . $coverPath;
        }
        $this->user->save();
        $this->show = false;
        session()->flash('success', 'Profile updated!');
    }

    public function render()
    {
        return view('livewire.profile.edit-profile-modal');
    }
}
