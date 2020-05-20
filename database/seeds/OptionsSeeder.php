<?php

use App\Models\CivilStatus;
use App\Models\Room;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i < 11; $i++){
            $room = new Room();
            $room->name = "$i";
            $room->save();
        }

        $civil = new CivilStatus();
        $civil->name = 'Soltero(a)';
        $civil->save();
        $civil = new CivilStatus();
        $civil->name = 'Casado(a)';
        $civil->save();
        $civil = new CivilStatus();
        $civil->name = 'Viudo(a)';
        $civil->save();
        $civil = new CivilStatus();
        $civil->name = 'Separado(a)';
        $civil->save();

    }
}
