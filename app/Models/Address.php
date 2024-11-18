<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'user_address';

    protected $fillable = [
        'address_1',
        'address_2',
        'postal_code',
        'state_province',
        'country',
        'user_id',
    ];
}
