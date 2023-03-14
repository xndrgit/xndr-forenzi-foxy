<x-app-layout>
    @section('title', __('| Home'))

    <x-layout.center-card>
        <x-slot name="cardHeader">
            {{ __('Dashboard') }}
        </x-slot>

        <x-slot name="cardBody">
            @if (session('status'))
                <x-alert.success role="alert">
                    {{ session('status') }}
                </x-alert.success>
            @endif

            {{ __('You are logged in!') }}
        </x-slot>
    </x-layout.center-card>
</x-app-layout>
