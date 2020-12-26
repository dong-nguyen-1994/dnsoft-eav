<?php

use Dnsoft\Eav\EavServiceProvider;
use Dnsoft\Eav\Models\AttributeOption;
use Dnsoft\Eav\Repositories\AttributeRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

if (!function_exists('eav_entity')) {
    /**
     * Get EAV Entity Collection
     *
     * @return Collection|mixed
     */
    function eav_entity()
    {
        return app('rinvex.attributes.entities');
    }
}

if (!function_exists('eav_attribute')) {
    /**
     * Get EAV Attribute Model
     *
     * @return \Dnsoft\Eav\Models\Attribute|Builder
     */
    function eav_attribute()
    {
        return app(AttributeRepositoryInterface::class);
    }
}

if (!function_exists('get_attribute_option_values'))
{
    /**
     * Get Attribute Option Values
     *
     * @param  \Dnsoft\Eav\Models\Attribute  $attribute
     * @return array
     */
    function get_attribute_option_values($attribute): array
    {
        $items = [];

        foreach ($attribute->options as $option) {
            $items[] = [
                'id'    => $option->id,
                'label' => $option->value,
                'value' => $option->id,
            ];
        }

        return $items;
    }
}

if (!function_exists('get_attribute_option_value')) {
    /**
     * Get attribute option value from eav
     *
     * @param $optionId
     * @return string
     */
    function get_attribute_option_value($optionId): string
    {
        $attributeOption = AttributeOption::find($optionId);
        if ($attributeOption) {
            return $attributeOption->value;
        }

        return $optionId;
    }
}

if (!function_exists('get_attribute_input_type_options')) {
    /**
     * Get Attribute Input Type Options
     *
     * @return array
     */
    function get_attribute_input_type_options(): array
    {
        return collect(EavServiceProvider::$mapInputType)
            ->map(function ($item, $key) {
                return [
                    'label' => get_attribute_input_type_label($key),
                    'value' => $key,
                ];
            })
            ->toArray();
    }
}

if (!function_exists('get_attribute_input_type_label')) {
    /**
     * Get Attribute Input Type Label
     *
     * @param $key
     * @return string
     */
    function get_attribute_input_type_label($key): string
    {
        $tranKey = 'eav::attribute.map_input_type.'.$key;

        return Lang::has($tranKey) ? Lang::get($tranKey) : Str::ucfirst(Str::camel($key));
    }
}

if (!function_exists('get_all_attributes_of_type')) {
    /**
     * Get all attribute of entity type
     *
     * @param $entityType
     * @return Collection
     */
    function get_all_attributes_of_type($entityType): Collection
    {
        return app(AttributeRepositoryInterface::class)->all($entityType);
    }
}
