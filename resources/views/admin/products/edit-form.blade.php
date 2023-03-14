<x-app-layout>
    @section('title', ($create ? __('| Product Create') : __('| Product Update')))

    <x-layout.container>
        <x-layout.form-header>
            {{ $create ? 'Create' : 'Update' }} Product
        </x-layout.form-header>

        <x-form
            action="{{ $action }}"
        >
            @if(!$create)
                @method('put')
            @endif

            <div class="form-group row">
                <div class="col-12 d-flex">
                    <div class="form-outline col-3">
                        <label
                            class="form-label"
                            for="code"
                        >
                            Codice
                        </label>
                        <input
                            class="form-control"
                            id="code"
                            name="code"
                            required
                            type="number"
                            value="{{ old('code', $product->code) }}"
                        />

                        @error('code')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>
                    <div class="form-outline col-3">
                        <label
                            class="form-label"
                            for="name"
                        >
                            Nome Prodotto
                        </label>

                        <input
                            class="form-control"
                            id="name"
                            name="name"
                            required
                            type="text"
                            value="{{ old('name', $product->name) }}"
                        />

                        @error('name')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>

                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="length"
                        >
                            Lato Lungo in cm
                        </label>
                        <input
                            class="form-control"
                            id="length"
                            name="length"
                            required
                            type="number"
                            value="{{ old('length', $product->length) }}"
                        />

                        @error('length')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>

                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="width"
                        >
                            Lato Corto in cm
                        </label>
                        <input
                            class="form-control"
                            id="width"
                            name="width"
                            required
                            type="number"
                            value="{{ old('width', $product->width) }}"
                        />

                        @error('width')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </div>
                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="height"
                        >
                            Altezza in cm
                        </label>
                        <input
                            class="form-control"
                            id="height"
                            name="height"
                            required
                            type="number"
                            value="{{ old('height', $product->height) }}"
                        />

                        @error('height')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>
                </div>
            </div>
            <hr/>

            <div class="form-group row">
                <div class="col-12 d-flex">
                    <div class="form-outline col-2">
                        <label for="subcategory_id">Sottocategoria</label>
                        @foreach ($categories as $key => $category)
                            <div
                                class="form-check"
                                id="subcategory-pack-{{ $category->id }}"
                                style="{{ $create ? ( $key == 0 ? '' : 'display: none;') : ($category->id == $product->category->id ? '' : 'display: none;') }}"
                            >
                                @foreach ( $category->subcategories as $subcategory)
                                    <label class="form-check-label px-2">
                                        <input
                                            {{ !$create && ($category->id == $product->category->id && $product->subcategories->contains($subcategory)) ? 'checked' : '' }}
                                            class="form-check-input subcategory-form-checkbox"
                                            id="subcategory_id"
                                            name="subcategory_id[]"
                                            type="checkbox"
                                            value="{{ $subcategory->id }}"
                                        />

                                        <span class="badge badge-secondary h4 p-2">{{ $subcategory->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <div class="col-10 d-flex flex-wrap">
                        <div class="form-outline col-4">
                            <label for="category_id">Categoria</label>
                            <select
                                class="form-control"
                                id="select-product-category"
                                name="category_id"
                            >
                                @foreach ($categories as $category)
                                    <option
                                        {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}
                                        value="{{ $category->id }}"
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="color"
                            >
                                Colore Prodotto
                            </label>
                            <select
                                class="form-control"
                                id="color"
                                name="color"
                                required
                            >
                                @foreach ($colors as $color)
                                    <option
                                        {{ $color == old('color', $product->color) ? 'selected' : '' }}
                                        value="{{ $color }}"
                                    >
                                        {{ ucwords($color) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('color')
                            <x-alert.danger>
                                {{ $message }}
                            </x-alert.danger>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="print"
                            >
                                Stampa Prodotto
                            </label>
                            <select
                                class="form-control"
                                id="print"
                                name="print"
                                required
                            >
                                @foreach ($prints as $print)
                                    <option
                                        {{ $print == old('print', $product->print) ? 'selected' : '' }}
                                        value="{{ $print }}"
                                    >
                                        {{ ucwords($print) }}
                                    </option>
                                @endforeach

                            </select>

                            @error('print')
                            <x-alert.danger>
                                {{ $message }}
                            </x-alert.danger>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="first_price"
                            >
                                Prezzo Scontato Per 100 Unità
                            </label>
                            <input
                                class="form-control"
                                id="first_price"
                                name="first_price"
                                required
                                step="0.01"
                                type="number"
                                value="{{ old('first_price', $product->first_price) }}"
                            />

                            @error('first_price')
                            <x-alert.danger>
                                {{ $message }}
                            </x-alert.danger>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="second_price"
                            >
                                Prezzo Scontato Per 300 Unità
                            </label>
                            <input
                                class="form-control"
                                id="second_price"
                                name="second_price"
                                required
                                step="0.01"
                                type="number"
                                value="{{ old('second_price', $product->second_price) }}"
                            />

                            @error('second_price')
                            <x-alert.danger>
                                {{ $message }}
                            </x-alert.danger>
                            @enderror
                        </div>

                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="third_price"
                            >
                                Prezzo Scontato Per 500 Unità
                            </label>
                            <input
                                class="form-control"
                                id="third_price"
                                name="third_price"
                                required
                                step="0.01"
                                type="number"
                                value="{{ old('third_price', $product->third_price) }}"
                            />

                            @error('third_price')
                            <x-alert.danger>
                                {{ $message }}
                            </x-alert.danger>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="third_price"
                            >
                                Prezzo Scontato Per 500 Unità
                            </label>

                            <input
                                class="form-control"
                                id="third_price"
                                name="third_price"
                                required
                                step="0.01"
                                type="number"
                                value="{{ old('third_price', $product->third_price) }}"
                            />

                            @error('third_price')
                            <x-alert.danger>
                                {{ $message }}
                            </x-alert.danger>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="fourth_price"
                            >
                                Prezzo Scontato Per 1000 Unità
                            </label>
                            <input
                                class="form-control"
                                id="fourth_price"
                                name="fourth_price"
                                required
                                step="0.01"
                                type="number"
                                value="{{ old('fourth_price', $product->fourth_price) }}"
                            />

                            @error('fourth_price')
                            <x-alert.danger>
                                {{ $message }}
                            </x-alert.danger>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <hr/>

            <div class="row">
                <div class="col-12 d-flex flex-wrap">
                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="price"
                        >
                            Prezzo
                        </label>
                        <input
                            class="form-control"
                            id="price"
                            name="price"
                            required
                            step="0.01"
                            type="number"
                            value="{{ old('price', $product->price) }}"
                        />

                        @error('price')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>

                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="price_saled"
                        >
                            Prezzo Scontato
                        </label>
                        <input
                            class="form-control"
                            id="price_saled"
                            name="price_saled"
                            step="0.01"
                            type="number"
                            value="{{ old('price_saled', $product->price_saled) }}"
                        />

                        @error('price_saled')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>

                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="weight"
                        >
                            Peso in kg
                        </label>
                        <input
                            class="form-control"
                            id="weight"
                            name="weight"
                            required
                            step="0.01"
                            type="number"
                            value="{{ old('weight', $product->weight) }}"
                        />

                        @error('weight')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>

                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="quantity"
                        >
                            Quantità
                        </label>
                        <input
                            class="form-control"
                            id="quantity"
                            name="quantity"
                            required
                            type="number"
                            value="{{ old('quantity', $product->quantity) }}"
                        />

                        @error('quantity')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>

                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="purchasable_in_multi_of"
                        >
                            In Multi Di
                        </label>
                        <input
                            class="form-control"
                            id="purchasable_in_multi_of"
                            min="1"
                            name="purchasable_in_multi_of"
                            required
                            type="number"
                            value="{{ old('purchasable_in_multi_of', $product->purchasable_in_multi_of) }}"
                        >

                        @error('purchasable_in_multi_of')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>

                    <div class="form-outline col-4">
                        <label
                            class="form-label"
                            for="description"
                        >
                            Descrizione Prodotto
                        </label>
                        <textarea
                            class="form-control"
                            cols="30"
                            id="description"
                            name="description"
                            required
                            rows="10"
                            style="word-wrap: break-word;"
                        >{{ old('description', $product->description) }}</textarea>

                        @error('description')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>

                    <div class="form-outline col-3">
                        <label
                            class="form-label"
                            for="mini_description"
                        >
                            Descrizione Breve
                        </label>

                        <textarea
                            class="form-control"
                            cols="30"
                            id="mini_description"
                            name="mini_description"
                            required
                            rows="4"
                            style="word-wrap: break-word;"
                        >{{ old('mini_description', $product->mini_description) }}</textarea>

                        @error('mini_description')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label
                            class="form-label"
                            for="img"
                        >
                            Immagine Prodotto
                        </label>

                        <input
                            class="form-control"
                            id="img"
                            name="img"
                            type="file"
                        />

                        <div
                            class="card mt-3"
                            style="max-width: 300px;"
                        >
                            @if (filter_var($product->img, FILTER_VALIDATE_URL))
                                <img
                                    alt="standard"
                                    class="card-img-top"
                                    src="{{ $product->img }}"
                                >
                            @endif
                        </div>

                        @error('img')
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
