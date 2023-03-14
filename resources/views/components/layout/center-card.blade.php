@props([
'columnWidth' => 'col-md-8'
])

<div {{
   $attributes->merge([
       'class' => 'container'
   ]) }}>
    <div class="row justify-content-center">
        <div class="{{ $columnWidth }}">
            <div class="card">
                @isset($cardHeader)
                    <div class="card-header">
                        {{ $cardHeader }}
                    </div>
                @endisset

                @isset($cardBody)
                    <div class="card-body">
                        {{ $cardBody }}
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
