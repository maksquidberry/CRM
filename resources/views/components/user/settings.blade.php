@extends('components.auth-app')

@section('content')
    <div class="w-100 d-flex flex-column">
        <livewire:user-settings/>
        <livewire:user-settings-password/>
    </div>
@endsection
