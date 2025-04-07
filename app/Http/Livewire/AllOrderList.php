<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\RestoranGroup;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AllOrderList extends Component
{
    use WithPagination;
    public $allOrders;

    public $restoran;
    public $date;
    public $shop_id;

    protected $rules = [
        'restoran' => 'integer|nullable',
        'date' => 'string|nullable',
    ];

    public function filterItems()
    {
        $this->validate();
        $orders = Order::orderBy('created_at', 'desc');
        if ($this->restoran > 0){
            $orders = $orders->where('restoran_id', $this->restoran);
        }
        if ($this->date){
            $orders = $orders->where('created_at', '>', ''.$this->date.' 00:00:00')->where('created_at', '<', ''.$this->date.' 23:59:59');
        }
        $this->allOrders = $orders->get();
    }

    public function mount()
    {
        if (\Auth::user()->id === 1 or \Auth::user()->id === 4) {
            $this->allOrders = Order::orderBy('created_at', 'desc')->limit(200)->get();
        }
        else {
            if (\Auth::user()->restoran_id) $this->allOrders = Order::where('restoran_id', \Auth::user()->restoran_id)->orderBy('created_at', 'desc')->limit(200)->get();
            else $this->allOrders = Order::orderBy('created_at', 'desc')->limit(200)->get();
        }
    }

    public function render()
    {
        return view('livewire.all-order-list');
    }
}
