<x-app-layout>
    @section('title', __('| User Create'))

    <x-layout.container>
        <x-layout.form-header>
            Create User
        </x-layout.form-header>

        <x-form
            action="{{ route('admin.users.store') }}"
        >
            <div class="form-group row">
                <div class="col">
                    <x-form-outline>
                        <label class="form-label w-100" for="name">
                            Nome
                        </label>
                        <input
                            class="form-control"
                            id="name"
                            name="name"
                            required
                            type="text"
                            value="{{ old('name', '') }}"
                        />

                        @error('name')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </x-form-outline>
                    <x-form-outline>
                        <label class="form-label w-100" for="surname">
                            Cognome
                        </label>
                        <input
                            class="form-control"
                            id="surname"
                            name="surname"
                            required
                            type="text"
                            value="{{ old('surname', '') }}"
                        />

                        @error('surname')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </x-form-outline>
                </div>
                <div class="col">
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="business_name"
                        >
                            Ragione Sociale
                        </label>
                        <input
                            class="form-control"
                            id="business_name"
                            name="business_name"
                            required
                            type="text"
                            value="{{ old('business_name', '') }}"
                        />

                        @error('business_name')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </x-form-outline>
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="address"
                        >
                            Indirizzo
                        </label>
                        <input
                            class="form-control"
                            id="address"
                            name="address"
                            required
                            type="text"
                            value="{{ old('address', '') }}"
                        />

                        @error('address')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </x-form-outline>
                </div>
                <div class="col">
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="cap"
                        >
                            Cap
                        </label>
                        <input
                            class="form-control"
                            id="cap"
                            name="cap"
                            required
                            type="text"
                            value="{{ old('cap', '') }}"
                        />

                        @error('cap')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </x-form-outline>
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="city"
                        >
                            Città
                        </label>
                        <input
                            class="form-control"
                            id="city"
                            name="city"
                            required
                            type="text"
                            value="{{ old('city', '') }}"
                        />

                        @error('city')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </x-form-outline>
                </div>
                <div class="col">
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="province"
                        >
                            Provincia
                        </label>
                        <input
                            class="form-control"
                            id="province"
                            name="province"
                            required
                            type="text"
                            value="{{ old('province', '') }}"
                        />

                        @error('province')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </x-form-outline>
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="state"
                        >
                            Stato
                        </label>
                        <input
                            class="form-control"
                            id="state"
                            name="state"
                            required
                            type="text"
                            value="{{ old('state', '') }}"
                        />

                        @error('state')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </x-form-outline>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="phone"
                        >
                            Telefono
                        </label>
                        <input
                            class="form-control"
                            id="phone"
                            name="phone"
                            required
                            type="text"
                            value="{{ old('phone', '') }}"
                        />

                        @error('phone')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </x-form-outline>
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="email"
                        >
                            Email
                        </label>
                        <input
                            class="form-control"
                            id="email"
                            name="email"
                            required
                            type="text"
                            value="{{ old('email', '') }}"
                        />

                        @error('email')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </x-form-outline>
                </div>

                <div class="col">
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="pec"
                        >
                            Pec
                        </label>
                        <input
                            class="form-control"
                            id="pec"
                            name="pec"
                            required
                            type="text"
                            value="{{ old('pec', '') }}"
                        />

                        @error('pec')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </x-form-outline>
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="code_sdi"
                        >
                            Codice Sdi
                        </label>
                        <input
                            class="form-control"
                            id="code_sdi"
                            name="code_sdi"
                            required
                            type="text"
                            value="{{ old('code_sdi', '') }}"
                        />

                        @error('code_sdi')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </x-form-outline>
                </div>

                <div class="col">
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="notes"
                        >
                            Note
                        </label>

                        <textarea
                            class="form-control"
                            cols="20"
                            id="notes"
                            name="notes"
                            rows="5"
                            style="white-space: nowrap !important;"
                            type="text"
                        >{{ old('notes', '') }}</textarea>

                        @error('pec')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </x-form-outline>
                </div>
                <div class="col">
                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="password"
                        >
                            Password
                        </label>
                        <input
                            class="form-control"
                            id="password"
                            name="password"
                            type="password"
                            required
                            value="{{ old('password', '') }}"
                        />

                        @error('password')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </x-form-outline>

                    <x-form-outline>
                        <label
                            class="form-label w-100"
                            for="admin"
                        >
                            Livello
                        </label>
                        <select
                            id="admin"
                            name="admin"
                            required
                            class="form-control"
                        >
                            @foreach ($roles as $role)
                                <option value="{{ $role->admin }}">{{ $role->admin }}</option>
                            @endforeach
                        </select>

                        @error('admin')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </x-form-outline>
                </div>
            </div>

            <div class="row justify-content-center m-4">
                <x-button
                    class="btn-primary btn-floating rounded-circle"
                >
                    <i class="fas fa-save"></i>
                </x-button>
            </div>
        </x-form>
    </x-layout.container>
</x-app-layout>
