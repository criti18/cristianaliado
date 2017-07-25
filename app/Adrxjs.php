<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adrxjs extends Model
{
    
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
    'name',
    'user',
    'pass',
    'rol',
    ];
}
