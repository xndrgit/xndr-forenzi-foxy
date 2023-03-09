@extends('layouts.app')

@section('content')
    <form
        action="{{ route('admin.subcategories.store') }}"
        enctype="multipart/form-data"
        method="post"
    > @csrf @method('POST')

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="form-outline col-6">
                                <label
                                    class="form-label"
                                    for="name"
                                >Nome
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
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-outline col-6">
                                <label
                                    class="form-label"
                                    for="category_name"
                                >Categoria
                                </label>
                                <select
                                    class="form-control"
                                    name="category_id"
                                >
                                    @foreach ($categories as $category)
                                        <option
                                            {{ $category->id == old('category_id', $subcategory->category_id) ? 'selected' : '' }}
                                            value="{{ $category->id }}"
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

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
                <i class="fas fa-2x fa-download "></i>
            </button>
        </div>

    </form>
@endsection
