<?php

namespace App\Http\Livewire;

use App\Models\RestoranGroup;
use App\Models\Restorans;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResotranEditItem extends Component
{
    public bool $isEditMode = false;
    public Restorans $restoran;

    protected $rules = [
        'restoran.name' => 'string|required',
        'restoran.description' => 'string|nullable',
    ];


    public function mount(?int $userId)
    {
        $this->isEditMode = $userId > 0;
        $this->restoran = $this->isEditMode === true ? Restorans::find($userId) : new Restorans();
    }


    public function saveUser()
    {
        $this->validate();
        $this->restoran->save();
        $this->dispatchBrowserEvent('saveUser');
    }
    public function render()
    {
        return view('livewire.resotran-edit-item');
    }
}
