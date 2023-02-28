@singleFile([
    'name' => $attribute->slug,
    'label' => $attribute->name,
    'type' => 'image',
    'id' => $attribute->name,
    'idHolder' => $attribute->name.'Holder',
    'files' => $attribute->name.'File',
])