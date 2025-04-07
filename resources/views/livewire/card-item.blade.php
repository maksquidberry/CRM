<div class="col-lg-4 col-md-6">
    <div class="w-100 stats__block h-100 d-flex flex-column justify-content-between position-relative py-3">
       {{-- <div class="w-100 d-flex flex-wrap">
            <span class="order__delivery order__type">Доставка</span>
            <span class="order__preorder order__type">Предзаказ</span>
        </div>--}}
        <div class="w-100 d-flex flex-column">
            <div class="w-100 mt-2 d-flex justify-content-between px-2">
                <span>Заказ №<b>{{substr($order->poster_id, -3)}}</b></span>
                <span>{{$order->start_order}}</span>
            </div>

            <div class="mt-2 d-flex flex-column px-2">
                <span>Состав:</span>
                <div class="w-100 stats__items">
                    <span>Шаурма Mini <b>3шт</b></span>
                    <span>Шаурма Standart <b>5шт</b></span>
                    <span>Шаурма Standart <b>5шт</b></span>
                </div>
            </div>
        </div>

        <div class="w-100 d-flex px-2 mt-4">
            @if(!$isActive)
                <button class="btn login__btns-submit" wire:click.prevent="takeOrder">
                    Взять в работу
                </button>

            @else
                <button class="btn login__btns-submit" wire:click.prevent="compleatOrder">
                    Завершить
                </button>
            @endif

        </div>
    </div>


</div>
