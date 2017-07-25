<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Concerns\belongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
    'user_id',
    'name',
    'comment',
    'score'
    ];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
}
