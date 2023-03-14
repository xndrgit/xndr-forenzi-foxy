<x-app-layout>
    @section('title', __('| Confirm Password'))

    <x-layout.center-card>
        <x-slot name="cardHeader">
            {{ __('Confirm Password') }}
        </x-slot>

        <x-slot name="cardBody">
            {{ __('Please confirm your password before continuing.') }}

            <x-form
                method="POST"
                action="{{ route('password.confirm') }}"
            >
                <div class="form-group row">
                    <label
                        for="password"
                        class="col-md-4 col-form-label text-md-right"
                    >
                        {{ __('Password') }}
                    </label>

                    <div class="col-md-6">
                        <input
                            id="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            required
                            autocomplete="current-password"
                        >

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <x-button class="btn btn-primary">
                            {{ __('Confirm Password') }}
                        </x-button>

                        @if (Route::has('password.request'))
                            <x-link
                                class="btn btn-link"
                                href="{{ route('password.request') }}"
                            >
                                {{ __('Ho dimenticato la password?') }}
                            </x-link>
                        @endif
                    </div>
                </div>
            </x-form>
        </x-slot>
    </x-layout.center-card>
</x-app-layout>
