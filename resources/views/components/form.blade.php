<form
    {{
   $attributes->merge([
       'action' => '/',
       'method' => 'post',
       'id' => '',
       'name' => '',
       'class' => '',
       'enctype' => 'multipart/form-data'
   ]) }}
>
    @csrf

    {{ $slot }}
</form>
