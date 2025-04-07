<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrdersItem;
use App\Models\Restorans;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function index()
    {

    }

    public function getCommentOrderIncomming($order_id)
    {
        $token = env('TOKEN_POSTER');
        $url = "https://joinposter.com/api/incomingOrders.getIncomingOrder?token={$token}&incoming_order_id={$order_id}";

        $request = \Http::get($url);
        $requestJson = json_decode($request->body(), 1);

        if (key_exists('error', $requestJson)) return '';
        else return $requestJson['response']['comment'];
    }


    private function getCommentOrderTransaction($order_id)
    {
        $token = env('TOKEN_POSTER');
        $url = "https://joinposter.com/api/dash.getTransaction?token={$token}&transaction_id={$order_id}&include_history=true&include_products=true&include_delivery=true";

        $request = \Http::get($url);
        $requestJson = json_decode($request->body(), 1);



        if (count($requestJson['response']) < 1) return null;
        else return $requestJson['response'][0]['transaction_comment'];
    }


    private function getCommentOrderTransactionTest($order_id)
    {
        $token = env('TOKEN_POSTER');
        $url = "https://joinposter.com/api/dash.getTransaction?token={$token}&transaction_id={$order_id}&include_history=true&include_products=true&include_delivery=true";

        $request = \Http::get($url);
        $requestJson = json_decode($request->body(), 1);

        if (count($requestJson['response']) < 1) return null;
        else return $requestJson['response'][0]['transaction_comment'];
    }



    public function getOrderComment()
    {
        echo $this->getCommentOrderTransactionTest(267528);
    }

    public function getAllGoods($id,$order_id)
    {
        $countItmes = OrdersItem::where('order_id', $id)->delete();

        $result = [
            'total_price' => 0,
            'total_amount' => 0,
        ];

        $token = env('TOKEN_POSTER');
        $url = "https://joinposter.com/api/dash.getTransactionProducts?token={$token}&transaction_id={$order_id}";

        $request = \Http::get($url);
        $requestJson = json_decode($request->body());
        if(count($requestJson->response) > 0){
            foreach ($requestJson->response as $item){
                $orderItem = new OrdersItem();
                $orderItem->name=$item->product_name;
                $orderItem->amount=intval($item->num);
                $orderItem->price=floatval($item->product_sum);
                $orderItem->order_id = $id;
                $orderItem->save();

                $result['total_price'] += floatval($item->product_sum);
                $result['total_amount'] += intval($item->num);
            }
        }

        return $result;
    }

    public function checkBoard()
    {
        $orders = new Order();
        $three_minutes_ago = Carbon::now()->subMinutes(3)->toDateTimeString();

        $ordersItems = $orders->where('get_user', '=',0)->where('close_order', '<=', $three_minutes_ago)->get();
        if(count($ordersItems) > 0){
            foreach ($ordersItems as $item){
                $item->get_user = 1;
                $item->save();
            }
        }
    }

    function getUpdateFromIncommOrder($order_id){
        $token = env('TOKEN_POSTER');
        $url = "https://joinposter.com/api/incomingOrders.getIncomingOrder?token={$token}&incoming_order_id={$order_id}";
        $request = \Http::get($url);
        $requestJson = json_decode($request->body(), 1);
        if(count($requestJson) > 0){
            if (key_exists('response', $requestJson)){
                if (key_exists('transaction_id', $requestJson['response'])){
                    return $requestJson['response'];
                }
                else return  true;
            }
            else return  true;
        } else return  true;
    }


    public function updateOrderToUser(){

        $time = Carbon::now()->subMinutes(3)->format('Y-m-d H:i:s');
        $orders = Order::where('status', 'complete')->where('get_user', 0)->where('end_pack_order', '<', $time)->limit(50)->get();
        foreach ($orders as $o){
            $o->get_user = 1;
            $o->save();
        }

    }

    public function newOrder(Request $request)
    {
        $file = file_put_contents('/www/wwwroot/crm.pubble.systems/log.txt', print_r($request->all(), 1), FILE_APPEND);
        $isReady = 1;
        if($isReady === 1){
            switch ($request->action){
            case 'closed':
                $orderUpdate = Order::where('poster_id', $request->object_id)->first();
                if($orderUpdate){
                    $result = $this->getAllGoods($orderUpdate->id, $request->object_id);
                    if (!$orderUpdate->comment){
                        if ($request->object = 'incoming_order') $orderUpdate->comment = $this->getCommentOrderIncomming($request->object_id);
                        else $orderUpdate->comment = $this->getCommentOrderTransaction($request->object_id);
                    }

                    $orderUpdate->total_price = $result['total_price'];
                    $orderUpdate->total_amount = $result['total_amount'];

                    if ($orderUpdate->status === 'create'){
                        $orderUpdate->status = 'new';
                        $orderUpdate->start_order = Carbon::now();
                    }

                    $orderUpdate->save();
                }
                break;

            case 'removed':
                $orderUpdate = Order::where('poster_id', $request->object_id)->first();
                if ($orderUpdate) $orderUpdate->delete();
                break;

            case 'changed':
                if ($request->data){
                    $list_str = $request->data;
                    $list_arr = json_decode($list_str, 1);
                    if (key_exists('transactions_history',$list_arr)){
                        if (key_exists('type_history',$list_arr['transactions_history'])){
                            switch ($list_arr['transactions_history']['type_history']){
                                case 'sendtokitchen':
                                    $orderUpdate = Order::where('poster_id', $request->object_id)->first();
                                    if($orderUpdate){
                                        $orderUpdate->start_order = Carbon::now();
                                        $orderUpdate->save();

                                        $result = $this->getAllGoods($orderUpdate->id, $request->object_id);
                                        if (!$orderUpdate->comment){
                                            if ($request->object = 'incoming_order') $orderUpdate->comment = $this->getCommentOrderIncomming($request->object_id);
                                            else $orderUpdate->comment = $this->getCommentOrderTransaction($request->object_id);
                                        }

                                        $orderUpdate->total_price = $result['total_price'];
                                        $orderUpdate->total_amount = $result['total_amount'];

                                        if ($orderUpdate->status === 'create'){
                                            $orderUpdate->status = 'new';
                                            $orderUpdate->start_order = Carbon::now();
                                        }

                                        $orderUpdate->save();
                                    }
                                    break;

                                case 'comment':
                                    if (key_exists('value_text', $list_arr['transactions_history'])){
                                        $comment = $list_arr['transactions_history']['value_text'];

                                        $orderUpdate = Order::where('poster_id', $request->object_id)->first();
                                        if($orderUpdate){
                                            if (!$orderUpdate->comment){
                                                $orderUpdate->comment = $comment;
                                                $orderUpdate->save();
                                            }
                                        }
                                    }
                                    break;
                            }
                        }
                    }
                }
                break;

            case 'added':
                $order = new Order();
                $order->poster_id = $request->object_id;
                $order->code = rand(0, 100);
                if ($request->object = 'incoming_order') $order->comment = $this->getCommentOrderIncomming($request->object_id);
                else $order->comment = $this->getCommentOrderTransaction($request->object_id);
                $order->type = $request->incoming_order === 'delivery' ? : 'order';
                $order->status = 'create';
                $order->start_order = date('Y-m-d H:i:s', (intval($request->time) + (3600*3)));


                if ($request->data){
                    $str = $request->data;
                    $res = json_decode($str, 1);
                    if (array_key_exists('transactions_history', $res)){
                        if (array_key_exists('user_id', $res['transactions_history'])){
                            $restoran = \App\Models\RestoranGroup::where('xml_id', $res['transactions_history']['user_id'])->first();
                            if ($restoran){
                                $group = \App\Models\Restorans::find($restoran->group_item);
                                $order->restoran_id = $group->id;
                            }
                        }
                    }
                }

                $status = $order->save();

                $this->getAllGoods($order->id, $request->object_id);
                break;
        }
        }

    }
}
