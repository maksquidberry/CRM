<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class NewOrderItem extends Component
{
    protected $listeners = ['refreshComponent' => 'render'];

    public $order;

    public function mount(int $id)
    {
        $this->order = Order::find($id);
    }

    public function startOrderWork()
    {
        switch (\Auth::user()->role){
            case 'cooker':
                $this->order->cooking_id = \Auth::user()->id;
                $this->order->start_cook_order = Carbon::now();
                $this->order->status = 'cooking';
                $this->order->save();
                break;

            case 'packer':
                $this->order->packing_id = \Auth::user()->id;
                $this->order->start_pack_order = Carbon::now();
                $this->order->status = 'packing';
                $this->order->save();
                break;
        }

        $this->emitTo(NewOrdersTabs::class, 'updateItems');
    }

    public function render()
    {
        return view('livewire.new-order-item');
    }
}
