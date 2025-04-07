<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class MyOrdersList extends Component
{

    public $orderList;

    public function mount()
    {
//        $orders = Order::whereDate('created_at', Carbon::today());
        $orders = new Order();

        switch (\Auth::user()->role){
            case 'cooker':
                $orders = $orders->where('status', 'cooking')->where('cooking_id', \Auth::user()->id)->whereNull('end_cook_order');
                break;

            case 'packer':
                $orders = $orders->where('status', 'packing')->where('packing_id', \Auth::user()->id)->whereNull('end_pack_order');
                break;

            default:
                break;
        }

        $this->orderList = $orders->where('get_user', 0)->get();

    }
    public function render()
    {
        return view('livewire.my-orders-list');
    }
}
