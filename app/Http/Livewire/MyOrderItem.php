<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class MyOrderItem extends Component
{
    public $order;

    public function mount(int $id)
    {
        $this->order = Order::find($id);
    }

    function endOrderWork()
    {
        switch (\Auth::user()->role){
            case 'cooker':
                $cooking_time_start =  Carbon::parse($this->order->start_cook_order);
                $cooking_time_end = Carbon::now();
                $cooking_seconds = $cooking_time_end->diffInSeconds($cooking_time_start);
                $this->order->end_cook_order = Carbon::now();
                $this->order->status = 'packing';
                $this->order->cook_seconds = $cooking_seconds;
                $this->order->start_pack_order = Carbon::now();
                $this->order->save();
                break;

            case 'packer':
                $start_pack_time = Carbon::parse($this->order->start_pack_order);
                $start_order = Carbon::parse($this->order->start_order);
                $end_pack_time = Carbon::now();
                $packing_second = $end_pack_time->diffInSeconds($start_pack_time);

//                TODO: Сделать что если время старта больше 20 минут то считать не общее время, а время упоковщика + повара
                $end_order_sec = $end_pack_time->diffInSeconds($start_order);

                $this->order->end_pack_order = Carbon::now();
                $this->order->status = 'complete';

                $this->order->packing_id = \Auth::user()->id;
                $this->order->pack_seconds = $packing_second;
                $this->order->close_order = Carbon::now();

                $this->order->status = 'complete';
                $this->order->close_sec = $end_order_sec;

                $this->order->save();
                break;

            default:
                switch ($this->order->status){
                    case "cooking":
                        $cooking_time_start =  Carbon::parse($this->order->start_cook_order);
                        $cooking_time_end = Carbon::now();
                        $cooking_seconds = $cooking_time_end->diffInSeconds($cooking_time_start);

                        $this->order->end_cook_order = Carbon::now();
                        $this->order->status = 'packing';
                        $this->order->cook_seconds = $cooking_seconds;
                        $this->order->save();
                        break;

                    case 'packing':
                        $cooking_time_start =  Carbon::parse($this->order->start_pack_order);
                        $cooking_time_end = Carbon::now();
                        $cooking_seconds = $cooking_time_end->diffInSeconds($cooking_time_start);

                        $this->order->end_pack_order = Carbon::now();
                        $this->order->status = 'complete';
                        $this->order->pack_seconds = $cooking_seconds;
                        $this->order->save();
                        break;
                }

                break;
        }

        $this->emitTo(MyOrdersTabs::class, 'updateItems');
    }
    public function render()
    {
        return view('livewire.my-order-item');
    }
}
