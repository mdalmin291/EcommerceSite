@push('css')
<style>
    .custom-search-dropdown {
        z-index: 10001;
    }

</style>
@endpush
<div>
    <div class="position-relative">
        <input type="text" wire:model.debounce.500ms="search" placeholder=" Code" value=""
            class="form-control" id="basicpill-firstname-input">

        @if (strlen($search) >= 2 && $selected)
        <div class="custom-search-dropdown position-absolute text-center rounded mt-1">
            <div class="list-group">
                @if ($search_list->count() > 0)
                @foreach ($search_list as $order)
                <a href="javascript:void(0)" class="list-group-item list-group-item-action"
                    wire:click="searchSelect({{$order}})">{{$order->code}}</a>
                @endforeach
                @else
                <a href="javascript:void(0)" class="list-group-item list-group-item-action">No result found for
                    {{$search}}</a>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

