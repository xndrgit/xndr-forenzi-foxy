<button {{
   $attributes->merge([
       'type' => 'submit',
       'class' => 'btn',
       'id' => '',
   ]) }}
>
    {{ $slot }}
</button>
