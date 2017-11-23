var plugin = {
    ajaxMethod: 'POST',

    install: function (element, directory) {
        var button   = $(element);
        var formData = new FormData();

        formData.append('directory', directory);

        button.addClass('disabled');

        $.ajax({
            url: '/admin/plugins/ajaxInstall/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (result) {
                window.location.reload();
            }
        });
    },
    activate: function (element, pluginId) {
        var button   = $(element);
        var formData = new FormData();
        var active = button.data('active');

        var status = 0;

        if (active === 0) {
            status = 1;
        } else {
            status = 0;
        }

        formData.append('id', pluginId);
        formData.append('active', status);

        $.ajax({
            url: '/admin/plugins/ajaxActivate/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (result) {
                button.attr('data-active', status);
            }
        });
    }
};