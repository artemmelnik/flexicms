var category = {
    ajaxMethod: 'POST',

    add: function (button) {
        var formData = $('#formCategory').serialize();

        $(button).addClass('loading');

        $.ajax({
            url: '/backend/category/create/',
            type: this.ajaxMethod,
            data: formData,
            beforeSend: function () {
            },
            success: function (result) {
                var response = jQuery.parseJSON(result);

                window.location = response.redirect_uri;
            }
        });
    },

    update: function (button) {
        var formData = $('#formCategory').serialize();
        var parent = $('#parent').val();

        $(button).addClass('loading');

        $.ajax({
            url: '/backend/category/update/',
            type: this.ajaxMethod,
            data: formData + '&parent=' + parent,
            beforeSend: function () {
            },
            success: function (result) {
                var response = jQuery.parseJSON(result);

                window.location = response.redirect_uri;
            }
        });
    }
};