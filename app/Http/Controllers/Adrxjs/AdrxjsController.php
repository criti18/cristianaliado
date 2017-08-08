<?php

namespace App\Http\Controllers\Adrxjs;

use App\Adrxjs;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class AdrxjsController extends ApiController
{

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
            'user'      => 'required',
            'pass'      => 'required|min:6|confirmed'
        ];

        $this->validate($request, $rules);

        $campos = $request->all();
        $campos['pass'] = bcrypt($request->password);


        $adrxjs = Adrxjs::create($campos);


        return $this->showOne($adrxjs, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adrxjs $adrxjs)
    {
        $adrxjs->delete();

        return $this->showOne($adrxjs, 200);
    }
}
