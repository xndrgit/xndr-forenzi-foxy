<x-app-layout>
    @section('title', ($create ? __('| Category Create') : __('| Category Update')))

    <x-layout.container>
        <x-layout.form-header>
            {{ $create ? 'Create' : 'Update' }} Category
        </x-layout.form-header>

        <x-form
            action="{{ $action }}"
        >
            @if(!$create)
                @method('put')
            @endif

            <div class="form-group row">
                <div class="form-outline col-2">
                    <label for="subcategory_id">Sottocategoria</label>

                    @foreach ($subcategories as $subcategory)
                        <div class="form-check">
                            <label class="form-check-label px-2">
                                @if ($errors->any())
                                    <input
                                        {{ in_array($subcategory->id, old('subcategory_id', [])) ? 'checked' : '' }}
                                        class="form-check-input"
                                        id="input-tags-{{ $subcategory->id }}"
                                        name="subcategory_id[]"
                                        readonly
                                        type="checkbox"
                                        value="{{ $subcategory->id }}"
                                    >
                                @else
                                    <input
                                        {{ !$create && $category->subcategories->contains($subcategory) ? 'checked' : '' }}
                                        class="form-check-input"
                                        id="input-tags-{{ $subcategory->id }}"
                                        name="subcategory_id[]"
                                        readonly
                                        type="checkbox"
                                        value="{{ $subcategory->id }}"
                                    >
                                @endif

                                <span class="badge badge-secondary h4 p-2">{{ $subcategory->name }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="col-10">
                    <div class="row">
                        <div class="col">
                            <div class="form-outline">
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
                                    value="{{ old('name', $category->name) }}"
                                    wrap="hard"
                                />

                                @error('name')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>

                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="color"
                                >
                                    Color
                                </label>

                                <input
                                    class="form-control"
                                    id="color"
                                    name="color"
                                    required
                                    type="text"
                                    value="{{ old('color', $category->color) }}"
                                />

                                @error('color')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>

                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="description"
                                >
                                    Descrizione
                                </label>

                                <input
                                    class="form-control"
                                    id="description"
                                    name="description"
                                    type="text"
                                    value="{{ old('description', $category->description) }}"
                                />

                                @error('description')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror

                            </div>
                        </div>

                        <div class="col">
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="img"
                                >
                                    Immagine
                                </label>
                                <input
                                    class="form-control"
                                    id="img"
                                    name="img"
                                    required
                                    type="text"
                                    value="{{ old('img', $category->img) }}"
                                />

                                @error('img')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>

                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="img2"
                                >
                                    Logo
                                </label>
                                <input
                                    class="form-control"
                                    id="img2"
                                    name="img2"
                                    type="text"
                                    value="{{ old('img2', $category->img2) }}"
                                />

                                @error('img2')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                        </div>
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
