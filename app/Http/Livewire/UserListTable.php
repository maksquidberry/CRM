<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserListTable extends Component
{
    public function deleteUser($id)
    {
        $userDeleted = User::find($id);
        $userDeleted->delete();
    }

    public function render()
    {
        $users = User::paginate(20);
        return view('livewire.user-list-table', compact('users'));
    }
}
