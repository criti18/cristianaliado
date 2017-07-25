<?php

namespace App\Http\Controllers\User;

use App\Comment;
use App\Http\Controllers\ApiController;
use Illuminate\Pagination\LengthAwarePaginator;
use App\User;
use Illuminate\Http\Request;

class UserCommentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $comments = $user->comments;
        $totalconteo = 0;
        $conteo = 0;
        $promedio = 0;
        
        if(count($comments) != 0){
        foreach($comments as $valor)
        {
            $conteo++;
            $totalconteo += $valor->score;
        }
        $promedio = $totalconteo / $conteo;
        }
        
        $collection = $this->paginate($comments);

        return response()->json(['data' => $collection,
        'promedio' => $promedio]);
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
            'name'      => 'required',
            'comment'      => 'required',
            'score'      => 'required|integer|min:1|max:5',
        ];

        $this->validate($request, $rules);

        $campos = $request->all();
        $campos['user_id']  =   $user->id;


        $comment = Comment::create($campos);


        return $this->showOne($comment, 201);
    }

}
