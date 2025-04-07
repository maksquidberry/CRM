<div class="w-100 mt-3 mt-md-0">
    <div class="w-100 dashboard__table-header d-flex justify-content-between align-items-center">
        <span class="fw-bold text-uppercase fs-4">Замолення до видачі</span>
        <span class="dashboard__table-counter">
            <span>До видачі:</span>
            <span>{{count($orderList)}} шт</span>
        </span>
    </div>

    <div class="w-100 mt-3" >
        <div class="row">
            @foreach($orderList as $order)
                <livewire:complete-order-item :key="time()" :id="$order->id" />
            @endforeach
        </div>
    </div>
</div>
