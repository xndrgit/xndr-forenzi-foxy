<form
    {{
   $attributes->merge([
       'action' => '/',
       'method' => 'POST',
       'id' => '',
       'name' => '',
       'class' => '',
       'enctype' => 'multipart/form-data'
   ]) }}
>
    @csrf

    {{ $slot }}
</form>
