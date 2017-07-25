<?php

namespace App\Http\Controllers\Aseguradora;

use App\Aseguradora;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class AseguradoraUserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aseguradora $aseguradora)
    {
        $users = $aseguradora->users;

        return $this->showAll($users);
    }

}
