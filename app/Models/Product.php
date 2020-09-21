<?php

namespace App\Models;

use App\Traits\SlugMappingTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SlugMappingTrait;

    protected $table = 'products';

    protected $guarded = [
        'id'
    ];
}
