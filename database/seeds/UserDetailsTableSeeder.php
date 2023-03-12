<?php

use App\Models\userDetail;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UserDetailsTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        //! prendo tutti gli utenti
        $users = User::all();

        $levels = ['registered', 'super admin'];

        //! per ogni utente inserisco un dettaglio utente
        foreach ($users as $user) {
            $userDetail = new UserDetail();
            $userDetail->user_id = $user->id;

            $userDetail->surname = $faker->lastName();
            $userDetail->business_name = $faker->domainName();
            $userDetail->notes = $faker->paragraph();

            $userDetail->address = $faker->address();
            $userDetail->phone = $faker->phoneNumber();
            $userDetail->city = $faker->city();
            $userDetail->cap = $faker->postcode();
            $userDetail->province = $faker->state();
            $userDetail->state = $faker->country();
            $userDetail->pec = $faker->email();
            $userDetail->code_sdi = $faker->randomNumber(8);

            $super_admin = env('SUPER_ADMIN', 'info@foxybox.it');

            if ($user->email == $super_admin) {
                $userDetail->admin = 'super admin';
            } else {
                $userDetail->admin = $faker->randomElement($levels);
            }

            $userDetail->save();
        }
    }
}
