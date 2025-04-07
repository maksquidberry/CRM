<div class="w-100 d-flex flex-column">
        <form class="w-100">
            <div class="row">
                <div class="col-12">
                    <h1>Пользователи</h1>
                </div>


                    @if($errors->any())
                        <div class="col-12 mb-2">
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        </div>
                    @endif


                <div class="col-lg-6 mb-2">
                    <div class="w-100 d-flex flex-column">
                        <span>E-mail</span>
                        <input type="text" wire:model="user.email" class="w-100 d-flex user__input">
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="w-100 d-flex flex-column">
                        <span>Должность</span>
                        <select name="role" wire:model="user.role" class="user__input bg-white text-black" id="">
                            <option value="admin">Администратор</option>
                            <option value="cooker">Повар</option>
                            <option value="packer">Упаковщик</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="w-100 d-flex flex-column">
                        <span>Ресторан</span>
                        <select name="role" wire:model="user.restoran_id" class="user__input bg-white text-black" id="">
                            <option value="">Не выбрано</option>
                            @foreach(\App\Models\Restorans::get() as $itm)
                                <option value="{{$itm->id}}">{{$itm->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="w-100 d-flex flex-column">
                        <span>Ім`я</span>
                        <input type="text" wire:model="user.first_name" class="w-100 d-flex user__input">
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="w-100 d-flex flex-column">
                        <span>Прізвище</span>
                        <input type="text" wire:model="user.second_name" class="w-100 d-flex user__input">
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="w-100 d-flex flex-column">
                        <span>По-батькові</span>
                        <input type="text" wire:model="user.last_name" class="w-100 d-flex user__input">
                    </div>
                </div>

                @if(!$isEditMode)
                    <div class="col-lg-6 mb-2">
                        <div class="w-100 d-flex flex-column">
                            <span>Пароль</span>
                            <input type="password" wire:model="user.password" class="w-100 d-flex user__input">
                        </div>
                    </div>
                @endif

                <div class="col-12 mt-3">
                    <div class="w-100">
                        <button class="dashboard__btns-red px-5" wire:click.prevent="saveUser">Сохранить</button>
                        <a href="{{route('users')}}" class="dashboard__btns-yellow px-5 ms-2">Назад</a>
                    </div>
                </div>
            </div>
        </form>

        <div class="w-100">
            <div class="row">
                @if($isEditMode)
                    <livewire:update-pass :id="$user->id"/>
                @endif
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('saveUser', (e) => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })

            Toast.fire({
                icon: 'success',
                title: 'Сохранено'
            })
        })
    </script>
</div>
