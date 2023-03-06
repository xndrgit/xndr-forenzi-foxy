@component('mail::message')
    # Richiedi la scatola personalizzata qui

    Cara {{ config('app.name') }},<br>

    Ho bisogno di una scatola personalizzata.<br>

    ## Riepilogo scatola personalizzata<br>
    MISURE: **{{ $data['length'] }} L x {{ $data['width'] }} P x {{ $data['height'] }} H**<br>
    QUANTITÀ: **{{ $data['quantity'] }}**<br>
    COLORE SCATOLA: **{{ $data['color'] }}**<br>
    TIPO DI CARTONE: **{{ $data['cardboard_type'] }}**<br>
    STAMPA: **{{ $data['press_type'] }}**<br>

    ## DATI: <br>
    {{ $data['address'] }},<br>
    {{ $data['business_name'] }}<br>
    {{ $data['first_name'] }} {{ $data['last_name'] }},<br>
    {{ $data['phone'] }},<br>
    {{ $data['sender_email'] }}<br>

    @component('mail::button', ['url' => 'https://foxybox.it'])
        Visualizza
    @endcomponent

    Saluti,<br>
    {{ $data['first_name'] }}
@endcomponent
