<?php

namespace Dnsoft\Eav\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attribute_image';

    protected $fillable = [
        'name',
        'slug',
        'input_type',
        ''
    ];
}
