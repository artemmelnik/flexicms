var setting = {
    ajaxMethod: 'POST',

    update: function(element) {
        var formData = $('#settingForm').serialize();
        var button = $(element);

        $.ajax({
            url: '/admin/settings/update/',
            type: this.ajaxMethod,
            data: formData,
            beforeSend: function(){
                button.addClass('loading');
            },
            success: function(result){
                console.log(result);
                button.removeClass('loading');
            }
        });
    }
};