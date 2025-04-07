<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Livewire\Component;

class UserStatsInfo extends Component
{
    public function render()
    {
        $orders = new Order();
        $ordersItemsAllToday = count($orders->getAllTodayOrders(\Auth::user()->role, \Auth::user()->id));
        $orderItemsActiveTodayCount = count($orders->getActiveOrdersUserToday(\Auth::user()->role, \Auth::user()->id));
        $completeOrders = count($orders->getOrdersUserCompleateToday(\Auth::user()->role, \Auth::user()->id));
        if (\Auth::user()->role === 'cooker'  or \Auth::user()->role === 'packer') $totalSec  =intval($orders->getOrdersTimeTotalToday(\Auth::user()->role, \Auth::user()->id));
        else $totalSec = 0;
        $ordersTime = $totalSec > 0 ? intval($totalSec / $ordersItemsAllToday) : 0;
        $timeTotalOrders = CarbonInterval::seconds($ordersTime)->cascade()->forHumans(null, true);
        return view('livewire.user-stats-info', compact('completeOrders', 'timeTotalOrders'));
    }
}
