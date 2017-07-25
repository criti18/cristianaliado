<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;

class UserCategoryController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $categories = $user->categories;

        return $this->showAll($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Category $category)
    {
        $user->categories()->syncWithoutDetaching([$category->id]);

        return $this->showAll($user->categories);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Category $category)
    {
        if (!$user->categories()->find($category->id)) {
            return $this->errorResponse('La categoria especificada no existe', 404);
        }

        $user->categories()->detach([$category->id]);

        return $this->showAll($user->categories);
    }

}
