<?php

namespace Dnsoft\Eav\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    const TEXT = 'text';
    const BOOLEAN = 'boolean';
    const INTEGER = 'integer';
    const VARCHAR = 'varchar';
    const DATETIME = 'datetime';
    const IMAGE = 'image';
    const MULTIPLE_SELECT = 'select';

    protected $table = 'attributes';

    protected $fillable = [
        'name',
        'slug',
        'input_type',
        ''
    ];

    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }

    public function entities()
    {
        return $this->hasMany(AttributeEntity::class, 'attribute_id', 'id');
    }
}
