<div class="w-100 text-white">
{{--    <div class="w-100 d-flex">--}}
{{--        <a href="{{route('users-create')}}" class="table__user-btn">Добавить пользователя</a>--}}
{{--    </div>--}}

    <table class="w-100 mt-3">
        <thead class="table__header-user">
            <td>№</td>
            <td>Фамилия</td>
            <td>Имя</td>
            <td>Отчество</td>
            <td>E-mail</td>
            <td>Роль</td>
            <td></td>
        </thead>

        <tbody class="table__body-user">
        @foreach($users as $user)
            <tr style="border-bottom: 1px solid white">
                <td>{{$user->id}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->second_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>
                    <a href="{{route('users-edit', ['id' => $user->id])}}" class="text-info"> Ред.</a>
                    <a href="javascript:void(0)" wire:click.prevent="deleteUser({{$user->id}})" class="text-danger ms-2"> Удал.</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
