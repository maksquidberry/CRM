<div class="w-100 d-flex flex-column" wire:poll.keep-alive>
    @if(Auth::user()->id === 1 or Auth::user()->id === 4)
        <div class="w-100 d-flex my-3">
            <form action="" wire:submit.prevent="filterItems" class="w-100 d-flex">
                <select name="" wire:model="restoran" class="w-25 px-2 text-black" style="border-radius: 20px" id="">
                    <option value="" selected >Всi заклади</option>
                    @foreach(\App\Models\Restorans::get() as $rest)
                        <option value="{{$rest->id}}">{{$rest->name}}</option>
                    @endforeach
                </select>
                <input type="date" wire:model="date" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="ms-2 w-25 h-100 px-2" style="border-radius: 20px">
                <div class="col-lg-2 ms-3">
                    <button type="submit" class="table__user-btn">Применить</button>
                </div>
            </form>
        </div>
    @endif
    <div class="w-100">
        @foreach($allOrders as $order)
            <div class="w-100 order__item mt-2">
                <div class="w-100">
                    <a class="w-100 orders__link" data-bs-toggle="collapse" href="#collapseExample__{{$order->id}}" role="button" aria-expanded="false" aria-controls="collapseExample__{{$order->id}}">
                        <span class="w-100 orders__table">
                            <span>{{$order->id}}</span>
                            <span>Замовлення №{{substr($order->poster_id, -3)}}</span>
                            <span>
                                @switch($order->status)
                                    @case('new')
                                        Новий
                                        @break
                                    @case('cooking')
                                        Готується
                                        @break
                                    @case('packing')
                                        Пакується
                                        @break
                                    @case('complete')
                                        Готовий
                                        @break
                                @endswitch
                            </span>
                            <span>
                                @if($order->get_user)
                                    Так
                                @else
                                    Ні
                                @endif
                            </span>
                            <span>{{$order->total_amount}}</span>
                            <span>{{$order->total_price / 100}} грн.</span>
                            <span @class([
        'light-green' => ( $order->close_sec  <= 390 ),
        'text-success' => ( $order->close_sec  > 390 and $order->close_sec  <= 450),
        'text-warning' => ( $order->close_sec  > 450 and $order->close_sec  <= 510),
        'orange' => ( $order->close_sec  > 510 and $order->close_sec  <= 570),
        'text-danger' => ( $order->close_sec  > 570),
])>
                               {{\Carbon\CarbonInterval::seconds($order->close_sec)->cascade()->locale('uk')->forHumans(null, true)}}
                            </span>

                            @if(\Carbon\Carbon::parse($order->start_order)->addHours(3)->timestamp < \Carbon\Carbon::now()->timestamp)
                                <span >{{\Carbon\Carbon::parse($order->start_order)->addHours(3)->locale('ru')->format('d F H:i')}}</span>
                            @else
                                <span >{{\Carbon\Carbon::parse($order->start_order)->addHours(3)->locale('ru')->format('d F H:i')}}</span>
                            @endif

{{--                            <span >{{\Carbon\Carbon::parse($order->start_order)->addHours(3)->locale('uk')->format('')->diffForHumans(null, true)}}</span>--}}
                        </span>
                    </a>
                </div>
                <div class="collapse" id="collapseExample__{{$order->id}}">
                    <div class="w-100 d-flex flex-column orders__items">
                        <ul class="w-100 my-2">
                            @foreach($order->getOrderItems() as $elem)
                                <li class="w-100">
                                    <div class="w-100 d-flex justify-content-between align-items-center orders__items-inner py-1" style="border-bottom: 1px white dashed ;">
                                        <span>{{$elem->name}}</span>
                                        <span>{{$elem->amount}}шт.</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
