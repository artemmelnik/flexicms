var resource = {
    ajaxMethod: 'POST',

    add: function(button) {
        var formData = new FormData();

        formData.append('resource_type_id', $('#formResourceTypeId').val());
        formData.append('title', $('#formTitle').val());
        formData.append('content', $('#formContent').val());

        $(button).addClass('loading');

        $.ajax({
            url: '/backend/resource/add/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
            },
            success: function(result){
                window.location = result;
            }
        });
    },

    update: function(button) {
        var formData = new FormData();
        var customFieldsForm = $('#customFieldsForm');

        formData.append('resource_id', $('#formResourceId').val());
        formData.append('title', $('#formTitle').val());
        formData.append('content', $('#formContent').val());
        formData.append('status', $('#status').val());
        formData.append('type', $('#type').val());
        formData.append('custom_fields', customFieldsForm.serialize());

        $('.js-category').each(function () {
            if ($(this).is(":checked")) {
                formData.append('categories[' + $(this).data('id') + ']', $(this).val());
            }
        });

        $('.relations').each(function () {
            var relationId = $(this).data('relation-id');

            $(this).find('a.ui.label').each(function () {
                formData.append('relations[' + relationId + '][]', $(this).data('value'));
            });
        });

        if ($('.js-custom-field-file').length > 0) {
            var item;
            $('.js-custom-field-file').each(function () {
                item = $(this)[0].files;
                formData.append('custom_fields_files[id]', $(this).attr('data-id'));

                for (var index in item) {
                    formData.append('custom_fields_files[' + index + ']', item[index]);
                    formData.append('custom_fields_files[' + index + '][id]', $(this).attr('data-id'));
                }
            });
        }

        if (typeof files !== 'undefined') {
            $.each(files, function(key, value){
                formData.append(key, value);
            });

            formData.append('resource_file_upload', 1);
        }

        $(button).addClass('loading');

        $.ajax({
            url: '/backend/resource/update/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function() {
            },
            success: function(result) {
                window.location.reload();
            }
        });
    },

    remove: function (fieldId, elementId, fileId) {
        var isRemove = confirm('Вы точно хотите удалить этот файл?');

        if (isRemove) {
            $.ajax({
                url: '/backend/custom_field/remove_file/',
                type: this.ajaxMethod,
                data: {
                    fieldId: fieldId,
                    elementId: elementId,
                    fileId: fileId
                },
                success: function(result){
                    $('#post_field_'+fieldId).val(result);
                    $('.js-image-' + fileId).remove();
                }
            });
        }
    },
};