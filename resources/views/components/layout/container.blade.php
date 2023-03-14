@props([
'columnWidth' => 'col-12'
])

<div {{
   $attributes->merge([
       'class' => 'container'
   ]) }}
>
    <div class="row">
        <div class="{{ $columnWidth }}">
            {{ $slot }}
        </div>
    </div>
</div>
