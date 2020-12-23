<?php

namespace Dnsoft\Eav\Traits;

use Illuminate\Database\Eloquent\Collection;
use Dnsoft\Eav\Events\EntityWasDeleted;
use Dnsoft\Eav\Events\EntityWasSaved;
use Rinvex\Attributes\Models\Value;
use Rinvex\Attributes\Scopes\EagerLoadScope;
use Rinvex\Attributes\Support\ValueCollection;
use Rinvex\Attributes\Traits\Attributable;

trait HasAttributeTrait
{
    use Attributable;
//    public function initializeHasAttributeTrait()
//    {
//        $this->with[] = 'eav';
//    }

    /**
     * Get the entity attributes.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEntityAttributes(): Collection
    {
        $morphClass = $this->getMorphClass();
        static::$entityAttributes = static::$entityAttributes ?? collect();

        if (!static::$entityAttributes->has($morphClass)) {
            $locale = app()->getLocale();

            $attributes = app('rinvex.attributes.attribute_entity')->where('entity_type', $morphClass)->get()->pluck('attribute_id');
            static::$entityAttributes->put($morphClass, app('rinvex.attributes.attribute')->whereIn('id', $attributes)->orderBy('sort_order', 'ASC')->orderBy("name->\${$locale}", 'ASC')->get()->keyBy('slug'));
        }

        return static::$entityAttributes->get($morphClass) ?? new Collection();
    }

    public static function bootAttributable()
    {
        static::addGlobalScope(new EagerLoadScope());
        static::saved(EntityWasSaved::class.'@handle');
        static::deleted(EntityWasDeleted::class.'@handle');
    }

    protected function getEntityAttributeValue(string $key)
    {
        $value = $this->getEntityAttributeRelation($key);

        if ($this->getEntityAttributes()->get($key)->is_collection) {
            return $value ? $value->pluck('content') : new Collection();
        }

        return ! is_null($value) ? $value->getAttribute('content') : null;
    }
}
