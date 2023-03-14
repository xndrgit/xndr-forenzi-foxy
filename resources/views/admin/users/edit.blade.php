<x-app-layout>
    @section('title', __('| User Edit'))

    <x-layout.container>
        <x-layout.form-header>
            Edit User
        </x-layout.form-header>

        <x-form
            action="{{ route('admin.users.update', ['user' => $user->id]) }}"
        >
            @method('put')

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
                            value="{{ old('name', $user->name) }}"
                            wrap="hard"
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
                            value="{{ old('surname', $user->user_detail->surname) }}"
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
                            value="{{ old('business_name', $user->user_detail->business_name) }}"
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
                            value="{{ old('address', $user->user_detail->address) }}"
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
                            value="{{ old('cap', $user->user_detail->cap) }}"
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
                            value="{{ old('city', $user->user_detail->city) }}"
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
                            value="{{ old('province', $user->user_detail->province) }}"
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
                            value="{{ old('state', $user->user_detail->state) }}"
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
                            value="{{ old('phone', $user->user_detail->phone) }}"
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
                            value="{{ old('email', $user->email) }}"
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
                            value="{{ old('pec', $user->user_detail->pec) }}"
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
                            value="{{ old('code_sdi', $user->user_detail->code_sdi) }}"
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
                            style="word-wrap: break-word;"
                        >{{ old('notes', $user->user_detail->notes) }}</textarea>

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
                            class="form-control bg-gray"
                            id="password"
                            name="password"
                            type="text"
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
                                <option value="{{ $role->admin }}" {{ $role->admin == $user->user_detail->admin ? 'selected' : '' }}>
                                    {{ $role->admin }}
                                </option>
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
