<x-app-layout>
    @section('title', __('| User Detail'))

    <x-layout.container
        rowClass="justify-content-center"
        columnClass="col-12 d-flex justify-content-center"
    >
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

        <article class="card card-arrow my-5">
            <x-link
                class="card__link"
                href="#"
            >
                <!-- Icon -->
                <div class="card__icon">
                    <svg viewbox="0 0 1129 994">
                        <g
                            fill-rule="nonzero"
                            fill="none"
                            stroke-width="41"
                            stroke="#999"
                        >
                            <path d="M564.5 212.437L95.67 873.5h937.66L564.5 212.437z"/>
                            <path d="M564.5 407.47L163.638 973.5h801.724L564.5 407.47z"/>
                            <path d="M564.5 35.409L39.699 774.5H1089.3L564.5 35.409z"/>
                        </g>
                    </svg>
                </div>

                <!-- Media -->
                <div class="card__media">
                    <svg viewbox="0 0 1129 994">
                        <g
                            fill-rule="nonzero"
                            fill="none"
                            stroke-width="41"
                            stroke="#F5F5F5"
                        >
                            <path d="M564.5 212.437L95.67 873.5h937.66L564.5 212.437z"/>
                            <path d="M564.5 407.47L163.638 973.5h801.724L564.5 407.47z"/>
                            <path d="M564.5 35.409L39.699 774.5H1089.3L564.5 35.409z"/>
                        </g>
                    </svg>
                </div>

                <!-- Header -->
                <div class="card__header">
                    <h3 class="card__header-title">
                        {{ $user->name }} {{ $user->user_detail && $user->user_detail->surname ? $user->user_detail->surname : '' }}
                    </h3>

                    <div class="d-flex">
                        <i class="fas fa-user-cog mx-1"></i>
                        <p class="card__header-meta">
                            {{ $user->user_detail && $user->user_detail->admin ? ucwords($user->user_detail->admin) : '' }}
                        </p>
                    </div>

                    <div class="card__header-icon">
                        <svg
                            fill="#fff"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"
                            />
                        </svg>
                    </div>
                </div>
            </x-link>
        </article>
    </x-layout.container>

    <x-layout.container
        columnClass="col-12 text-center"
    >
        <table class="table table-dark table-hover text-center">
            <thead>
            <tr>
                <th scope="row">Utente</th>
                <th scope="col">Stato</th>
                <th scope="col">Città</th>
                <th scope="col">Provincia</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Cap</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->user_detail && $user->user_detail->state ? $user->user_detail->state : '' }}</td>
                <td>{{ $user->user_detail && $user->user_detail->city ? $user->user_detail->city : '' }}</td>
                <td>{{ $user->user_detail && $user->user_detail->province ? $user->user_detail->province : '' }}</td>
                <td>{{ $user->user_detail && $user->user_detail->address ? $user->user_detail->address : '' }}</td>
                <td>{{ $user->user_detail && $user->user_detail->cap ? $user->user_detail->cap : '' }}</td>
            </tr>
            </tbody>
        </table>

        <table class="table table-dark table-hover text-center">
            <thead>
            <tr>
                <th scope="col">Ragione Sociale</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Pec</th>
                <th scope="col">Codice Sdi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $user->user_detail && $user->user_detail->business_name ? $user->user_detail->business_name : '' }}</td>
                <td>{{ $user->user_detail && $user->user_detail->phone ? $user->user_detail->phone : '' }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->user_detail && $user->user_detail->pec ? $user->user_detail->pec : '' }}</td>
                <td>{{ $user->user_detail && $user->user_detail->code_sdi ? $user->user_detail->code_sdi : '' }}</td>
            </tr>
            </tbody>
        </table>

        <x-link
            class="btn btn-sm btn-primary rounded-circle btn-floating"
            href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
        >
            <i class="fas fa-edit"></i>
        </x-link>
        <x-form
            action="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
            class="d-inline"
        >
            @csrf
            @method('DELETE')

            <x-button
                class="btn-sm btn-danger rounded-circle btn-floating"
            >
                <i class="fas fa-trash"></i>
            </x-button>
        </x-form>
    </x-layout.container>
</x-app-layout>
