<div class="w-100 login d-flex align-items-center justify-content-center">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center justify-content-center">
            <div class="col-lg-5 col-xl-4 col-md-5 col-md-8 col-12">
                <div class="w-100 login__inner">
                    <div class="w-100 d-flex justify-content-center">
                        <a href="" class="login__logo">
                            <img src="{{asset('assets/img/logo.png')}}" alt="">
                        </a>
                    </div>

                    <div class="w-100 d-flex justify-content-center mt-3">
                        <h5 class="fw-bold text-white text-uppercase login__title">Авторизация</h5>
                    </div>

                    <form action="" wire:submit.prevent="checkUser" id="login" class="w-100 mt-3 d-flex flex-column">
                        <div class="w-100 d-flex flex-column">
                            <span class="fs-6 text-white login__label">e-mail</span>
                            <input type="email" name="login" wire:model="name" class="login__input">
                        </div>
                        <div class="w-100 mt-2 d-flex flex-column">
                            <span class="fs-6 text-white login__label">Пароль</span>
                            <input type="password" name="password" wire:model="password" class="login__input">
                        </div>

                        <div class="w-100 d-flex">
                            @if($errors->any())
                                <span class="text-danger">{{$message}}</span>
                            @endif
                        </div>

                        <div class="w-100 login__btns mt-4">
                            <div class="d-flex justify-content-center"><button type="submit" class="login__btns-submit login__btns-item">Войти</button></div>
{{--                            <button type="reset" class="login__btns-reset login__btns-item w-100">Очистить</button>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
