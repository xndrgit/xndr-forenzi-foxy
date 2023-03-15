<x-app-layout>
    @section('title', __('| Orders'))

    <x-layout.container>
        <x-datatable
            tableId="orders-list-table"
            tableClass="table-dark"
            :columns="$tableColumns"
        >
            <x-slot name="tableRows"></x-slot>
        </x-datatable>
    </x-layout.container>
</x-app-layout>
