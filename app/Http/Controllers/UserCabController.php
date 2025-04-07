<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RestoranGroup;
use App\Models\Restorans;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class UserCabController extends Controller
{
    public function index()
    {
        $orders = new Order();
        $ordersItemsAllToday = count($orders->getAllTodayOrders(\Auth::user()->role, \Auth::user()->id));
        $orderItemsActiveTodayCount = count($orders->getActiveOrdersUserToday(\Auth::user()->role, \Auth::user()->id));
        $completeOrders = count($orders->getOrdersUserCompleateToday(\Auth::user()->role, \Auth::user()->id));

        if (\Auth::user()->role === 'cooker'  or \Auth::user()->role === 'packer') $totalSec  =intval($orders->getOrdersTimeTotalToday(\Auth::user()->role, \Auth::user()->id));
        else $totalSec = 0;

        $ordersTime = $totalSec > 0 ? intval($totalSec / $ordersItemsAllToday) : 0;
        $timeTotalOrders = CarbonInterval::seconds($ordersTime)->cascade()->forHumans(null, true);


        $order = $orders->whereNotNull('created_at')->where('status', '!=', 'create');
        switch (auth()->user()->role){
            case 'cooker':
                $order = $order->where('cooking_id', auth()->user()->id)->whereNotNull('end_cook_order');
                break;

            case 'packer':
                $order = $order->where('packing_id', auth()->user()->id)->whereNotNull('end_pack_order');
                break;
        }

        if (auth()->user()->restoran_id){
            $order = $order->where('restoran_id', auth()->user()->restoran_id);
        }

        $allOrders = $order->orderBy('created_at', 'desc');
        $allOrdersCount = $allOrders->count();
        $allOrders = $allOrders->paginate(25);

        return view('components.user.dashboard', compact('allOrders', 'completeOrders', 'timeTotalOrders', 'allOrdersCount'));
    }

    public function orders()
    {
        return view('components.user.orders');
    }

    public function settings()
    {
        return view('components.user.settings');
    }

    public function usersList()
    {
        $users = User::where('role', 'superadmin')->paginate(20);
        $restoran = RestoranGroup::get();
        return view('components.userlist', compact('users', 'restoran'));
    }

    public function userItem($id)
    {
        return view('components.userEdit', compact('id'));
    }

    public function userItemCreate()
    {
        $id = null;
        return view('components.userEdit', compact('id'));
    }

    public function restoranItem($id)
    {
        return view('components.retoranEdit', compact('id'));
    }

    public function restoranItemCreate()
    {
        $id = null;
        return view('components.retoranEdit', compact('id'));
    }

    public function statsList()
    {
        $orders = new Order();

        if (\Auth::user()->role === 'admin' or \Auth::user()->role === 'superadmin'){
//            all
            $ordersItemsAll = $orders->getAllOrdersTotal(true, 50);
            $ordersItemsAllCount = count($ordersItemsAll) > 0 ? count($ordersItemsAll) : 1;
            $totalCookSeconds = $orders->getTotalTimeCook() > 0 ? $orders->getTotalTimeCook() : 1;
            $totalPackSeconds = $orders->getTotalTimePack() > 0 ? $orders->getTotalTimePack() : 1;

            $totalCook = CarbonInterval::seconds(intval(($totalCookSeconds/$ordersItemsAllCount)))->cascade()->forHumans(null, true);
            $totalPack = CarbonInterval::seconds(intval(($totalPackSeconds/$ordersItemsAllCount)))->cascade()->forHumans(null, true);

//            today
            $ordersItemsAllToday = $orders->getAllOrdersTotalToday();
            $ordersItemsAllTodayCount = count($ordersItemsAllToday) > 0 ? count($ordersItemsAllToday) : 1;

            $totalCookSecondsToday = $orders->getTotalTimeCookToday() > 0 ? $orders->getTotalTimeCookToday() : 1;
            $totalPackSecondsToday = $orders->getTotalTimePackToday() > 0 ? $orders->getTotalTimePackToday() : 1;

            $totalCookToday = CarbonInterval::seconds(intval(($totalCookSecondsToday/$ordersItemsAllTodayCount)))->cascade()->forHumans(null, true);
            $totalPackToday = CarbonInterval::seconds(intval(($totalPackSecondsToday/$ordersItemsAllTodayCount)))->cascade()->forHumans(null, true);

            return view('components.user.stats-admin', compact('ordersItemsAll', 'totalCook', 'totalPack', 'ordersItemsAllToday', 'totalCookToday', 'totalPackToday'));
        }
        else{

            $ordersItemsAllToday = $orders->getAllTodayOrders(\Auth::user()->role, \Auth::user()->id);
            $ordersItemsAll = $orders->getAllOrders(\Auth::user()->role, \Auth::user()->id);
            $ordersItemsAllTodayCount = count($ordersItemsAllToday);
            $orderItemsActiveTodayCount = count($orders->getActiveOrdersUserToday(\Auth::user()->role, \Auth::user()->id));
            $completeOrders = count($orders->getOrdersUserCompleateToday(\Auth::user()->role, \Auth::user()->id));

            $totalSec  =intval($orders->getOrdersTimeTotalToday(\Auth::user()->role, \Auth::user()->id));
            $ordersTime = $totalSec > 0 ? intval($totalSec / $ordersItemsAllTodayCount) : 0;
            $timeTotalOrdersToday = CarbonInterval::seconds($ordersTime)->cascade()->forHumans(null, true);

            $OrdersTimeTotalSec = intval($orders->getOrdersTimeTotal(\Auth::user()->role, \Auth::user()->id));
            $ordersTimeAll = $totalSec > 0 ? intval($OrdersTimeTotalSec / count($ordersItemsAll)) : 0;
            $timeTotalOrdersToday = CarbonInterval::seconds($ordersTimeAll)->cascade()->forHumans(null, true);


            return view('components.user.stats', compact('ordersItemsAll', 'timeTotalOrdersToday', 'ordersItemsAllTodayCount', 'timeTotalOrdersToday'));
        }
    }

}

