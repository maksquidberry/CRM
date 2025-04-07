<div class="w-100 text-white">
    <table class="w-100 mt-3">
        <thead class="table__header-user">
        <td>№</td>
        <td>Название</td>
        <td>Описание</td>
        <td>Код</td>
        <td></td>
        </thead>

        <tbody class="table__body-user">
        @foreach($users as $user)
            <tr style="border-bottom: 1px solid white">
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->description}}</td>
                <td>{{$user->xml_id}}</td>
                <td>
                    <a href="{{route('restoran-edit', ['id' => $user->id])}}" class="text-info"> Ред.</a>
                    <a href="javascript:void(0)" wire:click.prevent="deleteUser({{$user->id}})" class="text-danger ms-2"> Удал.</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
