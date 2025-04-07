<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListOrderActive extends Component
{
    public function render()
    {
        $orders = new Order();
        $orders = $orders->where('get_user', 0);

        switch (Auth::user()->role)
        {
            case 'cook':
                $orders = $orders->where('status', 'cook')->where('cook_id', Auth::user()->id);
                break;

            case 'pack':
                $orders = $orders->where('status', 'pack')->where('pack_id', Auth::user()->id);
                break;
        }

        $orderList = $orders->get();

        return view('livewire.list-order-active', compact('orderList'));
    }
}
