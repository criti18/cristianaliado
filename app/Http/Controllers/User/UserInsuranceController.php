<?php

namespace App\Http\Controllers\User;

use App\Buyer;
use App\Http\Controllers\ApiController;
use App\User;
use App\insurances;
use Illuminate\Http\Request;

class UserInsuranceController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $insurances = $user->insurances;

        return $this->showAll($insurances);
    }

}
