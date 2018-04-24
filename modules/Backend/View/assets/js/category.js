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
    }
};