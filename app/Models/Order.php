<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [

    ];

    public function getAllOrders($role, $id, $withPagination = false, $paginate = 20)
    {
        $order = self::whereNotNull('created_at')->where('status', '!=', 'create');
        switch ($role){
            case 'cooker':
                $order = $order->where('cooking_id', $id)->whereNotNull('end_cook_order');
                break;

            case 'packer':
                $order = $order->where('packing_id', $id)->whereNotNull('end_pack_order');
                break;
        }
        if ($withPagination) {
            return  $order->paginate($paginate);
        } else {
            return $order->get();
        }
    }

    public function getActiveOrdersUserToday($role, $id, $paginate = 20)
    {
        $order = self::whereDate('created_at', Carbon::today())->where('status', '!=', 'create');
        switch ($role){
            case 'cooker':
                $order = $order->where('cooking_id', $id)->whereNull('end_cook_order');
                break;

            case 'packer':
                $order = $order->whereNull('end_pack_order')->where('status', 'packing');
                break;

            default:
                $order = $order->whereNull('end_cook_order')->orWhereNull('end_pack_order');
                break;
        }

        return $order->where('restoran_id', \Auth::user()->restoran_id)->orderBy('created_at', 'desc')->get();
    }

    public function getAllTodayOrdersWork($role, $id)
    {
        $order = self::whereDate('created_at', Carbon::today())->where('get_user', 0)->where('status', '!=', 'create');
        switch ($role){
            case 'cooker':
                $order = $order->where('cooking_id', $id);
                break;

            case 'packer':
                $order = $order->where('packing_id', $id);
                break;
        }
        return $order->orderBy('created_at', 'desc')->get();
    }

    public function getAllTodayOrders($role, $id)
    {
        $order = self::whereDate('created_at', Carbon::today())->where('status', '!=', 'create');
        switch ($role){
            case 'cooker':
                $order = $order->where('cooking_id', $id);
                break;

            case 'packer':
                $order = $order->where('packing_id', $id);
                break;
        }
        return $order->get();
    }


    public function getOrdersUserCompleateToday($role, $id)
    {
        $order = self::whereDate('created_at', Carbon::today())->where('status', '!=', 'create');
        switch ($role){
            case 'cooker':
                $order = $order->where('cooking_id', $id);
                break;

            case 'packer':
                $order = $order->where('packing_id', $id);
                break;
        }
        $order = $order->where('status', 'complete');

        return $order->get();
    }
    public function getCompleateToday($role, $id)
    {
//        $order = self::whereDate('created_at', Carbon::today());
        $order = self::where('status', 'complete')->where('get_user', 0);
        return $order->get();
    }


    public function getNewOrders($role, $id)
    {
        $order = self::whereDate('created_at', Carbon::today())->whereNotNull('total_amount');
        switch ($role){
            case 'cooker':
                $order = $order->where('status', 'create')->orWhere('status', 'new')->whereNull('cooking_id');
                break;

            case 'packer':
                $order = $order->where('status', 'packing')->whereNotNull('end_cook_order')->whereNull('packing_id');
                break;

            default:
                $order = $order->whereNull('start_cook_order')->whereNull('start_pack_order');
                break;
        }

        return $order;
    }

    public function getOrdersTimeTotalToday($role, $id)
    {
        $order = self::whereDate('created_at', Carbon::today())->where('status', '!=', 'create');
        switch ($role){
            case 'cooker':
                $order = $order->select('cook_seconds');
                $order = $order->where('cooking_id', $id);
                $order = $order->sum('cook_seconds');
                break;

            case 'packer':
                $order = $order->select('pack_seconds');
                $order = $order->where('packing_id', $id);
                $order = $order->sum('pack_seconds');
                break;
        }

        return $order;
    }

    public function getOrdersTimeTotal($role, $id)
    {
        $order = new self();
        switch ($role){
            case 'cooker':
                $order = $order->select('cook_seconds');
                $order = $order->where('cooking_id', $id);
                $order = $order->sum('cook_seconds');
                break;

            case 'packer':
                $order = $order->select('pack_seconds');
                $order = $order->where('packing_id', $id);
                $order = $order->sum('pack_seconds');
                break;
        }

        return $order;
    }

    public function getTotalTimeCook()
    {
        return self::select('cook_seconds')->whereNotNull('cook_seconds')->sum('cook_seconds');
    }

    public function getTotalTimePack()
    {
        return self::select('pack_seconds')->whereNotNull('pack_seconds')->sum('pack_seconds');
    }

    public function getAllOrdersTotal($withPagination = false, $paginate = 50)
    {
        if($withPagination){
            return self::where('status', '!=', 'create')->paginate($paginate);
        }
        else return self::where('status', '!=', 'create')->get();
    }

    public function getTotalTimeCookToday()
    {
        return self::select('cook_seconds')->whereDate('created_at', Carbon::today())->whereNotNull('cook_seconds')->sum('cook_seconds');
    }

    public function getTotalTimePackToday()
    {
        return self::select('pack_seconds')->whereDate('created_at', Carbon::today())->whereNotNull('pack_seconds')->sum('pack_seconds');
    }

    public function getAllOrdersTotalToday()
    {
        return self::where('status', '!=', 'create')->whereDate('created_at', Carbon::today())->get();
    }

    public function getOrderItems()
    {
        return OrdersItem::where('order_id', $this->id)->get();
    }
}
