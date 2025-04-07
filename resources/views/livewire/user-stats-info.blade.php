<div class="w-100 d-flex flex-column mb-3">
    <div class="w-100 dashboard__module px-4">
        <div class="w-100 d-flex flex-column">
            <span class="dashboard__module-label">Поточний час:</span>
            <span id="time__clock" class="clock"><?=date('H:i:s')?></span>
        </div>
        <script>
            var span = document.getElementById('time__clock');

            function time() {
                var d = new Date();
                var s = d.getSeconds();
                var m = d.getMinutes();
                var h = d.getHours();
                span.textContent =
                    ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
            }

            setInterval(time, 1000);
        </script>
    </div>

    <div class="w-100 dashboard__module mt-3 px-4 py-2">
        <div class="w-100 dashboard__user">
            <div class="d-flex align-items-center justify-content-center">
                <img src="{{asset('assets/img/user.png')}}" class="dashboard__user-img" alt="">
            </div>
            <div class="w-100 d-flex align-items-center">
                <span class="dashboard__user-text">{{Auth::user()->name}}</span>
            </div>
        </div>
        <div class="w-100 mt-3 d-flex flex-column">
            <p class="dashboard__user-info">
                <span>Посада:</span>
                <b>
                    @switch(Auth::user()->role)
                        @case('superadmin')
                            Основатель
                        @break

                        @case('admin')
                            Администратор
                            @break

                        @case('cooker')
                            Повар
                            @break

                        @case('packer')
                            Упаковщик
                            @break
                    @endswitch
                </b>
            </p>
            {{--<p class="dashboard__user-info">
                <span>Виконано замолень:</span>
                <b>{{$completeOrders}}</b>
            </p>--}}
            <p class="dashboard__user-info">
                <span>Середній час виконання замовлення:</span>
                <b>{{$timeTotalOrders}}</b>
            </p>
        </div>
    </div>
</div>
