var setting = {
    ajaxMethod: 'POST',

    update: function(element) {
        var formData = $('#settingForm').serialize();
        var button = $(element);

        $.ajax({
            url: '/backend/settings/update/',
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
    },
    setActiveTheme: function(element, theme) {
        var formData = new FormData();
        var button = $(element);

        formData.append('theme', theme);
        $.ajax({
            url: '/backend/settings/activateTheme/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                button.addClass('loading');
            },
            success: function(result){
                window.location.reload();
            }
        });
    }
};