<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdatePass extends Component
{
    public $password;
    public $user_id;

    protected $rules = [
        'password' => 'required',
    ];

    public function updatepass()
    {
        $user = User::find($this->user_id);
        $user->password = bcrypt($this->password);
        $user->save();

        $this->dispatchBrowserEvent('checngePass');
    }

    public function mount($id)
    {
        $this->user_id = $id;
    }

    public function render()
    {
        return view('livewire.update-pass');
    }
}
