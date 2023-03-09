<?php

namespace DnSoft\Eav\Models;

use DnSoft\Media\Traits\HasMediaTraitFileManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use DnSoft\Core\Traits\TranslatableTrait;
use DnSoft\Media\Traits\HasMediaTrait;
use Rinvex\Cacheable\CacheableEloquent;

/**
 * DnSoft\Eav\Models\AttributeOption
 *
 * @property int $id
 * @property int|null $attribute_id
 * @property string|null $value
 * @property bool $is_default
 * @property bool $show_frontend
 * @property int|null $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Dnsoft\Eav\Models\Attribute|null $attribute
 * @method static \Rinvex\Cacheable\EloquentBuilder|\Dnsoft\Eav\Models\AttributeOption newModelQuery()
 * @method static \Rinvex\Cacheable\EloquentBuilder|\Dnsoft\Eav\Models\AttributeOption newQuery()
 * @method static \Rinvex\Cacheable\EloquentBuilder|\Dnsoft\Eav\Models\AttributeOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\AttributeOption whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\AttributeOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\AttributeOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\AttributeOption whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\AttributeOption whereShowFrontend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\AttributeOption whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\AttributeOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\AttributeOption whereValue($value)
 * @mixin \Eloquent
 */
class AttributeOption extends Model
{
//    use CacheableEloquent;
    use TranslatableTrait;
    use HasMediaTraitFileManager;
//    use HasMediaTrait;
    protected $fillable = [
        'attribute_id',
        'value',
        'is_default',
        'show_frontend',
        'sort_order',
        'image',
    ];

    public $translatable = [
        'value',
    ];

    protected $casts = [
        'is_default'    => 'boolean',
        'show_frontend' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort_order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'ASC');
        });
    }

    public function attribute(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    public function setImageAttribute($value)
    {
        $this->mediaAttributes['eav_image'] = $value;
    }

    public function getImageAttribute()
    {
        return $this->getFirstMedia('product/attribute', 'eav_image');
    }
}
