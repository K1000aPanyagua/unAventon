<?php

use Illuminate\Database\Seeder;
use App\Usuario;
class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(Usuario::class, 10)->create();
    }
}
