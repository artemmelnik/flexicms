var post = {
    ajaxMethod: 'POST',

    add: function() {
        var formData = new FormData();

        formData.append('title', $('#formTitle').val());
        formData.append('content', $('.redactor-editor').html());

        $.ajax({
            url: '/admin/post/add/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){

            },
            success: function(result){
                console.log(result);
                window.location = '/admin/posts/edit/' + result;
            }
        });
    },

    update: function(button) {
        var formData = new FormData();

        formData.append('post_id', $('#formPostId').val());
        formData.append('title', $('#formTitle').val());
        formData.append('content', $('.redactor-editor').html());
        formData.append('status', $('#status').val());
        formData.append('type', $('#type').val());

        if(typeof files !== 'undefined' ) {
            $.each(files, function(key, value){
                formData.append(key, value);
            });

            formData.append('post_file_upload', 1);
        }

        $(button).addClass('loading');

        $.ajax({
            url: '/admin/post/update/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){

            },
            success: function(result){
                window.location.reload();
            }
        });
    }
};