$(document).on('ready', function() {
    $("#foto_perfil").fileinput({
        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: "Imagen",
        browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i>",
        removeClass: "btn btn-danger",
        removeLabel: "Delete",
        removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i>",
        showUpload: false
    });
});

