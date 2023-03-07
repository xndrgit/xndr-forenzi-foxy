@component('mail::message')
    # Richiedi la scatola personalizzata qui

    Cara {{ config('app.name') }},

    Ho bisogno di una scatola personalizzata.

    Riepilogo scatola personalizzata
    MISURE: {{ $data['length'] }} L x {{ $data['width'] }} P x {{ $data['height'] }} H
    QUANTITÀ: {{ $data['quantity'] }}
    COLORE SCATOLA: {{ $data['color'] }}
    TIPO DI CARTONE: {{ $data['cardboard_type'] }}
    STAMPA: {{ $data['press_type'] }}

    DATI:
    {{ $data['address'] }},
    {{ $data['business_name'] }}
    {{ $data['first_name'] }} {{ $data['last_name'] }},
    {{ $data['phone'] }},
    {{ $data['sender_email'] }}

    Saluti,
    {{ $data['first_name'] }}

    @component('mail::button', ['url' => 'https://foxybox.it'])
        Visualizza
    @endcomponent
@endcomponent
