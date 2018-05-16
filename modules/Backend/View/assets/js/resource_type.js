"use strict";

var resourceType = {
    addRelation: function (el) {
        var button = $(el);

        button.addClass('loading');

        $.ajax({
            url: '/backend/resource-type/add-relation/',
            type: 'post',
            data: $('#resourceTypeRelation').serialize(),
            success: function(result){
                button.removeClass('loading');

                if (result === 'done') {

                }

                window.location.reload();
            }
        });
    }
};