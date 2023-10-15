<x-app-layout>
    @section('title', ($create ? __('| Jumbo Create') : __('| Jumbo Update')))

    <x-layout.container>
        <x-layout.form-header>
            {{ $create ? 'Create' : 'Update' }} Jumbo
        </x-layout.form-header>

        <x-form action="{{ $action }}" enctype="multipart/form-data">
            @if(!$create)
                @method('put')
            @endif

            <div class="form-group row">
                <div class="form-group col-3">
                    <label
                        class="form-label"
                        for="src"
                    >
                        Immagine
                    </label>

                    <input
                        class="form-control"
                        id="src"
                        name="src"
                        type="file"
                    />

                    <div
                        class="card mt-3"
                        style="max-width: 300px;"
                    >
                        @if (filter_var($jumbo->src, FILTER_VALIDATE_URL))
                            <img
                                alt="Immagine"
                                class="card-img-top"
                                src="{{ $jumbo->src }}"
                            >
                        @endif
                    </div>

                    @error('img')
                    <x-alert.danger>
                        {{ $message }}
                    </x-alert.danger>
                    @enderror
                </div>
                <div class="col-10 d-flex">
                    <div class="form-outline col-6">
                        <label
                            class="form-label"
                            for="title"
                        >
                            Title
                        </label>

                        <input
                            class="form-control"
                            id="title"
                            name="title"
                            required
                            type="text"
                            value="{{ old('title', $jumbo->title) }}"
                            wrap="hard"
                        />

                        @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
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
                            rows="3"
                        >{{ old('description', $jumbo->description) }}</textarea>

                        @error('description')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
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
