<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Для тестов </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <?php
                    //bugs();
                    $i = 5;
                    echo $i++;
                    echo $i;
                    /*echo $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'].' '.$_SESSION['mngr']['userLastName'].'<br/>';
                    if(!empty($_SESSION['mngr']['userFirstName'])){
                        $firstName = $_SESSION['mngr']['userFirstName'];
                        $firstNameSub = mb_substr($_SESSION['mngr']['userFirstName'],0,1,"UTF-8").'.';
                    }else{
                        $firstName = $firstNameSub = '';
                    }
                    if(!empty($_SESSION['mngr']['userLastName'])){
                        $lastName = $_SESSION['mngr']['userLastName'];
                        $lastNameSub = mb_substr($_SESSION['mngr']['userLastName'],0,1,"UTF-8").'.';
                    }else{
                        $lastName = $lastNameSub = '';
                    }
                    echo $_SESSION['mngr']['userSurname'].' '.$firstNameSub.' '.$lastNameSub.'<br/>';*/
                    ?>
                </div>
            </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let urlOne = '/ajax/ajaxpost';
        $('#enterScr').on('click',function () {
            console.log(55);
            /*$.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=enterScript",
                success: function (data){

                }
            });*/
        });
    });
</script>