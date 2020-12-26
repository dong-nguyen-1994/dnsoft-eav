<?php

namespace Dnsoft\Eav\Models\Type;

use Dnsoft\Media\Traits\HasMediaTrait;
use Rinvex\Attributes\Models\Value;

/**
 * Dnsoft\Eav\Models\Type\Image
 *
 * @property int $id
 * @property int $content
 * @property int $attribute_id
 * @property int $entity_id
 * @property string $entity_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Rinvex\Attributes\Models\Attribute $attribute
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $entity
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dnsoft\Media\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Rinvex\Attributes\Support\ValueCollection|static[] all($columns = ['*'])
 * @method static \Rinvex\Attributes\Support\ValueCollection|static[] get($columns = ['*'])
 * @method static \Rinvex\Cacheable\EloquentBuilder|\Dnsoft\Eav\Models\Type\Image newModelQuery()
 * @method static \Rinvex\Cacheable\EloquentBuilder|\Dnsoft\Eav\Models\Type\Image newQuery()
 * @method static \Rinvex\Cacheable\EloquentBuilder|\Dnsoft\Eav\Models\Type\Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Type\Image whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Type\Image whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Type\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Type\Image whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Type\Image whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Type\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Type\Image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Image extends Value
{
    use HasMediaTrait;

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'content'      => 'integer',
        'attribute_id' => 'integer',
        'entity_id'    => 'integer',
        'entity_type'  => 'string',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('attribute_image_values');
        $this->setRules([
            'content'      => 'required',
            'attribute_id' => 'required|integer|exists:'.config('rinvex.attributes.tables.attributes').',id',
            'entity_id'    => 'required|integer',
            'entity_type'  => 'required|string',
        ]);
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function (Image $model) {
            $model->syncMedia($model->content);
        });
    }
}
