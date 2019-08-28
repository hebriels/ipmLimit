/**
 * Created by Slava on 17.04.2018.
 */
$(document).ready(function(){
    $('form').submit(function(event){
        var json;
        event.preventDefault();//откл отправку формы в браузере
        //alert ($(this).attr('action'));
        //return;

        $.ajax({
            type: $(this).attr('method'),//method post get
            url: $(this).attr('action'),//url обработчика
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                console.log(result);

                //return;
                json = jQuery.parseJSON(result);
                //console.log(json.url);
                if(json.url){
                    window.location.href = json.url;
                }else{
                    alert(json.status + ' - ' + json.message);
                }
            }
        });
    });
});
