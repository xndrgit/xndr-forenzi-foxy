<x-app-layout>
    @section('title', __('| Products'))

    <x-layout.container>
        {{-- if session viene eseguito al ricaricamento della pagina dopodichè viene espulso dal codice --}}
        @if (session('created'))
            <x-alert.success>
                l'elemento *{{ session('created') }}* è stato creato con successo.
            </x-alert.success>
        @endif
        @if (session('edited'))
            <x-alert.info>
                l'elemento *{{ session('edited') }}* è stato modificato con successo.
            </x-alert.info>
        @endif
        @if (session('deleted'))
            <x-alert.danger>
                l'elemento *{{ session('deleted') }}* è stato rimosso con successo.
            </x-alert.danger>
        @endif

        <div class="create-btn">
            <x-link
                class="btn btn-primary"
                href="{{ route('admin.products.create') }}"
            >
                {{ __('Create Product') }}
            </x-link>
        </div>

        <x-datatable
            tableId="products-list-table"
            tableClass="table-dark"
            :columns="$tableColumns"
        >
            <x-slot name="tableRows"></x-slot>
        </x-datatable>
    </x-layout.container>
</x-app-layout>
