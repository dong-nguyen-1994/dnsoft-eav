<?php

namespace Dnsoft\Eav\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeVarchar extends Model
{
    protected $table = 'attribute_varchar';

    protected $fillable = [
        'name',
        'slug',
        'input_type',
        ''
    ];
}
