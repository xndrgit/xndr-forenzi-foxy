<x-app-layout>
    @section('title', __('| Verify'))

    <x-layout.center-card>
        <x-slot name="cardHeader">
            {{ __('Verify Your Email Address') }}
        </x-slot>

        <x-slot name="cardBody">
            @if (session('resent'))
                <x-alert.success role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </x-alert.success>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <x-form
                class="d-inline"
                action="{{ route('verification.resend') }}"
            >
                <x-button class="btn-link p-0 m-0 align-baseline">
                    {{ __('click here to request another') }}
                </x-button>
            </x-form>
        </x-slot>
    </x-layout.center-card>
</x-app-layout>
