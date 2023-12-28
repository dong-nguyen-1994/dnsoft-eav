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
        const id = `options[option_${i}][image]`;
        let files = document.getElementById(`${id}`);
        files = $(files).data('input');
        reUpdateImageEditor(id, files);
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

    function reUpdateImageEditor(id, files) {
        (function (id, files, options) {
            console.log({ id });
            let button = document.getElementById(id);
            button.addEventListener('click', function () {
                const route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                const files = button.getAttribute('data-input');
                const target_preview = document.getElementById(button.getAttribute('data-preview'));

                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=1390,height=650');
                window.SetUrl = function (items) {
                    console.log({ items });
                    items = [items[0]]
                    console.log({ items });
                    const nameInput = $(`input[name="${id}"]`);
                    nameInput.val(items[0].name);

                    // clear previous preview
                    target_preview.innerHtml = '';

                    // set or change the preview image src
                    items.forEach(function (item) {
                        const key = randomKey(20);
                        const parent = document.createElement('span')
                        parent.setAttribute('class', `form-group image-item-${key}`)

                        let img = document.createElement('img')
                        img.setAttribute('class', 'img-thumbs')
                        img.setAttribute('src', item.thumb_url)
                        parent.appendChild(img);

                        const pElement = document.createElement('div')
                        pElement.setAttribute('data-key', key)
                        pElement.setAttribute('data-name', item.name)
                        pElement.setAttribute('class', `remove-item`)
                        pElement.innerHTML = 'Remove file'
                        parent.appendChild(pElement);
                        target_preview.appendChild(parent);

                        // Remove previous image
                        const previouseElement = parent.previousElementSibling;
                        if (previouseElement) {
                            const divElement = previouseElement.querySelector('div');
                            const fileName = divElement.getAttribute('data-name');
                            previouseElement.remove();

                            // Remove data image
                            const fileItems = $(`#${files}`).val();
                            let imagesName = fileItems.split(',');
                            const index = imagesName.indexOf(fileName.toString());
                            if (index > -1) {
                                imagesName.splice(index, 1);
                                $(`#${files}`).val(imagesName.join(','));
                            }
                        }
                    });

                    // trigger change event
                    target_preview.dispatchEvent(new Event('change'));
                };
            });
        })(id, files, { prefix: '/admin/file-manager', type: 'file' });
    }
});
