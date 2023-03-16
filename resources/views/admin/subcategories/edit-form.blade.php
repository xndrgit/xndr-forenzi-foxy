<x-app-layout>
    @section('title', ($create ? __('| Subcategory Create') : __('| Subcategory Update')))

    <x-layout.container>
        <x-layout.form-header>
            {{ $create ? 'Create' : 'Update' }} Subcategory
        </x-layout.form-header>

        <x-form
            action="{{ $action }}"
        >
            @if(!$create)
                @method('put')
            @endif

            <div class="form-group row">
                <div class="col-12 d-flex">
                    <div class="form-outline col-6">
                        <label
                            class="form-label"
                            for="name"
                        >
                            Nome
                        </label>

                        <input
                            class="form-control"
                            id="name"
                            name="name"
                            required
                            type="text"
                            value="{{ old('name', $subcategory->name) }}"
                            wrap="hard"
                        />

                        @error('name')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>

                    <div class="form-outline col-6">
                        <label
                            class="form-label"
                            for="description"
                        >
                            Descrizione
                        </label>

                        <textarea
                            class="form-control"
                            id="description"
                            name="description"
                            rows="2"
                        >{{ old('description', $subcategory->description) }}</textarea>

                        @error('description')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row justify-content-center m-4">
                <x-button class="btn btn-primary btn-floating rounded-circle">
                    <i class="fa-2x fas fa-save"></i>
                </x-button>
            </div>
        </x-form>
    </x-layout.container>
</x-app-layout>
