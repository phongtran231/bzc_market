<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SlugMapping extends Model
{
    protected $table = 'slug_mappings';

    protected $guarded = [
        'id'
    ];

    public $timestamps = false;

    protected $primaryKey = null;

    public $incrementing = false;

}
