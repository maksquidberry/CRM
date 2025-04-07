<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrdersBlock extends Component
{
    protected $listeners = ['refreshBlock'=> 'render'];

    public function render()
    {
        return view('livewire.orders-block');
    }
}
