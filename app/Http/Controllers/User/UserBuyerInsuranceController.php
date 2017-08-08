<?php

namespace App\Http\Controllers\User;

use App\Buyer;
use App\Http\Controllers\ApiController;
use App\Insurance;
use App\User;
use Illuminate\Http\Request;

class UserBuyerInsuranceController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Buyer $buyer)
    {

            $campos = $request->all();
            
            $campos['buyer_id']  =   $buyer->id;
            $campos['user_id']  =   $user->id;

            $insurances = Insurance::create($campos);



         return $this->showOne($insurances, 201);

    }

}
