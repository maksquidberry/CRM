<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class CompleteOrderItem extends Component
{
    public $order;

    public function mount(int $id)
    {
        $this->order = Order::find($id);
    }

    function getOrderToUser(){
        $nowTime = Carbon::now()->timestamp()->format('d.m.Y H:i:s');
        $created = Carbon::parse($this->order->created_at)->format('d.m.Y H:i:s');


        $this->order->get_user = 1;
        $this->order->close_order = Carbon::now();
        $this->order->close_sec = (strtotime($nowTime) - strtotime($created));
        $this->order->save();

        $this->emitTo(CompleateOrdersTabs::class, 'updateItems');
    }

    public function render()
    {
        return view('livewire.complete-order-item');
    }
}
