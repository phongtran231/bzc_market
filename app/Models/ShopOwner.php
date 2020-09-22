<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ShopOwner extends Authenticatable
{
    use Notifiable;

    protected $table = 'shop_owners';

    protected $hidden = [
        'password', 'remember_token',
    ];
}
