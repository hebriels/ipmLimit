var FormValidation = function () {
    var handleValidation1 = function () {

        var form1 = $('#formLogin');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
                mngrMail: {
                    required: "Логин должен быть заполнен"
                },
                mngrPwd: {
                    required: "Пароль должен быть заполнен"
                }
            },
            rules: {
                mngrMail: {
                    required: true
                },
                mngrPwd: {
                    required: true
                }
            },

            /*invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var cont = $(element).parent('.input-group');
                if (cont.size() > 0) {
                    cont.after(error);
                } else {
                    element.after(error);
                }

            },

            highlight: function (element) { // hightlight error inputs

                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            }*/
        });
    };

    return {
        init: function () {
            handleValidation1();
        }
    };
}();

$(document).ready(function() {
    FormValidation.init();

});