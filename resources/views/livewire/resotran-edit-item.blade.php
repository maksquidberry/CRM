<div class="w-100 d-flex flex-column">
    <form class="w-100">
        <div class="row">
            <div class="col-12">
                <h1>Заведения</h1>
            </div>

            @if($errors->any())
                <div class="col-12 mb-2">
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                </div>
            @endif

            <div class="col-lg-12 mb-2">
                <div class="w-100 d-flex flex-column">
                    <span>Названиe</span>
                    <input type="text" wire:model="restoran.name" class="w-100 d-flex user__input">
                </div>
            </div>
            <div class="col-lg-12 mb-2">
                <div class="w-100 d-flex flex-column">
                    <span>Описание</span>
                    <input type="text" wire:model="restoran.description" class="w-100 d-flex user__input">
                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="w-100">
                    <button class="dashboard__btns-red px-5" wire:click.prevent="saveUser">Сохранить</button>
                    <a href="{{route('users')}}" class="dashboard__btns-yellow px-5 ms-2">Назад</a>
                </div>
            </div>



        </div>
    </form>

    @if($isEditMode)
        <div class="col-12 mt-2">
            <h4>Новый пользователь:</h4>
        </div>

        <div class="col-12 mt-2">
            <livewire:user-restoran-form :id="$restoran->id"/>
        </div>

        <livewire:user-restoran-list :idGroup="$restoran->id"/>
    @endif

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
