function saveGeoFields() {
    var lat = $('#lat');
    var lng = $('#lng');
    var resourceId = $('#formResourceId');

    $.ajax({
        method: 'post',
        url: '/backend/resource/addGeoFields/',
        data: {
            lat: lat.val(),
            lng: lng.val(),
            resourceId: resourceId.val()
        },
        success: function (respond) {
            window.location.reload();
        }
    });
}