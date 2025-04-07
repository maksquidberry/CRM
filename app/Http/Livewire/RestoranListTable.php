<?php

namespace App\Http\Livewire;

use App\Models\Restorans;
use App\Models\User;
use Livewire\Component;

class RestoranListTable extends Component
{
    public function deleteUser($id)
    {
        $userDeleted = Restorans::find($id);
        $userDeleted->delete();
    }
    public function render()
    {
        $users = Restorans::get();
        return view('livewire.restoran-list-table', compact('users'));
    }
}
