<?php

namespace App\Http\Livewire;


use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrdersTabs extends Component
{
    use WithPagination;

    protected $listeners = ['updateItems' => 'render'];

    public function render()
    {
        $orders = new Order();
        $orderList = $orders->getActiveOrdersUserToday(\Auth::user()->role, \Auth::user()->id);
        return view('livewire.my-orders-tabs', compact('orderList'));
    }
}
