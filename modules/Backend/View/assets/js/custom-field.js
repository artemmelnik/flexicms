"use strict";

var customField = {
    ajaxMethod: 'POST',
    addGroupForm: $('#addGroupForm'),
    containerFields: $('#containerFields'),

    init: function () {
    },

    loadTemplates: function (select) {
        var formData = new FormData();
        var templateGroup = $('#templateGroup');

        formData.append('type', $(select).val());

        $.ajax({
            url: '/backend/custom_fields/ajaxLoadTemplates/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){

            },
            success: function(result){
                console.log(result);
                templateGroup.html(result);
            }
        });
    },

    addField: function (groupId) {
        var formData = new FormData();
        formData.append('group_id', groupId);

        var _this = this;
        $.ajax({
            url: '/backend/custom_fields/ajaxLoadNewFieldTemplate/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){

            },
            success: function(result){
                _this.containerFields.append(result);
            }
        });
    },

    updateFieldsGroup: function (button) {
        var formData = $('#updateFieldsGroup').serialize();

        $(button).addClass('loading');

        var _this = this;
        $.ajax({
            url: '/backend/custom_fields/ajaxUpdateFields/',
            type: this.ajaxMethod,
            data: formData,
            beforeSend: function(){

            },
            success: function(result){
                var objectResult = jQuery.parseJSON(result);

                $(button).removeClass('loading');

                if (objectResult.errors !== undefined) {
                    for (var id in objectResult.errors) {
                        var fieldErrors = objectResult.errors[id];

                        for (var key in fieldErrors) {
                            $('.field-' + id + '-' + key)
                                .addClass(fieldErrors[key])
                            ;
                        }
                    }
                } else {
                    location.reload();
                }
            }
        });
    },

    addGroup: function (button) {
        var formData = new FormData();
        var title = $('#titleGroup');
        var type = $('#typeGroup');
        var template = $('#templateGroup');

        $('.field').removeClass('error');

        if (title.val().length < 1) {
            title.parent().addClass('error');
            return false;
        }

        formData.append('title', title.val());
        formData.append('type', type.val());
        formData.append('template', template.val());

        $.ajax({
            url: '/backend/custom_fields/ajaxAddGroup/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){

            },
            success: function(result){
                console.log(result);

                if (result > 0) {
                    location.reload();
                }
            }
        });
    }
};

customField.init();