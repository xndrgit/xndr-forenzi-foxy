<x-app-layout>
    @section('title', __('| Jumbo Detail')))

    <x-layout.container>
        <div class="row justify-content-center">
            <div class="col-md-8 card">
                @if (filter_var($jumbo->src, FILTER_VALIDATE_URL))
                    <img
                        alt="Immagine"
                        class="card-img-top"
                        src="{{ $jumbo->src }}"
                    >
                @endif

                <div class="card-header">
                    {{ $jumbo->title }}
                </div>

                <div class="card-body">
                    <div class="card-text">
                        {{ $jumbo->description }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center m-4">
            <x-link
                class="btn btn-sm btn-primary rounded-circle btn-floating"
                href="{{ route('admin.jumbos.edit', ['jumbo' => $jumbo->id]) }}"
            >
                <i class="fas fa-edit"></i>
            </x-link>
        </div>
    </x-layout.container>
</x-app-layout>
