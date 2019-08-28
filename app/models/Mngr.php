<?php
/**
 * Created by PhpStorm.
 * User: Slava
 * Date: 25.04.2018
 * Time: 21:06
 */

namespace app\models;

use app\core\Model;
use SplFileInfo;
use app\lib\SendMail;
use app\models\UploaderInvoice;



class Mngr extends Model
{
    public $err;
    public $mngr;

    function clean($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        return $value;
    }
    public function getAllEntry()
    {
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(registrationDate,"%d-%m-%Y")) AS timeReg FROM users');
    }
//получаем имена таблиц менеджеров (кроме своей)
    public function getModifiedMngrMail($userRole)
    {
        $arr = [];
        $params = ['userRole' => $userRole];
        $arrUserMail = $this->db->row('SELECT userInitiatorTable FROM users WHERE userRole = :userRole', $params);
        foreach ($arrUserMail as $userMail) {
            foreach ($userMail as $value) {
                if ($value == $_SESSION['mngr']['userInitiatorTable']) {
                    break;
                }
                $arr[] = $value;
            }
        }
        return $arr;
    }
//получаем адрес кому должен отправить письмо данный пользователь
    public function getAddressMngrToMail()
    {
        return $this->db->column('SELECT userMail FROM users WHERE id = '.$_SESSION['mngr']['userToMail']);
    }
//в отпуске пользователь или нет
    public function userTestInHoliday($userID)
    {
        $params = ['userID' => $userID];
        return $this->db->column('SELECT holiday FROM users WHERE id = :userID', $params);
    }
//получаем все счета всех сотрудников любого отдела
    public function getInvoiceAllMngr($userDepartment)
    {
        //выбираем всех менеджеров (в том числе и начальника) из конкретного отдела
        $params = ['userDepartment' => $userDepartment];
        $arrAllTableMngr =  $this->db->row('SELECT userInitiatorTable FROM users WHERE userDepartment = :userDepartment', $params);
        $arrAllInvoice = [];
        foreach ($arrAllTableMngr as $tableOneMngr){
          foreach($tableOneMngr as $tableName) {
              $arrAllInvoice[] = $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM mngr_' . $tableName);
          }
        }
        return $arrAllInvoice;
    }
//получаем все счета в работе по ID пользователя
    public function getInvoiceWorkMngr($userID)
    {
        $params = [
            'mngrId' => $userID
        ];
        return $this->db->row('SELECT * FROM invoice WHERE mngrId = :mngrId AND statusInvoice IN(1,2,3)', $params);

    }
//получаем все подписанные счета всех сотрудников любого отдела для директора
    public function getInvoiceAllMngrForStatus($userDepartment, $statusInvoice)
    {
        //выбираем всех менеджеров (в том числе и начальника) из конкретного отдела
        $params = ['userDepartment' => $userDepartment];
        $arrAllTableMngr =  $this->db->row('SELECT userInitiatorTable FROM users WHERE userDepartment = :userDepartment', $params);
        $arrAllInvoice = [];
        foreach ($arrAllTableMngr as $tableOneMngr){
            foreach($tableOneMngr as $tableName) {
                $params = ['statusInvoice' => $statusInvoice];
                $arrAllInvoice[] = $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM mngr_' . $tableName.' WHERE statusInvoice = :statusInvoice', $params);
            }
        }
        return $arrAllInvoice;
    }
//получаем все служебки всех сотрудников любого отдела по статусу
    public function getPayAllMngr($userDepartment, $statusPay)
    {
        $params = ['statusPay' => $statusPay,
                    'userDepartment' => $userDepartment];
        $arrAllPay =  $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM payInvoice WHERE status_pay = :statusPay AND userDepartment = :userDepartment', $params);

        return $arrAllPay;
    }
//получить все служебки инициатора
    public function getAllPay()
    {
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM payInvoice WHERE user_id = "'.$_SESSION['mngr']['id'].'"');
    }
//получить все отпуска пользователей
    public function getAllHoliday()
    {
        return $this->db->row('SELECT * FROM holiday WHERE type_holiday="holiday" ORDER BY id DESC');
    }
//получаем все служебки всех сотрудников любого отдела
    public function getPayAllMngrDepartment($userDepartment)
    {
        $params = ['userDepartment' => $userDepartment];
        $arrAllPay =  $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM payInvoice WHERE userDepartment = :userDepartment', $params);

        return $arrAllPay;
    }
//получаем счета подчиненных
    public function getInvoiceSubordinatedEmployees()
    {
        $role = '';
        switch($_SESSION['mngr']['userRole']){
            case "divisionSaleHead":
                $role = 'mngrSale';
                break;
            case "divisionContractHead":
                $role = 'mngrContract';
                break;
            case "divisionTenderHead":
                $role = 'mngrTender';
                break;
            case "head":
               $role = 'mngr';
                break;
            default:
                $role = 'mngrSale';
                break;
        }
        $arrUserMail = $this->getModifiedMngrMail($role);
        $listInvoice = [];
        foreach ($arrUserMail as $userMail){
            $userMail = 'mngr_'.$userMail;
            $listInvoice[] = $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM '.$userMail);
        }
        return $listInvoice;
    }
//получаем данные одного менеджера
    public function getOneMngr($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT * FROM users WHERE id = :id', $params);
    }
//проверяем e-mail
    public function getLoginMngr($mailUser)
    {
        $params = ['mailUser' => $mailUser];
        return $this->db->row('SELECT * FROM users WHERE userMail = :mailUser', $params);
    }
//получаем массив пользователей
    public function getAllUsers()
    {
        return $this->db->row('SELECT * FROM users');
    }
//получаем массив контрагентов
    public function getAllContragents()
    {
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM contragents');
    }
//получаем массив проектов
    public function getAllProjects()
    {
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM projects');
    }
//получаем массив дополнений проектов
    public function getAllSuppProjects()
    {
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM suppProjects');
    }
//получаем допы проекта по ID проекта
    public function getSuppProject($projectID)
    {
        $params = ['projectID' => $projectID];
        return $this->db->row('SELECT * FROM suppProjects WHERE project_id = :projectID',$params);
    }
//получаем массив проектов с контрагентом
    public function getAllProjectsAndContragents()
    {
        $projects = $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM projects');
        $contragents = $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM contragents');

        $proAndCon = [];
        foreach ($projects as $project){
            foreach ($contragents as $contragent){
                if($project['idContragent']==$contragent['id']){
                    $proAndCon[] = [
                        'id'=>$project['id'],
                        'nameProject'=>$project['nameProject'].' - <span style="color: blue;">('.$contragent['name_contragent'].'</span>)'
                    ];
                }
            }
        }
        return $proAndCon;
    }
//получаем массив проектов контрагента
    public function getAllProjectsOneContragent($str)
    {
        $params = ['idContragent' => $str];
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM projects WHERE idContragent=:idContragent', $params);
    }
//получаем сумму всех подотчетов
    public function getSumPayInvoice()
    {
        $params = ['userID' => $_SESSION['mngr']['id']];
        return $this->db->row('SELECT SUM(money) AS moneySum FROM payInvoice WHERE under_report = "true" AND user_id=:userID AND status_pay="7" AND date_reportLastSign=""', $params);
    }
//получаем сумму всего в отчетах
    public function getSumExpencePayList()
    {
        $params = ['userID' => $_SESSION['mngr']['id']];
        return $this->db->row('SELECT SUM(money) AS moneySum FROM expensePay WHERE user_id=:userID AND expenseWork="true"', $params);
    }
//получаем список согласующих по ID пользователя
    public function getlistAction($userID,$lastSignInvoice,$lastSignPay)
    {
        $nextUserInvoice = $_SESSION['mngr']['userToMail'];
        $arrUserInvoice = [];
        $arrUserInvoice []= $nextUserInvoice;
        foreach ($this->getAllUsers() as $users){
            if($nextUserInvoice!=$lastSignInvoice) {
                $params = ['userID' => $nextUserInvoice];
                $nextUserInvoice = $this->db->column('SELECT userToMail FROM users WHERE id=:userID', $params);
                $arrUserInvoice []= $nextUserInvoice;
            }
        }

        $nextUserPay = $_SESSION['mngr']['userToMailPay'];
        $arrUserPay = [];
        $arrUserPay []= $nextUserPay;
        foreach ($this->getAllUsers() as $users){
            if($nextUserPay!=$lastSignPay) {
                $params = ['userID' => $nextUserPay];
                $nextUserPay = $this->db->column('SELECT userToMailPay FROM users WHERE id=:userID', $params);
                $arrUserPay []= $nextUserPay;
            }
        }

        $arrAllAction = [
            'arrUserInvoice' => $arrUserInvoice,
            'arrUserPay' => $arrUserPay
        ];
        return $arrAllAction;
        /*$params = ['userID' => $nextUserInvoice];
        return*/
    }
//получаем true или false на подписание для последнего согласующего налички
    public function visibleBtnFromLastSign($id)
    {
        $params = ['id' => $id];
        $initID = $this->db->column('SELECT user_id FROM payInvoice WHERE id=:id', $params);
        $toID = $this->getUserToMailPay($initID);
        if($toID!=$_SESSION['mngr']['id']){
            return 'false';
        }else{
            return 'true';
        }
    }
//получаем одну служебку одного менеджера
    public function getOnePayInvoice($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y %H:%m")) AS dateCreate FROM payInvoice WHERE id = :id', $params);
    }
//получаем расходы в конкретном подотчете
    public function getExpencePayList($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT * FROM expensePay WHERE id_pay = :id', $params);
    }
//получаем сумму расходов в конкретном подотчете
    public function getExpencePaySum($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT SUM(money) AS moneySum FROM expensePay WHERE id_pay = :id', $params);
    }
//получаем сумму неподтвержденных расходов в конкретном подотчете
    public function getExpenceNoSum($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT SUM(money) AS moneyNoSum FROM expensePay WHERE id_pay = :id AND status = "true"', $params);
    }
//получаем все подотчетные служебки инициатора
    public function getUnderReportPay()
    {
        $params = ['id' => $_SESSION['mngr']['id']];
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM payInvoice WHERE user_id = :id AND under_report = "true" AND status_pay="7"', $params);
    }
//получить все счета доступные для страницы invoice
    public function getAllInvoice()
    {
        $allowedList = $this->db->row('SELECT from_invoice FROM listUsers WHERE user_id='.$_SESSION['mngr']['id']);
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM invoice WHERE mngrId IN('.$allowedList[0]["from_invoice"].')');
    }
//получить все оплаченные счета и служебки с проектов
    public function getAllInvoiceSuccess()
    {

        $money = $this->db->row('SELECT money as summInvoiceForPayment,contract as numberContract FROM payInvoice WHERE status_pay="7" AND contract!=""');
        $invoice = $this->db->row('SELECT summInvoiceForPayment,numberContract FROM invoice WHERE invoice.statusInvoice="7" AND invoice.numberContract!=""');

        return array_merge ($money, $invoice);
    }
//получить все служебки доступные для страницы documents
    public function getAllPayInvoice()
    {
        $allowedList = $this->db->row('SELECT from_invoicePay FROM listUsers WHERE user_id='.$_SESSION['mngr']['id']);
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM payInvoice WHERE user_id IN('.$allowedList[0]["from_invoicePay"].')');
    }
//проверка на наличие ID пользователя в таблице listUsers
    public function testListUsers($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT * FROM listUsers WHERE user_id=:id',$params);
    }
//добавление списка пользователей INVOICE
    public function insertListUsers($userID)
    {
        $params = [
            'userID' => $userID
        ];
        return $this->db->query('INSERT INTO listUsers (user_id) VALUES (:userID)', $params);
    }
//получить все счета доступные для страницы dashboard
    public function getAllDashboard()
    {
        if(!$this->testListUsers($_SESSION['mngr']['id'])){
            $this->insertListUsers($_SESSION['mngr']['id']);
        }
        $allowedList = $this->db->row('SELECT from_Dashboard FROM listUsers WHERE user_id='.$_SESSION['mngr']['id']);
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM invoice WHERE mngrid IN('.$allowedList[0]["from_Dashboard"].')');
    }
//получить все служебки доступные для страницы dashboard
    public function getAllPayDashboard()
    {
        if(!$this->testListUsers($_SESSION['mngr']['id'])){
            $this->insertListUsers($_SESSION['mngr']['id']);
        }
        $allowedList = $this->db->row('SELECT from_Dashboard FROM listUsers WHERE user_id='.$_SESSION['mngr']['id']);
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM payInvoice WHERE user_id IN('.$allowedList[0]["from_Dashboard"].')');
    }
//получить все документы доступные для страницы dashboard
    public function getAllDocDashboard()
    {
        $params = ['userID' => $_SESSION['mngr']['id']];
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(dateAddDoc,"%d.%m.%Y")) AS dateCreate FROM docAdd WHERE signature=:userID',$params);
    }
//считаем сколько всего счетов у пользователя
    public function totalInvoice()
    {
        $count = $this->db->row('SELECT COUNT(*) AS total FROM invoice WHERE mngrid='.$_SESSION['mngr']['id']);
        if(!empty($count)) {
            return $count;
        }else{
            $count = 0;
            return $count;
        }
    }
//считаем сколько счетов согласовано, на согласовании или отказано
    public function statisticInvoice($statusInvoice)
    {
        $params = ['statusInvoice' => $statusInvoice];
        $count = $this->db->row('SELECT COUNT(*) AS total FROM invoice WHERE mngrid='.$_SESSION["mngr"]["id"].' AND statusInvoice = :statusInvoice', $params);
        if(!empty($count)) {
            return $count;
        }else{
            $count = 0;
            return $count;
        }
    }
//разрешенный к показу список счетов
    public function allowedListUsers()
    {
        return $this->db->row('SELECT * FROM listUsers WHERE user_id='.$_SESSION['mngr']['id']);
    }
//получение массива отделов
    public function getAllDepartments()
    {
        return $this->db->row('SELECT * FROM departments');
    }
//получение массива организаций
    public function getAllOrganization()
    {
        return $this->db->row('SELECT * FROM organization');
    }
//имя организации по ID
    public function getOrganizationForID($idOrganization)
    {
        $params = ['id' => $idOrganization];
        return $this->db->column('SELECT nameOrganization FROM organization WHERE id=:id', $params);
    }
//получаем наименование проекта по ID
    public function getNameProjectForID($numberProject)
    {
        $params = ['numberProject' => $numberProject];
        return $this->db->column('SELECT nameProject FROM projects WHERE id=:numberProject',$params);
    }
//получаем наименование контрагента по ID
    public function getNameContragentForID($idContragent)
    {
        $params = ['idContragent' => $idContragent];
        return $this->db->column('SELECT name_contragent FROM contragents WHERE id=:idContragent',$params);
    }
//получение массива должностей
    public function getAllRole()
    {
        return $this->db->row('SELECT * FROM departmentPost');
    }
//получаем все счета и служебки конкретного проекта
    public function getSearchProject($str)
    {
        $contractTable = [];

        if(empty($_POST['dateFrom'])){$dateFrom = '01.01.2000';}else{$dateFrom = $_POST['dateFrom'];}
        if(empty($_POST['dateTo'])){$dateTo = '01.01.2030';}else{$dateTo = $_POST['dateTo'];
        }
        list($day,$month,$year) = explode('.',$dateFrom);
        $dateFrom = $year.'-'.$month.'-'.$day.' 00:00:01';
        list($day,$month,$year) = explode('.',$dateTo);
        $dateTo = $year.'-'.$month.'-'.$day.' 23:59:59';

        $params = ['numberContract' => $str,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ];
        $contractTable[] =  $this->db->row ('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM invoice WHERE numberContract = :numberContract AND date_create > :dateFrom AND date_create < :dateTo',$params);

        $contractTable[] = $this->db->row ('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM payInvoice WHERE contract = :numberContract AND date_create > :dateFrom AND date_create < :dateTo',$params);

        return $contractTable;
    }
//получение списка избранного
    public function getAllFavorites()
    {
        $params = ['user_id' => $_SESSION['mngr']['id']];
        return $this->db->row('SELECT * FROM favorites WHERE user_id = :user_id', $params);
    }
//получение списка избранного
    public function getCommPartners($idInvoice,$typeAdd)
    {
        $params = [
            'idInvoice' => $idInvoice,
            'typeAdd' => $typeAdd
        ];
        return $this->db->row('SELECT * FROM comm_partner WHERE idInvoice = :idInvoice AND typeAdd=:typeAdd', $params);
    }
//получаем имя проекта
    public function getNameProject($idProject)
    {
        $params = ['idProject' => $idProject];
        return  $this->db->column('SELECT nameProject FROM projects WHERE id = :idProject', $params);
    }
//получаем имя контрагента
    public function getNameContragent($idContragent)
    {
        $params = ['idContragent' => $idContragent];
        return  $this->db->column('SELECT name_contragent FROM contragents WHERE id = :idContragent', $params);

    }
//получаем все счета и служебки конкретного контрагента
    public function getSearchContragent($str)
    {
        $contractTable = [];

        if(empty($_POST['dateFrom'])){
            $dateFrom = '01.01.2000';
        }else{
            $dateFrom = $_POST['dateFrom'];
        }
        if(empty($_POST['dateTo'])){
            $dateTo = '01.01.2030';
        }else{
            $dateTo = $_POST['dateTo'];
        }
        list($day,$month,$year) = explode('.',$dateFrom);
        $dateFrom = $year.'-'.$month.'-'.$day;
        list($day,$month,$year) = explode('.',$dateTo);
        $dateTo = $year.'-'.$month.'-'.$day.' 23:59:59';

        $allProjectsContragent = $this->getAllProjectsOneContragent($str);

        foreach ($allProjectsContragent as $item){
            $params = [
                'idProject' => $item['id'],
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo
            ];
            $contractTable[] =  $this->db->row ('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM invoice WHERE numberContract = :idProject AND date_create >= :dateFrom AND date_create <= :dateTo',$params);

        }
        foreach ($allProjectsContragent as $item){
            $params = [
                'idProject' => $item['id'],
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo
            ];
            $contractTable[] = $this->db->row ('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM payInvoice WHERE contract = :idProject AND date_create >= :dateFrom AND date_create <= :dateTo',$params);

        }
        return $contractTable;
    }
//проверяем данные менеджера при входе
    public function loginValidate()
    {
        $this->mngr = $this->getLoginMngr($_POST['mngrMail']);
        //проверка данных формы
        if (is_null($this->mngr) or empty($this->mngr) or $this->mngr[0]['userMail'] != $_POST['mngrMail'] or $this->mngr[0]['userPwd'] != $_POST['mngrPwd'] or $this->mngr[0]['adminUser'] == 'delete') {
            $this->err = 'Неверные данные для входа';
            return false;
        }
        return true;
    }
//добавить проверку при необходимости
    public function postValidate($type)
    {
        if($this->uploadInvoice() && $type == 'add'){
            return true;
        }else{
            return false;
        }
        /*if(empty($_FILES['imgInvoice']['tmp_name'] && $type == 'add')){
            $this->err = 'Файл не выбран';
            return false;
        }*/
    }
//добавление счета
    public function addEntry()
    {
        if ($_POST['urgentPayment'] == 'true'){$urgentPayment = 'on';}else {$urgentPayment = 'off';}
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
                $currency = 1;
                break;
            case 'EUR':
                $currency = 2;
                break;
            case 'USD':
                $currency = 3;
                break;
            case 'JPY':
                $currency = 4;
                break;
        }
        if(!empty($_POST['noticeInvoiceForPayment'])){
            $notice = $this->clean($_POST['noticeInvoiceForPayment']);
        }else{
            $notice = '';
        }
        $params = [
            'mngrId' => $_SESSION['mngr']['id'],
            'urgentPayment' => $urgentPayment,
            'date_create' => $_POST['datetimeStamp'],
            'needPay' => $_POST['needPay'],
            'numberContract' => $_POST['idProjectHidden'],
            'numberInvoice' => $this->clean($_POST['numberInvoice']),
            'statusInvoice' => '1',
            'initiatorSurname' => $_SESSION['mngr']['userSurname'],
            'initiatorFirstName' => $_SESSION['mngr']['userFirstName'],
            'initiatorRole' => $_SESSION['mngr']['userRole'],
            'initiatorMail' => '',
            'summInvoiceForPayment' => $money,
            'contragent' => $_POST['idHiddenContragent'],
            'organizationInvoiceForPayment' => $_POST['organizationInvoiceForPayment'],
            'noticeInvoiceForPayment' => $notice,
            'editLabel' => 'false',
            'currency' => $currency
        ];

        $this->db->query('INSERT INTO invoice
                          (mngrId, signature, urgentPayment, needPay, numberContract, numberInvoice, statusInvoice, initiatorSurname, initiatorFirstName, initiatorRole,
                          initiatorMail, summInvoiceForPayment, contragent, organizationInvoiceForPayment,
                          noticeInvoiceForPayment,editLabel,currency,date_create) 
                          VALUES (:mngrId, "0",:urgentPayment, :needPay, :numberContract, :numberInvoice, :statusInvoice, :initiatorSurname, :initiatorFirstName, :initiatorRole, 
                          :initiatorMail, :summInvoiceForPayment, :contragent, :organizationInvoiceForPayment,
                          :noticeInvoiceForPayment,:editLabel,:currency,:date_create)', $params);
        $idInvoice = $this->db->lastInsertId();
        $params = [
            'idInvoice' => $idInvoice,
            'typeAdd' => 'invoice',
            'mngrId' => $_SESSION['mngr']['id']
        ];
        $this->db->query('INSERT INTO comm_partner (idInvoice, typeAdd,idPartner) 
                          VALUES (:idInvoice, :typeAdd, :mngrId)', $params);
        if($this->testNoticeSettings($this->getUserToMail($_SESSION['mngr']['id']),'noticeDashAddInvoice')){
            $this->noticeInvoice($idInvoice);
        }
        /*if($this->testNoticeSettings($this->getUserToMail($_SESSION['mngr']['id']),'noticeMailAddInvoice')){
            $this->sendMail();
        }*/
        $params = [
            'idProject' => $_POST['idProjectHidden'],
        ];
        $this->db->query('UPDATE projects SET date_edit=NOW() WHERE id=:idProject', $params);

        return $idInvoice;
    }
//редактируем пользователя
    public function editEntry($id) {
        $params = ['id' => $id,
            'userSurname' => $_POST['userSurname'],
            'userFirstName' => $_POST['userFirstName'],
            'userLastName' => $_POST['userLastName'],
            'userDepartment' => $_POST['userDepartment'],
            'userRole' => $_POST['userRole'],
            'userWorkPhone' => $_POST['userWorkPhone'],
            'userPersonalPhone' => $_POST['userPersonalPhone'],
            'userMail' => $_POST['userMail'],
            'userSkype' => $_POST['userSkype'],
            'userPwd' => $_POST['userPwd']];
        $this->db->query('UPDATE users SET userSurname = :userSurname,
                          userFirstName = :userFirstName,
                          userLastName = :userLastName,
                          userDepartment = :userDepartment,
                          userRole = :userRole,
                          userWorkPhone = :userWorkPhone,
                          userPersonalPhone = :userPersonalPhone,
                          userMail = :userMail,
                          userSkype = :userSkype,
                          userPwd = :userPwd
                          WHERE id = :id', $params);
    }
//получаем id кому отправить служебку по ID пользователя
    public function getUserToMailPay($userID)
    {
        $params = ['userID' => $userID];
        return $this->db->column('SELECT userToMailPay FROM users WHERE id = :userID', $params);
    }
//получаем timezone
    public function getTimezone()
    {
        $idTimezone = $this->getOneOption('timezone');
        $params = ['id' => $idTimezone];
        return $this->db->column('SELECT correct_time FROM timezone WHERE id = :id', $params);
    }
//получаем id кому отправить счет по ID пользователя
    public function getUserToMail($userID)
    {
        $params = ['userID' => $userID];
        return $this->db->column('SELECT userToMail FROM users WHERE id = :userID', $params);
    }
//редактирование счета
    public function editInvoice()
    {
        if ($_POST['urgentPayment'] == 'true'){$urgentPayment = 'on';}else {$urgentPayment = 'off';}
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
                $currency = 1;
                break;
            case 'EUR':
                $currency = 2;
                break;
            case 'USD':
                $currency = 3;
                break;
        }
        if(!empty($_POST['noticeInvoiceForPayment'])){
            $notice = $this->clean($_POST['noticeInvoiceForPayment']);
        }else{
            $notice = '';
        }
        $params = [
            'idInvoice' => $_POST['idInvoice'],
            'urgentPayment' => $urgentPayment,
            'needPay' => $_POST['needPay'],
            'numberContract' => $_POST['idProjectHidden'],
            'numberInvoice' => $this->clean($_POST['numberInvoice']),
            'summInvoiceForPayment' => $money,
            'contragent' => $_POST['idHiddenContragent'],
            'organizationInvoiceForPayment' => $_POST['organizationInvoiceForPayment'],
            'noticeInvoiceForPayment' => $notice,
            'currency' => $currency
        ];
        $testRow = $this->db->rowCount('UPDATE invoice SET urgentPayment=:urgentPayment,needPay=:needPay,numberContract=:numberContract,numberInvoice=:numberInvoice,summInvoiceForPayment=:summInvoiceForPayment,
                                contragent=:contragent,organizationInvoiceForPayment=:organizationInvoiceForPayment,noticeInvoiceForPayment=:noticeInvoiceForPayment,currency=:currency WHERE id=:idInvoice', $params);
        if($testRow>0){
            $params = [
                'id' => $_POST['idInvoice'],
                'date_edit' => $_POST['dateEdit']
            ];
            $this->db->query('UPDATE invoice SET date_edit=:date_edit WHERE id=:id', $params);
        }
    }
//записать уведомление о добавлении счета
    public function noticeInvoice($idInvoice)
    {
        $userDataInitiator = $this->getOneMngr($_SESSION['mngr']['id']);//получил данные пользователя
        $params = [
            'whatIs'=>'invoice',
            'user_id_to' => $userDataInitiator[0]['userToMail'], //кому
            'user_id_from' => $userDataInitiator[0]['id'], //от кого
            'invoice_id' => $idInvoice,
            'tableUser' => 'invoice',
            'initiatorName' => $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName']
            ];
        $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                          VALUES (:whatIs, :user_id_to, :user_id_from, :invoice_id, :tableUser, :initiatorName)', $params);
        $params = [
            'invoice_id' => $idInvoice,
            'user_id_to' => $userDataInitiator[0]['userToMail'] //кто обязан согласовать
        ];
        $this->db->row('UPDATE invoice SET signature = :user_id_to WHERE id = :invoice_id',$params);

    }
//получение ID проекта по ID счета или служебки
    public function getProjectID($type,$id)
    {
        if($type=='invoice'){
            $params = ['id'=>$id];
            return $this->db->column('SELECT numberContract FROM invoice WHERE id = :id',$params);
        }else if($type=='invoicePay'){
            $params = ['id'=>$id];
            return $this->db->column('SELECT contract FROM payInvoice WHERE id = :id',$params);
        }else{
            return false;
        }
    }
//получение тем УВД
    public function getThemeDoc()
    {
        return $this->db->row('SELECT * FROM docAddTheme');
    }
//получение данных УВД по ID
    public function getAddDocID($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT * FROM docAdd WHERE id=:id',$params);
    }
//получаем ID отдела по ID пользователя
    public function getDepartmentID($userID)
    {
        $params = ['id' => $userID];
        return $this->db->column('SELECT userDepartment FROM users WHERE id=:id',$params);
    }
//получение всех данных УВД
    public function getAllAddDoc()
    {
        return $this->db->row('SELECT * FROM getAllAddDoc');
    }
//проверка рентабельности проекта по ID проекта
    public function testProfit($projectID)
    {
        if(!empty($projectID)){
            $getDataProject = $this->getDataProjectForID($projectID); //все данные проекта

            $idContragent = $getDataProject[0]['idContragent']; //контрагент
            $moneyProject = $getDataProject[0]['moneyProject']; //сумма проекта
            if(empty($moneyProject)){$moneyProject = 0;} //при отсутствии суммы проекта сумма 0
            if (!is_numeric($moneyProject)){$moneyProject = 0;}

            $profitProject = $getDataProject[0]['profitProject']; //установленная рентабельность проекта

            $getSearchProject = $this->getSearchProject($projectID); //список счетов и служебок
            $moneyInvoiceSeven = $moneyInvoiceOther = $moneyInvoicePaySeven = $moneyInvoicePayOther = $moneySupp = 0;
            foreach ($getSearchProject[0] as $invoice){
                switch ($invoice['statusInvoice']){
                    case '7':
                        $moneyInvoiceSeven = $invoice['summInvoiceForPayment']+$moneyInvoiceSeven;
                        break;
                    case '1':
                    case '2':
                        $moneyInvoiceOther = $invoice['summInvoiceForPayment']+$moneyInvoiceOther;
                        break;
                }
            }
            foreach ($getSearchProject[1] as $invoicePay){
                switch ($invoicePay['status_pay']){
                    case '7':
                        $moneyInvoicePaySeven = $invoicePay['money']+$moneyInvoicePaySeven;
                        break;
                    case '1':
                    case '2':
                        $moneyInvoicePayOther = $invoicePay['money']+$moneyInvoicePayOther;
                        break;
                }
            }
            $getSuppProject = $this->getSuppProject($projectID); //список допов
            foreach ($getSuppProject as $suppProject){
                $moneySupp = $suppProject['money_supp']+$moneySupp;
            }
            if(empty($moneySupp)){$moneySupp = 0;} //при отсутствии суммы допов сумма 0
            if (!is_numeric($moneySupp)){$moneySupp = 0;}
            $money = $moneyInvoiceSeven+$moneyInvoicePaySeven;
            $moneyOther = $moneyInvoiceOther+$moneyInvoicePayOther;
            $moneyProjectSupp = $moneySupp+$moneyProject;
            if(empty($moneyProjectSupp)){
                $moneyProjectSupp = 1;
            }

            if ($this->testOrgProject($idContragent)){//проверка контрагента свой или нет
                $summForPercent = $moneyInvoiceSeven+$moneyInvoicePaySeven;
                if($summForPercent == 0){
                    $summForPercent = 1;
                }
                $summForPercentOther = $moneyInvoiceSeven+$moneyInvoiceOther+$moneyInvoicePayOther+$moneyInvoicePaySeven;
                if($summForPercentOther == 0){
                    $summForPercentOther = 1;
                }
                //$perfectPercentOther = ($moneyProjectSupp/$summForPercentOther-1)*100;
                $perfectPercentOther = ($moneyProjectSupp-$summForPercentOther)/$moneyProjectSupp*100;
                if($perfectPercentOther>$profitProject){$profitExit = true;}else{$profitExit = false;}
                $testProject = [
                    'typeProject' => 'inside',
                    'moneyProjectSupp' => $moneyProjectSupp,
                    'moneyProject' => $moneyProject,
                    'perfect' => $moneyProjectSupp-($moneyInvoiceSeven+$moneyInvoicePaySeven),
                    'perfectOther' => $moneyProjectSupp-($moneyInvoiceSeven+$moneyInvoiceOther+$moneyInvoicePayOther+$moneyInvoicePaySeven),
                    //'perfectPercent' => ($moneyProjectSupp/$summForPercent-1)*100,
                    'perfectPercent' => ($moneyProjectSupp-$summForPercent)/$moneyProjectSupp*100,
                    'perfectPercentOther' => $perfectPercentOther,
                    'expenseProject' => 'не установлено',
                    'profitProject' => $profitProject,
                    'profitExit' => $profitExit,
                    'projectID' => $projectID,
                    'moneyInvoiceSeven' => $moneyInvoiceSeven, //счета согласованы
                    'moneyInvoiceOther' => $moneyInvoiceOther, //счета в работе
                    'moneyInvoicePaySeven' => $moneyInvoicePaySeven, //служебки согласованы
                    'moneyInvoicePayOther' => $moneyInvoicePayOther, //служебки в работе
                    'money' => $money,
                    'moneyOther' => $moneyOther
                ];
            }else{
                if(empty($getDataProject[0]['expenseProject'])){
                    $expenseProject = 0;
                }else{
                    $expenseProject = $getDataProject[0]['expenseProject']; //фикс траты
                }
                switch ($getDataProject[0]['selectedProject']){//процент или сумма
                    case '2'://проценты

                        break;
                    case '3'://сумма

                        break;
                }
                $summForPercent = $moneyInvoiceSeven+$moneyInvoicePaySeven+$expenseProject;
                if($summForPercent == 0){
                    $summForPercent = 1;
                }
                $summForPercentOther = $moneyInvoiceSeven+$moneyInvoiceOther+$moneyInvoicePayOther+$moneyInvoicePaySeven+$expenseProject;
                if($summForPercentOther == 0){
                    $summForPercentOther = 1;
                }
                //$perfectPercentOther = ($moneyProjectSupp/$summForPercentOther-1)*100;
                $perfectPercentOther = ($moneyProjectSupp-$summForPercentOther)/$moneyProjectSupp*100;
                if($perfectPercentOther>$profitProject){$profitExit = true;}else{$profitExit = false;}
                $testProject = [
                    'typeProject' => 'outside',
                    'moneyProjectSupp' => $moneyProjectSupp, //стоимость проекта всего
                    'moneyProject' => $moneyProject,
                    'perfect' => $moneyProjectSupp-($moneyInvoiceSeven+$moneyInvoicePaySeven+$expenseProject),
                    'perfectOther' => $moneyProjectSupp-($moneyInvoiceSeven+$moneyInvoiceOther+$moneyInvoicePayOther+$moneyInvoicePaySeven+$expenseProject),
                    //'perfectPercent' => ($moneyProjectSupp/$summForPercent-1)*100,
                    'perfectPercent' => ($moneyProjectSupp-$summForPercent)/$moneyProjectSupp*100,
                    'perfectPercentOther' => $perfectPercentOther,
                    'expenseProject' => $expenseProject,
                    'profitProject' => $profitProject,
                    'profitExit' => $profitExit,
                    'projectID' => $projectID,
                    'moneyInvoiceSeven' => $moneyInvoiceSeven, //счета согласованы
                    'moneyInvoiceOther' => $moneyInvoiceOther, //счета в работе
                    'moneyInvoicePaySeven' => $moneyInvoicePaySeven, //служебки согласованы
                    'moneyInvoicePayOther' => $moneyInvoicePayOther, //служебки в работе
                    'money' => $money,
                    'moneyOther' => $moneyOther
                ];
            }
        }else{
            $testProject = [
                'typeProject' => 'noproject',
                'moneyProjectSupp' => 0,
                'moneyProject' => 'не установлено',
                'perfect' => 0,
                'perfectOther' => 0,
                'perfectPercent' => 'не установлено',
                'perfectPercentOther' => 'не установлено',
                'expenseProject' => 'не установлено',
                'profitProject' => 'не установлено',
                'profitExit' => 'не установлено',
                'projectID' => 'не установлено',
                'moneyInvoiceSeven' => 'не установлено',
                'moneyInvoiceOther' => 'не установлено',
                'moneyInvoicePaySeven' => 'не установлено',
                'moneyInvoicePayOther' => 'не установлено',
                'money' => 0,
                'moneyOther' => 0
            ];
        }
        return $testProject;
    }
//получаем все данные проекта по ID
    public function getDataProjectForID($projectID)
    {
        $params = ['id' => $projectID];
        return $this->db->row('SELECT * FROM projects WHERE id=:id',$params);
    }
//проверка контрагента свой или нет
    public function testOrgProject($idContragent)
    {
        $params = ['idContragent' => $idContragent];
        $mineOrg = $this->db->column('SELECT mineOrg FROM contragents WHERE id = :idContragent',$params);
        if($mineOrg == 'true'){
            return true;
        }else{
            return false;
        }
    }
//отправить копию счета на сервер
    public function uploadInvoice($id)
    {
        //загружаем счет
        $loadFile = new UploaderInvoice($_FILES['imgInvoice']);
        if ($loadFile->isUploader()) {
            $loadFile->uploadInvoice();
            $keyUpload = true;
        } else {
            $this->err = $loadFile->errMessage;
            $keyUpload = false;
        }
        if($keyUpload==true){
            list($pathNone, $path) = explode("public_html", $loadFile->uploadInvoice());
            $params = [
                'pathScanInvoice' => $path,
                'id' => $id
            ];
            $this->db->query('UPDATE invoice SET pathScanInvoice = :pathScanInvoice WHERE id = :id', $params);
        }else{
            $this->err = '(ERROR UPLOAD FILE) - Не выбран файл или произошла ошибка при загрузке файла! Проверьте разрешенные форматы.';

        }
        return $keyUpload;


    }
    public function getOneEntry($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT * FROM users WHERE id = :id', $params);
    }
    public function isEntryExists($id)
    {
        $params = ['id' => $id];
        return $this->db->column('SELECT id FROM users WHERE id = :id', $params);
    }
//загружаем аватарку из профиля пользователя
    public function uploadAvatar()
    {
         //загружаем аватарку
            $loadFile = new UploaderAvatar($_FILES['imgAvatar']);
            if ($loadFile->isUploader()) {
                $loadFile->uploadAvatar();
            } else {
                $this->err = $loadFile->errMessage;
            }
            $params = ['pathAvatar' => ltrim($loadFile->uploadAvatar(),'.'),
                       'userMail' => $_SESSION['mngr']['userMail']];
            $this->db->query('UPDATE users SET userAvatar = :pathAvatar WHERE userMail = :userMail', $params);
    }
//берем путь к аватарке из базы
    public function getPathAvatar()
    {
        $params = ['id' => $_SESSION['mngr']['id']];
        return $this->db->column('SELECT userAvatar FROM users WHERE id = :id', $params);
    }
//получаем настройки уведомлений
    public function getNoticeSettingsUser($userID)
    {
        $params = ['userID'=>$userID];
        return $this->db->row('SELECT * FROM noticeSettings WHERE user_id=:userID',$params);
    }
//получить значение конкретной опции
    public function getOneOption($str)
    {
        $params = ['optionName' => $str];
        return $this->db->column('SELECT optionValue FROM optionSettings WHERE optionName=:optionName',$params);
    }
//проверка разрешенного уведемления
    public function testNoticeSettings($userID,$noticeTest)
    {
        $params = ['userID' => $userID];
        $result = $this->db->column('SELECT '.$noticeTest.' FROM noticeSettings WHERE user_id=:userID',$params);
        if($result == 'true'){
            return true;
        }else{
            return false;
        }
    }
//проверка отправляют ли пользователю уведомления при создании счета
    public function userToMail($userID)
    {
        $params = ['userID' => $userID];
        $result = $this->db->row('SELECT * FROM users WHERE userToMail=:userID',$params);
        if(!empty($result)){
            return true;
        }else{
            return false;
        }
    }
//проверка отправляют ли пользователю уведомления при создании служебки
    public function userToMailPay($userID)
    {
        $params = ['userID' => $userID];
        $result = $this->db->row('SELECT * FROM users WHERE userToMailPay=:userID',$params);
        if(!empty($result)){
            return true;
        }else{
            return false;
        }
    }
//проверка статуса служебки с подотчетом
    public function getStatusInvoicePay($id)
    {
        $params = ['id' => $id];
        $result = $this->db->column('SELECT date_reportLastSign FROM payInvoice WHERE id=:id',$params);
        if(!empty($result)){
            return true;
        }else{
            return false;
        }
    }
//отправляем письмо о необходимости согласовать счет
    public function sendMail()
    {
        $numberInvoice = '4';//$_POST['numberInvoice'];
        $summInvoiceForPayment = '4';//$_POST['summInvoiceForPayment'];
        $to = 'admin@qrant.ru';//$this->getUserToMail($_SESSION['mngr']['id']);//$this->getAddressMngrToMail();//достаем адрес кому должен отправлять письмо данный пользователь


        $organization = '4';//$this->getOrganizationForID($_POST['organizationInvoiceForPayment']);
        $contragent = '4';//$this->getNameContragentForID($_POST['idHiddenContragent']);
        $project = '4';//$this->getNameProjectForID($_POST['idProjectHidden']);
        $noticeInvoiceForPayment = '4';//$_POST['noticeInvoiceForPayment'];
        $theme = 'Согласование счета';
        $textAlert = 'Получен новый счет требующий Вашего согласования';
        /*if($_POST['urgentPayment']=='true'){
            $theme = 'Срочная оплата!';
            $textAlert = '<span 
            style="color: red;font-size: 18px;
            "><strong>Получен новый счет требующий Вашего срочного согласования</strong></span>';
        }*/
        $addressSite = $this->getOneOption('addressSite');
        $urlScanInvoice = 'no';//$_SESSION['mngr']['uploadsDir'];
        if($urlScanInvoice!='no'){
            $prewiev = '<a href="'.$addressSite.'/'.$urlScanInvoice.'" target="_blank" rel="noopener noreferrer" style="display:inline-block;border: 1px solid #333;border-radius: 5px;padding:10px;text-decoration: none;margin-right: 20px;background-color: #0b94ea;color: black;">СМОТРЕТЬ</a>';
        }else{
            $prewiev = '';
        }
        //$maxID = $this->db->row('SELECT MAX(id) FROM invoice');
        $urlInvoice = '4';//$maxID[0]['MAX(id)'];

        $message = 'Это сообщение от '.$_POST['initiatorSurname'].' '.$_POST['initiatorFirstName'];
$message .= <<<HERE
<div style="background-color:#fff;">
    <table style="border-collapse:collapse;" width="100%" cellspacing="0" cellpadding="12" align="center">
        <tbody>
            <tr>
                <td>
                    <div style="padding-top:16px;padding-bottom:24px;">
                        <table style="width:100%;" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                        <div style="padding-top:2px;text-align:left;">
                                            <a href="$addressSite" target="_blank" rel="noopener noreferrer">
                                                <img alt="motor-logo" style="border:0;padding:0;margin:0;display:block;" src="$addressSite/public/images/logos/logo.png" width="100">
                                            </a>
                                        </div>
                                        <div style="padding-top:9px;color:#9099a3;line-height:17px;font-size:15px;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;">
                                            Система согласования счетов
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="overflow:hidden;border-top:1px solid #f0f0f0;text-align:left;">
                        <div>
                            <p>Здравствуйте!</p>
                            <p>$textAlert:<br>
                            <p>Поставщик: $contragent</p>
                            <p>Номер счета: $numberInvoice</p>
                            <p>Сумма счета: $summInvoiceForPayment</p>
                            <p>Организация: $organization</p>
                            <p>Проект: $project</p>
                            <p>Примечания: $noticeInvoiceForPayment</p>
                                $prewiev
                                <a href="$addressSite/mngr/staffer/$urlInvoice" target="_blank" rel="noopener noreferrer"
                                style="display:inline-block;border: 1px solid #333;border-radius: 5px;padding:10px;text-decoration: none;margin-right: 20px;background-color:#3c9916;color: black;">ПЕРЕЙТИ В СЧЕТ</a>
                            <p>Если вы получили это письмо по ошибке, просто игнорируйте его.</p>

                        </div>
                    </div>
                    <div style="padding-top:15px;padding-bottom:15px;border-top:1px solid #f0f0f0;margin-top:20px;">
                        <div style="padding-top:3px;color:#b3b3b1;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;font-size:13px;line-height:20px;">
                            © <a href="$addressSite" style="text-decoration:none;color:#b3b3b1;" target="_blank" rel="noopener noreferrer">Система согласования счетов MOTOR</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
HERE;
        $from = array(
            $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'], // Имя отправителя
            $_SESSION['mngr']['userMail']// почта отправителя
        );
        /*$mailInvoice = new SendMail('kwt.net@yandex.ru', 'kwtnet121tentwk', 'ssl://smtp.yandex.ru', 465, "UTF-8");
        $mailInvoice->send($to, $theme, $message, $from);*/
        return true;
    }
//получаем один счет конкретного менеджера
    public function getStafferInvoice($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y %H:%i")) AS dateCreate FROM invoice WHERE id = :id', $params);
    }
//получаем массив валюты
    public function getCurrency()
    {
        return $this->db->row('SELECT * FROM currency');
    }
//отменяем editLabel
    public function endLabelEdit($idInvoice,$typeAdd)
    {
        if($typeAdd=='invoice'){
            $params = ['idInvoice'=>$idInvoice];
            return $this->db->column('UPDATE invoice SET editLabel="false" WHERE id=:idInvoice',$params);
        }else{
            $params = ['idInvoice'=>$idInvoice];
            return $this->db->column('UPDATE payInvoice SET editLabel="false" WHERE id=:idInvoice',$params);
        }
    }
//разрешено ли пользователю администрировать программу
    public function getAdminUsers($userID)
    {
        $params = ['id' => $userID];
        return $this->db->column('SELECT adminUser FROM users WHERE id=:id',$params);
    }
//получение массива должностей
    public function getAllPosts()
    {
        return $this->db->row('SELECT * FROM departmentPost');
    }
//получение массива опций сайта
    public function getAllOptions()
    {
        return $this->db->row('SELECT * FROM optionSettings');
    }
//получение настроек
    public function getNoticeSettings()
    {
        return $this->db->row('SELECT * FROM noticeSettings');
    }
//получение массива валюты
    public function getAllCurrency()
    {
        return $this->db->row('SELECT * FROM currency');
    }


}