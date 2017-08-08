<?php

use App\Adrxjs;
use App\Aseguradora;
use App\Buyer;
use App\Category;
use App\Comment;
use App\Contact;
use App\History;
use App\Insurance;
use App\Message;
use App\User;

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
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'		=> $faker->name,
        'email'		=> $faker->unique()->safeEmail,
        'password'	=> $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'city'   => $faker->city,
	    'address'	=> $faker->word,
	    'phone'		=> $faker->word,
        'experience'	=> $faker->word,
        'affiliations'	=> $faker->word,
        'timeAt'		=> $faker->datetime,
        'nameCo'	=> $faker->word,
        'siteW'		=> $faker->word,
        'services'	=> $faker->paragraph(1),
        'abstract'	=> $faker->paragraph(1),
        'cedula'	=> $faker->word,
        'businessName'	=> $faker->word,
        'rfc'			=> $faker->word,
        'razonSocial'	=> $faker->word,
        'cral'		=> $faker->numberBetween(1, 50),
        'nameLegal'	=> $faker->word,
        'activation'		=> $activation = $faker->randomElement([User::USUARIO_ACTIVADO, User::USUARIO_NO_ACTIVADO]),
        'activationToken'	=> $faker->word,
        'tipoCedula'		=> $faker->word,
        'longitude'	=> $faker->numberBetween(1, 50),
        'latitude'	=> $faker->numberBetween(1, 50),
        'agenteTipo'     => $faker->word,
        'especial1'     => $faker->word,
        'especial2'     => $faker->word,
        'especial3'     => $faker->word,
    ];
});

$factory->define(Adrxjs::class, function (Faker\Generator $faker) {

    return [
        'name'		=> $faker->name,
        'user'		=> $faker->unique()->safeEmail,
        'pass'		=> $faker->word,
        'rol'		=> $faker->word,
    ];
});

$factory->define(Aseguradora::class, function (Faker\Generator $faker) {

    return [
        'name'		=> $faker->name
    ];
});

$factory->define(Buyer::class, function (Faker\Generator $faker) {
	static $password;

    return [
        'name'			=> $faker->name,
        'email'			=> $faker->unique()->safeEmail,
        'phone'			=> $faker->word,
        'password'		=> $password ?: $password = bcrypt('secret'),
    ];
});

$factory->define(Category::class, function (Faker\Generator $faker) {

    return [
        'name'		=> $faker->name
    ];
});

$factory->define(Comment::class, function (Faker\Generator $faker) {

    return [
        'name'			=> $faker->name,
        'user_id'		=> User::all()->random()->id,
        'comment'		=> $faker->word,
        'score'			=> $faker->numberBetween(1, 5),
    ];
});

$factory->define(Contact::class, function (Faker\Generator $faker) {

    return [
        'user_id'		=> User::all()->random()->id,
        'buyer_id'		=> Buyer::all()->random()->id,
        'message'		=> $faker->word,
        'services'		=> $faker->word,
        'attention'		=> $attention = $faker->randomElement([Contact::CONTACTO_ATENCION, Contact::CONTACTO_NO_ATENCION]),
        'buy'			=> $buy = $faker->randomElement([Contact::CONTACTO_COMPRO, Contact::CONTACTO_NO_COMPRO]),
    ];
});

$factory->define(History::class, function (Faker\Generator $faker) {

    return [
        'user_id'		=> User::all()->random()->id,
        'quantity'		=> $faker->numberBetween(1, 5),
        'concept'		=> $faker->word,
    ];
});

$factory->define(Insurance::class, function (Faker\Generator $faker) {

    return [
        'buyer_id'			=> Buyer::all()->random()->id,
        'user_id'           => User::all()->random()->id,
        'typeInsurance'		=> $faker->word,
        'aseguradora'		=> $faker->word,
        'vigencia'			=> $faker->datetime,
        'noPoliz'			=> $faker->word,
        'telEmergency'		=> $faker->word,
        'telAsesor'			=> $faker->word,
        'coverage'			=> $faker->paragraph(1),
        'exclusions'		=> $faker->paragraph(1),
    ];
});

$factory->define(Message::class, function (Faker\Generator $faker) {

    return [
        'name'			=> $faker->name,
        'email'			=> $faker->word,
        'phone'			=> $faker->word,
        'message'		=> $faker->word,
        'reason'		=> $faker->word,
    ];
});