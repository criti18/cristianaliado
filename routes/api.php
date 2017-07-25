<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*Usuers*/
Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);
Route::resource('users.aseguradoras', 'User\UserAseguradoraController', ['only' => ['index', 'update', 'destroy']]);
Route::resource('users.histories', 'User\UserHistoryController', ['only' => ['index', 'store']]);
Route::resource('users.categories', 'User\UserCategoryController', ['only' => ['index', 'update', 'destroy']]);
Route::resource('users.comments', 'User\UserCommentController', ['only' => ['index', 'store']]);
Route::resource('users.contacts', 'User\UserContactController', ['only' => ['index', 'store']]);
Route::resource('users.insurances', 'User\UserInsuranceController', ['only' => ['index']]);
Route::resource('users.buyers.insurances', 'User\UserBuyerInsuranceController', ['only' => ['store']]);
Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');
Route::get('/me', 'User\UserController@aboutMe'); 


/*Adrxjs*/
Route::resource('adrxjs', 'Adrxjs\AdrxjsController', ['only' => ['store', 'destroy']]);

/*Aseguradoras*/
Route::resource('aseguradoras', 'Aseguradora\AseguradoraController', ['except' => ['create', 'edit']]);
Route::resource('aseguradoras.users', 'Aseguradora\AseguradoraUserController', ['only' => ['index']]);

/*Buyers*/
Route::resource('buyers', 'Buyer\BuyerController', ['except' => ['create', 'edit', 'store']]);
Route::resource('buyers.insurances', 'Buyer\BuyerInsuranceController', ['only' => ['index']]);
Route::resource('buyers.contacts', 'Buyer\BuyerContactController', ['only' => ['index']]);

/*Categories*/
Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit']]);
Route::resource('categories.users', 'Category\CategoryUserController', ['only' => ['index']]);

/*Comments*/
Route::resource('comments', 'Comment\CommentController', ['except' => ['create', 'edit', 'store']]);

/*Contacts*/
Route::resource('contacts', 'Contact\ContactController', ['except' => ['create', 'edit', 'store']]);

/*Histories*/
Route::resource('histories', 'History\HistoryController', ['only' => ['index', 'show', 'destroy']]);

/*Insurances*/
Route::resource('insurances', 'Insurance\InsuranceController', ['only' => ['index', 'show', 'update']]);

/*Messages*/
Route::resource('messages', 'Message\MessageController', ['except' => ['create', 'edit', 'update']]);

Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken' );