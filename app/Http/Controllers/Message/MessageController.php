<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\ApiController;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:api')->except(['store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();

        return $this->showAll($messages);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email'
        ];

        $this->validate($request, $rules);

        $campos = $request->all();


        $message = Message::create($campos);


        return $this->showOne($message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return $this->showOne($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return $this->showOne($message, 200);
    }
}
