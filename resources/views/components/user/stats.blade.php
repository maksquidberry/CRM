@extends('components.auth-app')

@section('content')
    <div class="w-100 d-flex flex-column mt-3 mt-md-0">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="w-100 dashboard__module px-3">
                    <div class="w-100 d-flex flex-column">
                        <h5 class="stats__title m-0 p-0">Статистика замовлень (Сьогодні):</h5>
                        <div class="w-100 d-flex flex-column mt-2">
                            <div class="stats__item d-flex flex-column mt-2">
                                <span class="stats__label">Всього виконано:</span>
                                <span class="stats__value">{{$ordersItemsAllTodayCount}} шт.</span>
                            </div>
                            <div class="stats__item d-flex flex-column mt-2">
                                <span class="stats__label">Середній час виконання:</span>
                                <span class="stats__value">{{$timeTotalOrdersToday}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="w-100 dashboard__module px-3">
                    <div class="w-100 d-flex flex-column">
                        <h5 class="stats__title m-0 p-0">Статистика замовлень (Всього):</h5>
                        <div class="w-100 d-flex flex-column mt-2">
                            <div class="stats__item d-flex flex-column mt-2">
                                <span class="stats__label">Всього виконано:</span>
                                <span class="stats__value">{{count($ordersItemsAll)}} шт.</span>
                            </div>
                            <div class="stats__item d-flex flex-column mt-2">
                                <span class="stats__label">Середній час виконання:</span>
                                <span class="stats__value">{{$timeTotalOrdersToday}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="w-100 stats__table">
                    <table class="w-100 ">
                        <thead class="stats__table-header">
                            <td style="width: 10%;">#</td>
                            <td style="width: 50%;">Заказ</td>
                            <td style="width: 10%;">Статус</td>
                            <td style="width: 10%;">Виданий</td>
                            <td style="width: 10%;">Позиций</td>
                            <td style="width: 10%;">Время</td>
                        </thead>

                        <tbody class="stats__table-body">
                            @foreach($ordersItemsAll as $order)
                                <tr class="stats__table-item">
                                    <td class="text-center fw-bold">{{$order->id}}</td>
                                    <td>Замовлення №{{substr($order->poster_id, -3)}}</td>
                                    <td class="text-center fw-bold">
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
                                    </td>
                                    <td class="text-center fw-bold">
                                        @if($order->get_user)
                                            Так
                                        @else
                                            Ні
                                        @endif
                                    </td>
                                    <td class="text-center fw-bold">{{$order->total_amount}}</td>
                                    <td class="text-center fw-bold">
                                        @switch(Auth::user()->role)
                                            @case('cooker')
                                                {{\Carbon\CarbonInterval::seconds($order->cook_seconds)->cascade()->forHumans(null, true)}}
                                                @break
                                            @case('packer')
                                                {{\Carbon\CarbonInterval::seconds($order->pack_seconds)->cascade()->forHumans(null, true)}}
                                                @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
