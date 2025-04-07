@extends('components.auth-app')

@section('content')
    <div class="w-100 pb-3 d-flex flex-column">
        <livewire:orders-block/>
    </div>

    <script>
        setTimeout(() => {
            window.location.reload()
        }, 10000)
    </script>
@endsection
