<?php

namespace App\Http\Controllers\Comment;

use App\Comment;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CommentController extends ApiController
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
        $comments = Comment::all();

        return $this->showAll($comments);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $this->showOne($comment);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Comment $comment)
    {
        
        $rules = [
            'score'  => 'numeric|min:0|max:5'
        ];

        $this->validate($request, $rules);

        if($request->has('name')){
            $comment->name = $request->name;
        }

        if($request->has('comment')){
            $comment->comment = $request->comment;
        }

        if($request->has('score')){
            $comment->score = $request->score;
        }

        if (!$comment->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $comment->save();

        return $this->showOne($comment, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return $this->showOne($comment, 200);
    }
}
