<?php

namespace App;

use App\Buyer;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends Model
{
    
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
    'buyer_id',
    'user_id',
    'typeInsurance',
    'aseguradora',
    'vigencia',
    'noPoliz',
    'telEmergency',
    'telAsesor',
    'coverage',
    'exclusions'
    ];

    public function buyers()
    {
        $this->belongsTo(Buyer::class);
    }

    public function users()
    {
        $this->belongsTo(User::class);
    }
    
}