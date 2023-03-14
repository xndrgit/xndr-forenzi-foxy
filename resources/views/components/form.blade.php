<form
    {{
   $attributes->merge([
       'action' => '/',
       'method' => 'POST',
       'class' => '',
       'enctype' => 'multipart/form-data'
   ]) }}
>
    @csrf

    {{ $slot }}
</form>
