<div class="w-100 mt-4">
    <div class="w-100 dashboard__table">
        <div class="w-100 dashboard__table-header d-flex justify-content-between align-items-center">
            <span class="fw-bold text-uppercase">Мої замовлення в роботі</span>
            <div class="dashboard__table-counter">
                <span>В роботі:</span>
                <span>{{count($orderList)}}</span>
            </div>
        </div>
        <div class="dashboard__table-items px-3 py-2">
            @foreach($orderList as $order)
                <div class="dashboard__table-item d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Замовлення №{{substr($order->poster_id, -3)}}</span>
                    <div>
                        <span class="fw-bold">{{\Carbon\Carbon::parse($order->created_at)->format('H:i')}}</span>

                        @php
                            $timeOrder = \Carbon\Carbon::parse($order?->start_cook_order);
                            $now = \Carbon\Carbon::now();

                            $time = $now->diff($timeOrder);
                        @endphp
                        <span class="@if($time->i > 15) text-danger @endif @if($time->h > 0) text-danger @endif">({{$time->h}}г {{$time->i}}хв {{$time->s}}с)</span>
                    </div>
                    <span class="text-uppercase fw-bold">
                        @switch($order->status)
                            @case('cooking')
                                Готується
                                @break
                            @case('packing')
                                Пакується
                                @break
                            @case('complete')
                                Готовий
                                @break
                            @case('new')
                                Новий
                                @break
                        @endswitch
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
