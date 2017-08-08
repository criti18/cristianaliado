<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aseguradora extends Model
{
    
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
    'name'
    ];

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

}
