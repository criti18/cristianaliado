<?php

namespace App\Http\Controllers\User;

use App\History;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;

class UserHistoryController extends ApiController
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
        $histories = $user->histories;

        return $this->showAll($histories);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $rules = [
            'quantity'      => 'required'
        ];

        $this->validate($request, $rules);

        $campos = $request->all();
        $campos['user_id']  =   $user->id;


        $history = History::create($campos);


        return $this->showOne($history, 201);
    }

}
