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
            $room->name = 'hab_'."$i";
            $room->office_id = 1;
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

        DB::table('communes')->insert([
            ['id'=>1,'name' => 'Cerrillos'],
            ['id'=>2,'name' => 'Cerro Navia'],
            ['id'=>3,'name' => 'Conchalí' ],
            ['id'=>4,'name' => 'El Bosque' ],
            ['id'=>5,'name' => 'Estación Central'],
            ['id'=>6,'name' => 'Huechuraba'],
            ['id'=>7,'name' => 'Independencia'],
            ['id'=>8,'name' => 'La Cisterna'],
            ['id'=>9,'name' => 'La Granja'],
            ['id'=>10,'name' => 'La Florida' ],
            ['id'=>11,'name' => 'La Pintana'  ],
            ['id'=>12,'name' => 'La Reina'  ],
            ['id'=>13,'name' => 'Las Condes'  ],
            ['id'=>14,'name' => 'Lo Barnechea'  ],
            ['id'=>15,'name' => 'Lo Espejo'  ],
            ['id'=>16,'name' => 'Lo Prado' ],
            ['id'=>17,'name' => 'Macul' ],
            ['id'=>18,'name' => 'Maipú' ],
            ['id'=>19,'name' => 'Ñuñoa' ],
            ['id'=>20,'name' => 'Pedro Aguirre Cerda' ],
            ['id'=>21,'name' => 'Peñalolén' ],
            ['id'=>22,'name' => 'Providencia' ],
            ['id'=>23,'name' => 'Pudahuel' ],
            ['id'=>24,'name' => 'Quilicura' ],
            ['id'=>25,'name' => 'Quinta Normal' ],
            ['id'=>26,'name' => 'Recoleta' ],
            ['id'=>27,'name' => 'Renca' ],
            ['id'=>28,'name' => 'San Miguel' ],
            ['id'=>29,'name' => 'San Joaquín' ],
            ['id'=>30,'name' => 'San Ramón' ],
            ['id'=>31,'name' => 'Santiago' ],
            ['id'=>32,'name' => 'Vitacura' ]
        ]);


    }
}
