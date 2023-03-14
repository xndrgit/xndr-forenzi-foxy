<x-app-layout>
    @section('title', __('| Login'))

    <x-layout.center-card class="auth-box">
        <x-slot name="cardHeader">
            {{ __('Accedi') }}
        </x-slot>

        <x-slot name="cardBody">
            <x-form
                action="{{ route('login') }}"
                method="POST"
            >
                <div class="form-group row">
                    <label
                        class="col-md-4 col-form-label text-md-right"
                        for="email"
                    >
                        {{ __('E-Mail') }}
                    </label>

                    <div class="col-md-6">
                        <input
                            autocomplete="email"
                            autofocus
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
                            autocomplete="current-password"
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
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input
                                {{ old('remember') ? 'checked' : '' }}
                                class="form-check-input"
                                id="remember"
                                name="remember"
                                type="checkbox"
                            >

                            <label
                                class="form-check-label"
                                for="remember"
                            >
                                {{ __('Ricordami') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <x-button>
                            {{ __('Accedi') }}
                        </x-button>

                        @if (Route::has('password.request'))
                            <x-link
                                class="btn btn-link"
                                href="{{ route('password.request') }}"
                            >
                                {{ __('Ho dimenticato la password') }}
                            </x-link>
                        @endif
                    </div>
                </div>
            </x-form>
        </x-slot>
    </x-layout.center-card>
</x-app-layout>

@push('scripts')
    <script type="text/javascript">
        window.onload = function () {
            window.localStorage.removeItem('user');
        }
    </script>
@endpush
