<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class CounterItemList extends Component
{
    public function render()
    {
        $list = new Order();
        $list = $list->getNewOrders(auth()->user()->role, auth()->user()->id);

        if (\Auth::user()->restoran_id){
            $list = $list->where('restoran_id', \Auth::user()->restoran_id);
        }
        $list = $list->get();
        $list_count = count($list);
        return view('livewire.counter-item-list', compact('list_count'));
    }
}
