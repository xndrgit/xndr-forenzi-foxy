@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                {{-- if session viene eseguito al ricaricamento della pagina dopodichè viene espulso dal codice --}}
                @if (session('created'))
                    <div class="alert alert-success">
                        La sottocategoria *{{ session('created') }}* è stata creata con successo.
                    </div>
                @endif
                @if (session('edited'))
                    <div class="alert alert-warning">
                        La sottocategoria *{{ session('edited') }}* è stata modificata con successo.
                    </div>
                @endif
                @if (session('deleted'))
                    <div class="alert alert-danger">
                        La sottocategoria *{{ session('deleted') }}* è stata rimossa con successo.
                    </div>
                @endif

                <table class="table table-dark table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Categoria</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Impostazioni</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($subcategories as $subcategory)
                            <tr>

                                <td>{{ $subcategory->category_id }}</td>

                                <th scope="row">{{ $subcategory->name }}</th>
                                <td>
                                    <a
                                        class="btn btn-sm btn-primary rounded-circle"
                                        href="{{ route('admin.subcategories.edit', $subcategory->id) }}"
                                    ><i class="fas fa-edit"></i></a>
                                    <form
                                        action="{{ route('admin.subcategories.destroy', $subcategory->id) }}"
                                        class="d-inline"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-sm btn-danger rounded-circle"
                                            type="submit"
                                        >
                                            <i class="fas fa-trash "></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <h1>No Subcategories</h1>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
