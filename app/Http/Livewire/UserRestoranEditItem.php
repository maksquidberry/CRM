<?php

namespace App\Http\Livewire;

use App\Models\RestoranGroup;
use Livewire\Component;

class UserRestoranEditItem extends Component
{
    public $item;

    public function mount($id)
    {
        $this->item = RestoranGroup::find($id);
    }

    public function delete()
    {
        $this->item->delete();
        $this->dispatchBrowserEvent('saveUser');
    }

    public function render()
    {
        return view('livewire.user-restoran-edit-item');
    }
}
