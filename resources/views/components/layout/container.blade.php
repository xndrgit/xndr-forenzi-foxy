@props([
'columnClass' => 'col-12',
'rowClass' => ''
])

<div {{
   $attributes->merge([
       'class' => 'container'
   ]) }}
>
    <div class="row {{ $rowClass }}">
        <div class="{{ $columnClass }}">
            {{ $slot }}
        </div>
    </div>
</div>
