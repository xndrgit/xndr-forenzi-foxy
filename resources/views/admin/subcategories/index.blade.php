<x-app-layout>
    @section('title', __('| Subcategories'))

    <x-layout.container>
        {{-- if session viene eseguito al ricaricamento della pagina dopodichè viene espulso dal codice --}}
        @if (session('created'))
            <x-alert.success>
                La categoria *{{ session('created') }}* è stato creato con successo.
            </x-alert.success>
        @endif
        @if (session('edited'))
            <x-alert.info>
                La categoria *{{ session('edited') }}* è stato modificato con successo.
            </x-alert.info>
        @endif
        @if (session('deleted'))
            <x-alert.danger>
                La categoria *{{ session('deleted') }}* è stato rimosso con successo.
            </x-alert.danger>
        @endif

        <div class="create-btn">
            <x-link
                class="btn btn-primary"
                href="{{ route('admin.subcategories.create') }}"
            >
                {{ __('Create Subcategory') }}
            </x-link>
        </div>

        <x-datatable
            tableId="subcategories-list-table"
            tableClass="table-dark"
            :columns="$tableColumns"
        >
            <x-slot name="tableRows"></x-slot>
        </x-datatable>
    </x-layout.container>
</x-app-layout>
