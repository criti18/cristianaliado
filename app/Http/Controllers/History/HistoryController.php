<?php

namespace App\Http\Controllers\History;

use App\History;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class HistoryController extends ApiController
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
        $histories = History::all();

        return $this->showAll($histories);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        return $this->showOne($history);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        $history->delete();

        return $this->showOne($history, 200);
    }
}
