<?php

namespace App\Repositories;

use App\Models\Personalize;
use App\Mail\Personalize as PersonalizeMail;
use Illuminate\Support\Facades\Mail;

class PersonalizeRepository extends Repository
{
    protected $colors = [
        'warm'  => 'AVANA',
        'white' => 'BIANCA',
    ];

    protected $cardboard_type = [
        'box1' => 'SCATOLA A 1 ONDA',
        'box2' => 'SCATOLE A 2 ONDE',
    ];

    protected $press_type = [
        'neutral' => 'NEUTRA',
        'press1'  => 'STAMPA A 1 COLORE',
        'press2'  => 'STAMPA A 2 COLORI',
    ];

    public function model()
    {
        return app(Personalize::class);
    }


    public function requestCustomBox($request)
    {
        ini_set('max_execution_time', 500);
        $user_id = null;
        if (auth()->check()) {
            $user_id = auth()->id();
        }

        $receipt_email = env('RECEIPT_EMAIL', 'mymails.alexander@gmail.com');

        $data = [
            'receipt_email'  => $receipt_email,
            'sender_email'   => $request->input('sender_email') ?: '',
            'first_name'     => $request->input('first_name') ?: '',
            'last_name'      => $request->input('last_name') ?: '',
            'business_name'  => $request->input('business_name') ?: '',
            'address'        => $request->input('address') ?: '',
            'phone'          => $request->input('phone') ?: '',
            'length'         => $request->input('length') ?: '',
            'width'          => $request->input('width') ?: '',
            'height'         => $request->input('height') ?: '',
            'quantity'       => $request->input('quantity') ?: '',
            'color'          => $request->input('color') ? array_flip($this->colors)[$request->input('color')] : '',
            'cardboard_type' => $request->input('cardboard_type') ? array_flip($this->cardboard_type)[$request->input('cardboard_type')] : '',
            'press_type'     => $request->input('press_type') ? array_flip($this->press_type)[$request->input('press_type')] : '',
            'created_at'     => now(),
            'updated_at'     => now(),
        ];

        if ($user_id) {
            $data['user_id'] = $user_id;
        }

        $id = $this->model()->insertGetId($data);

        $data['color'] = $request->input('color') ?: '';
        $data['cardboard_type'] = $request->input('cardboard_type') ?: '';
        $data['press_type'] = $request->input('press_type') ?: '';

        config('mail.from.address', $request->input('sender_email'));

        Mail::to($receipt_email)->send(new PersonalizeMail($data));

        return $id;
    }
}
