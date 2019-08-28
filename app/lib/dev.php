<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

    function bugs($var)
    {
        echo '<pre style="margin: 0 50px;background-color: #fff;">';
        var_dump($var);
        echo '</pre>';
    }
    function codeDecodePrice ($str,$type){
        if($type=='encode'){
            $strEn = str_replace(array(
                '0','1','2','3','4','5','6','7','8','9'
            ), array(
                'yAez','yRz','ybz','ynwTz','ypPz','yNmz','y4z','ydfgz','y8hz','ynoI1z'
            ), $str);
        }else{
            $strEn = str_replace(array(
                'yAez','yRz','ybz','ynwTz','ypPz','yNmz','y4z','ydfgz','y8hz','ynoI1z'
            ), array(
                '0','1','2','3','4','5','6','7','8','9'
            ), $str);
        }
        return $strEn;
    }
    function getImageFolder($pathScanInvoice)
    {
        if($pathScanInvoice != '') {
            $fileName = explode("/", $pathScanInvoice);
            //bugs($fileName);
            if($fileName['0']==''){
                $pathScanInvoice = $fileName['3'];
                $fileExtension = new SplFileInfo($fileName['3']);
            }else{
                $pathScanInvoice = $fileName['0'];
                $fileExtension = new SplFileInfo($fileName['0']);
            }
            $fileExtension->getExtension(); //расширение файла
            switch ($fileExtension->getExtension()) {
                case 'pdf':
                case 'PDF':
                case 'Pdf':
                case 'PDf':
                case 'pDF':
                case 'pdF':
                    return '<a href="/file/invoice/'.$pathScanInvoice.'" target="_blank" class="cbp-lightbox btn btn-sm btn-outline-brand btn-icon" data-image="'.$pathScanInvoice.'"
                                                   data-title="'.$pathScanInvoice.'" title="Смотреть">
                                                    <i class="far fa-file-pdf"></i></a>';
                    break;
                case 'jpg':
                case 'jpeg':
                case 'JPG':
                case 'JPEG':
                    return '<a href="/file/invoice/'.$pathScanInvoice.'" target="_blank" class="cbp-lightbox btn btn-sm btn-outline-brand btn-icon" data-image="'.$pathScanInvoice.'"
                                                   data-title="'.$pathScanInvoice.'" title="Смотреть">
                                                    <i class="far fa-file-image"></i></a>';
                    break;
                case 'png':
                case 'PNG':
                    return '<a style="margin-right: 4px;" href="/file/invoice/'.$pathScanInvoice.'" class="cbp-lightbox btn dark btn-xs btn-outline sbold uppercase" data-image="'.$pathScanInvoice.'"
                                                   data-title="'.$pathScanInvoice.'" data-toggle="popover" data-trigger="hover" data-placement="auto" title="просмотр" data-content="Нажмите для просмотра счета">
                                                    <i class="far fa-file-image"></i></a>';
                    break;
                case 'doc':
                case 'docx':
                    return '<a style="margin-right: 4px;" href="/file/invoice/'.$pathScanInvoice.'" class="btn dark btn-xs btn-outline sbold uppercase" data-image="'.$pathScanInvoice.'"
                                                   data-title="'.$pathScanInvoice.'" data-toggle="popover" data-trigger="hover" data-placement="auto" title="скачать" data-content="Нажмите чтобы скачать счет">
                                                    <i class="far fa-file-word"></i></a>';
                    break;
                case 'xls':
                case 'xlsx':
                    return '<a style="margin-right: 4px;" href="/file/invoice/'.$pathScanInvoice.'" class="btn dark btn-xs btn-outline sbold uppercase" data-image="'.$pathScanInvoice.'"
                                                   data-title="'.$pathScanInvoice.'" data-toggle="popover" data-trigger="hover" data-placement="auto" title="скачать" data-content="Нажмите чтобы скачать счет">
                                                    <i class="far fa-file-excel"></i></a>';
                    break;
                default:
                    return '<a href="javascript:;" target="_blank" class="btn btn-sm btn-outline-warning btn-icon" title="Просмотр не доступен">
                                                    <i class="flaticon-warning"></i></a>';
                    break;
            }
        }else{
            return '<a href="javascript:;" target="_blank" class="btn btn-sm btn-outline-warning btn-icon" title="Просмотр не доступен">
                                                    <i class="flaticon-warning"></i></a>';
        }
    }
    function getImageFolderPay($path)
    {
        $fileExtension = new SplFileInfo($path);
        $fileExtension->getExtension(); //расширение файла
        switch ($fileExtension->getExtension()) {
            case 'pdf':
            case 'PDF':
            case 'Pdf':
            case 'PDf':
            case 'pDF':
            case 'pdF':
                return '<a href="/file/invoicePay/'.$path.'" target="_blank" class="btn btn-sm btn-outline-brand btn-icon" data-toggle="lightbox" data-image="'.$path.'"
                                                   data-title="'.$path.'" title="просмотр">
                                                    <i class="far fa-file-pdf"></i></a>';
                break;
            case 'jpg':
            case 'jpeg':
            case 'JPG':
            case 'JPEG':
                return '<a href="/file/invoicePay/'.$path.'" target="_blank" class="btn btn-sm btn-outline-brand btn-icon" data-toggle="lightbox" data-image="'.$path.'"
                                                   data-title="'.$path.'" title="просмотр">
                                                    <i class="far fa-file-image"></i></a>';
                break;
            case 'png':
            case 'PNG':
                return '<a style="margin-right: 4px;" href="/file/invoicePay/'.$path.'" class="cbp-lightbox btn dark btn-xs btn-outline sbold uppercase" data-image="'.$path.'"
                                                   data-title="'.$path.'" data-toggle="popover" data-trigger="hover" data-placement="auto" title="просмотр" data-content="Нажмите для просмотра счета">
                                                    <i class="far fa-file-image"></i></a>';
                break;
            case 'doc':
            case 'docx':
                return '<a style="margin-right: 4px;" href="/file/invoicePay/'.$path.'" class="btn dark btn-xs btn-outline sbold uppercase" data-image="'.$path.'"
                                                   data-title="'.$path.'" data-toggle="popover" data-trigger="hover" data-placement="auto" title="скачать" data-content="Нажмите чтобы скачать счет">
                                                    <i class="far fa-file-word"></i></a>';
                break;
            case 'xls':
            case 'xlsx':
                return '<a style="margin-right: 4px;" href="/file/invoicePay/'.$path.'" class="btn dark btn-xs btn-outline sbold uppercase" data-image="'.$path.'"
                                                   data-title="'.$path.'" data-toggle="popover" data-trigger="hover" data-placement="auto" title="скачать" data-content="Нажмите чтобы скачать счет">
                                                    <i class="far fa-file-excel"></i></a>';
                break;
            default:
                return 'Просмотр не доступен';
                break;
        }
    }
    function getImageFolderDoc($path)
    {
        $fileExtension = new SplFileInfo($path);
        $fileExtension->getExtension(); //расширение файла
        switch ($fileExtension->getExtension()) {
            case 'pdf':
            case 'PDF':
            case 'Pdf':
            case 'PDf':
            case 'pDF':
            case 'pdF':
                return '<a href="/file/addDoc/'.$path.'" target="_blank" class="btn btn-sm btn-outline-brand btn-icon" data-toggle="lightbox" data-image="'.$path.'"
                                                   data-title="'.$path.'" title="просмотр">
                                                    <i class="far fa-file-pdf"></i></a>';
                break;
            case 'jpg':
            case 'jpeg':
            case 'JPG':
            case 'JPEG':
                return '<a href="/file/addDoc/'.$path.'" target="_blank" class="btn btn-sm btn-outline-brand btn-icon" data-toggle="lightbox" data-image="'.$path.'"
                                                   data-title="'.$path.'" title="просмотр">
                                                    <i class="far fa-file-image"></i></a>';
                break;
            case 'png':
            case 'PNG':
                return '<a style="margin-right: 4px;" href="/file/addDoc/'.$path.'" class="cbp-lightbox btn dark btn-xs btn-outline sbold uppercase" data-image="'.$path.'"
                                                   data-title="'.$path.'" data-toggle="popover" data-trigger="hover" data-placement="auto" title="просмотр" data-content="Нажмите для просмотра счета">
                                                    <i class="far fa-file-image"></i></a>';
                break;
            case 'doc':
            case 'docx':
                return '<a style="margin-right: 4px;" href="/file/addDoc/'.$path.'" class="btn dark btn-xs btn-outline sbold uppercase" data-image="'.$path.'"
                                                   data-title="'.$path.'" data-toggle="popover" data-trigger="hover" data-placement="auto" title="скачать" data-content="Нажмите чтобы скачать счет">
                                                    <i class="far fa-file-word"></i></a>';
                break;
            case 'xls':
            case 'xlsx':
                return '<a style="margin-right: 4px;" href="/file/addDoc/'.$path.'" class="btn dark btn-xs btn-outline sbold uppercase" data-image="'.$path.'"
                                                   data-title="'.$path.'" data-toggle="popover" data-trigger="hover" data-placement="auto" title="скачать" data-content="Нажмите чтобы скачать счет">
                                                    <i class="far fa-file-excel"></i></a>';
                break;
            default:
                return 'Просмотр не доступен';
                break;
        }
    }

    function getLabelStatus($labelStatus)
    {
        switch ($labelStatus){
            case '1':
                return '<span class="btn btn-label-warning"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="на согласовании">
                            <i class="flaticon-stopwatch p-0"></i>
                        </span>';
                break;
            case '2':
                if($_SESSION['mngr']['userRole']=='head' || $_SESSION['mngr']['userRole']=='op'){
                    return '<span class="btn btn-label-info"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="на согласовании">
                            <i class="flaticon-stopwatch p-0"></i>
                        </span>';
                }else{
                    return '<span class="btn btn-label-warning"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="согласован руководителем">
                            <i class="flaticon-stopwatch p-0"></i>
                        </span>';
                }
                break;
            case '3':
                if($_SESSION['mngr']['userRole']=='head' || $_SESSION['mngr']['userRole']=='op'){
                    return '<span class="btn btn-label-info"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="согласован руководителем">
                            <i class="flaticon-stopwatch p-0"></i>
                        </span>';
                }else {
                    return '<span class="btn btn-label-info"
                                  data-toggle="popover" data-trigger="hover" data-placement="auto"
                                  data-content="согласован генеральным директором">
                                <i class="flaticon-stopwatch p-0"></i>
                            </span>';
                }
                break;
            case '4':
                return '<span class="btn btn-label-brand"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="Ожидает действия">
                            <i class="flaticon-stopwatch p-0"></i>
                        </span>';
                break;
            case '4.1':
                return '<span class="btn btn-label-warning"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="На согласовании">
                            <i class="flaticon-stopwatch p-0"></i>
                        </span>';
                break;
            case '4.2':
                return '<span class="btn btn-label-success"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="Документ согласован">
                            <i class="la la-star p-0"></i>
                        </span>';
                break;
            case '5':
                return '<span class="btn btn-label-danger"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="отказ">
                            <i class="flaticon2-trash p-0"></i>
                        </span>';
                break;
            case '6':
                return '<span class="btn btn-label-success"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="согласован но не оплачен">
                            <i class="la la-star-o p-0"></i>
                        </span>';
                break;
            case '7':
                return '<span class="btn btn-label-success"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="согласован и оплачен">
                            <i class="la la-star p-0"></i>
                        </span>';
                break;
            default:
                return '<span class="btn btn-label-warning"
                              data-toggle="popover" data-trigger="hover" data-placement="auto"
                              data-content="на согласовании">
                            <i class="flaticon-stopwatch p-0"></i>
                        </span>';
                break;
        }
    }
    function getDepartmentRole($role)
    {
        $item = 'sale';
        switch ($role)
        {
            case 'owner':
            case 'genDir':
                $item = 'control';
                break;
            case 'divisionSaleHead':
                $item = 'sale';
                break;
            case 'divisionServiceHead':
                $item = 'service';
                break;
            case 'productionHead':
                $item = 'production';
                break;
            case 'logist':
                $item = 'production';
                break;
            case 'mngrSale':
                $item = 'sale';
                break;
            case 'mngrService':
                $item = 'service';
                break;
        }
        return $item;
    }
    function getUnderReport($report)
    {
        switch ($report)
        {
            case 'true':
                $item = '<button type="button" class="btn yellow-gold btn-xs">Подотчет</button>';
                break;
            case 'trueOff':
                $item = '<button type="button" class="btn green-jungle btn-xs">Подотчет сдан</button>';
                break;
            case 'false':
                $item = 'Наличка';
                break;
        }
        return $item;
    }
    function currencyCB($code){
        $url = "http://www.cbr.ru/scripts/XML_daily.asp"; // URL, XML документ, всегда содержит актуальные данные
        $curs = array(); // массив с данными

        if(!$xml=simplexml_load_file($url)) die('Ошибка загрузки XML'); // загружаем полученный документ в дерево XML
        list($d, $m, $y) = explode('.', $xml->attributes()->Date);
        $curs['date']=mktime(0, 0, 0, $m, $d, $y);; // получаем текущую дату

        foreach($xml->Valute as $m){ // перебор всех значений
            // для примера будем получать значения курсов лишь для двух валют USD и EUR
            if($m->CharCode==$code){
                $curs[(string)$m->CharCode]=(float)str_replace(",", ".", (string)$m->Value); // запись значений в массив
            }
        }
        return $curs;
    }
    function profitProject($optionArgs)
    {
        $moneyProjectSupp = number_format($optionArgs['moneyProjectSupp'], 2, '.', '&nbsp;');
        if($moneyProjectSupp == 0.00){
            $moneyProjectSupp = 'не установлено';
        }else{
            $moneyProjectSupp = $moneyProjectSupp.'&nbsp;р.';
        }
        $moneyProfit = number_format($optionArgs['money'], 2, '.', '&nbsp;');
        $moneyOther = number_format($optionArgs['moneyOther'], 2, '.', '&nbsp;');
        $perfect = number_format($optionArgs['perfect'], 2, '.', '&nbsp;');
        $perfectOther = number_format($optionArgs['perfectOther'], 2, '.', '&nbsp;');
        $nameContragent = "<b style='color:red;'>нет привязки к покупателю!</b>";
        switch ($optionArgs['typeProject']){
            case 'inside':
                foreach ($optionArgs['allProjects'] as $allProject) {
                    if($optionArgs['numberContract'] == $allProject['id']){
                        //если разрешена статистика пользователю
                        if(!empty($optionArgs['from_Statistic'])){
                            foreach ($optionArgs['allContragents'] as $itemContr){
                                if(!empty($allProject['idContragent'])){
                                    if($allProject['idContragent'] == $itemContr['id']){
                                        $nameContragent = $itemContr['name_contragent'];
                                    }
                                }
                            }
                            $output = '<table>
                                    <tr>
                                        <td width="180"><b>Контрагент</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td><b><span style="color: #3380BE;">'.$nameContragent.'</span></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Проект</b></td>
                                        <td><b>-</b></td>
                                        <td><b><a href="javascript:;" class="linkContract"
                                            data-numcont="'.$optionArgs['numberContract'].'">'.$allProject['nameProject'].'</a></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Стоимость проекта</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td>'.$moneyProjectSupp.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: green"><b>Текущие расходы</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: green">'.$moneyProfit.'&nbsp;р.</td>
                                    </tr>
                                    <tr>
                                        <td style="color: red"><b>На согласовании</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: red">'.$moneyOther.'&nbsp;р.</td>
                                    </tr>
                                </table>';
                            return $output;
                        }else{
                            foreach ($optionArgs['allContragents'] as $itemContr){
                                if(!empty($allProject['idContragent'])){
                                    if($allProject['idContragent'] == $itemContr['id']){
                                        $nameContragent = $itemContr['name_contragent'];
                                    }
                                }
                            }
                            $output = '<table>
                                    <tr>
                                        <td width="180"><b>Контрагент</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td><b><span style="color: #3380BE;">'.$nameContragent.'</span></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Проект</b></td>
                                        <td><b>-</b></td>
                                        <td><b><a href="javascript:;" class="linkContract"
                                            data-numcont="'.$optionArgs['numberContract'].'">'.$allProject['nameProject'].'</a></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Стоимость проекта</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td>'.$moneyProjectSupp.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: green"><b>Текущие расходы</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: green">'.$moneyProfit.'&nbsp;р.</td>
                                    </tr>
                                    <tr>
                                        <td style="color: red"><b>На согласовании</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: red">'.$moneyOther.'&nbsp;р.</td>
                                    </tr>
                                </table>';
                            return $output;
                        }
                    }
                }
                break;
            case 'outside':
                foreach ($optionArgs['allProjects'] as $allProject) {
                    if($optionArgs['numberContract'] == $allProject['id']){
                        //если разрешена статистика пользователю
                        if(!empty($optionArgs['from_Statistic'])){
                            foreach ($optionArgs['allContragents'] as $itemContr){
                                if(!empty($allProject['idContragent'])){
                                    if($allProject['idContragent'] == $itemContr['id']){
                                        $nameContragent = $itemContr['name_contragent'];
                                    }
                                }
                            }
                            $output = '<table>
                                    <tr>
                                        <td width="180"><b>Контрагент</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td><b><span style="color: #3380BE;">'.$nameContragent.'</span></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Проект</b></td>
                                        <td><b>-</b></td>
                                        <td><b><a href="javascript:;" class="linkContract"
                                            data-numcont="'.$optionArgs['numberContract'].'">'.$allProject['nameProject'].'</a></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Стоимость проекта</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td>'.$moneyProjectSupp.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: green"><b>Текущие расходы</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: green">'.$moneyProfit.'&nbsp;р.</td>
                                    </tr>
                                    <tr>
                                        <td style="color: green"><b>Прибыль</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: green"><b>'.$perfect.'&nbsp;р. ('.round($optionArgs['perfectPercent'], 2). '%)</b></td>
                                    </tr>
                                    <tr>
                                        <td style="color: red"><b>На согласовании</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: red">'.$moneyOther.'&nbsp;р.</td>
                                    </tr>
                                    <tr>
                                        <td style="color: red"><b>Прибыль</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: red"><b>'.$perfectOther.'&nbsp;р. ('.round($optionArgs['perfectPercentOther'], 2).'%)</b></td>
                                    </tr>
                                </table>';
                            return $output;
                        }else{
                            foreach ($optionArgs['allContragents'] as $itemContr){
                                if(!empty($allProject['idContragent'])){
                                    if($allProject['idContragent'] == $itemContr['id']){
                                        $nameContragent = $itemContr['name_contragent'];
                                    }
                                }
                            }
                            $output = '<table>
                                    <tr>
                                        <td width="180"><b>Контрагент</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td><b><span style="color: #3380BE;">'.$nameContragent.'</span></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Проект</b></td>
                                        <td><b>-</b></td>
                                        <td><b><a href="javascript:;" class="linkContract"
                                            data-numcont="'.$optionArgs['numberContract'].'">'.$allProject['nameProject'].'</a></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Стоимость проекта</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td>'.$moneyProjectSupp.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: green"><b>Текущие расходы</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: green">'.$moneyProfit.'&nbsp;р.</td>
                                    </tr>
                                    <tr>
                                        <td style="color: green"><b>Прибыль</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: green"><b>'.$perfect.'&nbsp;р. ('.round($optionArgs['perfectPercent'], 2). '%)</b></td>
                                    </tr>
                                    <tr>
                                        <td style="color: red"><b>На согласовании</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: red">'.$moneyOther.'&nbsp;р.</td>
                                    </tr>
                                    <tr>
                                        <td style="color: red"><b>Прибыль</b></td>
                                        <td width="10"><b>-</b></td>
                                        <td style="color: red"><b>'.$perfectOther.'&nbsp;р. ('.round($optionArgs['perfectPercentOther'], 2).'%)</b></td>
                                    </tr>
                                </table>';
                            return $output;
                        }
                    }
                }
                break;
            default:
                $output = '<table>
                        <tr>
                            <td width="180"><b>Контрагент</b></td>
                            <td width="10"><b>-</b></td>
                            <td><i>без привязки к контрагенту</i></td>
                        </tr>
                        <tr>
                            <td><b>Проект</b></td>
                            <td><b>-</b></td>
                            <td><i>без привязки к проекту</i></td>
                        </tr>
                    </table>';
                return $output;
                break;
        }
    }
