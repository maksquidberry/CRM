<?php

namespace App\Http\Livewire;

use App\Models\RestoranGroup;
use Livewire\Component;

class UserRestoranForm extends Component
{
    public  $item;
    public $groupId;


    protected $rules = [
        'item.name' => 'string|required',
        'item.description' => 'string|nullable',
        'item.xml_id' => 'string|nullable',
    ];

    public function save()
    {
        $this->validate();
        $this->item->group_item = $this->groupId;
        $this->item->save();
        $this->item = new RestoranGroup();
        $this->dispatchBrowserEvent('saveUser');
    }
    public function mount($id)
    {
        $this->groupId = $id;
        $this->item = new RestoranGroup();
    }

    public function render()
    {
        return view('livewire.user-restoran-form');
    }
}
