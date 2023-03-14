<x-app-layout>
    @section('title', __('| Register'))

    <x-layout.center-card class="auth-box">
        <x-slot name="cardHeader">
            {{ __('Register') }}
        </x-slot>

        <x-slot name="cardBody">
            <x-form
                action="{{ route('register') }}"
                method="POST"
            >
                <div class="form-group row">
                    <label
                        class="col-md-4 col-form-label text-md-right"
                        for="name"
                    >
                        {{ __('Name') }}
                    </label>

                    <div class="col-md-6">
                        <input
                            autocomplete="name"
                            autofocus
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            required
                            type="text"
                            value="{{ old('name') }}"
                        >

                        @error('name')
                            <span
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-4 col-form-label text-md-right"
                        for="email"
                    >
                        {{ __('E-Mail Address') }}
                    </label>

                    <div class="col-md-6">
                        <input
                            autocomplete="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            required
                            type="email"
                            value="{{ old('email') }}"
                        >

                        @error('email')
                            <span
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-4 col-form-label text-md-right"
                        for="password"
                    >
                        {{ __('Password') }}
                    </label>

                    <div class="col-md-6">
                        <input
                            autocomplete="new-password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            required
                            type="password"
                        >

                        @error('password')
                            <span
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-4 col-form-label text-md-right"
                        for="password-confirm"
                    >
                        {{ __('Confirm Password') }}
                    </label>

                    <div class="col-md-6">
                        <input
                            autocomplete="new-password"
                            class="form-control"
                            id="password-confirm"
                            name="password_confirmation"
                            required
                            type="password"
                        >
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <x-button>
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </div>
            </x-form>
        </x-slot>
    </x-layout.center-card>
</x-app-layout>
