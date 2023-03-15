<x-app-layout>
    @section('title', __('| Subcategory Detail'))

    <x-layout.container
        rowClass="justify-content-center"
        columnClass="col-12 m-5 text-center"
    >
        @if (session('created'))
            <x-alert.success>
                l'elemento *{{ session('created') }}* è stato creato con successo.
            </x-alert.success>
        @endif

        @if (session('edited'))
            <x-alert.info>
                l'elemento *{{ session('edited') }}* è stato modificato con successo.
            </x-alert.info>
        @endif

        <div class="container d-flex flex-wrap justify-content-around">
            <div class="card d-flex align-items-center mb-3">
                <div class="card-body text-center p-1">
                    <span class="card-title">SCATOLE</span>
                    <br>
                    <span class="card-text font-weight-bold">{{ $subcategory->name }}</span>

                    <div class="card-text">{{ $subcategory->description }}</div>
                </div>
            </div>
        </div>

        @if ($subcategory->products->count() > 0)
            <div class="row justify-content-center row-cols-1 row-cols-md-4 g-2 mt-2">
                @foreach ($subcategory->products as $product)
                    <div class="col">
                        <div class="card my-4">
                            <img
                                alt="Hollywood Sign on The Hill"
                                class="card-img-top"
                                src="https://pngimg.com/d/box_PNG84.png"
                            />
                            <div class="card-body">
                                <h1 class="card-title fw-bold">{{ $product->name }}</h1>

                                <div class="badge badge-pill px-3 py-2 rounded-pill badge-dark">
                                    {{ $product->category->name }}
                                </div>

                                <p class="card-title fw-bold small p-2 text-muted">

                                    CODICE: {{ $product->code }}

                                </p>

                                <div>
                                    <div class="badge">

                                        @if ($product->price_saled)
                                            <del><i class="fas fa-tag mr-2"></i>€{{ $product->price }}</del>
                                        @else
                                            <i class="fas fa-tag mr-2"></i>€{{ $product->price }}
                                        @endif

                                    </div>

                                    <div class="badge text-danger">

                                        @if ($product->price_saled)
                                            <i class="fas fa-tag mr-2 "></i>
                                            €<span class="">{{ $product->price_saled }}</span>
                                        @endif
                                    </div>

                                    <div class="badge">
                                        <i class="fas fa-box mr-2"></i>{{ $product->quantity }}
                                    </div>

                                </div>

                                <p class="card-text">
                                    {{ $product->mini_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h1 class="mt-2">No Products For This Subcategory</h1>
        @endif

        <x-link
            class="btn btn-sm btn-primary rounded-circle btn-floating"
            href="{{ route('admin.subcategories.edit', ['subcategory' => $subcategory->id]) }}"
        >
            <i class="fas fa-edit"></i>
        </x-link>
    </x-layout.container>
</x-app-layout>
