$("#imgInvoice").fileinput({
    theme: "explorer-fas",
    showUpload: false, //не показывать кнопку загрузки
    showClose:false, //не показывать крестик закрытия
    showRemove:true, //показывать кнопку удалить
    showUploadedThumbs:false,
    //uploadAsync:true,
    //uploadUrl: "/ajax/ajaxpost",
    /*uploadExtraData: function() {
        return {
            mainAjax: 'filesupload'
            //summInvoiceForPayment: $('#summInvoiceForPayment').val()
        };
    },*/
    required: true,
    allowedFileExtensions: ['jpeg','jpg','JPEG','JPG','pdf'],
    language: 'ru',
    //showBrowse: false,
    browseOnZoneClick: true,
    defaultPreviewContent: '<h4 class="text-muted">Перетащите сюда файлы или кликните для выбора прямо здесь.</h4>',

    maxFileCount: 1,
    autoReplace:true,
    multiple:true,
    minFileCount: 1,
    validateInitialCount: true,
    initialPreviewAsData: true,
    preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
    previewFileIconSettings: { // configure your icon file extensions
        'doc': '<i class="fa fa-file-word-o text-primary"></i>',
        'xls': '<i class="fa fa-file-excel-o text-success"></i>',
        'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
        /*'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',*/
        'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
        'htm': '<i class="fa fa-file-code-o text-info"></i>',
        'txt': '<i class="fa fa-file-text-o text-info"></i>',
        'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
        'mp3': '<i class="fa fa-file-audio-o text-warning"></i>',
        /*'jpg': '<i class="fa fa-file-photo-o text-danger"></i>',
        'jpeg': '<i class="fa fa-file-photo-o text-danger"></i>',*/
        'gif': '<i class="fa fa-file-photo-o text-muted"></i>',
        'png': '<i class="fa fa-file-photo-o text-primary"></i>'
    },
    previewFileExtSettings: { // configure the logic for determining icon file extensions
        'doc': function(ext) {
            return ext.match(/(doc|docx)$/i);
        },
        'xls': function(ext) {
            return ext.match(/(xls|xlsx)$/i);
        },
        'ppt': function(ext) {
            return ext.match(/(ppt|pptx)$/i);
        },
        'zip': function(ext) {
            return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
        },
        'htm': function(ext) {
            return ext.match(/(htm|html)$/i);
        },
        'txt': function(ext) {
            return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
        },
        'mov': function(ext) {
            return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
        },
        'mp3': function(ext) {
            return ext.match(/(mp3|wav)$/i);
        }
    }
});

//var url1 = 'http://ipm.samaprof.ru/file/invoicePay/'+$('#imgInvoicePay').val();
var url1 = '/file/invoicePay/'+$('#fileInfoData').data('path');
var titleDoc = $('#fileInfoData').data('name');
$("#imgInvoicePay").fileinput({
    theme: "explorer-fas",
    showUpload: false, //не показывать кнопку загрузки
    showClose:false, //не показывать крестик закрытия
    //showUploadedThumbs:true,
    //uploadAsync:true,
    //uploadUrl: "/ajax/ajaxpost",
    /*uploadExtraData: function() {
        return {
            mainAjax: 'filesupload'
            //summInvoiceForPayment: $('#summInvoiceForPayment').val()
        };
    },*/
    overwriteInitial: false,
    //initialPreview: url1,
    initialPreviewAsData: true,
    /*initialPreviewConfig: [
        {type: "pdf",  size: 45056, caption: titleDoc}
    ],*/



    //required: true,
    allowedFileExtensions: ['jpeg','jpg','JPEG','JPG','pdf'],
    language: 'ru',
    //showBrowse: false,
    browseOnZoneClick: true,
    defaultPreviewContent: '<h4 class="text-muted">Перетащите сюда файл или кликните для выбора прямо здесь.</h4>',

    maxFileCount: 1,
    autoReplace:true,
    multiple:true,
    //minFileCount: 1,
    validateInitialCount: true,

    preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
    previewFileIconSettings: { // configure your icon file extensions
        'doc': '<i class="fa fa-file-word-o text-primary"></i>',
        'xls': '<i class="fa fa-file-excel-o text-success"></i>',
        'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
        'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
        'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
        'htm': '<i class="fa fa-file-code-o text-info"></i>',
        'txt': '<i class="fa fa-file-text-o text-info"></i>',
        'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
        'mp3': '<i class="fa fa-file-audio-o text-warning"></i>',
        /*'jpg': '<i class="fa fa-file-photo-o text-danger"></i>',
        'jpeg': '<i class="fa fa-file-photo-o text-danger"></i>',*/
        'gif': '<i class="fa fa-file-photo-o text-muted"></i>',
        'png': '<i class="fa fa-file-photo-o text-primary"></i>'
    },
    previewFileExtSettings: { // configure the logic for determining icon file extensions
        'doc': function(ext) {
            return ext.match(/(doc|docx)$/i);
        },
        'xls': function(ext) {
            return ext.match(/(xls|xlsx)$/i);
        },
        'ppt': function(ext) {
            return ext.match(/(ppt|pptx)$/i);
        },
        'zip': function(ext) {
            return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
        },
        'htm': function(ext) {
            return ext.match(/(htm|html)$/i);
        },
        'txt': function(ext) {
            return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
        },
        'mov': function(ext) {
            return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
        },
        'mp3': function(ext) {
            return ext.match(/(mp3|wav)$/i);
        },
        'pdf': function(ext) {
            return ext.match(/(pdf)$/i);
        }
    }
});
$("#imgAddDoc").fileinput({
    theme: "explorer-fas",
    showUpload: false, //не показывать кнопку загрузки
    showClose:false, //не показывать крестик закрытия
    overwriteInitial: false,
    initialPreviewAsData: true,
    allowedFileExtensions: ['jpeg','jpg','JPEG','JPG','pdf'],
    language: 'ru',
    browseOnZoneClick: true,
    defaultPreviewContent: '<h4 class="text-muted">Перетащите сюда файл или кликните для выбора прямо здесь.</h4>',

    maxFileCount: 1,
    minFileCount: 1,
    autoReplace:true,
    multiple:true,
    validateInitialCount: true,

    preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
    previewFileIconSettings: { // configure your icon file extensions
        'doc': '<i class="fa fa-file-word-o text-primary"></i>',
        'xls': '<i class="fa fa-file-excel-o text-success"></i>',
        'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
        'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
        'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
        'htm': '<i class="fa fa-file-code-o text-info"></i>',
        'txt': '<i class="fa fa-file-text-o text-info"></i>',
        'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
        'mp3': '<i class="fa fa-file-audio-o text-warning"></i>',
        /*'jpg': '<i class="fa fa-file-photo-o text-danger"></i>',
        'jpeg': '<i class="fa fa-file-photo-o text-danger"></i>',*/
        'gif': '<i class="fa fa-file-photo-o text-muted"></i>',
        'png': '<i class="fa fa-file-photo-o text-primary"></i>'
    },
    previewFileExtSettings: { // configure the logic for determining icon file extensions
        'doc': function(ext) {
            return ext.match(/(doc|docx)$/i);
        },
        'xls': function(ext) {
            return ext.match(/(xls|xlsx)$/i);
        },
        'ppt': function(ext) {
            return ext.match(/(ppt|pptx)$/i);
        },
        'zip': function(ext) {
            return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
        },
        'htm': function(ext) {
            return ext.match(/(htm|html)$/i);
        },
        'txt': function(ext) {
            return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
        },
        'mov': function(ext) {
            return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
        },
        'mp3': function(ext) {
            return ext.match(/(mp3|wav)$/i);
        },
        'pdf': function(ext) {
            return ext.match(/(pdf)$/i);
        }
    }
});