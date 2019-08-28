<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- Заголовок -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Подотчет </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
    </div>
    <!-- #Заголовок -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__body" style="padding-top: 0;">
                <div class="kt-widget kt-widget--user-profile-3">
                    <div class="kt-widget__bottom" style="border-top:0;margin-top: 0;">
                        <div class="kt-widget__item">
                            <div class="kt-widget__icon">
                                <i class="flaticon-pie-chart"></i>
                            </div>
                            <div class="kt-widget__details">
                                <span class="kt-widget__title">Общая сумма</span>
                                <span class="kt-widget__value">
                                    <?php
                                    if(empty($allPay[0]['moneySum'])){
                                        echo '0';
                                    }else{
                                        echo $allPay[0]['moneySum'];}
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div class="kt-widget__item">
                            <div class="kt-widget__icon">
                                <i class="flaticon-file-1"></i>
                            </div>
                            <div class="kt-widget__details">
                                <span class="kt-widget__title">В отчете</span>
                                <span class="kt-widget__value">
                                    <?php
                                    if(empty($expensePay[0]['moneySum'])){
                                        echo '0';
                                    }else{
                                        echo $expensePay[0]['moneySum'];} ?>
                                </span>
                            </div>
                        </div>
                        <div class="kt-widget__item">
                            <div class="kt-widget__icon">
                                <i class="flaticon-coins"></i>
                            </div>
                            <div class="kt-widget__details">
                                <span class="kt-widget__title">Остаток</span>
                                <span class="kt-widget__value">
                                    <?php
                                    if(empty($allPay[0]['moneySum']) && empty($expensePay[0]['moneySum'])){
                                        echo '0';
                                    }else{
                                        if(!empty($allPay[0]['moneySum']) && empty($expensePay[0]['moneySum'])){
                                            echo $allPay[0]['moneySum'];
                                        }else{
                                            echo $allPay[0]['moneySum']-$expensePay[0]['moneySum'];
                                        }}
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead class="bg-blue">
                        <tr>

                            <th>
                                <a href="javascript:;">Дата</a>
                            </th>
                            <th>
                                <a href="javascript:;">Сумма</a>
                            </th>
                            <th>
                                <a href="javascript:;">В отчете</a>
                            </th>
                            <th>
                                <a href="javascript:;">Остаток</a>
                            </th>
                            <th>
                                <a href="javascript:;">Отчет</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($underReportPay as $myData):?>
                        <?php if(empty($myData['date_reportLastSign'])):?>
                        <tr>
                            <td class="table-date font-blue">
                                <a href="javascript:;"><?php echo $myData['dateCreate'];?></a>
                            </td>
                            <td class="table-title">
                                <h3><?php echo $myData['money'];?></h3>
                            </td>
                            <td class="table-title">
                                <h3><?php echo $myData['money_exp'];?></h3>
                            </td>
                            <td class="table-title">
                                <h3><?php echo $myData['money']-$myData['money_exp'];?></h3>
                            </td>
                            <td class="table-download">
                                <?php if($myData['check_pay']!='true'){
                                    echo '<a href="/mngr/reportpay/'.$myData['id'].'" class="btn btn-xs btn-success">Перейти</a>';
                                }else{
                                    echo 'проверяется';
                                }?>
                            </td>
                        </tr>
                        <?php endif; endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>