<?php

use Illuminate\Database\Seeder;

class sociosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
////para ejecutar esto en cmd php artisan db:seed --class=sociosTableSeeder

    public function run()
    {
        //
        factory(App\socio::class)
        ->times(10)
        ->create();
    }
}
