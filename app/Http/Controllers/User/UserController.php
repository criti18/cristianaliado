<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:api')->only(['update', 'destroy', 'aboutMe']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::where('activation', 1)->get();

        return $this->showAll($usuarios);
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
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed'
        ];

        $this->validate($request, $rules);

        $campos = $request->all();
        $campos['image1'] = (isset($params->image1)) ? $params->image1 : 'null';
        $campos['image2'] = (isset($params->image2)) ? $params->image2 : 'null';
        $campos['image3'] = (isset($params->image3)) ? $params->image3 : 'null';
        $campos['password'] = bcrypt($request->password);
        $campos['activation'] = User::USUARIO_NO_ACTIVADO;
        $campos['activationToken'] = User::generarVerificationToken();
        $campos['cral'] = 0;


        $usuario = User::create($campos);


        return $this->showOne($usuario, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return $this->showOne($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'password'  => 'min:6|confirmed'
        ];

        $this->validate($request, $rules);
        
        if($request->has('name')){
            $user->name = $request->name;
        }

        if($request->has('city')){
            $user->city = $request->city;
        }

        if($request->has('address')){
            $user->address = $request->address;
        }

        if($request->has('phone')){
            $user->phone = $request->phone;
        }
        if($request->has('experience')){
            $user->experience = $request->experience;
        }
        if($request->has('affiliations')){
            $user->affiliations = $request->affiliations;
        }
        if($request->has('nameCo')){
            $user->nameCo = $request->nameCo;
        }
        if($request->has('siteW')){
            $user->siteW = $request->siteW;
        }
        if($request->has('services')){
            $user->services = $request->services;
        }

        if($request->has('abstract')){
            $user->abstract = $request->abstract;
        }
        if($request->has('cedula')){
            $user->cedula = $request->cedula;
        }
        if($request->has('businessName')){
            $user->businessName = $request->businessName;
        }
        
        if($request->has('rfc')){
            $user->rfc = $request->rfc;
        }
        
        if($request->has('razonSocial')){
            $user->razonSocial = $request->razonSocial;
        }

        if($request->has('nameLegal')){
            $user->nameLegal = $request->nameLegal;
        }

        if($request->has('tipoCedula')){
            $user->tipoCedula = $request->tipoCedula;
        }

        if($request->has('longitude')){
            $user->longitude = $request->longitude;
        }

        if($request->has('latitude')){
            $user->latitude = $request->latitude;
        }

        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }

        if($request->hasFile('image1')){
            Storage::delete($user->image1);
            $user->image1 = $request->image1->store('');
        }
        
        if($request->hasFile('image2')){
            Storage::delete($user->image2);
            $user->image2 = $request->image2->store('');
        }

        if($request->hasFile('image3')){
            Storage::delete($user->image3);
            $user->image3 = $request->image3->store('');
        }

        if($request->has('agenteTipo')){
            $user->agenteTipo = $request->agenteTipo;
        }

        if($request->has('especial1')){
            $user->especial1 = $request->especial1;
        }

        if($request->has('especial2')){
            $user->especial2 = $request->especial2;
        }

        if($request->has('especial3')){
            $user->especial3 = $request->especial3;
        }

        if (!$user->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $user->save();

        return $this->showOne($user, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete($user->image1, $user->image2, $user->image3);

        $user->delete();

        return $this->showOne($user, 200);
    }

    public function verify($token)
    {
        $user = User::where('activationToken', $token)->firstOrFail();

        $user->activation = User::USUARIO_ACTIVADO;
        $user->activationToken = null;

        $user->save();

        return $this->showMessage('la cuenta ha sido verificada');
    }

    public function aboutMe()
    {
       $user = Auth::user();

       return $user;
    }

    public function agentes()
    {
       $usuarios = User::where('activation', 0)->get();

        return $this->showAll($usuarios);
    }
}
