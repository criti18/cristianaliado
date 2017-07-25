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
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Adrxjs::truncate();
        Aseguradora::truncate();
        Buyer::truncate();
        Category::truncate();
        Comment::truncate();
        Contact::truncate();
        History::truncate();
        Insurance::truncate();
        Message::truncate();
        DB::table('category_user')->truncate();
        DB::table('aseguradora_user')->truncate();

        User::flushEventListeners();
        Aseguradora::flushEventListeners();
        Buyer::flushEventListeners();
        Message::flushEventListeners();
        Comment::flushEventListeners();
        Contact::flushEventListeners();
        History::flushEventListeners();

        $cantidadUser = 200;
        $cantidadAdrxjs = 10;
        $cantidadAseguradora = 90;
        $cantidadBuyer = 200;
        $cantidadCategory = 5;
        $cantidadComment = 150;
        $cantidadContact = 300;
        $cantidadHistory = 100;
        $cantidadInsurance = 50;
        $cantidadMessage = 80;

        factory(Adrxjs::class, $cantidadAdrxjs)->create();
        factory(Aseguradora::class, $cantidadAseguradora)->create();
        factory(Buyer::class, $cantidadBuyer)->create();
        factory(Category::class, $cantidadCategory)->create();

        factory(User::class, $cantidadUser)->create()->each(
        	function ($user){
        		$categorias = Category::all()->random(mt_rand(1,5))->pluck('id');
        		$aseguradoras = Aseguradora::all()->random(mt_rand(1,5))->pluck('id');

        		$user->categories()->attach($categorias);
        		$user->aseguradoras()->attach($aseguradoras);
        	}
        	);

        factory(Comment::class, $cantidadComment)->create();
        factory(Contact::class, $cantidadContact)->create();
        factory(History::class, $cantidadHistory)->create();
        factory(Insurance::class, $cantidadInsurance)->create();
        factory(Message::class, $cantidadMessage)->create();


    }
}
