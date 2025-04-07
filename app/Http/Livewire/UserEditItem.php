<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserEditItem extends Component
{
    public bool $isEditMode = false;
    public User $user;

    protected $rules = [
        'user.email' => 'required|email',
        'user.first_name' => 'string|nullable',
        'user.second_name' => 'string|nullable',
        'user.last_name' => 'string|nullable',
        'user.role' => 'required',
        'user.restoran_id' => 'integer|nullable',
    ];


    public function mount(?int $userId)
    {
        $this->isEditMode = $userId > 0;
        $this->user = $this->isEditMode === true ? User::find($userId) : new User();

        if (!$this->isEditMode){
            $this->rules['user.password'] = 'required|confirmed|min:8';
        }
    }


    public function saveUser()
    {
        $this->validate();
        $this->user->name = $this->user->first_name . ' '. $this->user->second_name . ' '. $this->user->last_name;

        if ($this->isEditMode === false){
            $this->user->password = Hash::make($this->user->password);
        }

        $this->user->save();
        $this->dispatchBrowserEvent('saveUser');
    }

    public function render()
    {
        return view('livewire.user-edit-item');
    }
}
