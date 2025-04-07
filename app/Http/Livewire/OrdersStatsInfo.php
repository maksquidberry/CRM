<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrdersStatsInfo extends Component
{
    public function render()
    {
        $orders = new Order();

        $order = $orders->whereNotNull('created_at')->where('status', '!=', 'create');
        switch (auth()->user()->role){
            case 'cooker':
                $order = $order->where('cooking_id', auth()->user()->id)->whereNotNull('end_cook_order');
                break;

            case 'packer':
                $order = $order->where('packing_id', auth()->user()->id)->whereNotNull('end_pack_order');
                break;
        }

        $allOrders = $order->orderBy('created_at', 'desc')->paginate(25);


        return view('livewire.orders-stats-info', compact('allOrders'));
    }
}
