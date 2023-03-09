@selecth([
    'name' => $attribute->slug,
    'label' => $attribute->name,
    'allowClear' => true,
    'options' => get_attribute_option_values($attribute)
])
