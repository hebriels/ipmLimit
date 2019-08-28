<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\SendMail;
use app\models\Ajax;
use app\models\Mngr;

class AjaxController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'ajax';
    }

    function clean($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        return $value;
    }

    function translit($str,$type)
    {
        $str = mb_strtolower($str, 'utf-8');
        $str = str_replace(array(
            '?','!',',',':',';','*','(',')','{','}','%','#','№','@','$','^','+','/','\\','=','|','"','\'',
            'а','б','в','г','д','е','ё','з','и','й','к',
            'л','м','н','о','п','р','с','т','у','ф','х',
            'ъ','ы','э',' ','ж','ц','ч','ш','щ','ь','ю','я'
        ), array(
            '','','','','','','','','','','','','','','','','','','','','','','',/*remove bad chars*/
            'a','b','v','g','d','e','e','z','i','y','k',
            'l','m','n','o','p','r','s','t','u','f','h',
            'j','i','e','_','zh','ts','ch','sh','shch',
            '','yu','ya'
        ), $str);
        if($type == 'document'){
            return date("dmY_His").'_'.$str;
        }else{
            return $str;
        }

    }
    //замена jpg на pdf
    /*function convertJPGtoPDF($paths,$direct)
    {
        list($directorySite, $shell) = explode('app', __DIR__);
        require($directorySite.'/vendor/autoload.php');
        $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        $pdf->SetMargins(0, 0, 0);

        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('arial', '', 11);

        for ($i = 0; $i < count($paths); $i++) {
            $pdf->AddPage();
            $imgFile = '<img src="' . $paths[$i] . '"/>';
            $pdf->writeHTMLCell(0, null, 0, 0, $imgFile, 0, 0, 0, true, 'C', true);
        }

        ob_end_clean();
        $preName = $this->translit('onlyJPEG','document');
        $pdf->Output($direct . DIRECTORY_SEPARATOR.$preName.'.pdf', 'F');
        $newPDF = $preName . '.pdf';
        return $newPDF;
    }*/
    //объединение jpeg c pdf
    /* function updateJPGtoPDF($direct, $pathsPDF)
    {
        list($directorySite, $shell) = explode('app', __DIR__);
        require($directorySite.'/vendor/autoload.php');
        try {

            $mpdf = new Mpdf(['mode' => 'utf-8']);
            $mpdf->SetImportUse();
            foreach ($pathsPDF as $item){
                $allPage = $mpdf->SetSourceFile('public/scanInvoice/' . $item);
                for ($i = 1; $i <= $allPage; $i++) {
                    $mpdf->AddPage();
                    $tplId = $mpdf->ImportPage($i);
                    $mpdf->UseTemplate($tplId);
                    $mpdf->WriteHTML('');
                }
            }
            $preName = $this->translit('JPEGandPDF','document');
            $mpdf->Output($direct.DIRECTORY_SEPARATOR.$preName.'.pdf', 'F');
            return $preName.'.pdf';
        } catch (MpdfException $e) {
            return $e->getMessage();
        }
    }

    function updatePDFtoPDF($direct, $pathsPDF)
    {
        $directorySite = explode('/app', __DIR__);
        require_once($directorySite[0].DIRECTORY_SEPARATOR.'vendor/autoload.php');
        try {
            $mpdf = new Mpdf(['mode' => 'utf-8']);
            $mpdf->SetImportUse();

            foreach ($pathsPDF as $item){
                $allPage = $mpdf->SetSourceFile('public/scanInvoice/' . $item);
                for ($i = 1; $i <= $allPage; $i++) {
                    $mpdf->AddPage();
                    $tplId = $mpdf->ImportPage($i);
                    $mpdf->UseTemplate($tplId);
                    $mpdf->WriteHTML('');
                }
            }
            $preName = $this->translit('onlyPDF','document');
            $mpdf->Output($direct.DIRECTORY_SEPARATOR.$preName.'.pdf', 'F');
            return $preName.'.pdf';
        } catch (MpdfException $e) {
            return $e->getMessage();
        }
    }*/
    //добавляем данные к PDF документу
    /*function addPageInfoPDF($direct,$resultPaths)
    {
        $directorySite = explode('/app', __DIR__);
        require_once($directorySite[0].DIRECTORY_SEPARATOR.'vendor/autoload.php');
        if(!empty($_POST['currencyTransform'])){
            $money = explode(' ',$_POST['currencyTransform']);
            $money = $this->clean($money[0]);
        }else{
            $money = $this->clean($_POST['summInvoiceForPayment']);
        }
        $money = str_replace(',','.',$money);
        $money = str_replace(' ','',$money);
        switch ($_POST['selectCurrency']){
            case 'RUR':
                $currency = '';
                break;
            case 'EUR':
                $currency = 'Внимание! Счет инициирован в валюте (Евро). Сумма выведена в рублях по курсу ЦБ на момент инициализации.';
                break;
            case 'USD':
                $currency = 'Внимание! Счет инициирован в валюте (Доллар). Сумма выведена в рублях по курсу ЦБ на момент инициализации.';
                break;
        }
        try {
            $html = '<h2>Информация о счете</h2><table border="1">
                    <tr>
                        <td>№ счета</td><td>'.$_POST["numberInvoice"].'</td>
                    </tr>
                    <tr>
                        <td>Проект</td><td>'.$this->model->getNameProjectForID($_POST["idProjectHidden"]).'</td>
                    </tr>
                    <tr>
                        <td>Сумма к оплате</td><td>'.$money.'</td>
                    </tr>
                    <tr>
                        <td>Поставщик</td><td>'.$this->model->getNameContragentForID($_POST["idHiddenContragent"]).'</td>
                    </tr>
                    <tr>
                        <td>Инициатор</td><td>'.$_SESSION["mngr"]["userSurname"].' '.$_SESSION["mngr"]["userFirstName"].'</td>
                    </tr>
                    <tr>
                        <td>Примечание</td><td>'.$_POST["noticeInvoiceForPayment"].'</td>
                    </tr>
                </table>
            <h3>'.$currency.'</h3>';
            $mpdf = new Mpdf(['mode' => 'utf-8']);
            $mpdf->SetImportUse();
            $page2 = $mpdf->SetSourceFile('public/scanInvoice/'.$resultPaths);
            for ($i=1;$i<=count($page2);$i++) {
                //$mpdf->SetPageTemplate($page2);
                $mpdf->AddPage();
                $tplId = $mpdf->ImportPage($i);
                $mpdf->UseTemplate($tplId);
                $mpdf->WriteHTML('');
            }
            $mpdf->addPage();
            $mpdf->WriteHTML($html);
            //$preName = $this->translit('onlyPDF3');
            $mpdf->Output($direct.DIRECTORY_SEPARATOR.$resultPaths, 'F');
            return $resultPaths;
        } catch (MpdfException $e) {
            return $e->getMessage();
        }
    }*/
    //изменение размера картинки
    function resize($image, $w_o = false, $h_o = false) {
        if (($w_o < 0) || ($h_o < 0)) {
            echo "Некорректные входные параметры";
            return false;
        }
        list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)
        $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
        $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
        if ($ext) {
            $func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
            $img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
        } else {
            echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
            return false;
        }
        /* Если указать только 1 параметр, то второй подстроится пропорционально */
        if (!$h_o) $h_o = $w_o / ($w_i / $h_i);
        if (!$w_o) $w_o = $h_o / ($h_i / $w_i);
        $img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
        imageAlphaBlending($img_o, false);
        imageSaveAlpha($img_o, true);
        imagecopyresampled($img_o, $img_i, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его
        $func = 'image'.$ext; // Получаем функция для сохранения результата
        return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
    }
    function dateTrans($str) {
        $arr1 = explode('.',$str);
        $daySign = $arr1[0];
        $monthSign = $arr1[1];
        $arr2 = explode(' ',$arr1[2]);
        $yearSign = $arr2[0];
        $timeSign = $arr2[1];
        $lastSign = $yearSign.'-'.$monthSign.'-'.$daySign.' '.$timeSign.':00';
        return $lastSign;
    }
    //функция добавления инфо файла pdf
    /*public function addInfoForPrint($direct,$html)
    {
        $directorySite = explode('/app', __DIR__);
        require_once($directorySite[0].DIRECTORY_SEPARATOR.'vendor/autoload.php');
        try {
            $mpdf = new Mpdf();

            $mpdf->AddPage();
            $mpdf->WriteHTML($html);

            $preName = $this->translit('onlyPrint','document');
            $mpdf->Output($direct.DIRECTORY_SEPARATOR.$preName.'.pdf', 'F');
            return $preName.'.pdf';
        } catch (MpdfException $e) {
            return $e->getMessage();
        }
    }*/
    function funcCURLSelAutorize($loginSel,$passSel)
    {
        $ch = curl_init('https://auth.selcdn.ru/');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Auth-User:'.$loginSel,
            'X-Auth-Key:'.$passSel
        ]);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_HEADERFUNCTION,
            function($curl, $header) use (&$headers)
            {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2)
                    return $len;

                $name = strtolower(trim($header[0]));
                $headers[$name] = [trim($header[1])];
                return $len;
            }
        );

        $resultCurl = curl_exec($ch);
        $cURL_Error = curl_errno($ch);
        if ($cURL_Error > 0){
            echo 'cURL Error: --'.$cURL_Error.'--<br>';
            $result = false;
        }else{
            $result = $resultCurl;
        }
        curl_close($ch);
        $data = [
            'token' => $headers['x-auth-token'][0],
            'sUrl' => $headers['x-storage-url'][0]
        ];
        return $data;
        //$token = $headers['x-auth-token'][0];
        //$sUrl = $headers['x-storage-url'][0];
    }
    function funcInsertFile($fileSel,$fileNameSel)
    {
        $data = $this->funcCURLSelAutorize('88868_user-2311175141','kwtnetyand123');

        $newFile = 'public/scanInvoice/'.$fileNameSel;

        $fp = fopen($newFile,'r');
        $filesize = filesize($newFile);

        $ch = curl_init('https://api.selcdn.ru/v1/SEL_88868/2311175141/'.$fileNameSel);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_INFILE, $fp);
        curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Auth-Token:'.$data['token']
        ]);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $resultCurl = curl_exec($ch);

        fclose($fp);
        return $resultCurl;
    }

    public function ajaxpostAction()
    {
        if(isset($_POST['adminAjax'])){
            switch ($_POST['adminAjax']){
                case 'editOptions':
                    $params = $this->clean($_POST['params']);
                    $this->model->editOptions($_POST['option'],$params);
                    $data = array(
                        'true' => 'true'
                    );
                    echo json_encode($data);
                    break;
                case 'editNotice':
                    $params = $this->clean($_POST['params']);
                    $this->model->editNotice($_POST['userID'],$_POST['notice'],$params);
                    $data = array(
                        'true' => 'true'
                    );
                    echo json_encode($data);
                    break;
                case 'editDepartment':
                    $id = $_POST['id'];
                    $name = $this->clean($_POST['name']);
                    $this->model->editDepartment($id,$name);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'editBossDepartment':
                    $this->model->editBossDepartment();
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'editOrganization':
                    $id = $_POST['id'];
                    $nameOrganization = $this->clean($_POST['nameOrganization']);
                    $innOrganization = $this->clean($_POST['innOrganization']);
                    $kppOrganization = $this->clean($_POST['kppOrganization']);
                    $this->model->editOrganization($id,$nameOrganization,$innOrganization,$kppOrganization);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'editPosts':
                    $id = $_POST['id'];
                    $name = $this->clean($_POST['name']);
                    $this->model->editPosts($id,$name);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'editToMail':
                    $id = $_POST['id'];
                    $name = $this->clean($_POST['name']);
                    $rowName = $_POST['rowName'];
                    $this->model->editToMail($id,$name,$rowName);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'editCurrencyOption':
                    $currency = $_POST['currency'];
                    $tableValue = $_POST['tableValue'];
                    $params = $this->clean($_POST['params']);
                    $this->model->editCurrencyOption($currency,$tableValue,$params);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'editListUsers':
                    if(!$this->model->testListUsers($_POST['userID'])){
                        $this->model->insertListUsers($_POST['userID'],$_POST['newValue'],$_POST['tableCol']);
                    }else{
                        $this->model->updateListUsers($_POST['userID'],$_POST['newValue'],$_POST['tableCol']);
                    }
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'editPostsDepartment':
                    $id = $_POST['id'];
                    $name = $this->clean($_POST['name']);
                    $this->model->editPostsDepartment($id,$name);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'deleteDepartment':
                    $deleteID = $_POST['deleteID'];
                    $this->model->deleteDepartment($deleteID);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'deleteOrganization':
                    $deleteID = $_POST['deleteID'];
                    $this->model->deleteOrganization($deleteID);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'deletePosts':
                    $deleteID = $_POST['deleteID'];
                    $this->model->deletePosts($deleteID);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'addDepartment':
                    $newDepartment = $this->clean($_POST['newDepartment']);
                    $this->model->addDepartment($newDepartment);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'addOrganization':
                    $newOrganization = $this->clean($_POST['newOrganization']);
                    $innOrganization = $this->clean($_POST['innOrganization']);
                    $kppOrganization = $this->clean($_POST['kppOrganization']);
                    $this->model->addOrganization($newOrganization,$innOrganization,$kppOrganization);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'addPosts':
                    $postDepartment = $_POST['postDepartment'];
                    $newPosts = $this->clean($_POST['newPosts']);
                    $this->model->addPosts($postDepartment,$newPosts);
                    $data = array(
                        'true' => true
                    );
                    echo json_encode($data);
                    break;
                case 'getDepartments':
                    $departments = $this->model->getDepartments();
                    $data = array(
                        'departments' => $departments
                    );
                    echo json_encode($departments);
                    break;
                case 'getListUsers':
                    echo json_encode($this->model->getListUsers());
                    break;
                case 'getListCurrency':
                    echo json_encode($this->model->getListCurrency());
                    break;
                case 'getListUserInvoice':
                    echo json_encode($this->model->getListUserInvoice());
                    break;
                case 'getListProgress':
                    $listProgress = $this->model->getListProgress();
                    $departments = $this->model->getAllDepartments();
                    $posts = $this->model->getAllPosts();
                    $listProg = [];
                    $allList = [];
                    foreach ($listProgress as $listProgres){
                        if($listProgres['postDP']=='department'){
                            foreach ($departments as $department){
                                if($department['id']==$listProgres['text']){
                                    $listProg[] =  [
                                        'id'=>$listProgres['id'],
                                        'parent'=>$listProgres['parent'],
                                        'text'=>$department['nameDepartment']
                                    ];
                                    //$object = (object)$listProg;
                                }
                            }
                        }
                        if($listProgres['postDP']=='posts'){
                            foreach ($posts as $postsP){
                                if($postsP['id']==$listProgres['text']){
                                    $listProg[] =  [
                                        'id'=>$listProgres['id'],
                                        'parent'=>$listProgres['parent'],
                                        'text'=>$postsP['postDepartment']
                                    ];
                                    $object = (object)$listProg;
                                }
                            }
                        }
                    }
                    $allList = (array)$object;
                    $data = array(
                        'progress' => $allList
                    );
                    echo json_encode($data);
                    break;
                case 'updateProgress':
                    $result = $this->model->updateProgress($_POST);
                    $data = array(
                        'result' => $result
                    );
                    echo json_encode($data);
                    break;
                case 'holiday':
                    $this->model->updateHoliday($_POST['userID'],$_POST['typeHoliday'],$_POST['dateToday'],$_POST['autoDelegate']);
                    break;
                case 'updateLogo':
                    if (empty($_FILES['file'])) {
                        echo json_encode(['error'=>'noImage']);
                        return;
                    }

                    $filenames = $this->translit($_FILES['file']['name'][0],'logo');
                    list($directorySite, $shell) = explode('app',__DIR__);
                    $direct = $directorySite.'assets/images/logos';

                    $nameImage = $this->model->getOneOption('imageLogo'); //имя текущего логотипа
                    unlink($directorySite.'/assets/images/logos'.DIRECTORY_SEPARATOR.$nameImage); //удаляем старый логотип

                    $target = $direct.DIRECTORY_SEPARATOR.$filenames;
                    if(move_uploaded_file($_FILES['file']['tmp_name'][0], $target)) {
                        $data = ['error' => 'успешная отправка'];
                    }else{
                        $data = ['error'=>'Запись в базу нарушена'];
                    }

                    $this->resize('assets/images/logos'.DIRECTORY_SEPARATOR.$filenames, false,32.4); //меняем высоту изображения

                    $this->model->editOptions('imageLogo',$filenames); //меняем имя логотипа в базе
                    echo json_encode($data);
                    break;
                default:
                    $data = array(
                        'result' => 'not switch'
                    );
                    echo json_encode($data);
                    break;
            }
        }
        if(isset($_POST['mainAjax'])){
            switch ($_POST['mainAjax']){
                case 'updateStatusInvoice':
                    if(!isset($_SESSION['mngr']['userSurname'])){
                        unset($_SESSION['mngr']);
                        $this->view->redirect('/');
                        break;
                    }
                    $invoiceId = $_POST['invoiceId'];
                    $mngrID = $_POST['mngrID'];
                    $mngrtable = $_POST['mngrtable'];
                    $dateToday = $_POST['dateToday'];
                    $userName = $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'];
                    $userToMile = $this->model->getUserToMail($_SESSION['mngr']['id']);

                    if($_POST['btn']=='success') {
                        $this->model->noticeNextInvoice($invoiceId,$mngrtable);//уведомление об изменении счета
                        if($mngrtable=='invoice'){
                            $this->model->insertPartner($invoiceId,'invoice');
                        }else{
                            $this->model->insertPartner($invoiceId,'forPay');
                        }
                    }elseif($_POST['btn']=='failure'){
                        $inputValueFailure = $this->clean($_POST['inputValueFailure']); //текст отказа
                        $this->model->failureComment($invoiceId,$mngrtable,$inputValueFailure); //установка последнего комментария
                    }elseif(isset($_POST['inputValueMoney'])){
                        $inputValueMoney = $this->clean($_POST['inputValueMoney']); //изменение суммы при подписании
                        $this->model->updateSummInvoice($invoiceId,$inputValueMoney); //изменение цены
                    }
                    $this->model->deleteNoticeCycle($invoiceId,$mngrtable); //удаление уведомления
                    $getStatusInvoice = $this->model->updateStatusInvoice($invoiceId, $mngrtable, $mngrID, $dateToday, $_POST['btn'], $userName, $userToMile);
                    $data = array(
                        'getStatusInvoice' => $getStatusInvoice
                    );
                    echo json_encode($data);
                    break;
                case 'loadNoticeDB':
                    $allNoticeUser = $this->model->noticeUserDB($_POST['userID']);
                    $data = array(
                        'allNoticeUser' => $allNoticeUser,
                        'allNoticeCount' => count($allNoticeUser)
                    );
                    echo json_encode($data);
                    break;
                case 'firstLoadCommentDB':
                    $arrComments = $this->model->firstLoadCommentDB($_POST['idInvoice'],$_POST['type']);
                    $allComment = [];
                    foreach ($arrComments as $comment){
                        $typeComment = '';
                        if($comment['autorComment']==$_SESSION['mngr']['id']){
                            $typeComment = 'kt-chat__message--right';
                        }
                        $dataUser = $this->model->getOneUsers($comment['autorComment']);
                        $allComment[] = [
                            'id' => $comment['id'],
                            'avatar' => $dataUser[0]['userAvatar'],
                            'autor' => $dataUser[0]['userSurname'].' '.$dataUser[0]['userFirstName'],
                            'dateCreate' => $comment['dateCreate'],
                            'textComment' => $comment['textComment'],
                            'typeComment' => $typeComment,
                        ];
                    }
                    $this->model->deleteNoticeCycle($_POST['idInvoice'],$_POST['type']);
                    $data = array(
                        'allComment' => $allComment
                    );
                    echo json_encode($data);
                    break;
                case 'loadCommentDB':
                    $arrComments = $this->model->loadCommentDB($_POST['idInvoice'],$_POST['lastIdComment'],$_POST['typeAdd']);
                    $allComment = [];
                    foreach ($arrComments as $comment){
                        $typeComment = '';
                        if($comment['autorComment']==$_SESSION['mngr']['id']){
                            $typeComment = 'kt-chat__message--right';
                        }
                        $dataUser = $this->model->getOneUsers($comment['autorComment']);
                        $allComment[] = [
                            'id' => $comment['id'],
                            'avatar' => $dataUser[0]['userAvatar'],
                            'autor' => $dataUser[0]['userSurname'].' '.$dataUser[0]['userFirstName'],
                            'dateCreate' => $comment['dateCreate'],
                            'textComment' => $comment['textComment'],
                            'typeComment' => $typeComment,
                        ];
                    }
                    $this->model->deleteNoticeCycle($_POST['idInvoice'],$_POST['typeAdd']);
                    $data = array(
                        'allComment' => $allComment
                    );
                    echo json_encode($data);
                    break;
                case 'insertCommentDB':
                    $idInvoice = $_POST['idInvoice'];
                    $textComment = $this->clean($_POST['textComment']);
                    $idComment = $this->model->insertCommentDB($idInvoice,$textComment,$_POST['dateTimeStamp']);
                    $data = array(
                        'textComment' => $textComment,
                        'idComment' => $idComment
                    );
                    echo json_encode($data);
                    break;
                case 'testPartner':
                    $testPartner = $this->model->testPartner($_POST['idInvoice'],$_POST['typeAdd']);
                    $testPartner = explode(",",$testPartner[0]['idPartner']);
                    $arrTrue = 'false';
                    foreach ($testPartner as $item){
                        if($item==$_SESSION['mngr']['id']){
                            $arrTrue = 'true';
                        }
                    }
                    if($arrTrue == 'false'){
                        $this->model->insertPartner($_POST['idInvoice'],$_POST['typeAdd']);
                    }
                    $data = array(
                        'arrTest' => $arrTrue
                    );
                    echo json_encode($data);
                    break;
                case 'deleteNoticeDB':
                    $this->model->deleteNoticeDB($_POST['noticeid']);
                    break;
                case 'loadAllInvoiceMngr':
                    $userRole = $_SESSION['mngr']['userRole']; //id должности
                    $userDepartment = $this->model->getOneMngrListUser($_SESSION['mngr']['id'],'from_Statistic');
                    if($_POST['forUserID']=='all'){
                        $listUserID = $this->model->getListUserIDFromDepartment($userDepartment); //id работников отдела
                    }else{
                        $listUserID = $this->model->getOneUsers($_POST['forUserID']);
                    }

                    if(!isset($_POST['dateFrom']) || !isset($_POST['dateTo'])){
                        $dateFrom = '01.01.2018';$dateTo = '01.01.2030';
                    }else{
                        $dateFrom = $_POST['dateFrom'];$dateTo = $_POST['dateTo'];
                    }
                    list($day,$month,$year) = explode('.',$dateFrom);
                    $dateFrom = $year.'-'.$month.'-'.$day;
                    list($day,$month,$year) = explode('.',$dateTo);
                    $dateTo = $year.'-'.$month.'-'.$day;

                    $allInvoiceMngr = [];
                    foreach ($listUserID as $item){

                        $invoiceCount = $this->model->getIvoiceCountUser($item['id'],$dateFrom,$dateTo);
                        if($invoiceCount!=0 && $this->model->getAdminUsers($item['id'])!='delete') {
                            $totalInvoice = '';
                            if ($this->model->loadAllInvoiceMngr($item['id'], $dateFrom, $dateTo) === '') {
                                $totalInvoice = 0;
                            } else {
                                $totalInvoice = $this->model->loadAllInvoiceMngr($item['id'], $dateFrom, $dateTo);
                                $totalInvoice = number_format($totalInvoice, 2, '.', '&nbsp;');
                            }

                            $statusSuccess = $this->model->getInvoiceSuccessUser($item['id'], $dateFrom, $dateTo);
                            $statusFailure = $this->model->getInvoiceFailureUser($item['id'], $dateFrom, $dateTo);
                            $percent = 0;
                            if ($statusSuccess + $statusFailure != 0) {
                                $percent = round((100 / ($statusSuccess + $statusFailure)) * $statusSuccess, 1);
                            }
                            $dateCreate = $lastSign = $diff = $diff2 = $date1 = $date2 = 0;
                            if ($this->model->timeInvoice($item['id'], $dateFrom, $dateTo)) {
                                $timeInvoice = $this->model->timeInvoice($item['id'], $dateFrom, $dateTo);
                                for ($i = 0; $i < $statusSuccess; $i++) {
                                    $dateCreate = $timeInvoice[$i]['date_create'];

                                    if ($timeInvoice[$i]['date_signature'] == '') {
                                        $lastSign = $dateCreate;
                                    } else {
                                        $resultSign = json_decode($timeInvoice[$i]['date_signature'], true);
                                        $lastSign = $resultSign[count($resultSign) - 1];
                                        //$lastSign = json_decode($resultSign,true);
                                        $lastSign = $this->dateTrans($lastSign['date']);
                                    }

                                    $dateSuccess = $this->dateTrans($timeInvoice[$i]['date_success']);

                                    $dateCreate = strtotime($dateCreate) * 1000;
                                    $dateSuccess = strtotime($dateSuccess) * 1000;
                                    $lastSign = strtotime($lastSign) * 1000;

                                    $diff += $lastSign - $dateCreate;
                                    $diff2 += $dateSuccess - $lastSign;

                                    $summSign = $diff;
                                    $summSs = $diff2;
                                }
                                if ($statusSuccess !== 0) {
                                    $summSign = $summSign / $statusSuccess;
                                    $summSign = floor($summSign);

                                    $summSs = $summSs / $statusSuccess;
                                    $summSs = floor($summSs);

                                    $dayS = floor($summSign / 86400000);
                                    $summSign -= $dayS * 86400000;
                                    $hS = floor($summSign / 3600000);
                                    $summSign -= $hS * 3600000;
                                    $mS = floor($summSign / 60000);

                                    $daySs = floor($summSs / 86400000);
                                    $summSs -= $daySs * 86400000;
                                    $hSs = floor($summSs / 3600000);
                                    $summSs -= $hSs * 3600000;
                                    $mSs = floor($summSs / 60000);

                                    $dayS = (int)preg_replace('/\D/', '', $dayS);
                                    $date1 = $dayS . 'д:' . $hS . 'ч:' . $mS . 'м';
                                    $date2 = $daySs . 'д:' . $hSs . 'ч:' . $mSs . 'м';
                                }
                            }
                            $allInvoiceMngr[] = [
                                //'userID'=>$item['id'],
                                'userName' => '<div class="kt-user-card-v2">
                                            <div class="kt-user-card-v2__pic">
                                            <img src="/assets/images/ava/' . $item['userAvatar'] . '" class="m-img-rounded kt-marginless" alt="ava">
                                                </div>
                                            <div class="kt-user-card-v2__details">
                                            <span class="kt-user-card-v2__name">' . $this->model->getNameDepartmentsPost($item['userRole']) . '</span>
                                            <a href="javascript:;" class="kt-user-card-v2__email kt-link targetUserName" data-userid="' . $item['id'] . '" data-username="' . $item['userSurname'] . ' ' . $item['userFirstName'] . '">' . $item['userSurname'] . ' ' . $item['userFirstName'] . '</a>
                                            </div>
                                            </div>',
                                'invoiceCount' => $this->model->getIvoiceCountUser($item['id'], $dateFrom, $dateTo),
                                'totalInvoice' => $totalInvoice,
                                'statusSuccess' => $statusSuccess,
                                'statusFailure' => $statusFailure,
                                'percent' => '<div class="kt-widget12__progress">	
                                                <div class="progress kt-progress--sm">
                                                    <div class="progress-bar kt-bg-brand" role="progressbar" style="width: '.$percent.'%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>								 
                                                <span class="kt-widget12__stat">
                                                    '.$percent.'%
                                                </span>
                                            </div>',
                                'signature' => $date1,
                                'payment' => $date2
                            ];
                        }
                    }
                    $data = array(
                        'arrStatMngr' => $allInvoiceMngr
                    );
                    echo json_encode($data);
                    break;
                case 'loadDepartmentStatistic':
                    $userID = $_POST['userID'];
                    $allowedListUsers = $this->model->allowedListUsers();

                    $fromInvoice = explode(',',$allowedListUsers[0]['from_invoice']);
                    $totalInvoice = ''; //сумма всех счетов в работе
                    $countInvoiceWork = ''; //кол-во счетов в работе
                    foreach ($fromInvoice as $fInvoice){
                        $totalInvoice = (float)$totalInvoice+(float)$this->model->loadAllInvoiceMngrInWork($fInvoice);
                        $countInvoiceWork = (float)$countInvoiceWork+(float)$this->model->loadAllCountInvoiceInWork($fInvoice);
                    }
                    $totalInvoice = number_format($totalInvoice, 2, '.', '&nbsp;');

                    $fromPay = explode(',',$allowedListUsers[0]['from_invoicePay']);
                    $totalPay = ''; //сумма всех служебок в работе
                    $countPayWork = ''; //кол-во счетов в работе
                    foreach ($fromPay as $fPay){
                        $totalPay = (float)$totalPay+(float)$this->model->loadAllPayMngrInWork($fPay);
                        $countPayWork = (float)$countPayWork+(float)$this->model->loadAllCountPayInWork($fPay);
                    }
                    $totalPay = number_format($totalPay, 2, '.', '&nbsp;');

                    $fromDoc = explode(',',$allowedListUsers[0]['from_doc']);
                    $countDocWork = ''; //кол-во документов в работе
                    foreach ($fromDoc as $fDoc){
                        $countDocWork = (float)$countDocWork+(float)$this->model->loadAllCountDocInWork($fDoc);
                    }

                    $allDepStat = [];
                    $allDepStat[] = [
                        /*'department' => 555,
                        'userChargeData' => '<div class="kt-user-card-v2">
                                    <div class="kt-user-card-v2__pic">
                                        <img src="/assets/images/ava/nophoto.jpg" class="m-img-rounded kt-marginless" alt="ava">
                                    </div>
                                    <div class="kt-user-card-v2__details">
                                        <span class="kt-user-card-v2__name">Управляющий</span>
                                        <a href="javascript:;" class="kt-user-card-v2__email kt-link targetUserName">Босс</a>
                                    </div>
                                </div>',*/
                        'totalInvoice' => '<div class="kt-user-card-v2">
                                    <div class="kt-user-card-v2__details">
                                        <a href="javascript:;" class="kt-user-card-v2__name kt-link targetLink" data-link="table1">'.$countInvoiceWork.' в работе</a>
                                        <span class="kt-user-card-v2__email">'.$totalInvoice.'&nbsp;р.</span>
                                    </div>
                                </div>',
                        'totalPay' => '<div class="kt-user-card-v2">
                                    <div class="kt-user-card-v2__details">
                                        <a href="javascript:;" class="kt-user-card-v2__name kt-link targetLink" data-link="table3">'.$countPayWork.' в работе</a>
                                        <span class="kt-user-card-v2__email">'.$totalPay.'&nbsp;р.</span>
                                    </div>
                                </div>',
                        'totalDoc' => '<div class="kt-user-card-v2">
                                    <div class="kt-user-card-v2__details">
                                        <a href="javascript:;" class="kt-user-card-v2__name kt-link targetLink" data-link="table4">'.$countDocWork.' в работе</a>
                                        <span class="kt-user-card-v2__email"></span>
                                    </div>
                                </div>'
                    ];
                    $data = array(
                        'test' => $countPayWork,
                        'arrDepStat' => $allDepStat
                    );
                    echo json_encode($data);
                    break;
                case 'dataTest':
                    $testType = $_POST['testType'];
                    switch ($_POST['groupType']){
                        case 'testinvoice':
                            switch ($testType){
                                case 'dataall':
                                    $testData = $this->model->getAllInvoice(); //все счета
                                    break;
                            }
                            break;
                        case 'testpay':
                            switch ($testType){
                                case 'dataall':
                                    $testData = $this->model->getAllInvoicePay(); //все счета
                                    break;
                            }
                            break;
                        case 'testdoc':

                            break;
                        case 'testcontragents':

                            break;
                        case 'testproject':
                            switch ($testType){
                                case 'dataall':
                                    $testData = $this->model->getAllProjects(); //все счета
                                    break;
                            }
                            break;
                    }
                    $data = array(
                        'testData' => $testData
                    );
                    echo json_encode($data);
                    break;
                case 'insertContract':
                    $numberContract = $this->clean($_POST['numberContract']);
                    if($this->model->testContract($numberContract)==false){
                        $this->model->insertContract($numberContract);
                    }
                    break;
                case 'insertPay':
                    $numberContractPay = $this->clean($_POST['numberContractPay']);
                    $idProjectHiddenPay = $this->clean($_POST['idProjectHiddenPay']);
                    $deletePathRepPay = $_POST['deletePathRepPay'];
                    $datetimeStamp = $_POST['datetimeStamp'];
                    $summForPayment = $this->clean($_POST['summForPayment']);
                    $money = str_replace(',','.',$summForPayment);
                    $noticeForPay = $_POST['noticeForPay'];

                    $success = true;
                    $paths = '';
                    if (!empty($_FILES['file'])) {
                        $filenames = $_FILES['file']['name'];

                        list($directorySite, $shell) = explode('app',__DIR__);
                        $direct = $directorySite.'file/invoicePay';

                        $preName = $this->translit($filenames[0],'document');
                        $target = $direct.DIRECTORY_SEPARATOR.$preName;
                        if(move_uploaded_file($_FILES['file']['tmp_name'][0], $target)) {
                            $paths = $preName;
                        } else {
                            $success = false;
                        }
                    }
                    if($deletePathRepPay!='false'){
                        $paths = $deletePathRepPay;
                    }
                    $data = ['error' => $success];

                    $this->model->insertPay($_POST['underReportPay'],$idProjectHiddenPay,$money,$noticeForPay,$paths,$datetimeStamp);
                    echo json_encode($data);
                    break;
                case 'editNotice':
                    $params = $this->clean($_POST['params']);
                    $this->model->editNotice($_POST['userID'],$_POST['notice'],$params);
                    $data = array(
                        'true' => 'true'
                    );
                    echo json_encode($data);
                    break;
                case 'searchOneProject':
                    $idProject = $_POST['idProject'];
                    $dateFrom = $this->clean($_POST['dateFrom']);
                    $dateTo = $this->clean($_POST['dateTo']);

                    if($this->model->testContract($idProject)==true){
                        $testContract = true;
                        if(empty($dateFrom) || empty($dateTo)){
                            $dateFrom = '1.01.2000';
                            $dateTo = '1.01.2030';
                        }
                        //$dataContract = $this->model->dataProject($idProject,$dateFrom,$dateTo);
                    }else{
                        $testContract = false;
                    }

                    $data = array(
                        'numberContract' => $idProject,
                        'dateFrom' => $dateFrom,
                        'dateTo' => $dateTo,
                        'testContract' => $testContract,
                        //'dataContract' => $dataContract
                    );
                    echo json_encode($data);
                    break;
                case 'checkProject':
                    $numberContract = $this->clean($_POST['numberContract']);
                    $dataProjects = $this->model->checkProject($numberContract);
                    $dataProject = [];
                    foreach ($dataProjects as $item){
                        $nameContragent = $this->model->getNameContragentForID($item['idContragent']);
                        if($nameContragent==false){
                            $nameContragent = 'нет привязки';
                        }
                        if(empty($item['moneyProject'])){
                            $item['moneyProject'] = 0;
                        }
                        $dataProject[] = [
                            'id' => $item['id'],
                            'nameProject' => $item['nameProject'],
                            'dateCreate' => $item['dateCreate'],
                            'idContragent' => $nameContragent,
                            'notice' => $item['notice_project'],
                            'moneyProject' => $item['moneyProject']
                        ];
                    }
                    $dataContragent = $this->model->checkContragent($numberContract);

                    $data = array(
                        'dataProject' => $dataProject,
                        'dataContragent' => $dataContragent
                    );
                    echo json_encode($data);
                    break;
                case 'labelEdit':
                    $idInvoice = $_POST['idInvoice'];
                    $typeAdd = $_POST['typeAdd'];
                    $label = $_POST['label'];
                    if($label=='true'){
                        $_SESSION['mngr']['editInvoice'] = 'true';
                        $_SESSION['mngr']['idInvoice'] = $_POST['idInvoice'];
                    }else{
                        unset($_SESSION['mngr']['editInvoice']);
                        unset($_SESSION['mngr']['idInvoice']);
                    }
                    $this->model->labelEdit($idInvoice,$typeAdd,$label);
                    break;
                case 'testSignature':
                    $idInvoice = $_POST['idInvoice'];
                    $typeAdd = $_POST['typeAdd'];
                    $data = array(
                        'resultTest' => $this->model->testSignature($idInvoice,$typeAdd)
                    );
                    echo json_encode($data);
                    break;
                case 'testEdit':
                    $idInvoice = $_POST['idInvoice'];
                    $typeAdd = $_POST['typeAdd'];
                    $dateEdit = $_POST['dateEdit'];
                    $data = array(
                        'resultTest' => $this->model->testEdit($idInvoice,$typeAdd,$dateEdit)
                    );
                    echo json_encode($data);
                    break;
                case 'insertContragent':
                    $newInnContragent = $this->clean($_POST['newInnContragent']);
                    $newNameContragent = $this->clean($_POST['newNameContragent']);
                    $datetimeStamp = $_POST['dateTime'];
                    $newKppContragent = $this->clean($_POST['newKppContragent']);
                    $newNoticeContragent = $this->clean($_POST['newNoticeContragent']);
                    $mineOrg = $_POST['mineOrg'];
                    $idInitiator = $_POST['idInitiator'];
                    if($this->model->testContragent($newInnContragent)==false){
                        $idContragent = $this->model->insertContragent($newInnContragent,$newNameContragent,$newKppContragent,$newNoticeContragent,$mineOrg,$idInitiator,$datetimeStamp);
                    }else{
                        $idContragent = 'false';
                    }
                    $data = array(
                        'idContragent' => $idContragent
                    );
                    echo json_encode($data);
                    break;
                case 'insertProject':
                    $newNameProject = $this->clean($_POST['newNameProject']);
                    $newNoticeProject = $this->clean($_POST['newNoticeProject']);
                    $datetimeStamp = $_POST['dateTime'];
                    $idContragent = $_POST['idContragent'];
                    $idInitProject = $_POST['idInitProject'];
                    $expenseProject = $this->clean($_POST['expenseProject']);
                    $moneyProject = $this->clean($_POST['moneyProject']);
                    $moneyProject = str_replace(',','.',$moneyProject);
                    $selectedProject = $_POST['selectedProject'];
                    $profitProject = round($this->clean($_POST['profitProject']),2);

                    $idProject = $this->model->insertProject($newNameProject,$newNoticeProject,$idContragent,$idInitProject,$expenseProject,$moneyProject,$selectedProject,$profitProject,$datetimeStamp);

                    $data = array(
                        'idProject' => $idProject
                    );
                    echo json_encode($data);
                    break;
                case 'insertSuppProject':
                    $userID = $_POST['userID'];
                    $idProject = $_POST['idProject'];
                    $nameSupp = $this->clean($_POST['nameSupp']);
                    $moneySupp = $this->clean($_POST['moneySupp']);
                    $moneySupp = str_replace(',','.',$moneySupp);

                    $this->model->insertSuppProject($userID,$idProject,$nameSupp,$moneySupp,$_POST['dateTime']);

                    $data = array(
                        'result' => true
                    );
                    echo json_encode($data);
                    break;
                case 'editSuppProject':
                    $userID = $_POST['userID'];
                    $idEditSupp = $_POST['idEditSupp'];
                    $nameSupp = $this->clean($_POST['nameSupp']);
                    $moneySupp = $this->clean($_POST['moneySupp']);
                    $moneySupp = str_replace(',','.',$moneySupp);

                    $this->model->editSuppProject($idEditSupp,$nameSupp,$moneySupp);

                    $data = array(
                        'result' => true
                    );
                    echo json_encode($data);
                    break;
                case 'deletSuppProject':
                    $idSupp = $_POST['idSupp'];
                    $this->model->deletSuppProject($idSupp);

                    $data = array(
                        'result' => true
                    );
                    echo json_encode($data);
                    break;
                case 'updateContragent':
                    $newInnContragent = $this->clean($_POST['newInnContragent']);
                    $newNameContragent = $this->clean($_POST['newNameContragent']);
                    $datetimeStamp = $_POST['dateTime'];
                    $newKppContragent = $this->clean($_POST['newKppContragent']);
                    $newNoticeContragent = $this->clean($_POST['newNoticeContragent']);
                    $mineOrg = $_POST['mineOrg'];
                    $idCont = $_POST['idCont'];
                    $idUserEdit = $_POST['idUserEdit'];
                    $this->model->updateContragent($newInnContragent,$newNameContragent,$newKppContragent,$newNoticeContragent,$mineOrg,$idUserEdit,$idCont,$datetimeStamp);
                    $data = array(
                        'idContragent' => true
                    );
                    echo json_encode($data);
                    break;
                case 'updateProject':
                    $nameProject = $this->clean($_POST['nameProject']);
                    $editMoneyProject = $this->clean($_POST['editMoneyProject']);
                    $editMoneyProject = str_replace(',','.',$editMoneyProject);
                    $editExpenseProject = $this->clean($_POST['editExpenseProject']);
                    $editSelectedProject = $_POST['editSelectedProject'];
                    $editProfitProject = $this->clean($_POST['editProfitProject']);
                    $noticeProject = $this->clean($_POST['noticeProject']);
                    $this->model->updateProject($nameProject,$_POST['nameContragent'],$noticeProject,$_POST['idProject'],$_POST['userID'],$editMoneyProject,$editExpenseProject,$editSelectedProject,$editProfitProject,$_POST['dateTime']);
                    $data = array(
                        'idProject' => true
                    );
                    echo json_encode($data);
                    break;
                case 'getProject':
                    $idContra = $_POST['idContra'];
                    $oneProjects = $this->model->getProject($idContra);
                    $oneProject = [];
                    foreach ($oneProjects as $item){
                        $nameContragent = $this->model->getNameContragentForID($item['idContragent']);
                        if($nameContragent==false){
                            $nameContragent = 'нет привязки';
                        }
                        if(empty($item['moneyProject'])){
                            $item['moneyProject'] = 0;
                        }
                        $oneProject[] = [
                            'id' => $item['id'],
                            'nameProject' => $item['nameProject'],
                            'dateCreate' => $item['dateCreate'],
                            'idContragent' => $nameContragent,
                            'moneyProject' => $item['moneyProject']
                        ];
                    }
                    $data = array(
                        'oneProject' => $oneProject
                    );
                    echo json_encode($data);
                    break;
                case 'insertFavorite':
                    $favorite = $this->model->insertFavorite($_POST['userID'],$_POST['idProject']);
                    $data = array(
                        'favorite' => $favorite
                    );
                    echo json_encode($data);
                    break;
                case 'deleteFavorite':
                    $this->model->deleteFavorite($_POST['userID'],$_POST['idProject']);
                    break;
                case 'deleteAllNoticeUserID':
                    $this->model->deleteAllNoticeUserID($_SESSION['mngr']['id']);
                    break;
                case 'addPartner':
                    $idInvoice = $_POST['idInvoice'];
                    $selectUser = $_POST['selectUser'];
                    $typeAdd = $_POST['typeAdd'];
                    $this->model->addPartner($idInvoice,$selectUser,$typeAdd);
                    $dataUser = $this->model->getOneUsers($selectUser);
                    $data = array(
                        'userName' => $dataUser[0]['userSurname'].' '.$dataUser[0]['userFirstName'],
                        'selectUser' => $selectUser,
                        'userAvatar' => $dataUser[0]['userAvatar']
                    );
                    echo json_encode($data);
                    break;
                case 'getCurrency':
                    $selectCurrency = $_POST['selectCurrency'];
                    $dateToday = strtotime($_POST['dateToday']);
                    $testDate = $this->model->testDateCurrency($selectCurrency)-86400;
                    $testDate = date('Y-m-d', $testDate);
                    $testDate = strtotime($testDate);

                    if($dateToday!=$testDate){
                        $url = 'http://www.cbr.ru/scripts/XML_daily.asp'; // URL, XML документ, всегда содержит актуальные данные
                        $currencyCB = [];//array(); // массив с данными

                        if(!$xml=simplexml_load_file($url)){
                            $currencyCB = false;  //die('Ошибка загрузки XML'); // загружаем полученный документ в дерево XML
                            $data = array(
                                'currencyCB' => $currencyCB
                            );
                            echo json_encode($data);
                            break;
                        }else{
                            $xml=simplexml_load_file($url);
                            list($d, $m, $y) = explode('.', $xml->attributes()->Date);
                            $currencyCB['date']=mktime(0, 0, 0, $m, $d, $y);; // получаем текущую дату

                            foreach($xml->Valute as $m){ // перебор всех значений
                                if($m->CharCode==$selectCurrency){
                                    $currencyCB[(string)$m->CharCode]=(float)str_replace(",", ".", (string)$m->Value); // запись значений в массив
                                }
                            }
                            $this->model->updateDateCurrency($selectCurrency,$currencyCB['date'],$currencyCB[$selectCurrency]);
                        }

                    }else{
                        $currencyCB = false;
                    }


                    $data = array(
                        'currencyCB' => $currencyCB,
                        //'dateToday' => $dateToday,
                        //'testDate' => $testDate
                    );
                    echo json_encode($data);
                    break;
                case 'blankSum':
                    $idPay = $_POST['idPay'];
                    $money = $_POST['money'];
                    $moneySum = $this->model->blankSum($idPay);
                    if(empty($moneySum[0]['moneySum'])){
                        $moneySum = 0;
                    }else{
                        $moneySum = $moneySum[0]['moneySum'];
                    }
                    $notList = $this->model->blankSumNotList($idPay);
                    if(empty($notList[0]['moneySum'])){
                        $notList = 0;
                    }else{
                        $notList = $notList[0]['moneySum'];
                    }
                    $moneyResult = $money-$moneySum;
                    $notList = $money-$notList;
                    $data = array(
                        'moneySum' => $moneySum,
                        'money' => $moneyResult,
                        'notList' => $notList
                    );
                    echo json_encode($data);
                    break;
                case 'reportExpenseSave':
                    $idPay = $_POST['idPay'];
                    $expense = trim($_POST['expense']);
                    $money = trim($_POST['money']);
                    $checkPay = $_POST['checkPay'];
                    $dateExpense = $_POST['dateExpense'];

                    $idExpense = $this->model->reportExpenseSave($idPay,$expense,$_POST['idProject'],$money,$checkPay,$dateExpense);
                    $nameProject = $this->model->getNameProjectForID($_POST['idProject']);
                    if($nameProject==false){
                        $nameProject = 'без проекта';
                    }
                    $data = array(
                        'idPay' => $idPay,
                        'expense' => $expense,
                        'nameProject' => $nameProject,
                        'money' => $money,
                        'checkPay' => $checkPay,
                        'dateExpense' => $dateExpense,
                        'idExpense' => $idExpense
                    );
                    echo json_encode($data);
                    break;
                case 'expenseSaveEdit':
                    $id = $_POST['id'];
                    $idPay = $_POST['idPay'];
                    $expense = $this->clean($_POST['expense']);
                    $money = $this->clean($_POST['money']);
                    $checkPay = $_POST['checkPay'];
                    $dateExpense = $_POST['dateExpense'];

                    $this->model->expenseSaveEdit($idPay,$id,$expense,$_POST['idProject'],$money,$checkPay,$dateExpense);

                    $data = array(
                        'id' => $id,
                        'expense' => $expense,
                        'money' => $money,
                        'dateExpense' => $dateExpense
                    );
                    echo json_encode($data);
                    break;
                case 'expenseDelete':
                    $this->model->expenseDelete($_POST['idDelit'],$_POST['idPay']);
                    break;
                case 'reportSend':
                    $userTo = $this->model->getUserToMailPay($_SESSION['mngr']['id']);
                    $this->model->reportSend($_POST['idPay'],$userTo);
                    break;
                case 'testEditInvoice':
                    $testEditInvoice = $this->model->testEditInvoice();
                    if(empty($testEditInvoice)){
                        $testEditInvoice = false;
                    }else{
                        $testEditInvoice = $testEditInvoice[0];
                        $_SESSION['mngr']['editInvoice'] = 'true';
                        $_SESSION['mngr']['idInvoice'] = $testEditInvoice['id'];
                    }
                    $data = array(
                        'testEditInvoice' => $testEditInvoice
                    );
                    echo json_encode($data);
                    break;
                case 'insertImprovement':
                    $to = 'm.fedorov@s-ama.ru';
                    $theme = 'Улучшайзер';
                    $message = $this->clean($_POST['textImprovement']);
                    $from = array(
                        $_POST['userName'], // Имя отправителя
                        $_POST['userMail']// почта отправителя
                    );
                    $mailInvoice = new SendMail('kwt.net@yandex.ru', 'kwtnet121tentwk', 'ssl://smtp.yandex.ru', 465, "UTF-8");
                    $mailInvoice->send($to, $theme, $message, $from);
                    //$this->model->insertProject($newNameProject,$newNoticeProject,$idContragent,$idInitProject);
                    break;
                case 'addInvoice':
                    if($_POST['deletePathRep']=='false') {
                        if (empty($_FILES['file'])) {
                            echo json_encode(['error' => 'noImage']);
                            return;
                        }
                        $success = null;
                        $preExt = $paths = $pathsPDF = [];
                        $fileJpeg = $filePDF = $resultG = 0;
                        $filenames = $_FILES['file']['name'];
                        list($directorySite, $shell) = explode('app',__DIR__);
                        $direct = $directorySite.'file/invoice';

                        for($i=0; $i < count($filenames); $i++){
                            $preExtense = explode('.', basename($filenames[$i]));
                            $preExt[] = array_pop($preExtense);
                        }
                        for($i=0;$i<count($preExt);$i++){
                            if($preExt[$i]=='jpeg' || $preExt[$i]=='jpg' || $preExt[$i]=='JPEG' || $preExt[$i]=='JPG'){
                                $fileJpeg = 1;
                            }
                            if($preExt[$i]=='pdf' || $preExt[$i]=='PDF' || $preExt[$i]=='Pdf' || $preExt[$i]=='PDf'){
                                $filePDF = 1;
                            }
                        }
                        if($fileJpeg == 1 && $filePDF == 0){
                            for($i=0; $i < count($filenames); $i++){
                                $preName = $this->translit($filenames[$i],'document');
                                $ext = explode('.', basename($filenames[$i]));
                                $fileExt = array_pop($ext);

                                $target = $direct.DIRECTORY_SEPARATOR.$preName.".".$fileExt;

                                if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $target)) {
                                    $success = true;
                                    if($fileExt!='pdf' && $fileExt!='PDF' && $fileExt!='Pdf'){
                                        $paths[] = '/file/invoice/' . $preName . '.' . $fileExt;
                                    }
                                } else {
                                    $success = false;
                                    break;
                                }
                            }
                            //$resultJPGtoPDF = $this->convertJPGtoPDF($paths, $direct);


                            $addressSite = $this->model->getOneOption('addressSite');
                            $sold = base64_encode(file_get_contents($addressSite.$paths[0]));

                            $post = [
                                'userAgentAPI' => '567',
                                'base64' => $sold
                            ];
                            $ch = curl_init('https://apipdf.s-ama.ru/pdflist');
                            curl_setopt($ch,CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

                            $resultCurl = curl_exec($ch);
                            $cURL_Error = curl_errno($ch);
                            if ($cURL_Error > 0){
                                echo 'cURL Error: --'.$cURL_Error.'--<br>';
                                $resultG = false;
                            }else{
                                $resultG = $resultCurl;
                            }
                            curl_close($ch);
                            $resultG = json_decode($resultG,true);
                            file_put_contents($directorySite.'file/invoice/'.$resultG['fileName'], base64_decode($resultG['base64Out']));

                            //$resultPaths = $resultJPGtoPDF;
                            $resultPaths = $resultG['fileName'];
                            list($directorySite, $shell) = explode('/app', __DIR__);
                            foreach ($paths as $file) {
                                unlink($directorySite . $file);
                            }
                        }elseif($fileJpeg == 1 && $filePDF == 1){
                            echo json_encode(['error'=>'noJPEGandPDF']);
                            return;
                        }elseif($fileJpeg == 0 && $filePDF == 1){
                            for($i=0; $i < count($filenames); $i++){
                                $preName = $this->translit($filenames[$i],'document');
                                $ext = explode('.', basename($filenames[$i]));
                                $fileExt = array_pop($ext);

                                $target = $direct.DIRECTORY_SEPARATOR.$preName.".".$fileExt;

                                if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $target)) {

                                    //$fileNameSel = $preName.".".$fileExt;
                                    //$datas = $this->funcInsertFile($_FILES['file']['tmp_name'][$i],$fileNameSel);

                                    $success = true;
                                    if($fileExt=='pdf'  || $fileExt=='PDF' || $fileExt=='Pdf'){
                                        $pathsPDF[] = $preName.'.'.$fileExt;
                                    }
                                } else {
                                    $success = false;
                                    break;
                                }
                            }
                            if(count($pathsPDF)>1){
                                foreach ($pathsPDF as $file) {
                                    unlink($directorySite.'/file/invoice/'.$file);
                                }
                                echo json_encode(['error'=>'noPDFandPDF']);
                                return;
                            }else{
                                $resultPaths = $preName.".".$fileExt;
                            }

                        }

                    }else{
                        $success = true;
                        $resultPaths = $_POST['deletePathRep'];
                    }



                    if ($success === true) {
                        $mngr = new Mngr();
                        $idInvoice = $mngr->addEntry();
                        if($this->model->testNoticeSettings($this->model->getUserToMail($_SESSION['mngr']['id']),'noticeMailSuccess')) {
                            $this->model->sendMailNext($this->model->getUserToMail($_SESSION['mngr']['id']), $idInvoice, 'invoice', 'newinvoice', '/file/invoice/' . $resultPaths);
                        }
                        $this->model->updatePathsInInvoice($idInvoice,$resultPaths);

                        $data = [
                            'error' => 'успешная отправка',
                            'idInvoice' => $idInvoice,
                            'resultPaths' => $resultPaths,
                            //'resultG' => $resultG
                        ];
                    }elseif($success === false) {
                        $data = ['error'=>'Запись в базу нарушена'];
                    } else {
                        $data = ['error'=>'Какая то еще проблема'];
                    }
                    echo json_encode($data);
                    break;
                case 'editInvoice':
                    $idInvoice = $_POST['idInvoice'];
                    $testStatus = $this->model->getStatus($idInvoice,'invoice');
                    if($testStatus=='1'){
                        $mngr = new Mngr();
                        $mngr->editInvoice();

                        unset($_SESSION['mngr']['editInvoice']);
                        unset($_SESSION['mngr']['idInvoice']);

                        list($directorySite, $shell) = explode('app', __DIR__);
                        $direct = $directorySite . 'file/invoice';

                        if (!empty($_FILES['file'])) {
                            $success = null;
                            $preExt = $paths = $pathspdf = [];
                            $fileJpeg = $filePDF = $resultG = 0;
                            $filenames = $_FILES['file']['name'];

                            list($directoryForUndelete, $shell) = explode('/app', __DIR__);
                            unlink($directoryForUndelete . $_POST['oldFile']); //удаляем старый файл

                            for ($i = 0; $i < count($filenames); $i++) {
                                $preExtense = explode('.', basename($filenames[$i]));
                                $preExt[] = array_pop($preExtense);
                            }
                            for ($i = 0; $i < count($preExt); $i++) {
                                if ($preExt[$i] == 'jpeg' || $preExt[$i] == 'jpg' || $preExt[$i] == 'JPEG' || $preExt[$i] == 'JPG') {
                                    $fileJpeg = 1;
                                }
                                if ($preExt[$i] == 'pdf' || $preExt[$i] == 'PDF' || $preExt[$i]=='Pdf' || $preExt[$i]=='PDf') {
                                    $filePDF = 1;
                                }
                            }
                            if ($fileJpeg == 1 && $filePDF == 0) {
                                for ($i = 0; $i < count($filenames); $i++) {
                                    $preName = $this->translit($filenames[$i],'document');
                                    $ext = explode('.', basename($filenames[$i]));
                                    $fileExt = array_pop($ext);

                                    $target = $direct . DIRECTORY_SEPARATOR . $preName . "." . $fileExt;

                                    if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target)) {
                                        $success = true;
                                        if ($fileExt!='pdf' && $fileExt!='PDF' && $fileExt!='Pdf') {
                                            $paths[] = '/file/invoice/' . $preName . '.' . $fileExt;
                                        }
                                    } else {
                                        $success = false;
                                        break;
                                    }
                                }
                                //$resultJPGtoPDF = $this->convertJPGtoPDF($paths, $direct);


                                $addressSite = $this->model->getOneOption('addressSite');
                                $sold = base64_encode(file_get_contents($addressSite.$paths[0]));

                                $post = [
                                    'userAgentAPI' => '567',
                                    'base64' => $sold
                                ];
                                $ch = curl_init('https://apipdf.s-ama.ru/pdflist');
                                curl_setopt($ch,CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

                                $resultCurl = curl_exec($ch);
                                $cURL_Error = curl_errno($ch);
                                if ($cURL_Error > 0){
                                    echo 'cURL Error: --'.$cURL_Error.'--<br>';
                                    $resultG = false;
                                }else{
                                    $resultG = $resultCurl;
                                }
                                curl_close($ch);
                                $resultG = json_decode($resultG,true);
                                file_put_contents($directorySite.'file/invoice/'.$resultG['fileName'], base64_decode($resultG['base64Out']));

                                //$resultPaths = $resultJPGtoPDF;
                                $resultPaths = $resultG['fileName'];
                                list($directorySite, $shell) = explode('/app', __DIR__);
                                foreach ($paths as $file) {
                                    unlink($directorySite . $file);
                                }
                            } elseif ($fileJpeg == 1 && $filePDF == 1) {
                                echo json_encode(['error' => 'noJPEGandPDF']);
                                return;
                            } elseif ($fileJpeg == 0 && $filePDF == 1) {
                                for ($i = 0; $i < count($filenames); $i++) {
                                    $preName = $this->translit($filenames[$i],'document');
                                    $ext = explode('.', basename($filenames[$i]));
                                    $fileExt = array_pop($ext);

                                    $target = $direct . DIRECTORY_SEPARATOR . $preName . "." . $fileExt;

                                    if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target)) {
                                        $success = true;
                                        if ($fileExt == 'pdf' || $fileExt=='PDF' || $fileExt=='Pdf') {
                                            $pathspdf[] = $preName . '.' . $fileExt;
                                        }
                                    } else {
                                        $success = false;
                                        break;
                                    }
                                }
                                if (count($pathspdf) > 1) {
                                    foreach ($pathspdf as $file) {
                                        unlink($directorySite . '/file/invoice/' . $file);
                                    }
                                    echo json_encode(['error' => 'noPDFandPDF']);
                                    return;
                                } else {
                                    $resultPaths = $preName . "." . $fileExt;
                                }

                            }

                            if ($success === true) {

                                $this->model->updatePathsInInvoice($idInvoice,$resultPaths);

                                $data = [
                                    'error' => 'успешная отправка',
                                    'idInvoice' => $idInvoice,
                                    'resultPaths' => $resultPaths
                                ];
                                echo json_encode($data);
                                return;
                            } elseif ($success === false) {
                                $data = ['error' => 'Запись в базу нарушена'];
                                echo json_encode($data);
                                return;
                            }
                        }
                        $data = [
                            'error' => 'успешная отправка',
                            'idInvoice' => $idInvoice
                        ];
                    }else{
                        $data = [
                            'error' => 'noedit'
                        ];
                    }
                    echo json_encode($data);
                    break;
                case 'editPay':
                    $payID = $_POST['payID'];
                    $testStatus = $this->model->getStatus($payID,'invoicePay');
                    if($testStatus=='1'){
                        $contractCheckPay = $_POST['contractCheckPay']; //чек на проекте
                        $underReportPay = $_POST['underReportPay']; //чек на подотчете
                        $idProjectHiddenPay = $_POST['idProjectHiddenPay']; //ID проекта
                        $summForPayment = $this->clean($_POST['summForPayment']); //сумма служебки
                        $noticeForPay = $this->clean($_POST['noticeForPay']); //примечание

                        $resultEdit = $this->model->editPay($payID,$_POST['dateEdit'],$underReportPay,$idProjectHiddenPay,$summForPayment,$noticeForPay);

                        $success = true;
                        $paths = '';
                        if (!empty($_FILES['file'])) {
                            $filenames = $_FILES['file']['name'];

                            list($directoryForUndelete, $shell) = explode('/app', __DIR__);
                            unlink($directoryForUndelete . $_POST['oldFile']); //удаляем старый файл

                            list($directorySite, $shell) = explode('app',__DIR__);
                            $direct = $directorySite.'file/invoicePay';

                            $preName = $this->translit($filenames[0],'document');
                            $target = $direct.DIRECTORY_SEPARATOR.$preName;
                            if(move_uploaded_file($_FILES['file']['tmp_name'][0], $target)) {
                                $paths = $preName;
                                $this->model->updatePathsInInvoicePay($payID, $preName);
                            } else {
                                $success = false;
                            }
                        }
                        $data = ['error' => $success];
                    }else{
                        $data = ['error' => 'noedit'];
                    }
                    echo json_encode($data);
                    break;
                case 'addInfoForPrint':
                    list($directorySite, $shell) = explode('app', __DIR__);
                    $direct = $directorySite . 'file/invoice';
                    $html = $_POST['html'];
                    //$resultPath = $this->addInfoForPrint($direct,$html);
                    $resultG = 0;

                    $post = [
                        'userAgentAPI' => '8910',
                        'htmlData' => $html
                    ];
                    $ch = curl_init('https://apipdf.s-ama.ru/pdflist');
                    curl_setopt($ch,CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

                    $resultCurl = curl_exec($ch);
                    $cURL_Error = curl_errno($ch);
                    if ($cURL_Error > 0){
                        echo 'cURL Error: --'.$cURL_Error.'--<br>';
                        $resultG = false;
                    }else{
                        $resultG = $resultCurl;
                    }
                    curl_close($ch);
                    $resultG = json_decode($resultG,true);
                    file_put_contents($directorySite.'file/'.$resultG['fileName'], base64_decode($resultG['base64Out']));

                    $data = [
                        'resultPath' => $resultG['fileName']
                    ];
                    echo json_encode($data);
                    break;
                case 'loginValidate':
                    $mngr = new Mngr();
                    if(!$mngr->loginValidate()){
                        echo json_encode('incorrect');
                        break;
                    }else{
                        $_SESSION['mngr'] = $mngr->mngr[0];
                        echo json_encode('correct');
                    }
                    break;
                case 'changeUserPwd':
                    $currentPwd = $this->clean($_POST['currentPwd']);
                    $newPwd = $this->clean($_POST['newPwd']);
                    $result = false;
                    if($this->model->changeUserPwd($currentPwd,$newPwd)){
                        $result = true;
                    }
                    echo json_encode($result);
                    break;
                case 'updateTableNeedPay':
                    $dataTables = $this->model->updateTableNeedPay();
                    $formatingData = [];
                    foreach ($dataTables as $dataTable) {
                        $dateSuccess = explode(' ',$dataTable['date_success']);
                        $moneySum = number_format($dataTable['summInvoiceForPayment'], 2, '.', '&nbsp;');

                        $formatingData[] = [
                            'id' => $dataTable['id'],
                            'date_success' => $dateSuccess[0],
                            'numberInvoice' => $dataTable['numberInvoice'],
                            'initiatorSurname' => $dataTable['initiatorSurname'] . ' ' . $dataTable['initiatorFirstName'],
                            'organization' => $this->model->getOrganizationForID($dataTable['organizationInvoiceForPayment']),
                            'contragent' => $this->model->getNameContragentForID($dataTable['contragent']),
                            'summ' => $moneySum.'&nbsp;р.',
                            'action' => '<button class="btn btn-xs green needPayID" data-id="'.$dataTable['id'].'"
                            data-mngrid="'.$dataTable['mngrId'].'" data-mail="'.$this->model->getEmailMngr($dataTable['mngrId']).'"><i class="fa fa-list"></i></button>'
                        ];
                    }
                    echo json_encode($formatingData);
                    break;
                case 'saveNeedPay':
                    if (empty($_FILES['file'])) {
                        echo json_encode(['error'=>'noImage']);
                        return;
                    }else{
                        $filenames = $_FILES['file']['name'];
                        $preName = $this->translit('needPay','document');
                        $ext = explode('.', basename($filenames));
                        $fileExt = array_pop($ext);

                        list($directorySite, $shell) = explode('app',__DIR__);
                        $direct = $directorySite.'public/scanInvoice';
                        $target = $direct.DIRECTORY_SEPARATOR.$preName.".".$fileExt;

                        if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                            $success = true;
                            $paths = 'public/scanInvoice/' . $preName . '.' . $fileExt;
                        } else {
                            $success = false;
                        }

                        if ($success === true) {

                            $result = $this->model->sendNeedPay($paths);
                            if($result!=true){
                                $data = [
                                    'info'=>$result
                                ];
                                unlink($directorySite.DIRECTORY_SEPARATOR.$paths);
                            }else{
                                $this->model->upadeNeedPayInvoice($_POST['idInvoice']);
                                $data = [
                                    'info'=>$result
                                ];
                                unlink($directorySite.DIRECTORY_SEPARATOR.$paths);
                            }

                        }else{
                            $data = ['error'=>'Запись в базу нарушена'];
                        }
                        echo json_encode($data);
                    }
                    break;
                case 'updateReport':
                    $this->model->updateReport($_POST['expid'],$_POST['reportClass']);
                    break;
                case 'testReportClass':
                    $resultClass = $this->model->testReportClass($_POST['idPay']);
                    $data = array(
                        'resultClass' => $resultClass
                    );
                    echo json_encode($data);
                    break;
                case 'updateReportReturnSend':
                    $mngr = new Mngr();
                    $lastSignPay = $mngr->getOneOption('lastSignPay');
                    $resultClass = $this->model->updateReportReturnSend($_POST['idPay'],$_POST['reportClass'],$_POST['initiatorID'],$lastSignPay,$_POST['dateToday']);
                    $data = array(
                        'resultClass' => $resultClass
                    );
                    echo json_encode($data);
                    break;
                case 'updateReportLastBack':
                    $this->model->updateReportLastBack($_POST['idPay'],$_POST['dateToday']);
                    break;
                case 'updateReportLastPay':
                    $this->model->updateReportLastPay($_POST['idPay'],$_POST['dateToday']);
                    break;
                case 'updateReportLastSuccess':
                    $this->model->updateReportLastSuccess($_POST['idPay'],$_POST['dateToday']);
                    break;
                case 'updateReportAll':
                    $this->model->updateReportAll($_POST['idPay'],$_POST['report']);
                    break;
                case 'mergeProjects':
                    $idMerge = $_POST['idMerge'];
                    $idMergeSupp = explode(",", $_POST['idMergeSupp']);
                    $arrMergeID = json_decode($_POST['arrMergeID'],true);
                    $arrMergeClean = [];
                    for ($i=0;$i<count($arrMergeID);$i++){
                        if($arrMergeID[$i]['id']!=$idMerge) {
                            $arrMergeClean[] = $arrMergeID[$i]['id'];
                        }
                    }
                    $this->model->mergeProjects($idMerge,$arrMergeClean,$idMergeSupp);
                    $data = array(
                        'idMerge' => $idMerge,
                        'arrMergeID' => $arrMergeID,
                        'arrMergeClean' => $arrMergeClean,
                        'idMergeSupp' => $idMergeSupp
                    );
                    echo json_encode($data);
                    break;
                case 'holiday':
                    $this->model->updateHoliday($_POST['userID'],$_POST['typeHoliday'],$_POST['dateToday'],$_POST['autoDelegate']);
                    break;
                case 'currentAffairs':
                    $resultCurrent = $this->model->currentAffairs($_POST['userID']);
                    $data = array(
                        'resultCurrent' => $resultCurrent
                    );
                    echo json_encode($data);
                    break;
                case 'postPost':
                    $invoiceId = $_POST['invoiceId'];
                    $mngrID = $_POST['mngrID'];
                    $mngrtable = $_POST['mngrtable'];
                    $dateToday = $_POST['dateToday'];
                    $userName = $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'];
                    $userToMile = $this->model->getUserToMail($_SESSION['mngr']['id']);

                    $getInvoice = $this->model->getPostPost($_POST['invoiceId']);
                    $addressSite = $this->model->getOneOption('addressSite');
                    $_POST['numberInvoice'] = $getInvoice['numberInvoice'];
                    $_POST['money'] = $getInvoice['summInvoiceForPayment'];
                    $_POST['organization'] = $this->model->getOrganizationForID($getInvoice['organizationInvoiceForPayment']);
                    $_POST['inn_organization'] = $this->model->getOrganizationInnForID($getInvoice['organizationInvoiceForPayment']);
                    $_POST['notice'] = $getInvoice['noticeInvoiceForPayment'];
                    $_POST['pathScanInvoice'] = $addressSite.'/file/invoice/'.$getInvoice['pathScanInvoice'];
                    $_POST['pathFileInvoice'] = base64_encode(file_get_contents($addressSite.'/file/invoice/'.$getInvoice['pathScanInvoice']));
                    //   /public/scanInvoice/02082018_123048_02.08.18-bazhenov.pdf
                    $_POST['idProject'] = $getInvoice['numberContract'];
                    $_POST['nameProject'] = $this->model->getNameProjectForID($getInvoice['numberContract']);
                    $getContragentID = $this->model->getContragentID($getInvoice['numberContract']);
                    $_POST['idContragent'] = $getContragentID;
                    if($getContragentID!=0){
                        $getContragentInfoID = $this->model->getContragentInfoID($getContragentID);
                        $_POST['inn_contragent'] = $getContragentInfoID[0]['inn_contragent'];
                        $_POST['name_contragent'] = $getContragentInfoID[0]['name_contragent'];
                        $_POST['kpp_contragent'] = $getContragentInfoID[0]['kpp_contragent'];
                    }else{
                        $_POST['inn_contragent'] = $_POST['name_contragent'] = $_POST['kpp_contragent'] = 0;
                    }


                    //$getContragentID = $this->model->getContragentID($getInvoice['contragent']);
                    $getSaleInfoID = $this->model->getContragentInfoID($getInvoice['contragent']);
                    $_POST['idContragentSale'] = $getInvoice['contragent'];
                    $_POST['inn_contragentSale'] = $getSaleInfoID[0]['inn_contragent'];
                    $_POST['kpp_contragentSale'] = $getSaleInfoID[0]['kpp_contragent'];
                    $_POST['name_contragentSale'] = $getSaleInfoID[0]['name_contragent'];

                    $data = array(
                        'getStatusPost' => $_POST
                    );
                    echo json_encode($data);
                    break;
                case 'testOrgProject':
                    $data = array(
                        'resultTestOrg' => $this->model->testOrgProject($_POST['idContragent'])
                    );
                    echo json_encode($data);
                    break;
                case 'dataTableDops':
                    $idProject = $_POST['idProject'];
                    $getSuppProject = $this->model->getSuppProject($idProject);
                    $data = array(
                        'getSuppProject' => $getSuppProject
                    );
                    echo json_encode($data);
                    break;
                case 'testProfit':
                    $mngr = new Mngr();
                    $projectID = $mngr->getProjectID($_POST['tableFromProjectID'],$_POST['idInvoice']);
                    $testProfit = $mngr->testProfit($projectID);//получить рентабельность проекта
                    $data = array(
                        'projectID' => $projectID,
                        'testProfit' => $testProfit
                    );
                    echo json_encode($data);
                    break;
                case 'dataTableAjax':
                    //входные данные
                    $status = $_POST['status'];
                    if(empty($_POST['dateFrom'])){$dateFrom = '01.01.2000';}else{$dateFrom = $_POST['dateFrom'];}
                    if(empty($_POST['dateTo'])){$dateTo = '01.01.2030';}else{$dateTo = $_POST['dateTo'];
                    }
                    list($day,$month,$year) = explode('.',$dateFrom);
                    $dateFrom = $year.'-'.$month.'-'.$day.' 00:00:01';
                    list($day,$month,$year) = explode('.',$dateTo);
                    $dateTo = $year.'-'.$month.'-'.$day.' 23:59:59';
                    $idProject = $_POST['idProject'];
                    $idDepartment = $_POST['idDepartment'];
                    $idInitiator = $_POST['idInitiator'];
                    $idOrganization = $_POST['idOrganization'];
                    $idContragent = $_POST['idContragent'];
                    //доп.данные
                    $allProjects = $this->model->getAllProjects();
                    $allContragents = $this->model->getAllContragents();

                    //поисковый запрос
                    $tableAjax = $this->model->dataTableAjax($status,$dateFrom,$dateTo,$idProject,$idDepartment,$idInitiator,$idOrganization,$idContragent);

                    //объявление переменных
                    $arrData = [];
                    $summMoney = 0;

                    foreach ($tableAjax as $item){
                        $labelStatus = getLabelStatus($item['statusInvoice']);
                        $userName = $item['initiatorSurname'].' '.$item['initiatorFirstName'];

                        $fileName = explode("/", $item['pathScanInvoice']);
                        //bugs($fileName);
                        /*if($fileName['0']==''){
                            $pathScanInvoice = $fileName['3'];
                            $this->model->updatePathsInInvoice($item['id'],$pathScanInvoice);
                            //$this->model->regetPaths($item['id'],);
                        }else{
                            $pathScanInvoice = $fileName['0'];

                        }*/



                        $preview = getImageFolder($item['pathScanInvoice']);
                        $btnReview = '<div class="btn-group btn-group" role="group">';
                        if($item['statusInvoice'] == '7' || $item['statusInvoice'] == '5'){
                            $btnReview = '<div class="btn-group btn-group" role="group">
                                        <a href="/mngr/add?id='.$item['id'].'&type=invoice"
                                           class="btn btn-sm btn-brand btn-icon" target="_blank"
                                           data-toggle="popover" data-trigger="hover"
                                           data-placement="auto" data-content="Повторить">
                                            <i class="fas fa-sync"></i>
                                        </a>';
                        }
                        $btnTarget = $btnReview.' '.$preview.'<a href="/mngr/staffer/'.$item['id'].'"
                                           class="btn btn-sm btn-brand btn-icon" target="_blank"
                                           data-toggle="popover" data-trigger="hover"
                                           data-placement="auto" data-content="Перейти">
                                            <i class="fa fa-arrows-alt"></i>
                                        </a></div>';
                        if(!empty($item['numberContract'])){
                            foreach ($allProjects as $allProject) {
                                if($item['numberContract'] == $allProject['id']){
                                    if(!empty($allowedListUsers[0]['from_Statistic'])){
                                        foreach ($allContragents as $itemContr){
                                            if(!empty($allProject['idContragent'])){
                                                if($allProject['idContragent'] == $itemContr['id']){
                                                    $itemContragent = $itemContr['name_contragent'];
                                                }
                                            }else{
                                                $itemContragent = "<b style='color:red;'>нет привязки к покупателю!</b>";
                                            }
                                        }
                                        $numberContract = '<a href="javascript:;" class="linkContract"
                                                data-numcont="'.$item['numberContract'].'" data-toggle="popover" data-trigger="hover"
                                            data-placement="auto" data-html="true" title="Покупатель" data-content="'.$itemContragent.'">'.$allProject['nameProject'].'</a>';
                                    }else{
                                        $numberContract = $allProject['nameProject'];
                                    }
                                }
                            }
                        }else{
                            $numberContract = '';
                        }
                        $organization = $this->model->getOrganizationForID($item['organizationInvoiceForPayment']);
                        $departmentID = $this->model->getDepartmentID($item['mngrId']); //узнаем ID отдела
                        $department = $this->model->getNameDepartments($departmentID); //узнаем название отдела
                        $contragent = $this->model->getNameContragentForID($item['contragent']); //узнаем название поставщика

                        if (!is_numeric($item['summInvoiceForPayment'])) {
                            $item['summInvoiceForPayment']= 0;
                        }

                        $summMoney = $item['summInvoiceForPayment']+$summMoney;
                        $money = number_format($item['summInvoiceForPayment'], 2, '.', '&nbsp;');

                        $arrData[] = [
                            'tableInvoice-id' => $item['id'],
                            'tableInvoice-statusNumber' => $item['statusInvoice'],
                            'tableInvoice-statusInvoice' => $labelStatus,
                            'tableInvoice-date' => $item['dateCreate'],
                            'tableInvoice-contractNumber' => $numberContract,
                            'tableInvoice-invoiceNumber' => $item['numberInvoice'],
                            'tableInvoice-department' => $department,
                            'tableInvoice-initiator' => $userName,
                            'tableInvoice-organization' => $organization,
                            'tableInvoice-kontragent' => $contragent,
                            'tableInvoice-summ' => $money.'&nbsp;р.',
                            'tableInvoice-actions' => $btnTarget,
                            'tableInvoice-notice' => $item['noticeInvoiceForPayment']
                        ];
                    }
                    $data = array(
                        //'tableAjax' => $tableAjax,
                        'arrData' => json_encode($arrData),
                        'summMoney' => $summMoney
                    );
                    echo json_encode($data);
                    break;
                case 'dataTableAjaxPay':
                    //входные данные
                    $status = $_POST['status'];
                    if(empty($_POST['dateFrom'])){$dateFrom = '01.01.2000';}else{$dateFrom = $_POST['dateFrom'];}
                    if(empty($_POST['dateTo'])){$dateTo = '01.01.2030';}else{$dateTo = $_POST['dateTo'];
                    }
                    list($day,$month,$year) = explode('.',$dateFrom);
                    $dateFrom = $year.'-'.$month.'-'.$day.' 00:00:01';
                    list($day,$month,$year) = explode('.',$dateTo);
                    $dateTo = $year.'-'.$month.'-'.$day.' 23:59:59';
                    $typePay = $_POST['typePay'];
                    $idProject = $_POST['idProject'];
                    $idDepartment = $_POST['idDepartment'];
                    $idInitiator = $_POST['idInitiator'];
                    //доп.данные
                    $allProjects = $this->model->getAllProjects();
                    $allContragents = $this->model->getAllContragents();
                    $allowedListUsers = $this->model->allowedListUsers();

                    //поисковый запрос
                    $tableAjax = $this->model->dataTableAjaxPay($status,$dateFrom,$dateTo,$typePay,$idProject,$idDepartment,$idInitiator);

                    //объявление переменных
                    $arrData = [];
                    $summMoney = $summMoneyIssued = 0;

                    foreach ($tableAjax as $item){
                        $labelStatus = getLabelStatus($item['status_pay']);
                        $userName = $item['initiatorSurname'].' '.$item['initiatorFirstName'];
                        $preview = '';
                        if(!empty($item['paths_pay'])){
                            $preview = getImageFolderPay($item['paths_pay']);
                        }
                        $btnReview = '<div class="btn-group btn-group" role="group">';
                        if($item['status_pay'] == '7' || $item['status_pay'] == '5'){
                            $btnReview = '<div class="btn-group btn-group" role="group">
                                        <a href="/mngr/add?id='.$item['id'].'&type=invoicepay"
                                           class="btn btn-sm btn-brand btn-icon" target="_blank"
                                           data-toggle="popover" data-trigger="hover"
                                           data-placement="auto" data-content="Повторить">
                                            <i class="fas fa-sync"></i>
                                        </a>';
                        }
                        $btnTarget = $btnReview.' '.$preview.'<a href="/mngr/onepay/'.$item['id'].'"
                                           class="btn btn-sm btn-brand btn-icon" target="_blank"
                                           data-toggle="popover" data-trigger="hover"
                                           data-placement="auto" data-content="Перейти">
                                            <i class="fa fa-arrows-alt"></i>
                                        </a></div>';
                        if(!empty($item['contract'])){
                            foreach ($allProjects as $allProject) {
                                if($item['contract'] == $allProject['id']){
                                    if(!empty($allowedListUsers[0]['from_Statistic'])){
                                        foreach ($allContragents as $itemContr){
                                            if(!empty($allProject['idContragent'])){
                                                if($allProject['idContragent'] == $itemContr['id']){
                                                    $itemContragent = $itemContr['name_contragent'];
                                                }
                                            }else{
                                                $itemContragent = "<b style='color:red;'>нет привязки к покупателю!</b>";
                                            }
                                        }
                                        $numberContract = '<a href="javascript:;" class="linkContract"
                                                data-numcont="'.$item['contract'].'" data-toggle="popover" data-trigger="hover"
                                            data-placement="auto" data-html="true" title="Покупатель" data-content="'.$itemContragent.'">'.$allProject['nameProject'].'</a>';
                                    }else{
                                        $numberContract = $allProject['nameProject'];
                                    }
                                }
                            }
                        }else{
                            $numberContract = '';
                        }

                        $departmentID = $this->model->getDepartmentID($item['user_id']); //узнаем ID отдела
                        $department = $this->model->getNameDepartments($departmentID); //узнаем название отдела
                        //$contragent = $this->model->getNameContragentForID($item['contragent']); //узнаем название поставщика
                        $report = getUnderReport($item['under_report']);

                        if (!is_numeric($item['money'])) {
                            $item['money']= 0;
                        }

                        $summMoney = $item['money']+$summMoney; //запрошенные деньги
                        $money = number_format($item['money'], 2, '.', '&nbsp;');

                        if (!is_numeric($item['issuedMoney'])) {
                            $item['issuedMoney']= 0;
                        }

                        $summMoneyIssued = $item['issuedMoney']+$summMoneyIssued; //выданные деньги
                        $moneyIssued = number_format($item['issuedMoney'], 2, '.', '&nbsp;');

                        $arrData[] = [
                            'tablePay-id' => $item['id'],
                            'tablePay-statusNumber' => $item['status_pay'],
                            'tablePay-statusInvoice' => $labelStatus,
                            'tablePay-date' => $item['dateCreate'],
                            'tablePay-report' => $report,
                            'tablePay-reportPay' => $moneyIssued.'&nbsp;р.',
                            'tablePay-contractNumber' => $numberContract,
                            'tablePay-department' => $department,
                            'tablePay-initiator' => $userName,
                            'tablePay-summ' => $money.'&nbsp;р.',
                            'tablePay-actions' => $btnTarget,
                            'tablePay-notice' => $item['notice_pay']
                        ];
                    }
                    $data = array(
                        //'tableAjax' => $tableAjax,
                        'arrData' => json_encode($arrData),
                        'summMoney' => $summMoney
                    );
                    echo json_encode($data);
                    break;
                case 'dataTableAjaxDoc':
                    //входные данные
                    $status = $_POST['status'];
                    if(empty($_POST['dateFrom'])){$dateFrom = '01.01.2000';}else{$dateFrom = $_POST['dateFrom'];}
                    if(empty($_POST['dateTo'])){$dateTo = '01.01.2030';}else{$dateTo = $_POST['dateTo'];
                    }
                    list($day,$month,$year) = explode('.',$dateFrom);
                    $dateFrom = $year.'-'.$month.'-'.$day.' 00:00:01';
                    list($day,$month,$year) = explode('.',$dateTo);
                    $dateTo = $year.'-'.$month.'-'.$day.' 23:59:59';

                    $themeDoc = $_POST['themeDoc'];
                    $fromToDoc = $_POST['fromToDoc'];
                    $idDepartment = $_POST['idDepartment'];
                    $idChargeDoc = $_POST['idChargeDoc'];

                    //доп.данные
                    $allContragents = $this->model->getAllContragents();

                    //поисковый запрос
                    $tableAjax = $this->model->dataTableAjaxDoc($status,$dateFrom,$dateTo,$themeDoc,$fromToDoc,$idDepartment,$idChargeDoc);

                    //объявление переменных
                    $arrData = [];

                    foreach ($tableAjax as $item){
                        $labelStatus = getLabelStatus($item['status']);
                        $getDataUserCharge = $this->model->getOneUsers($item['chargeUserID']);
                        $userName = $getDataUserCharge[0]['userSurname'].' '.$getDataUserCharge[0]['userFirstName'];
                        $preview = '';
                        if(!empty($item['fileAddDoc'])){
                            $preview = getImageFolderDoc($item['fileAddDoc']);
                        }
                        $btnTarget = $preview.'<a href="/mngr/onedoc/'.$item['id'].'"
                                           class="btn btn-sm btn-brand btn-icon" target="_blank"
                                           data-toggle="popover" data-trigger="hover"
                                           data-placement="auto" data-content="Перейти">
                                            <i class="fa fa-arrows-alt"></i>
                                        </a></div>';

                        $themeAllDoc = $this->model->getThemeDoc();
                        $themeItem = '';
                        foreach ($themeAllDoc as $themeD){
                            if($item['themeAddDoc']==$themeD['id']){
                                $themeItem = $themeD['themeDoc'];
                            }
                        }
                        $departmentID = $this->model->getDepartmentID($item['chargeUserID']); //узнаем ID отдела
                        $department = $this->model->getNameDepartments($departmentID); //узнаем название отдела
                        //$report = getUnderReport($item['under_report']);
                        $fromTo = '';
                        if(!empty($item['fromTo'])){
                            $fromTo = $this->model->getNameContragentForID($item['fromTo']);
                        }
                        $arrData[] = [
                            'tableDoc-id' => $item['id'],
                            'tableDoc-statusNumber' => $item['status'],
                            'tableDoc-status' => $labelStatus,
                            'tableDoc-date' => $item['dateCreate'],
                            'tableDoc-themeDoc' => $themeItem,
                            'tableDoc-fromTo' => $fromTo,
                            'tableDoc-department' => $department,
                            'tableDoc-chargeUser' => $userName,
                            'tableDoc-actions' => $btnTarget,
                            'tableDoc-notice' => $item['noticeAddDoc']
                        ];
                    }
                    $data = array(
                        'tableAjax' => $tableAjax,
                        'arrData' => json_encode($arrData)
                    );
                    echo json_encode($data);
                    break;
                case 'getUserSettingsType':
                    //входные данные
                    $userID = $_POST['userID'];
                    $typeData = $_POST['type'];

                    //доп.данные
                    $allUsers = $this->model->getListUsers();

                    //поисковый запрос
                    //$dataQuery = json_decode($this->model->getOneMngrListUser($userID,$typeData),true);
                    $dataQuery = explode(",", $this->model->getOneMngrListUser($userID,$typeData));

                    //объявление переменных
                    $arrData = [];

                    foreach ($allUsers as $oneUser){

                        $selectedS = '';
                        foreach ($dataQuery as $item){
                            if($item==$oneUser['value']){
                                $selectedS = "selected='selected'";
                            }
                        }
                        $arrData[] = [
                            'id' => $oneUser['value'],
                            'name' => $oneUser['text'],
                            'selectedS' => $selectedS
                        ];
                    }
                    $data = array(
                        'arrData' => $arrData
                    );
                    echo json_encode($data);
                    break;
                case 'updateAvatar':
                    if (empty($_FILES['file'])) {
                        echo json_encode(['error'=>'noImage']);
                        return;
                    }

                    $filenames = $this->translit($_FILES['file']['name'][0],'Avatar');
                    list($directorySite, $shell) = explode('app',__DIR__);
                    $direct = $directorySite.'assets/images/ava';

                    $nameImage = $this->model->getPathAvatar(); //имя текущего аватара
                    if($nameImage!='nophoto.jpg'){
                        unlink($directorySite.'/assets/images/ava'.DIRECTORY_SEPARATOR.$nameImage); //удаляем старый логотип
                    }

                    $target = $direct.DIRECTORY_SEPARATOR.$filenames;
                    if(move_uploaded_file($_FILES['file']['tmp_name'][0], $target)) {
                        $data = ['error' => 'успешная отправка'];
                    }else{
                        $data = ['error'=>'Запись в базу нарушена'];
                    }

                    $this->resize('assets/images/ava'.DIRECTORY_SEPARATOR.$filenames, 300,300); //меняем высоту изображения

                    $this->model->updateAvatar($filenames); //меняем имя логотипа в базе
                    echo json_encode($data);
                    break;
                case 'checkUserMail':
                    $checkMail = $this->model->checkUserMail($_POST['userMail']);

                    $data = array(
                        'checkUserMail' => $checkMail
                    );
                    echo json_encode($data);
                    break;
                case 'addUser':
                    $addUs = $this->model->addUser();
                    $data = array(
                        'addUs' => $addUs
                    );
                    echo json_encode($data);
                    break;
                case 'editUser':
                    $editUser = $this->model->editUser();
                    $data = array(
                        'editUser' => $editUser
                    );
                    echo json_encode($data);
                    break;
                case 'listUsersSend':
                    $themeAlertUsers = $this->clean($_POST['themeAlertUsers']);
                    $messageAlertUsers = $this->clean($_POST['messageAlertUsers']);
                    $selectedUsersID = $_POST['selectedUsersID'];
                    $resultSend = $this->model->listUsersSend($themeAlertUsers,$messageAlertUsers,$selectedUsersID);

                    $data = array(
                        'resultSend' => $resultSend
                    );
                    echo json_encode($data);
                    break;
                case 'getListTimezone':
                    echo json_encode($this->model->getListTimezone());
                    break;
                case 'getNameProject':
                    echo json_encode($this->model->getNameProjectForID($_POST['idProject']));
                    break;
                case 'getNameContragent':
                    echo json_encode(htmlspecialchars_decode($this->model->getNameContragentForID($_POST['idContragent'])));
                    break;
                case 'getThemeDoc':
                    $arrThemeDocs = $this->model->getThemeDoc();
                    $allThemeDoc = [];
                    foreach ($arrThemeDocs as $theme){
                        $userData = $this->model->getOneUsers($theme['chargUser']);
                        $allThemeDoc[] = [
                            'themeDoc' => $theme['themeDoc'],
                            'chargUser' => $userData[0]['userSurname'].' '.$userData[0]['userFirstName'],
                            'action' => '<button type="button"
                                    class="btn btn-sm btn-outline-success btn-icon btn-editTheme"
                                    data-themeid="'.$theme['id'].'" data-themedoc="'.$theme['themeDoc'].'"
                                    data-charguser="'.$theme['chargUser'].'"
                                    data-toggle="popover" data-trigger="hover"
                                    data-placement="auto" title="Редактировать" data-content="Нажмите для редактирования темы">
                                    <i class="fas fa-edit"></i></button>
                                    <button type="button"
                                    class="btn btn-sm btn-outline-danger btn-icon btn-deleteTheme"
                                    data-themeid="'.$theme['id'].'"
                                    data-toggle="popover" data-trigger="hover"
                                    data-placement="auto" title="Редактировать" data-content="Нажмите для удаления темы">
                                    <i class="fas fa-trash-alt"></i></button>'
                        ];
                    }
                    echo json_encode($allThemeDoc);
                    break;
                case 'addThemeDoc':
                    $themeNew = $this->clean($_POST['themeNew']);
                    $addThemeDocID = $this->model->addThemeDoc($themeNew);
                    $data = array(
                        'addThemeDocID' => $addThemeDocID
                    );
                    echo json_encode($data);
                    break;
                case 'addDoc':
                    if (empty($_FILES['file'])) {
                        echo json_encode(['error' => 'noImage']);
                        return;
                    }

                    $success = null;
                    $preExt = $paths = $pathsPDF = [];
                    $fileJpeg = $filePDF = $resultG = 0;
                    $filenames = $_FILES['file']['name'];
                    list($directorySite, $shell) = explode('app',__DIR__);
                    $direct = $directorySite.'file/addDoc';

                    for($i=0; $i < count($filenames); $i++){
                        $preExtense = explode('.', basename($filenames[$i]));
                        $preExt[] = array_pop($preExtense);
                    }
                    for($i=0;$i<count($preExt);$i++){
                        if($preExt[$i]=='jpeg' || $preExt[$i]=='jpg' || $preExt[$i]=='JPEG' || $preExt[$i]=='JPG'){
                            $fileJpeg = 1;
                        }
                        if($preExt[$i]=='pdf' || $preExt[$i]=='PDF' || $preExt[$i]=='Pdf' || $preExt[$i]=='PDf'){
                            $filePDF = 1;
                        }
                    }
                    if($fileJpeg == 1 && $filePDF == 0){
                        for($i=0; $i < count($filenames); $i++){
                            $preName = $this->translit($filenames[$i],'document');
                            $ext = explode('.', basename($filenames[$i]));
                            $fileExt = array_pop($ext);

                            $target = $direct.DIRECTORY_SEPARATOR.$preName.".".$fileExt;

                            if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $target)) {
                                $success = true;
                                if($fileExt!='pdf' && $fileExt!='PDF' && $fileExt!='Pdf'){
                                    $paths[] = '/file/addDoc/' . $preName . '.' . $fileExt;
                                }
                            } else {
                                $success = false;
                                break;
                            }
                        }
                        //$resultJPGtoPDF = $this->convertJPGtoPDF($paths, $direct);


                        $addressSite = $this->model->getOneOption('addressSite');
                        $sold = base64_encode(file_get_contents($addressSite.$paths[0]));

                        $post = [
                            'userAgentAPI' => '567',
                            'base64' => $sold
                        ];
                        $ch = curl_init('https://apipdf.s-ama.ru/pdflist');
                        curl_setopt($ch,CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

                        $resultCurl = curl_exec($ch);
                        $cURL_Error = curl_errno($ch);
                        if ($cURL_Error > 0){
                            echo 'cURL Error: --'.$cURL_Error.'--<br>';
                            $resultG = false;
                        }else{
                            $resultG = $resultCurl;
                        }
                        curl_close($ch);
                        $resultG = json_decode($resultG,true);
                        file_put_contents($directorySite.'file/addDoc/'.$resultG['fileName'], base64_decode($resultG['base64Out']));

                        //$resultPaths = $resultJPGtoPDF;
                        $resultPaths = $resultG['fileName'];
                        list($directorySite, $shell) = explode('/app', __DIR__);
                        foreach ($paths as $file) {
                            unlink($directorySite . $file);
                        }
                    }elseif($fileJpeg == 1 && $filePDF == 1){
                        echo json_encode(['error'=>'noJPEGandPDF']);
                        return;
                    }elseif($fileJpeg == 0 && $filePDF == 1){
                        for($i=0; $i < count($filenames); $i++){
                            $preName = $this->translit($filenames[$i],'document');
                            $ext = explode('.', basename($filenames[$i]));
                            $fileExt = array_pop($ext);

                            $target = $direct.DIRECTORY_SEPARATOR.$preName.".".$fileExt;

                            if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $target)) {

                                //$fileNameSel = $preName.".".$fileExt;
                                //$datas = $this->funcInsertFile($_FILES['file']['tmp_name'][$i],$fileNameSel);

                                $success = true;
                                if($fileExt=='pdf'  || $fileExt=='PDF' || $fileExt=='Pdf'){
                                    $pathsPDF[] = $preName.'.'.$fileExt;
                                }
                            } else {
                                $success = false;
                                break;
                            }
                        }
                        if(count($pathsPDF)>1){
                            foreach ($pathsPDF as $file) {
                                unlink($directorySite.'/file/addDoc/'.$file);
                            }
                            echo json_encode(['error'=>'noPDFandPDF']);
                            return;
                        }else{
                            $resultPaths = $preName.".".$fileExt;
                        }

                    }



                    if ($success === true) {

                        $idAddDoc = $this->model->addDoc();

                        $this->model->sendMailNext($this->model->getIDUserFromIDdepDoc($_POST['depDoc']), $idAddDoc, 'addDoc', 'newAddDoc', '/file/addDoc/'.$resultPaths);

                        $this->model->updatePathsInAddDoc($idAddDoc,$resultPaths);

                        $this->model->noticeAddDoc('newDoc',$this->model->getIDUserFromIDdepDoc($_POST['depDoc']),$idAddDoc);

                        $data = [
                            'error' => 'успешная отправка',
                            /*'idInvoice' => $idInvoice,
                            'resultPaths' => $resultPaths,*/
                            //'resultG' => $resultG
                        ];
                    }elseif($success === false) {
                        $data = ['error'=>'Запись в базу нарушена'];
                    } else {
                        $data = ['error'=>'Какая то еще проблема'];
                    }
                    echo json_encode($data);
                    break;
                case 'editThemeDoc':
                    $editThemeDoc = $this->clean($_POST['editThemeDoc']);
                    $this->model->editThemeDoc($editThemeDoc);
                    echo json_encode($data);
                    break;
                case 'saveDocAnswer':
                    $this->model->saveDocAnswer();
                    echo json_encode('true');
                    break;
                case 'editStatusDoc':
                    $this->model->editStatusDoc();
                    echo json_encode('true');
                    break;
                case 'saveEditCharge':
                    $this->model->saveEditCharge();
                    echo json_encode('true');
                    break;
                case 'saveEditDepOrTheme':
                    $this->model->saveEditDepOrTheme();
                    echo json_encode('true');
                    break;
                case 'deleteThemeDoc':
                    $this->model->deleteThemeDoc();
                    break;
                case 'enterScript':
                    $this->model->enterScript();
                    echo json_encode('$data');
                    break;
            }
        }
    }
}