<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'user_payments';

    protected $fillable = [
        'card_number',
        'expiry_month',
        'expiry_year',
        'cvv',
        'user_id',
    ];
}
