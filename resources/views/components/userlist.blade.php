@extends('components.auth-app')

@section('content')
    <div class="w-100 text-white pb-3 d-flex flex-column">
        <div class="w-100 d-flex mb-1">
            <a href="{{route('users-create')}}" style="text-decoration:none;" class="dashboard__btns-yellow px-3">Добавить пользователя</a>
        </div>
        <livewire:user-list-table/>
    </div>
    <div class="w-100 text-white pb-3 d-flex flex-column">
        <div class="w-100 d-flex mb-1">
            <a href="{{route('restoran-create')}}" style="text-decoration:none;" class="dashboard__btns-yellow px-3">Добавить заведение</a>
        </div>
        <livewire:restoran-list-table/>
    </div>
@endsection
