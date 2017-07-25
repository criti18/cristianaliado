<?php

namespace App\Http\Controllers\Contact;

use App\Contact;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class ContactController extends ApiController
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
    public function index()
    {
        $contacts = Contact::all();

        return $this->showAll($contacts);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return $this->showOne($contact);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $rules = [
            'attention' => 'boolean',
            'buy'       => 'boolean'
        ];

        $this->validate($request, $rules);

        if($request->has('attention')){
            $contact->attention = $request->attention;
        }

        if($request->has('buy')){
            $contact->buy = $request->buy;
        }

        if (!$contact->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $contact->save();

        return $this->showOne($contact, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return $this->showOne($contact, 200);
    }
}
