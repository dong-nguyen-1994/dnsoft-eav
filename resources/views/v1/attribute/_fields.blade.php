@input(['name' => 'name', 'label' => __('eav::attribute.name')])
@slug([
    'name' => 'slug',
    'label' => __('eav::attribute.slug'),
    'disabledx' => object_get($item, 'exists'),
    'field_slug' => 'name'
])
@select([
    'name' => 'input_type',
    'label' => __('eav::attribute.input_type'),
    'options' => get_attribute_input_type_options(),
    'default' => 'text',
    'disabled' => object_get($item, 'exists')
])

<div class="form-group" id="groupOptionValue" style="display: none;">
    <label for="name" class="font-weight-600">
        {{ __('eav::attribute.manager_option_value.label') }}
    </label>
    <div class="manager-option-value table-responsive">
        <table class="table" id="tableManagerOptionValue">
            <thead>
            <tr>
                <td width="30"></td>
                <td width="100">{{ __('eav::attribute.manager_option_value.is_default') }}</td>
                <td>{{ __('eav::attribute.manager_option_value.value') }}</td>
                <td>{{ __('eav::attribute.manager_option_value.image') }}</td>
                <td width="100"></td>
            </tr>
            </thead>
            <tbody>
            @foreach(object_get($item, 'options') ?? [] as $opt)
                <tr>
                    <td>
                        <i class="fas fa-grip-vertical mouse-move"></i>
                        <input type="hidden" name="options[{{ $opt->id }}][id]" value="{{ $opt->id }}">
                    </td>
                    <td>
                        <div class="custom-radio text-center">
                            <input type="radio" id="optionValue{{ $opt->id }}" name="options[{{ $opt->id }}][is_default]" value="1" {{ $opt->is_default ? 'checked' : '' }} class="custom-control-input">
                            <label class="custom-control-label" for="optionValue{{ $opt->id }}"></label>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="options[{{ $opt->id }}][value]" value="{{ $opt->value }}">
                    </td>
                    <td>
                        @singleFile([
                            'type' => 'image',
                            'item' => $opt,
                            'name' => "options[$opt->id][image]",
                            'fieldGetData' => "image",
                            'label' => '',
                            'value' => $opt->image,
                            'type' => 'image',
                            'id' => $opt->id,
                            'idHolder' => 'optIdHolder_'.$opt->id,
                            'files' => 'holderFiles_'.$opt->id
                        ])
                    </td>
                    <td>
                        <a href="#" class="delete btn btn-danger">
                            {{ __('core::button.delete') }}
                        </a>
                    </td>
                </tr>
            @endforeach

            @if(count(object_get($item, 'options') ?? []) == 0)
                <tr>
                    <td>
                        <i class="fas fa-grip-vertical mouse-move"></i>
                    </td>
                    <td>
                        <div class="custom-radio text-center">
                            <input type="radio" id="option_1" name="options[option_1][is_default]" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="option_1"></label>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="options[option_1][value]">
                    </td>
                    <td>
                        @singleFile(['name' => "options[option_1][image]", 'label' => '', 'type' => 'image', 'id' => 'option_1', 'idHolder' => 'opop1Image', 'files' => 'files2'])
                    </td>
                    <td>
                        <a href="#" class="delete btn btn-danger">
                            {{ __('core::button.delete') }}
                        </a>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>

        <a href="#" id="btnAddOptionValue" class="btn btn-outline-dark">
            {{ __('eav::attribute.manager_option_value.add_option') }}
        </a>
        <a href="#" id="btnClearDefault" class="btn btn-outline-danger">
            {{ __('eav::attribute.manager_option_value.clear_default') }}
        </a>
    </div>
</div>

<script type="text/html" id="optionValueRowTemplate">
    <tr>
        <td>
            <i class="fas fa-grip-vertical mouse-move"></i>
        </td>
        <td>
            <div class="custom-radio text-center">
                <input type="radio" id="__OPTION_ID__" name="options[__OPTION_ID__][is_default]" value="1" class="custom-control-input">
                <label class="custom-control-label" for="__OPTION_ID__"></label>
            </div>
        </td>
        <td>
            <input type="text" name="options[__OPTION_ID__][value]">
        </td>
        <td>
            @singleFile(['name' => "options[__OPTION_ID__][image]", 'label' => '', 'type' => 'image', 'id' => '__OPTION_ID__', 'idHolder' => 'opReplaceImage__OPTION_ID__', 'files' => 'files2'])
        </td>
        <td>
            <a href="#" class="delete btn btn-danger">
                {{ __('core::button.delete') }}
            </a>
        </td>
    </tr>
</script>

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/eav/admin/css/attribute.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/eav/admin/js/attribute.js') }}"></script>
@endpush
