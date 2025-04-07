<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class NewOrdersList extends Component
{
    public $orderList;

    public function mount()
    {
        $orders = new Order();
        $this->orderList = $orders->getNewOrders(\Auth::user()->role, \Auth::user()->id)->get();

    }

    public function render()
    {
        return view('livewire.new-orders-list');
    }
}
