<div class="col-12 mb-3">
    <div class="w-100">
        <form wire:submit.prevent="save" class="row d-flex">
            <div class="col-12 col-md-4 mb-2">
                <div class="w-100 d-flex flex-column">
                    <span>Название</span>
                    <input type="text" wire:model="item.name" class="w-100 d-flex user__input">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="w-100 d-flex flex-column">
                    <span>Описание</span>
                    <input type="text" wire:model="item.description" class="w-100 d-flex user__input">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-2">
                <div class="w-100 d-flex flex-column">
                    <span>Код</span>
                    <input type="text" wire:model="item.xml_id" class="w-100 d-flex user__input">
                </div>
            </div>
            <div class="col-lg-12 mt-2">
                <button wire:click.prevent='save' class="btn w-100 login__btns-submit">Сохранить</button>
            </div>
        </form>
    </div>
</div>
