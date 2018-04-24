window.onload = function () {
    if ($('.redactor').length > 0) {
        var redactor = [];
        $('.redactor').each(function (elem) {
            //var redactor = new Jodit('.redactor');
            redactor[elem] = new Jodit(this, {
                i18n: 'en'
            });
        });
    }
};

var files;
$('input.upload-file').on('change', function(){
    files = this.files;

    if (files && files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('img.post-image').attr('src', e.target.result);
        };

        reader.readAsDataURL(files[0]);
    }
});

$('.upload-post-image').on( 'click', function(event) {
    event.stopPropagation();
    event.preventDefault();

    $('input.upload-file').click();
});

$(document)
    .ready(function() {
        // show dropdown on hover
        $('.ui.dropdown').dropdown({
            on: 'hover'
        });

        $('.btn-create-menu').on('click', function() {
            $('.mini.modal')
                .modal('show')
            ;
        });

        $('.btn-create-group-fields').on('click', function() {
            $('.tiny.modal')
                .modal('show')
            ;
        });

        $('.ui.help-element')
            .popup({
                hoverable: true,
                delay: {
                    show: 100,
                    hide: 500
                }
            });

        $('.ui.accordion')
            .accordion();

        $('.menu .item')
            .tab();
    })
;

$(function() {
    var group = $("ol.edit-menu").sortable({
        group: 'edit-menu',
        handle: 'i.icon-cursor-move',
        onDragStart: function ($item, container, _super) {
            // Duplicate items of the no drop area
            if(!container.options.drop)
                $item.clone().insertAfter($item);
            _super($item, container);
        },
        onDrop: function ($item, container, _super) {
            var data = group.sortable("serialize").get();
            var jsonString = JSON.stringify(data, null, ' ');
            var formData = new FormData();

            console.log(data);

            formData.append('data', jsonString);
            formData.append('menu_id', $('#sortMenuId').val());

            $.ajax({
                url: '/backend/settings/ajaxMenuSortItems/',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){

                },
                success: function(result){

                }
            });

            _super($item, container);
        }
    });
});