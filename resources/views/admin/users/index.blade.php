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

        <table class="table table-dark table-hover text-center">
            <thead>
            <tr>
                <th scope="col">Ruolo</th>
                <th scope="col">Nome</th>
                <th scope="col">Mail</th>
                <th scope="col">Telefono</th>
                <th scope="col">Impostazioni</th>
            </tr>
            </thead>
            <tbody>
            @if($users)
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">
                            {{ $user->user_detail && $user->user_detail->admin ? $user->user_detail->admin : '' }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->user_detail && $user->user_detail->phone ? $user->user_detail->phone : '' }}
                        </td>
                        <td>
                            <x-link
                                class="btn btn-sm btn-success rounded-circle"
                                href="{{ route('admin.users.show', $user->id) }}"
                            >
                                <i class="fas fa-eye"></i>
                            </x-link>
                            <x-link
                                class="btn btn-sm btn-primary rounded-circle"
                                href="{{ route('admin.users.edit', $user->id) }}"
                            >
                                <i class="fas fa-edit"></i>
                            </x-link>
                            <x-form
                                action="{{ route('admin.users.destroy', $user->id) }}"
                                class="d-inline"
                                method="POST"
                            >
                                @method('DELETE')

                                <x-button
                                    class="btn-sm btn-danger rounded-circle"
                                >
                                    <i class="fas fa-trash"></i>
                                </x-button>
                            </x-form>
                        </td>
                    </tr>
                @endforeach
            @else
                <h1>No users</h1>
            @endif
            </tbody>
        </table>
    </x-layout.container>
</x-app-layout>
