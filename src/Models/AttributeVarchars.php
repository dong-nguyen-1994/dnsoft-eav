<?php

namespace Dnsoft\Eav\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeVarchars extends Model
{
    protected $table = 'attribute_varchars';

    protected $fillable = [
        'name',
        'slug',
        'input_type',
        ''
    ];
}
