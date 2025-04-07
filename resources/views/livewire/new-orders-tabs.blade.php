<div class="w-100 mt-3" wire:poll.keep-alive>
    <div class="w-100 dashboard__table-header d-flex justify-content-between align-items-center">
        <span class="fw-bold text-uppercase fs-4">НОВІ ЗАМОВЛЕННЯ</span>
        <span class="dashboard__table-counter">
            <span>В черзі:</span>
            <span>{{count($orderList)}} шт</span>
        </span>
    </div>

    <div class="w-100 mt-3" >
        <div class="row">
            @foreach($orderList as $order)
                <livewire:new-order-item :key="time()" :id="$order->id" />
            @endforeach
        </div>
    </div>
</div>
