var FormValidation = function () {
    $.validator.addMethod('regNumb', function (value, element) {
        return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:\d{3})+)(?:[\.,]\d{1,2})?$/gm.test(value);
    },"Возможно есть пробелы. Точка или запятая разделитель копеек!");
    // basic validation
    var handleValidation1 = function () {
        var form1 = $('#formAddInvoice');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);
        $.validator.addMethod('idProjectHidden', function (value, element) {
            if($('#contractCheck').prop('checked') === true && $('#idProjectHidden').val() === ''){
                return false;
            }else{
                return true;
            }},"Проект должен быть выбран из списка или создан новый!");
        $.validator.addMethod('idHiddenContragent', function (value, element) {
            return $('#idHiddenContragent').val();
            },"Поставщик должен быть выбран из списка!");
        form1.validate({
            /*errorElement: 'div', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input*/
            messages: {
                innContragent: {
                    required: "Поставщик должен быть выбран из списка или создайте контрагента"
                },
                numberInvoice: {
                    required: "Номер счета указан на вашем счете"
                },
                imgInvoice: "765"
            },
            rules: {
                numberContract: {
                    idProjectHidden:true
                },
                innContragent: {
                    idHiddenContragent: true
                },
                summInvoiceForPayment: {
                    required: true,
                    regNumb: true
                },
                numberInvoice: {
                    required: true
                },
                imgInvoice: {
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                /*var alert = $('#kt_form_1_msg');
                alert.removeClass('kt-hidden').show();*/
                KTUtil.scrollTo('m_form_1_msg', -200);
            },

            /*errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr('name') === 'imgInvoice' ) {
                    //$('#downloadFile').text($(error).html());
                    $('#downloadFile').removeClass('hiddenVisible');
                    $("#imgInvoice__validate").text($(error).text());
                    //console.log($(error).html());
                }

            },*/

            /*highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },*/

            /*submitHandler: function (form) {
                //.show();
                //error1.hide();

                //$('#formAddInvoice').submit();
                swal({
                    title: "Идет отправка!",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1500
                });
            }*/
        });
    };

    var handleValidation2 = function () {
        // for more info visit the official plugin documentation:
        // http://docs.jquery.com/Plugins/Validation

        var form1 = $('#formAddInvoicePay');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);
        $.validator.addMethod('idProjectHiddenPay', function (value, element) {
            if($('#contractCheckPay').prop('checked') === true && $('#idProjectHiddenPay').val() === ''){
                return false;
            }else{
                return true;
            }},"Проект должен быть выбран из списка или создан новый!");
        form1.validate({
            messages: {},
            rules: {
                numberContractPay: {
                    idProjectHiddenPay:true
                },
                summForPayment: {
                    required: true,
                    regNumb: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                /*var alert = $('#kt_form_1_msg');
                alert.removeClass('kt-hidden').show();*/
                KTUtil.scrollTo('m_form_1_msg', -200);
            },

            /*errorPlacement: function (error, element) { // render error placement for each input type
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

    var handleValidation3 = function () {
        // for more info visit the official plugin documentation:
        // http://docs.jquery.com/Plugins/Validation

        var form1 = $('#formEditInvoice');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);
        $.validator.addMethod('idProjectHidden', function (value, element) {
            if($('#contractCheck').prop('checked') === true && $('#idProjectHidden').val() === ''){
                return false;
            }else{
                return true;
            }},"Проект должен быть выбран из списка или создан новый!");
        $.validator.addMethod('idHiddenContragent', function (value, element) {
            return $('#idHiddenContragent').val();
        },"Поставщик должен быть выбран из списка!");
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
                innContragent: {
                    required: "Поставщик должен быть выбран из списка или создайте контрагента"
                }
            },
            rules: {
                numberContract: {
                    idProjectHidden:true
                },
                innContragent: {
                    idHiddenContragent: true
                },
                summInvoiceForPayment: {
                    required: true,
                    regNumb: true
                },
                numberInvoice: {
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                /*success1.hide();
                error1.show();*/
                KTUtil.scrollTo('m_form_1_msg', -200);
            },

            /*errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr('name') === 'imgInvoice' ) {
                    //$('#downloadFile').text($(error).html());
                    $('#downloadFile').removeClass('hiddenVisible');
                    $("#imgInvoice__validate").text($(error).text());
                    console.log($(error).html());
                }
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

    let handleValidation4 = function () {

        let form1 = $('#formAddDoc');

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input

            rules: {
                depDoc: {
                    required:true
                },
                typeDoc: {
                    required:true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                KTUtil.scrollTo('m_form_1_msg', -200);
            },
        });
    };

    return {
        //main function to initiate the module
        init: function () {
            handleValidation1();
            handleValidation2();
            handleValidation3();
            handleValidation4();
        }
    };
}();

jQuery(document).ready(function() {
    FormValidation.init();

});