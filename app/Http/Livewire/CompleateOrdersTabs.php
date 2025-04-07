<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class CompleateOrdersTabs extends Component
{

    protected $listeners = ['updateItems' => 'render'];

    public function render()
    {
        $orders = new Order();
        $orderList = $orders->getCompleateToday(\Auth::user()->role, \Auth::user()->id);
        return view('livewire.compleate-orders-tabs', compact('orderList'));
    }
}
