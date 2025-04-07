<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CardItem extends Component
{
    public $index;
    public bool $isActive;

    public Order|null $order;

    public function mount()
    {
        $this->order = Order::find($this->index);
    }

    public function takeOrder()
    {
        if (Auth::user()->role === 'cook') $this->order->cook_id = Auth::user()->id;
        if (Auth::user()->role === 'pack') $this->order->pack_id = Auth::user()->id;
        $this->order->save();
    }

    public function compleatOrder()
    {

        switch ($this->order->status)
        {
            case "new":
                $this->order->status = 'cook';
                break;

            case "cook":
                $this->order->status = 'pack';
                break;

            case "pack":
                $this->order->status = 'complete';
                break;
        }

        $this->order->save();
    }

    public function render()
    {
        return view('livewire.card-item');
    }
}
