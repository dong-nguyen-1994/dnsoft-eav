<?php

namespace DnSoft\Eav\Models;

/**
 * Dnsoft\Eav\Models\Attribute
 *
 * @property int $id
 * @property string $slug
 * @property array $name
 * @property array|null $description
 * @property int $sort_order
 * @property string|null $group
 * @property string $type
 * @property string|null $input_type
 * @property bool $is_required
 * @property bool $is_collection
 * @property string|null $default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array $entities
 * @property-read int|null $entities_count
 * @property-read mixed $admin_form
 * @property-read array $translations
 * @property \Illuminate\Database\Eloquent\Collection|\Dnsoft\Eav\Models\AttributeOption[] $options
 * @property-read int|null $options_count
 * @method static \Rinvex\Cacheable\EloquentBuilder|\Dnsoft\Eav\Models\Attribute newModelQuery()
 * @method static \Rinvex\Cacheable\EloquentBuilder|\Dnsoft\Eav\Models\Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Rinvex\Attributes\Models\Attribute ordered($direction = 'asc')
 * @method static \Rinvex\Cacheable\EloquentBuilder|\Dnsoft\Eav\Models\Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereInputType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereIsCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dnsoft\Eav\Models\Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attribute extends \Rinvex\Attributes\Models\Attribute
{
  protected $fillable = [
    'name',
    'slug',
    'description',
    'sort_order',
    'group',
    'type',
    'input_type',
    'is_required',
    'is_collection',
    'default',
    'entities',
    'options'
  ];

  public static function getTypeMap(): array
  {
    return self::$typeMap;
  }

  public function options(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(AttributeOption::class);
  }

  public function getAdminFormAttribute(): string
  {
    $version = get_version_actived();
    return "eav::$version.admin.attribute-form." . $this->input_type;
  }

  public function setOptionsAttribute($options)
  {
    $oldOptionIds = $this->options()->pluck('id')->toArray();
    $inputOptionIds = collect($options)->pluck('id')->map(function ($item) {
      return (int) $item;
    })->toArray();
    $removeOptionIds = array_values(array_diff($oldOptionIds, $inputOptionIds));

    static::saved(function ($model) use ($removeOptionIds, $options) {
      $this->options()->whereIn('id', $removeOptionIds)->delete();

      $i = 1;
      foreach ($options as $option) {
        if (!empty($option['value'])) {
          $this->options()->updateOrCreate([
            'id' => $option['id'] ?? 0,
          ], [
            'title'      => $option['title'],
            'value'      => $option['value'],
            'color'      => $option['color'],
            // 'image'      => $option['image'] ?? null,
            'is_default' => $option['is_default'] ?? 0,
            'sort_order' => $i++,
          ]);
        }
      }
    });
  }
}
