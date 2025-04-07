<div class="w-100 d-flex flex-column" >
    {{--@if(Auth::user()->role === 'packer' or Auth::user()->role === 'admin' or Auth::user()->role === 'superadmin')
        <div class="w-100 my-3 mt-md-0"  wire:poll.3000ms>
            <livewire:compleate-orders-tabs :key="time()"/>
        </div>
    @endif--}}

    <div class="w-100" >
        <livewire:my-orders-tabs :key="time()"/>
    </div>
    @if(Auth::user()->role !== 'packer')
        <div class="w-100">
            <livewire:new-orders-tabs  :key="time()"/>
        </div>
        @endif
</div>
