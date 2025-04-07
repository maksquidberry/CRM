<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderListNew extends Component
{
    public function render()
    {
        $orders = new Order();
        $orders = $orders->where('get_user', 0);

        switch (Auth::user()->role)
        {
            case 'cook':
                $orders = $orders->where('status', 'cook')->whereNull('cook_id');
                break;

            case 'pack':
                $orders = $orders->where('status', 'pack')->whereNull('pack_id');
                break;
        }

        $orderList = $orders->get();

        return view('livewire.order-list-new', compact('orderList'));
    }
}
