<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class NewOrdersTabs extends Component
{
    use WithPagination;

    protected $listeners = ['updateItems' => 'render'];

    public function render()
    {
        $orders = new Order();
        $orderList = $orders->getNewOrders(\Auth::user()->role, \Auth::user()->id);

        if (\Auth::user()->restoran_id){
            $orderList = $orderList->where('restoran_id', auth()->user()->restoran_id);
        }

        $orderList = $orderList->orderBy('id', 'desc')->get();

        return view('livewire.new-orders-tabs', compact('orderList'));
    }
}
