@foreach(get_all_attributes_of_type($entityType) as $attribute)
    <div class="{{ $attribute->input_type }}">
        @includeIf($attribute->admin_form)
    </div>
@endforeach
