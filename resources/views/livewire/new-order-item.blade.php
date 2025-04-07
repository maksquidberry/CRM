<div class="col-lg-4 col-md-6 col-sm-6 col-12 mt-2">
    <div class="w-100 px-3 py-2 @if($order->type === 'delivery') bg-warning @endif dashboard__items-inner d-flex flex-column">
        <span class="fw-bold dashboard__items-title">№{{substr($order->poster_id, -3)}}</span>
        <div class="d-flex flex-column dashboard__items-params my-1">
            <div class="w-100 d-flex justify-content-between mt-2">
                <span class="dashboard__params-label">Дата появи:</span>
                <span class="dashboard__params-value">{{\Carbon\Carbon::parse($order->start_order)->locale('ru')->format('d F H:i')}}</span>
            </div>
            @if($order->delivery_date)
                <div class="w-100 d-flex justify-content-between mt-2">
                    <span class="dashboard__params-label">Дата доставки:</span>
                    <span class="dashboard__params-value">{{\Carbon\Carbon::parse($order->delivery_date)->format('d')}} {{\Carbon\Carbon::parse($order->delivery_date)->locale('ru')->format('F')}}  {{\Carbon\Carbon::parse($order->delivery_date)->format('H:i')}} шт</span>
                </div>
            @endif

            @if($order->comment)
                <div class="w-100 d-flex bg-warning p-1 mt-1 mb-3" style="border-radius: 10px">
                    <div class="w-100 px-2">
                        {{$order->comment}}
                    </div>
                </div>
            @endif

            {{--<div class="w-100 d-flex justify-content-between mt-2">
                <span class="dashboard__params-label">Час появи:</span>
                <span class="dashboard__params-value">{{\Carbon\Carbon::parse($order->created_at)->format('H:i')}}</span>
            </div>--}}
            <div class="w-100 d-flex justify-content-between mt-2">
                <span class="dashboard__params-label">Кількість позицій:</span>
                <span class="dashboard__params-value">{{$order->total_amount}} шт</span>
            </div>
        </div>
        <div class="w-100 mt-1 d-flex">
            <button class="dashboard__btns-green w-100" wire:click.prevent="startOrderWork">В роботу</button>
        </div>
    </div>
</div>
