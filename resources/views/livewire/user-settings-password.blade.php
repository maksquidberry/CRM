<div class="w-100 mt-3">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="w-100 d-flex">
                <h3 class="settings__title">ПАРОЛЬ:</h3>
            </div>
            <form action="" wire:submit.prevent="updateUserInfo" class="w-100">
                <div class="row">


                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="w-100 d-flex flex-column">
                            <span class="settings__label">Новий пароль</span>
                            <input type="password" required minlength="8" class="settings__input" wire:model="password_new">
                            <span class="settings__info">мінімум 8 сиволів</span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="w-100 d-flex flex-column">
                            <span class="settings__label">Повторіть пароль</span>
                            <input type="password" required minlength="8" class="settings__input" wire:model="password_confirmd">
                            <span class="settings__info">мінімум 8 сиволів</span>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="w-100 d-flex justify-content-end">
                            <button class="dashboard__btns-yellow px-4" type="submit">Зберегти</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('updatedUserPassword', ()=>{
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            })

            Toast.fire({
                icon: 'success',
                title: 'Дані успішно змінено!'
            })
        })

        window.addEventListener('errorUserPassword', ()=>{
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            })

            Toast.fire({
                icon: 'error',
                title: 'Дані не змінено! Поролі не збігаються!'
            })
        })
    </script>
</div>
