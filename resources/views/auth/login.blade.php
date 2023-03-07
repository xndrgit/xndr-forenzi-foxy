@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Accedi') }}</div>

                    <div class="card-body">
                        <form
                            action="{{ route('login') }}"
                            method="POST"
                        >
                            @csrf

                            <div class="form-group row">
                                <label
                                    class="col-md-4 col-form-label text-md-right"
                                    for="email"
                                >{{ __('E-Mail') }}</label>

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
                                >{{ __('Password') }}</label>

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
                                    <button
                                        class="btn "
                                        type="submit"
                                    >
                                        {{ __('Accedi') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a
                                            class="btn btn-link"
                                            href="{{ route('password.request') }}"
                                        >
                                            {{ __('Ho dimenticato la password') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        window.onload = function() {
            window.localStorage.removeItem('user');
        }
    </script>
@endpush

<style>
    .card {
        border-radius: 4px;
        background: #fff;
        box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
        transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
    }

    button.btn {
        background-color: #f68630;
        border: none;
        border-radius: 0px;
        color: white;
        font-weight: bold;
        padding: 6px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 10px;
        margin: 15px 0;
        cursor: pointer;
        transition: all 0.5s ease-in-out;
    }
</style>
