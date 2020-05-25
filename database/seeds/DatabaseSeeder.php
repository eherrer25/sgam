<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             RoleTableSeeder::class,
             UsersTableSeeder::class,
<<<<<<< HEAD

=======
             OptionsSeeder::class,
>>>>>>> 4444ceacfcfa8f524aaffb6dc9f6750946acd692
         ]);
    }
}
