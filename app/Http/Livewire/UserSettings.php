<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserSettings extends Component
{
    use WithFileUploads;

    public $avatar;
    public $user;

    public function rules()
    {
        return [
            'user.name' => 'string|nullable',
            'user.first_name' => 'string|nullable',
            'user.second_name' => 'string|nullable',
            'user.last_name' => 'string|nullable',
            'user.email' => 'required|email',
        ];
    }

    public function updateUserInfo()
    {
        $this->validate();
        $this->user->name = $this->user->second_name . ' ' . $this->user->first_name . ' '. $this->user->last_name;
        $this->user->save();

        \Auth::setUser($this->user);

        $this->dispatchBrowserEvent('updatedUser');
    }

    public function mount()
    {
        $this->user = User::find(\Auth::user()->id);
    }

    public function render()
    {
        return view('livewire.user-settings');
    }
}
