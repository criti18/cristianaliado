<?php

namespace App\Http\Controllers\User;

use App\Aseguradora;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;

class UserAseguradoraController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $aseguradoras = $user->aseguradoras;

        return $this->showAll($aseguradoras);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Aseguradora $aseguradora)
    {
        $user->aseguradoras()->syncWithoutDetaching([$aseguradora->id]);

        return $this->showAll($user->aseguradoras);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Aseguradora $aseguradora)
    {
        if (!$user->aseguradoras()->find($aseguradora->id)) {
            return $this->errorResponse('La aseguradora especificada no existe', 404);
        }

        $user->aseguradoras()->detach([$aseguradora->id]);

        return $this->showAll($user->aseguradoras);
    }

}
