<div class="col-lg-4 col-md-6 col-sm-6 col-12 mt-2">
    <div class="w-100 h-100 px-3 py-2 @if($order->type === 'delivery') bg-warning @endif   dashboard__items-inner d-flex flex-column align-items-between justify-content-between">
        <div class="w-100 d-flex flex-column">
            @if($order->comment)
                <div class="w-100 d-flex bg-warning p-1 mt-1 mb-3" style="border-radius: 10px">
                    <div class="w-100 px-2">
                        {{$order->comment}}
                    </div>
                </div>
            @endif
            <span class="fw-bold dashboard__items-title">№{{substr($order->poster_id, -3)}} ({{$order->status}})</span>
            <div class="d-flex flex-column dashboard__items-params my-1">
                <div class="w-100 d-flex justify-content-between mt-2">
                    <span class="dashboard__params-label">Відправлено:</span>
                    <span class="dashboard__params-value">{{\Carbon\Carbon::parse($order->start_order)->format('d')}} {{\Carbon\Carbon::parse($order->start_order)->locale('ru')->format('F')}}  {{\Carbon\Carbon::parse($order->start_order)->addHours(3)->format('H:i')}}</span>
                </div>
                <div class="w-100 d-flex justify-content-between mt-2">
                    <span class="dashboard__params-label">Кількість позицій:</span>
                    <span class="dashboard__params-value">{{$order->total_amount}} шт</span>
                </div>
                @if($order->delivery_date)
                    <div class="w-100 d-flex justify-content-between mt-2">
                        <span class="dashboard__params-label">Дата доставки:</span>
                        <span class="dashboard__params-value">{{\Carbon\Carbon::parse($order->delivery_date)->format('d')}} {{\Carbon\Carbon::parse($order->delivery_date)->locale('ru')->format('F')}}  {{\Carbon\Carbon::parse($order->delivery_date)->format('H:i')}} шт</span>
                    </div>
                @endif
            </div>

            <div class="w-100 d-flex flex-column mt-3">
                <span class="fw-bold">Наіменування:</span>
                <div class="d-flex flex-column">
                    @foreach(\App\Models\OrdersItem::where('order_id', $order->id)->get() as $item)
                        <div class="product__item d-flex justify-content-between align-items-center">
                            <span class="product__item-name">{{$item->name}}</span>
                            <span class="product__item-value fw-bold">{{$item->amount}} шт</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-100 mt-2 d-flex">
            <button class="dashboard__btns-red w-100" wire:click.prevent="endOrderWork">
                @switch(auth()->user()->role)
                    @case('packer')
                        Видати
                        @break

                    @default
                        Завершити
                        @break
                @endswitch
            </button>
        </div>
    </div>
</div>
