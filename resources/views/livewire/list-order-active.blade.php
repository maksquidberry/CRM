<div class="col-12 mb-2">
    <div class="w-100 mt-3 dashboard__bg px-3 py-4">
        <div class="w-100">
            <div class="row">
                <div class="col-12">
                    <div class="w-100 d-flex">
                        <h6 class="fw-bold">Активні замовлення:</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($orderList as $order)
                    <livewire:card-item index="{{$order->id}}" :is-active="true" />
                @endforeach
            </div>
        </div>
    </div>

    <script>
        setInterval(()=>{
            @this.render;
        }, 1000)
    </script>
</div>
