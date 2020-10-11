<?php

namespace Dnsoft\Eav\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    protected $table = 'attribute_options';

    protected $fillable = [
        'name',
        'slug',
        'input_type',
        ''
    ];
}
