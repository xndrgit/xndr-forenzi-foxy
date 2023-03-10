@extends('layouts.app')

@section('content')
    <form
        action="{{ route('admin.products.store') }}"
        enctype="multipart/form-data"
        method="post"
    > @csrf @method('POST')

        <div class="container">
            <div class="row">
                <div class="col-12 d-flex">
                    <div class="form-outline col-3">
                        <label
                            class="form-label"
                            for="code"
                        >Codice
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
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="form-outline col-3">
                        <label
                            class="form-label"
                            for="name"
                        >Nome Prodotto
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
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="length"
                        >Lato Lungo in cm
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
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="width"
                        >Lato Corto in cm
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
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="height"
                        >Altezza in cm
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
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                </div>
            </div>

            <hr>

            <div class="row">

                <div class="col-12 d-flex">

                    <div class="form-outline col-2">
                        <label for="subcategory_id">Sottocategoria</label>

                        @foreach ($categories as $key => $category)
                            <div
                                class="form-check"
                                id="subcategory-pack-{{ $category->id }}"
                                style="{{ $key == 0 ? '' : 'display: none;' }}"
                            >
                                @foreach ( $category->subcategories as $subcategory)
                                    <label class="form-check-label px-2">
                                        <input
                                            class="form-check-input subcategory-form-checkbox"
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
                                onchange="changeCategory(this)"
                            >
                                @foreach ($categories as $category)
                                    <option
                                        {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}
                                        value="{{ $category->id }}"
                                    >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="color"
                            >Colore Prodotto
                            </label>
                            <select
                                class="form-control"
                                id="color"
                                name="color"
                                required
                            >
                                @foreach ($colors as $color)
                                    <option
                                        {{ $color->color == old('color', $product->color) ? 'selected' : '' }}
                                        {{-- @if (old('color', $product->color) == $color->color)selected@endif --}}
                                        value="{{ $color->color }}"
                                    >
                                        {{ ucwords($color->color) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('color')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="print"
                            >Stampa Prodotto
                            </label>
                            <select
                                class="form-control"
                                id="print"
                                name="print"
                                required
                            >
                                @foreach ($prints as $print)
                                    <option
                                        {{ $print->print == old('print', $product->print) ? 'selected' : '' }}
                                        value="{{ $print->print }}"
                                    >
                                        {{ ucwords($print->print) }}
                                    </option>
                                @endforeach

                            </select>

                            @error('print')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="first_price"
                            >Prezzo Scontato Per 100 Unità
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
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="second_price"
                            >Prezzo Scontato Per 300 Unità
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
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="third_price"
                            >Prezzo Scontato Per 500 Unità
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
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="third_price"
                            >Prezzo Scontato Per 500 Unità
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
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                        <div class="form-outline col-4">
                            <label
                                class="form-label"
                                for="fourth_price"
                            >Prezzo Scontato Per 1000 Unità
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
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                    </div>

                </div>

            </div>

            <hr>

            <div class="row">
                <div class="col-12 d-flex flex-wrap">
                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="price"
                        >Prezzo
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
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="price_saled"
                        >Prezzo Scontato
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
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="weight"
                        >Peso in kg
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
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="quantity"
                        >Quantità
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
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="form-outline col-2">
                        <label
                            class="form-label"
                            for="purchasable_in_multi_of"
                        >In Multi Di
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
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    <div class="form-outline col-4">
                        <label
                            class="form-label"
                            for="description"
                        >Descrizione Prodotto
                        </label>
                        <textarea
                            class="form-control"
                            cols="30"
                            id="description"
                            name="description"
                            required
                            rows="10"
                            style="white-space: pre-wrap !important;"
                            type="text"
                        >{{ old('description', $product->description) }}</textarea>

                        @error('description')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="form-outline col-3">
                        <label
                            class="form-label"
                            for="mini_description"
                        >Descrizione Breve
                        </label>
                        <textarea
                            class="form-control"
                            cols="30"
                            id="mini_description"
                            name="mini_description"
                            required
                            rows="4"
                            style="white-space: pre-wrap !important;"
                            type="text"
                        >{{ old('mini_description', $product->mini_description) }}</textarea>

                        @error('mini_description')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="form-group col-3">
                        <label
                            class="form-label"
                            for="img"
                        >Immagine Prodotto</label>
                        <input
                            class="form-control"
                            id="img"
                            name="img"
                            type="file"
                        >
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
                            @else
                                <img
                                    alt="current image"
                                    class="card-img-top"
                                    src="{{ asset('storage/' . $product->img) }}"
                                >
                            @endif

                        </div>
                        @error('img')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="row justify-content-center m-4">
                <button
                    class="btn btn-primary btn-floating rounded-circle"
                    type="submit"
                >
                    <i class="fa-2x fas fa-download "></i>
                </button>
            </div>

        </div>

    </form>
@endsection

@push('scripts')
    <script type="text/javascript">
        let oldCategoryID = document.getElementById('select-product-category').value;

        // update subcategory dynamic
        function changeCategory(param)
        {
            const selectedCategoryID = param.value;
            hideOldSubcategories(selectedCategoryID);
            oldCategoryID = selectedCategoryID;
        }

        // hide old subcategories
        function hideOldSubcategories(selectedCategoryID)
        {
            let subcategoryCheckboxes = document.querySelectorAll("input[type='checkbox'].subcategory-form-checkbox");
            if (subcategoryCheckboxes && subcategoryCheckboxes.length)
            {
                for (let subcategoryCheckbox of subcategoryCheckboxes)
                {
                    subcategoryCheckbox.checked = false;
                }
            }

            document.querySelector("#subcategory-pack-" + oldCategoryID).style.display = 'none';
            document.querySelector("#subcategory-pack-" + selectedCategoryID).style.display = '';
        }
    </script>
@endpush
