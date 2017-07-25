<?php

namespace App\Http\Controllers\Aseguradora;

use App\Aseguradora;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class AseguradoraController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aseguradoras = Aseguradora::all();

        return response()->json($aseguradoras);


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
            'name'      => 'required'
        ];

        $this->validate($request, $rules);

        $campos = $request->all();


        $aseguradora = Aseguradora::create($campos);


        return $this->showOne($aseguradora, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Aseguradora $aseguradora)
    {

        return $this->showOne($aseguradora);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aseguradora $aseguradora)
    {
        
        if($request->has('name')){
            $aseguradora->name = $request->name;
        }

        if (!$aseguradora->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $aseguradora->save();

        return $this->showOne($aseguradora, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aseguradora $aseguradora)
    {
        $aseguradora->delete();

        return $this->showOne($aseguradora, 200);
    }
}
