@input(['name' => 'name', 'label' => __('eav::attribute.name'), 'is_margin' => true])

@select([
    'name' => 'input_type',
    'label' => __('eav::attribute.input_type'),
    'options' => get_attribute_input_type_options(),
    'default' => 'text',
    'disabled' => object_get($item, 'exists'),
    'is_margin' => true
])
