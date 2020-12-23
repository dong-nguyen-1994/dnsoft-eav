$(document).ready(function () {
    let $table = $('#tableManagerOptionValue');
    $table.find('tbody').sortable({
        helper: function (e, ui) {
            ui.children().each(function () {
                $(this).width($(this).width());
            });
            return ui;
        },
        placeholder: 'ui-sortable-placeholder',
        axis: 'y',
        start: function (e, ui) {
            ui.placeholder.height(ui.item.height());
        }
    });

    $('#btnAddOptionValue').on('click', function (e) {
        e.preventDefault();

        this.blur();
        this.hideFocus = false;
        this.style.outline = null;

        const i = $table.find('tbody tr').length + 1;
        const html = $('#optionValueRowTemplate').html().replace(/__OPTION_ID__/g, `option_${i}`);
        $(html).appendTo($table.find('tbody'));
    });

    $('#btnClearDefault').on('click', function (e) {
        e.preventDefault();

        this.blur();
        this.hideFocus = false;
        this.style.outline = null;

        $table.find('input[type="radio"]').prop('checked', false);
    });

    $table.on('change', 'input[type="radio"]', function () {
        $table.find('input[type="radio"]').not(this).prop('checked', false);
    });

    $table.on('click', '.delete', function (e) {
        e.preventDefault();

        $(this).closest('tr').remove();
    });

    $('#input_type').on('change', function () {
        if (['dropdown', 'multiple_select'].includes($(this).val())) {
            $('#groupOptionValue').show();
            $('#groupOptionValue input').prop('disabled', false);
        } else {
            $('#groupOptionValue').hide();
            $('#groupOptionValue input').prop('disabled', true);
        }
    }).trigger('change');
});
