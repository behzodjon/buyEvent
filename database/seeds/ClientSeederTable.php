<?php

use Illuminate\Database\Seeder;

class ClientSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Client::class, 10)->create();

    }
}
