<?php

use Dnsoft\Eav\EavServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Dnsoft\Eav\Repositories\AttributeRepositoryInterface;

if (!function_exists('get_attribute_input_type_options')) {
    /**
     * Get Attribute Input Type Options
     *
     * @return array
     */
    function get_attribute_input_type_options()
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
    function get_attribute_input_type_label($key)
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
    function get_all_attributes_of_type($entityType)
    {
        return app(AttributeRepositoryInterface::class)->all($entityType);
    }
}
