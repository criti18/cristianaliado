<?php

namespace App;

use App\Buyer;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contact extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    const CONTACTO_ATENCION = '1';
    const CONTACTO_NO_ATENCION = '0';

    const CONTACTO_COMPRO = '1';
    const CONTACTO_NO_COMPRO = '0';

    protected $fillable = [
    'user_id',
    'buyer_id',
    'message',
    'services',
    'attention',
    'buy'
    ];

    public function atencionBuyer()
    {
    	return $this->attention = Contact::CONTACTO_ATENCION;
    }

    public function comproBuyer()
    {
    	return $this->buy = Contact::CONTACTO_COMPRO;
    }

    public function users(){
    	return $this->belongTo(User::class);
    }

    public function buyers(){
    	return $this->belongsTo(Buyer::class);
    }
}
