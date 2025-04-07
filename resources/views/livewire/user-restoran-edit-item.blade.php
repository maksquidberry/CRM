<div class="col-12">
    <div class="w-100">
        <table class="w-100 table table-border text-white">
            <tr>
                <td class="w-25">{{$item->name}}</td>
                <td class="w-25">{{$item->description}}</td>
                <td class="w-25">{{$item->xml_id}}</td>
                <td class="w-25 text-end"><a href="" wire:click.prevent="delete" class="text-warning">Удалить</a></td>
            </tr>
        </table>
    </div>
</div>
