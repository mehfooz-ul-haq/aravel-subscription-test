<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subscription_type',
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
