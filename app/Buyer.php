<?php

namespace App;

use App\Contact;
use App\Insurance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends Model
{
    
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
    'name',
    'email',
    'phone',
    'password'
    ];

    public function contacts()
    {
    	return $this->hasMany(Contact::class);
    }

    public function insurances()
    {
    	return $this->hasMany(Insurance::class);
    }

}
