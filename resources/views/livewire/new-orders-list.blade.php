<div class="w-100 mt-4">
    <div class="w-100 dashboard__table">
        <div class="w-100 dashboard__table-header d-flex justify-content-between align-items-center">
            <span class="fw-bold text-uppercase">Замолення в черзі</span>
            <div class="dashboard__table-counter">
                <span>Очікує:</span>
                <span>{{count($orderList)}}</span>
            </div>
        </div>
        <div class="dashboard__table-items px-3 py-2">
            @foreach($orderList as $order)
                <div class="dashboard__table-item d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Замовлення №{{substr($order->poster_id, -3)}}</span>
                    <span class="fw-bold">{{\Carbon\Carbon::parse($order->created_at)->format('H:i')}}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
