<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class ResetOrdersItems extends Component
{

    public function resetItems()
    {
       $orders = Order::update('get_user', 1)->where('get_user', 0);
    }

    public function render()
    {
        return view('livewire.reset-orders-items');
    }
}
