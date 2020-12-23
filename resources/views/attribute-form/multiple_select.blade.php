@selecth([
    'name' => $attribute->slug,
    'label' => $attribute->name,
    'multiple' => true,
    'allowClear' => true,
    'options' => get_attribute_option_values($attribute)
])
