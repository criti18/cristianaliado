<?php

namespace App;

use App\Category;
use App\Comment;
use App\Contact;
use App\History;
use App\Insurance;
use App\UsersImage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    protected $dates = ['deleted_at'];
    const USUARIO_ACTIVADO = '1';
    const USUARIO_NO_ACTIVADO = '0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'address',
        'phone',
        'experience',
        'affiliations',
        'timeAt',
        'nameCo',
        'image1',
        'image2',
        'image3',
        'siteW',
        'services',
        'abstract',
        'cedula',
        'businessName',
        'rfc',
        'razonSocial',
        'cral',
        'nameLegal',
        'activation',
        'activationToken',
        'tipoCedula',
        'longitude',
        'latitude',
        'agenteTipo',
        'especial1',
        'especial2',
        'especial3'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function esActivado()
    {
        return $this->activation == User::USUARIO_ACTIVADO;
    }

    public static function generarVerificationToken()
    {
        return str_random(40);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function aseguradoras()
    {
        return $this->belongsToMany(Aseguradora::class);
    }

    public function insurances()
    {
        return $this->hasMany(Insurance::class);
    }
    
}
