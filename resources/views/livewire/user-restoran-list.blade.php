<div class="col-12 mt-5" wire:poll.keep-alive>
    <div class="w-100">
        <div class="row">
            <div class="col-12 mt-4">
                <h4>Пользователи в группе:</h4>
            </div>

            @if(count($groupItems) > 0)
                @foreach($groupItems as $itm)
                    <div class="col-12 mt-3">
                        <livewire:user-restoran-edit-item wire:key="{{$itm->id}}" :id="$itm->id"/>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
