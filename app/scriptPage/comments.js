let commentsFunc = function () {
    function commentsUser() {
        let urlOne = '/ajax/ajaxpost';
        let idInvoice = $('#idDoc').val();
        let userAvatar = $('#userAvatar').val();
        let nameUserComment = $('#userName').val();
        let getStatus = $('#getStatus').val();
        let userID = $('#userID').val();
        let typeDoc = $('.btnEnterComment').data('typedoc');

        //разрешение на комментарий
        function getStatusInvoceFailure() {
            if(getStatus==='5'){
                $('#commentBan').remove();
            }
        }
        getStatusInvoceFailure();
        //список существующих комментариев при загрузке
        function getComments() {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=firstLoadCommentDB&idInvoice=" + idInvoice + "&type=" + typeDoc,
                success: function (data) {
                    let result = $.parseJSON(data);
                    $.each(result.allComment, function (col, val) {
                        let output = '';
                        if (val.typeComment === 'kt-chat__message--right') {
                            output += '<div class="kt-chat__message kt-chat__message--right">\
                                                <div class="kt-chat__user">\
                                                    <span class="kt-chat__datetime">' + val.dateCreate + '</span>\
                                                    <a href="#" class="kt-chat__username" id="' + val.id + '">' + val.autor + '</span></a>\
                                                    <span class="kt-userpic kt-userpic--circle kt-userpic--sm">\
                                                        <img src="/assets/images/ava/' + val.avatar + '" alt="image">\
                                                    </span>\
                                                </div>\
                                                <div class="kt-chat__text kt-bg-light-brand">' + val.textComment + '</div>\
                                            </div>';
                        } else {
                            output += '<div class="kt-chat__message">\
                                                <div class="kt-chat__user">\
                                                    <span class="kt-userpic kt-userpic--circle kt-userpic--sm">\
                                                        <img src="/assets/images/ava/' + val.avatar + '" alt="image">\
                                                    </span>\
                                                    <a href="#" class="kt-chat__username" id="' + val.id + '">' + val.autor + '</span></a>\
                                                    <span class="kt-chat__datetime">' + val.dateCreate + '</span>\
                                                </div>\
                                                <div class="kt-chat__text kt-bg-light-success">' + val.textComment + '</div>\
                                            </div>';
                        }
                        $('.commentList').append(output);
                    });
                }
            });
        }
        getComments();
        //добавление нового комментария при нажатии Enter
        $('#idTextareaComment').keypress(function (e) {
            if (e.which == 13) {
                $('.btnEnterComment').click();
            }
        });
        //добавление в список для получения уведомлений о комментариях
        $('.addPartners').on('click',function () {
            Swal.fire({
                title: "Желаете следить за комментариями?",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Отмена",
            }).then((isConfirm)=>{
                if (isConfirm.value){
                    addPartners();
                    Swal.fire({
                        title: "Вы добавлены",
                        type: "success"
                    });
                }
            });
        });
        function addPartners() {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testPartner&idInvoice="+idInvoice+"&typeAdd="+typeDoc,
                success: function (data){}
            });
        }
        //добавление нового комментария
        $('.btnEnterComment').on('click', function () {
            let textareaText = $('.textTextarea');
            let typeDoc = $(this).data('typedoc');
            let textComment = textareaText.val(); //комментарий
            let dateToday = datetimeToday(); //дата для отображения 'DD.MM.YYYY HH:mm'
            let dateTimeStamp = datetimeStamp(); //дата для записи в базу 'YYYY-MM-DD HH:mm:ss'
            let lastIdComment = parseInt($('.commentList a:last').attr('id')) + 1;
            textareaText.val(''); //очистить поле комментария
            let output = '<div class="kt-chat__message kt-chat__message--right">\
                                <div class="kt-chat__user">\
                                    <span class="kt-chat__datetime">' + dateToday + '</span>\
                                    <a href="#" class="kt-chat__username" id="' + lastIdComment + '">' + nameUserComment + '</span></a>\
                                    <span class="kt-userpic kt-userpic--circle kt-userpic--sm">\
                                        <img src="/assets/images/ava/' + userAvatar + '" alt="image">\
                                    </span>\
                                </div>\
                                <div class="kt-chat__text kt-bg-light-brand">' + textComment + '</div>\
                            </div>';
            $('.commentList').append(output);
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=insertCommentDB&textComment=" + textComment + "&typeDoc=" + typeDoc + "&idInvoice=" + idInvoice + "&dateTimeStamp=" + dateTimeStamp,
                success: function (data) {
                    if (isNaN(lastIdComment)) {
                        $('.commentList').empty();
                        getComments();
                    }
                }
            });
            addPartners();
        });
        // начать повторы с интервалом 5 сек
        let timerId = setInterval(function(){
            let lastIdComment = $('.commentList a:last').attr('id');
            /*$.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=testLabelEdit&idInvoice="+idInvoice+"&typeAdd="+typeDoc,
                success: function (data){
                    let result = $.parseJSON(data);
                    if(result.resultTest[0]['editLabel']==='true'){
                        if(result.resultTest[0]['mngrId']===userID){
                            Swal.fire({
                                title: "ВНИМАНИЕ!",
                                text: "Вы забыли отредактировать счет",
                                type: "warning",
                                allowOutsideClick: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Отменить редактирование",
                                //closeOnConfirm: false,
                                closeModal: true
                            }).then((isConfirm)=>{
                                if (isConfirm.value){
                                    console.log(idInvoice);
                                    $.ajax({
                                        url: urlOne, type: "POST", dataType: "text",
                                        data: "mainAjax=labelEdit&idInvoice="+idInvoice+"&typeAdd=invoice&label=false",
                                        success: function (data) {}
                                    });
                                }
                            });
                        }else{
                            Swal.fire({
                                title: "ВНИМАНИЕ!",
                                text: "счет редактируется",
                                type: "warning",
                                allowOutsideClick: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Понятно",
                                closeOnConfirm: false,
                                closeModal: true
                            });
                        }
                    }
                }
            });*/
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=loadCommentDB&lastIdComment="+lastIdComment+"&idInvoice="+idInvoice+"&typeAdd="+typeDoc,
                success: function (data) {
                    let result = $.parseJSON(data);
                    $.each(result.allComment,function(col,val){
                        let output = '';
                        if(val.typeComment==='kt-chat__message--right'){
                            output +='<div class="kt-chat__message kt-chat__message--right">\
                                            <div class="kt-chat__user">\
                                                <span class="kt-chat__datetime">'+val.dateCreate+'</span>\
                                                <a href="#" class="kt-chat__username" id="'+val.id+'">'+val.autor+'</span></a>\
                                                <span class="kt-userpic kt-userpic--circle kt-userpic--sm">\
                                                    <img src="/assets/images/ava/'+val.avatar+'" alt="image">\
                                                </span>\
                                            </div>\
                                            <div class="kt-chat__text kt-bg-light-brand">'+val.textComment+'</div>\
                                        </div>';
                        }else {
                            output += '<div class="kt-chat__message">\
                                            <div class="kt-chat__user">\
                                                <span class="kt-userpic kt-userpic--circle kt-userpic--sm">\
                                                    <img src="/assets/images/ava/'+val.avatar+'" alt="image">\
                                                </span>\
                                                <a href="#" class="kt-chat__username" id="'+val.id+'">'+val.autor+'</span></a>\
                                                <span class="kt-chat__datetime">'+val.dateCreate+'</span>\
                                            </div>\
                                            <div class="kt-chat__text kt-bg-light-success">'+val.textComment+'</div>\
                                        </div>';
                        }
                        $('.commentList').append(output);
                    });
                }
            });
        },5000);
    }
    return {
        init: function() {
            commentsUser();
        }
    };
}();

$(document).ready(function() {
    commentsFunc.init();
});
