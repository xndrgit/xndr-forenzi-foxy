<x-app-layout>
    @section('title', __('| Reset Password'))

    <x-layout.center-card>
        <x-slot name="cardHeader">
            {{ __('Reset Password') }}
        </x-slot>

        <x-slot name="cardBody">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <x-form action="{{ route('password.update') }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">
                    <label
                        for="email"
                        class="col-md-4 col-form-label text-md-right">
                        {{ __('E-Mail Address') }}
                    </label>

                    <div class="col-md-6">
                        <input
                            id="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ $email ?? old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                        >

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        for="password"
                        class="col-md-4 col-form-label text-md-right">
                        {{ __('Password') }}
                    </label>

                    <div class="col-md-6">
                        <input
                            id="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            required
                            autocomplete="new-password"
                        >

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        for="password-confirm"
                        class="col-md-4 col-form-label text-md-right"
                    >
                        {{ __('Confirm Password') }}
                    </label>

                    <div class="col-md-6">
                        <input
                            id="password-confirm"
                            type="password"
                            class="form-control"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                        >
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <x-button class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </x-button>
                    </div>
                </div>
            </x-form>
        </x-slot>
    </x-layout.center-card>
</x-app-layout>
