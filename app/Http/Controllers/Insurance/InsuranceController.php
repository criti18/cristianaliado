<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\ApiController;
use App\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends ApiController
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
        $insurances = Insurance::all();

        return $this->showAll($insurances);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Insurance $insurance)
    {
        return $this->showOne($insurance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insurance $insurance)
    {
        
        $rules = [
            'vigencia'  => 'date'
        ];

        $this->validate($request, $rules);


        if($request->has('typeInsurance')){
            $insurance->typeInsurance = $request->typeInsurance;
        }

        if($request->has('aseguradora')){
            $insurance->aseguradora = $request->aseguradora;
        }

        if($request->has('vigencia')){
            $insurance->vigencia = $request->vigencia;
        }

        if($request->has('noPoliz')){
            $insurance->noPoliz = $request->noPoliz;
        }

        if($request->has('telEmergency')){
            $insurance->telEmergency = $request->telEmergency;
        }

        if($request->has('telAsesor')){
            $insurance->telAsesor = $request->telAsesor;
        }

        if($request->has('coverage')){
            $insurance->coverage = $request->coverage;
        }

        if($request->has('exclusions')){
            $insurance->exclusions = $request->exclusions;
        }


        if (!$insurance->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $insurance->save();

        return $this->showOne($insurance, 201);

    }

}
