@extends('layouts.app')

@section('content')
    <form
        action="{{ route('admin.categories.store') }}"
        method="post"
    >
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="row">
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
                                            for="description"
                                        >
                                            Descrizione
                                        </label>
                                        <input
                                            class="form-control"
                                            id="description"
                                            name="description"
                                            required
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
                                        >Immagine
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
                                        >Logo
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
                </div>
            </div>
        </div>

        <div class="row justify-content-center m-4">
            <button
                class="btn btn-primary btn-floating rounded-circle"
                type="submit"
            >
                <i class="fas fa-download "></i>
            </button>
        </div>

    </form>
@endsection
