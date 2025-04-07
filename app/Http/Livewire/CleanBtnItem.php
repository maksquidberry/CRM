<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class CleanBtnItem extends Component
{

    public function cleanOrder()
    {
        Order::where('get_user', 0)->update([
            'get_user' => 1,
            'status' => 'complete',
            'cooking_id' => auth()->user()->id,
            'packing_id' => auth()->user()->id,
            'start_cook_order' => Carbon::now(),
            'end_cook_order' => Carbon::now(),
            'start_pack_order' => Carbon::now(),
            'end_pack_order' => Carbon::now(),
            'close_order' => Carbon::now(),
            'cook_seconds' => 1,
            'pack_seconds' => 1,
            'close_sec' => 1,
        ]);
    }
    public function render()
    {
        return view('livewire.clean-btn-item');
    }
}
