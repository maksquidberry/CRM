@extends('components.auth-app')

@section('content')
    <div class="ww-100 text-white pb-3 d-flex flex-column">
        @if(intval($id) > 0)
            <livewire:user-edit-item :userId="$id"/>
        @else
            <livewire:user-edit-item :userId="null"/>
        @endif
    </div>
@endsection
