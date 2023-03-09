@extends('layouts.app')

@section('content')
    <form
        action="{{ route('admin.subcategories.update', ['subcategory' => $subcategory->id]) }}"
        enctype="multipart/form-data"
        method="post"
    > @csrf @method('PUT')

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
                                    for="description"
                                >
                                    Descrizione
                                </label>
                                <textarea
                                    class="form-control"
                                    id="description"
                                    name="description"
                                    rows="2"
                                >{{ old('name', $subcategory->description) }}</textarea>

                                @error('description')
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
                <i class="fas fa-download "></i>
            </button>
        </div>

    </form>
@endsection
