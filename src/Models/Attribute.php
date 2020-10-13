<?php

namespace Dnsoft\Eav\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Attribute extends Model
{
    protected $table = 'attributes';

    protected $fillable = [
        'name',
        'slug',
        'input_type',
        'description',
        'is_collection',
        'entities',
    ];

    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }

    public function entities()
    {
        return $this->hasMany(AttributeEntity::class, 'attribute_id', 'id');
    }

    /**
     * Access entities relation and retrieve entity types as an array,
     * Accessors/Mutators preceeds relation value when called dynamically.
     *
     * @return array
     */
    public function getEntitiesAttribute(): array
    {
        return $this->entities()->pluck('entity_type')->toArray();
    }

    /**
     * Set the attribute attached entities.
     *
     * @param mixed $entities
     *
     * @return void
     */
    public function setEntitiesAttribute($entities): void
    {
        static::saved(function ($model) use ($entities) {
            $this->entities()->delete();
            ! $entities || $this->entities()->createMany(array_map(function ($entity) {
                return ['entity_type' => $entity];
            }, $entities));
        });
    }
}
