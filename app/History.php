<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
    'user_id',
    'quantity',
    'concept'
    ];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
}
