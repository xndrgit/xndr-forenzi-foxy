<x-app-layout>
    @section('title', __('| Verify'))

    <x-layout.center-card>
        <x-slot name="cardHeader">
            {{ __('Verifica la tua mail') }}
        </x-slot>

        <x-slot name="cardBody">
            @if (session('resent'))
                <x-alert.success role="alert">
                    {{ __('Un link di verifica è stato mandato alla tua mail') }}
                </x-alert.success>
            @endif

            {{ __('Prima di procedere verifica se hai ricevuto un link nella tua mail') }}
            {{ __('Se non hai ricevuto la mail') }},
            <x-form
                class="d-inline"
                action="{{ route('verification.resend') }}"
            >
                <x-button class="btn-link p-0 m-0 align-baseline">
                    {{ __('Clicca qui per riceverne un altro) }}
                </x-button>
            </x-form>
        </x-slot>
    </x-layout.center-card>
</x-app-layout>
