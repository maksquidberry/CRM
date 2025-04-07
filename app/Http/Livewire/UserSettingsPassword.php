<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserSettingsPassword extends Component
{
    use WithFileUploads;

    public $avatar;
    public $user;
    public $password_confirmd;
    public $password_new;

    public function rules()
    {
        return [
            'password_new' => 'required',
            'password_confirmd' => 'required',
        ];
    }

    public function updateUserInfo()
    {
        $this->validate();
        if ($this->password_new === $this->password_confirmd){
            $this->user->password = bcrypt($this->password_new);
            $this->user->save();
            \Auth::setUser($this->user);
            $this->dispatchBrowserEvent('updatedUserPassword');
        }
        else {
            $this->dispatchBrowserEvent('errorUserPassword');
        }


    }

    public function mount()
    {
        $this->user = User::find(\Auth::user()->id);
    }

    public function render()
    {
        return view('livewire.user-settings-password');
    }
}
