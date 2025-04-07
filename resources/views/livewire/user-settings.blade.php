<div class="w-100">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="w-100 d-flex">
                <h3 class="settings__title">ОСОБИСТІ ДАНІ:</h3>
            </div>
            <form action="" wire:submit.prevent="updateUserInfo" class="w-100">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="w-100 d-flex flex-column">
                            <span class="settings__label">Фамилия</span>
                            <input type="text" class="settings__input" wire:model="user.second_name">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="w-100 d-flex flex-column">
                            <span class="settings__label">Имя</span>
                            <input type="text" class="settings__input" wire:model="user.first_name">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="w-100 d-flex flex-column">
                            <span class="settings__label">Отчество</span>
                            <input type="text" class="settings__input" wire:model="user.last_name">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="w-100 d-flex flex-column">
                            <span class="settings__label">EMAIL</span>
                            <input type="text" class="settings__input" wire:model="user.email">
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
        window.addEventListener('updatedUser', ()=>{
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
    </script>
</div>
