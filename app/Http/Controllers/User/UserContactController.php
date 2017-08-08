<?php

namespace App\Http\Controllers\User;

use App\Buyer;
use App\Contact;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserContactController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:api')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $contacts = $user->contacts;

        return $this->showAll($contacts);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        
        $buyers = DB::table('buyers')->where('email', $request->input('email'))->first();

        if($buyers == null)
        {
            $rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:buyers',
            'phone'     => 'required'
            ];

            $this->validate($request, $rules);

            $campos = $request->only(['name', 'email', 'phone', 'password']);
            $campos['password'] = "123456";

            $buyer = Buyer::create($campos);

            $camposContact = $request->except(['name', 'email', 'phone', 'password']);
            $camposContact['buyer_id'] = $buyer->id;
            $camposContact['user_id'] = $user->id;
            $camposContact['attention'] = Contact::CONTACTO_NO_ATENCION;
            $camposContact['buy'] = Contact::CONTACTO_NO_COMPRO;

            $creditos = $user->cral - 1;
            $user->save();

            $contacto = Contact::create($camposContact);

            return $this->showOne($buyer, 201);
        }else{
            
            $camposContact = $request->except(['name', 'email', 'phone', 'password']);
            $camposContact['buyer_id'] = $buyers->id;
            $camposContact['user_id'] = $user->id;
            $camposContact['attention'] = Contact::CONTACTO_NO_ATENCION;
            $camposContact['buy'] = Contact::CONTACTO_NO_COMPRO;

            $contacto = Contact::create($camposContact);

            return $this->showOne($contacto, 201);
        }

    }

}
