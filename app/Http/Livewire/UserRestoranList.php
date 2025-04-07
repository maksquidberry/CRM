<?php

namespace App\Http\Livewire;

use App\Models\RestoranGroup;
use Livewire\Component;

class UserRestoranList extends Component
{
    public $group;

    public function mount($idGroup)
    {
        $this->group = $idGroup;
    }

    public function render()
    {
        $groupItems = RestoranGroup::where('group_item', $this->group)->get();
        return view('livewire.user-restoran-list', compact('groupItems'));
    }
}
