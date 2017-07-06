<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

////para ejecutar esto en cmd php artisan db:seed --class=sociosTableSeeder
$factory->define(App\socio::class, function(Faker\Generator 
	$faker){
	return [

        'nombre' => $faker->name,
        'apellido' => $faker->lastName,
        'fechaNac'=>$faker->dateTime,
       //'dui'=>$faker->numberBetween('11111111111','99999999911'),
        'dui'=>$faker->realText(random_int(10,10)),
        'direccion'=>$faker->name,//realText(random_int(20,30)),
		//'telefono'=>$faker->number(9).to_i=>['999999999'],   
        'telefono'=>$faker->realText(random_int(10,11)),   
        //'email' => $faker->unique()->safeEmail,
		'apodo' => $faker->name,
        'tipoSocio' => $faker->randomElement(['Socio Activo','Activo Mayor']),
        'cargo' => $faker->randomElement(['Presidente','Secretario','Tesorero']),
        
		//'content'=>$faker->realText(random_int(20,160)),
		//'image'=>$faker->imageUrl(600,338),
        'created_at'=>$faker->dateTimeThisDecade,
        'updated_at'=>$faker->dateTimeThisDecade,

	];
});
