<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuthUser extends Component
{
    public string $name;
    public string $password;


    public function mount()
    {
        $this->name = '';
        $this->password = '';
    }
    protected $rules = [
        'name' => 'required|string|min:6',
        'password' => 'required|string|max:500',
    ];

    public function checkUser()
    {
        $check = Auth::attempt(['email' => $this->name, 'password' => $this->password]);
        if ($check){
            return redirect()->route('dashboard');
        }
    }
    public function render()
    {
        return view('livewire.auth-user');
    }
}
