<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
=======
        $office = new \App\Models\Office();
        $office->name = 'Santiago';
        $office->address = 'Alameda 130';
        $office->commune = 'Santiago Centro';
        $office->save();


>>>>>>> 4444ceacfcfa8f524aaffb6dc9f6750946acd692
        $user = User::create([
            'name' => 'admin',
            'last_name' => 'super',
            'status' => 1,
            'email' => 'admin@gmail.com',
            'office_id' => $office->id,
            'password' => Hash::make('123456'),

        ]);

        $user->assignRole('admin');
    }
}
