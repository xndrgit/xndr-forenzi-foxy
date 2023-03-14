<x-app-layout>
    @section('title', __('| Users'))

    <x-layout.container>
        {{-- if session viene eseguito al ricaricamento della pagina dopodichè viene espulso dal codice --}}
        @if (session('created'))
            <x-alert.success>
                l'utente *{{ session('created') }}* è stato creato con successo.
            </x-alert.success>
        @endif
        @if (session('edited'))
            <x-alert.info>
                l'utente *{{ session('edited') }}* è stato modificato con successo.
            </x-alert.info>
        @endif
        @if (session('deleted'))
            <x-alert.danger>
                l'utente *{{ session('deleted') }}* è stato rimosso con successo.
            </x-alert.danger>
        @endif

        <div class="create-btn">
            <x-link
                class="btn btn-primary"
                href="{{ route('admin.users.create') }}"
            >
                {{ __('Create User') }}
            </x-link>
        </div>

        <x-datatable
            tableId="users-list-table"
            tableClass="table-dark"
            :columns="$tableColumns"
        >
            <x-slot name="tableRows"></x-slot>
        </x-datatable>
    </x-layout.container>
</x-app-layout>
