<div class="col-12 mt-5">
    <div class="w-100">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <div class="w-100 d-flex flex-column">
                    <span>Пароль</span>
                    <input type="password" wire:model="password" class="w-100 d-flex user__input">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="w-100">
                    <button class="dashboard__btns-red w-100" wire:click.prevent="updatepass">Сохранить</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('checngePass', (e) => {
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
