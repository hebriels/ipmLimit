<?php

namespace app\models;

use app\core\Model;
use app\lib\SendMail;
//use Mpdf\Mpdf;

class Ajax extends Model
{
//получение массива отделов
    public function getAllDepartments()
    {
        return $this->db->row('SELECT * FROM departments');
    }
//обновление иерархии отделов
    public function updateProgress($post)
    {
        $params = [
            'parent' => $post['old_parent'],
            'old_position' => $post['old_position']+1
        ];
        $this->db->row('UPDATE progression SET positions = positions - 1 WHERE parent = :parent AND positions > :old_position',$params);
        $params = [
            'new_parent' => $post['new_parent'],
            'new_position' => $post['new_position']+1
        ];
        $this->db->row('UPDATE progression SET positions = positions + 1 WHERE parent = :new_parent AND positions >= :new_position',$params);
        $params = [
            'id' => $post['id'],
            'new_parent' => $post['new_parent'],
            'new_position' => $post['new_position']+1
        ];
        $this->db->query('UPDATE progression SET parent = :new_parent, positions = :new_position WHERE id = :id',$params);
        return $post;
    }
//получение массива должностей
    public function getAllPosts()
    {
        return $this->db->row('SELECT * FROM departmentPost');
    }
//изменение ответа на документ
    public function saveDocAnswer()
    {
        $params = [
            'id' => $_POST['idDoc'],
            'answerDoc' => $_POST['saveDoc']
        ];
        $this->db->row('UPDATE docAdd SET answerDoc = :answerDoc WHERE id = :id',$params);
    }
//изменение ответчика
    public function saveEditCharge()
    {
        $idDoc = $_POST['idDoc'];
        $userTo = $_POST['selectUserForDep'];
        $this->sendMailNext($userTo, $idDoc, 'addDoc', 'newAddDoc', '/file/addDoc/'.$_POST['fileAddDoc']);
        $this->noticeAddDoc('newDoc', $userTo, $idDoc);
        $params = [
            'id' => $idDoc,
            'signature' => $userTo,
            'chargeUserID' => $userTo
        ];
        $this->db->row('UPDATE docAdd SET signature = :signature, chargeUserID = :chargeUserID WHERE id = :id',$params);
    }
//изменение отдела и(или) тематики
    public function saveEditDepOrTheme()
    {
        $params = [
            'id' => $_POST['idDoc'],
            'signature' => $this->getIDUserFromIDdepDoc($_POST['selectEditDep']),
            'themeAddDoc' => $_POST['selectEditTheme']
        ];
        $this->db->row('UPDATE docAdd SET signature = :signature, themeAddDoc=:themeAddDoc WHERE id = :id',$params);
    }
//список отделов
    public function getDepartments()
    {
        return $this->db->row('SELECT id AS "value", nameDepartment AS text FROM departments');
    }
//название должности по ID
    public function getNameDepartmentsPost($id)
    {
        $params = ['id' => $id];
        return $this->db->column('SELECT postDepartment FROM departmentPost WHERE id=:id',$params);
    }
//название отдела по ID
    public function getNameDepartments($id)
    {
        $params = ['id' => $id];
        return $this->db->column('SELECT nameDepartment FROM departments WHERE id=:id',$params);
    }
//список пользователей
    public function getListUsers()
    {
        return $this->db->row('SELECT id AS "value", CONCAT(userSurname," ",userFirstName) AS text FROM users WHERE adminUser!="delete"');
    }
//оправка оповещений пользователям по email
    public function listUsersSend($themeAlertUsers,$messageAlertUsers,$selectedUsersID)
    {
        $addressSite = $this->getOneOption('addressSite');
        $imageLogo = $this->getOneOption('imageLogo'); //получаем логотип
        $message = 'Это сообщение от '.$_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'];
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
                                                <img alt="motor-logo" style="border:0;padding:0;margin:0;display:block;" src="$addressSite/assets/images/logos/$imageLogo" width="100">
                                            </a>
                                        </div>
                                        <div style="padding-top:9px;color:#9099a3;line-height:17px;font-size:15px;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;">
                                            Система контроля проектов
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="overflow:hidden;border-top:1px solid #f0f0f0;text-align:left;">
                        <div>
                            <p>$messageAlertUsers<br>
                            <p>Если вы получили это письмо по ошибке, просто игнорируйте его.</p>

                        </div>
                    </div>
                    <div style="padding-top:15px;padding-bottom:15px;border-top:1px solid #f0f0f0;margin-top:20px;">
                        <div style="padding-top:3px;color:#b3b3b1;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;font-size:13px;line-height:20px;">
                            © <a href="$addressSite" style="text-decoration:none;color:#b3b3b1;" target="_blank" rel="noopener noreferrer">Система согласования счетов</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
HERE;
        $from = array(
            "Система контроля проектов",//$_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'], // Имя отправителя
            $this->getOneOption('postAddress')//$_SESSION['mngr']['userMail']// почта отправителя
        );
        $postSettings = $this->getOneOption('postSettings');
        if($postSettings == 'true'){
            $postAddress = $this->getOneOption('postAddress');
            $postPass = $this->getOneOption('postPass');
            $postSMTPHost = $this->getOneOption('postSMTPHost');
            $postSMTPPort = $this->getOneOption('postSMTPPort');
            $mailInvoice = new SendMail($postAddress, $postPass, $postSMTPHost, $postSMTPPort, "UTF-8");
            return $mailInvoice->send($selectedUsersID, $themeAlertUsers, $message, $from);
        }else{
            return false;
        }
    }
//данные пользователя по ID
    public function getOneUsers($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT * FROM users WHERE id=:id',$params);
    }
//получаем ID отдела по ID пользователя
    public function getDepartmentID($userID)
    {
        $params = ['id' => $userID];
        return $this->db->column('SELECT userDepartment FROM users WHERE id=:id',$params);
    }
//список валюты
    public function getListCurrency()
    {
        return $this->db->row('SELECT id AS "value", nameCurrency AS text FROM currency');
    }
//список timezone
    public function getListTimezone()
    {
        return $this->db->row('SELECT id AS "value", name_zone AS text FROM timezone');
    }
//список ID пользователей конкретного отдела
    public function getListUserIDFromDepartment($str)
    {
        $params = ['userDepartment' => $str];
        return $this->db->row('SELECT * FROM users WHERE FIND_IN_SET(userDepartment, :userDepartment)',$params);
    }
//Сумма всех счетов пользователя
    public function loadAllInvoiceMngr($mngrId,$dateFrom,$dateTo)
    {
        $params = [
            'mngrId' => $mngrId,
            'dateFrom' => $dateFrom.' 00:00:00',
            'dateTo' => $dateTo.' 23:59:59'
        ];
        $totalInvoice = $this->db->row('SELECT SUM(summInvoiceForPayment) AS total FROM invoice WHERE statusInvoice="7" AND mngrId=:mngrId AND date_create > :dateFrom AND date_create < :dateTo',$params);
        if(empty($totalInvoice[0]['total'])){$totalInvoice = '0';}else{$totalInvoice = $totalInvoice[0]['total'];}
        return $totalInvoice;
    }
//Сумма всех счетов пользователя в работе
    public function loadAllInvoiceMngrInWork($mngrId)
    {
        $params = [
            'mngrId' => $mngrId
        ];
        $totalInvoice = $this->db->row('SELECT SUM(summInvoiceForPayment) AS total FROM invoice WHERE statusInvoice IN(1,2,3,6) AND mngrId=:mngrId',$params);
        if(empty($totalInvoice[0]['total'])){$totalInvoice = '0';}else{$totalInvoice = $totalInvoice[0]['total'];}
        return $totalInvoice;
    }
//Количество всех счетов пользователя в работе
    public function loadAllCountInvoiceInWork($userID)
    {
        $params = [
            'mngrId' => $userID
        ];
        $colInvoiceWork = $this->db->row('SELECT * FROM invoice WHERE statusInvoice IN(1,2,3,6) AND mngrId=:mngrId',$params);
        return count($colInvoiceWork);
    }
//Количество всех служебок пользователя в работе
    public function loadAllCountPayInWork($userID)
    {
        $params = [
            'user_id' => $userID
        ];
        $colPayWork = $this->db->row('SELECT * FROM payInvoice WHERE status_pay IN(1,2,3,6) AND user_id=:user_id',$params);
        return count($colPayWork);
    }
//Количество всех документов пользователя в работе
    public function loadAllCountDocInWork($userID)
    {
        $params = [
            'chargeUserID' => $userID
        ];
        $colDocWork = $this->db->row('SELECT * FROM docAdd WHERE status IN(4,4.1) AND chargeUserID=:chargeUserID',$params);
        return count($colDocWork);
    }
//Сумма всех служебок пользователя в работе
    public function loadAllPayMngrInWork($userID)
    {
        $params = [
            'user_id' => $userID
        ];
        $totalPay = $this->db->row('SELECT SUM(money) AS total FROM payInvoice WHERE status_pay IN(1,2,3,6) AND user_id=:user_id',$params);
        if(empty($totalPay[0]['total'])){$totalPay = '0';}else{$totalPay = $totalPay[0]['total'];}
        return $totalPay;
    }
//Сумма всех счетов пользователя
    public function timeInvoice($mngrId,$dateFrom,$dateTo)
    {
        $params = [
            'mngrId' => $mngrId,
            'dateFrom' => $dateFrom.' 00:00:00',
            'dateTo' => $dateTo.' 23:59:59'
        ];
        return $this->db->row('SELECT date_create,date_signature,date_success FROM invoice WHERE statusInvoice="7" AND mngrId=:mngrId AND date_create > :dateFrom AND date_create < :dateTo',$params);
    }
//Кол-во всех счетов пользователя
    public function getIvoiceCountUser($mngrId,$dateFrom,$dateTo)
    {
        $params = [
            'mngrId' => $mngrId,
            'dateFrom' => $dateFrom.' 00:00:00',
            'dateTo' => $dateTo.' 23:59:59'
        ];
        $colInvoice = $this->db->row('SELECT * FROM invoice WHERE mngrId=:mngrId AND date_create > :dateFrom AND date_create < :dateTo',$params);
        return count($colInvoice);
    }
//Кол-во оплаченных счетов пользователя
    public function getInvoiceSuccessUser($mngrId,$dateFrom,$dateTo)
    {
        $params = [
            'mngrId' => $mngrId,
            'dateFrom' => $dateFrom.' 00:00:00',
            'dateTo' => $dateTo.' 23:59:59'
        ];
        $colInvoice = $this->db->row('SELECT * FROM invoice WHERE mngrId=:mngrId AND statusInvoice = "7" AND date_create > :dateFrom AND date_create < :dateTo',$params);
        return count($colInvoice);
    }
//Кол-во отказанных счетов пользователя
    public function getInvoiceFailureUser($mngrId,$dateFrom,$dateTo)
    {
        $params = [
            'mngrId' => $mngrId,
            'dateFrom' => $dateFrom.' 00:00:00',
            'dateTo' => $dateTo.' 23:59:59'
        ];
        $colInvoice = $this->db->row('SELECT * FROM invoice WHERE mngrId=:mngrId AND statusInvoice = "5" AND date_create > :dateFrom AND date_create < :dateTo',$params);
        return count($colInvoice);
    }
//Получение всех счетов
    public function getAllInvoice()
    {
        return $this->db->row('SELECT * FROM invoice');
    }
//Получение всех служебок
    public function getAllInvoicePay()
    {
        return $this->db->row('SELECT * FROM payInvoice');
    }
//список пользователей из ListUsers
    public function getListUserInvoice()
    {
        return $this->db->row('SELECT * FROM listUsers');
    }
//определенный список из ListUsers по ID пользователя
    public function getOneMngrListUser($userID,$str)
    {
        $params = [
            'user_id' => $userID
        ];
        return $this->db->column('SELECT '.$str.' FROM listUsers WHERE user_id=:user_id',$params);
    }
//проверка на наличие ID пользователя в таблице listUsers
    public function testListUsers($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT * FROM listUsers WHERE user_id=:id',$params);
    }
//получение массива иерархии предприятия
    public function getListProgress()
    {
        return $this->db->row('SELECT id AS id, IF (parent = 0, "#", parent) AS parent,
           text as text, positions AS positions, postDP AS postDP FROM progression ORDER BY parent,positions');
    }
//получение массива иерархии одного отдела предприятия
    public function getListDepartProgress($userDepartment)
    {
        $params = ['userDepartment' => $userDepartment];
        return $this->db->row('SELECT text FROM progression WHERE parent=:userDepartment',$params);
    }
//редактирование отдела
    public function editDepartment($id,$name)
    {
        $params = [
            'id' => $id,
            'nameDep' => $name,
        ];
        $this->db->query('UPDATE departments SET nameDepartment=:nameDep WHERE id=:id', $params);
    }
//редактирование руководителя отдела
    public function editBossDepartment()
    {
        $params = [
            'id' => $_POST['depID'],
            'bossID' => $_POST['bossID']
        ];
        $this->db->query('UPDATE departments SET bossID=:bossID WHERE id=:id', $params);
    }
//редактирование организации
    public function editOrganization($id,$nameOrganization,$innOrganization,$kppOrganization)
    {
        $params = [
            'id' => $id,
            'nameOrganization' => $nameOrganization,
            'innOrganization' => $innOrganization,
            'kppOrganization' => $kppOrganization,
        ];
        $this->db->query('UPDATE organization SET nameOrganization=:nameOrganization,innOrganization=:innOrganization,kppOrganization=:kppOrganization WHERE id=:id', $params);
    }
//имя организации по ID
    public function getOrganizationForID($idOrganization)
    {
        $params = ['id' => $idOrganization];
        return $this->db->column('SELECT nameOrganization FROM organization WHERE id=:id', $params);
    }
//ИНН организации по ID
    public function getOrganizationInnForID($idOrganization)
    {
        $params = ['id' => $idOrganization];
        return $this->db->column('SELECT innOrganization FROM organization WHERE id=:id', $params);
    }
//редактирование списка пользователей INVOICE
    public function updateListUsers($userID,$newValue,$tableCol)
    {
        $params = [
            'userID' => $userID,
            'newValue' => $newValue,
        ];
        return $this->db->query('UPDATE listUsers SET '.$tableCol.'=:newValue WHERE user_id=:userID', $params);
    }
//добавление списка пользователей INVOICE
    public function insertListUsers($userID,$newValue,$tableCol)
    {
        $params = [
            'userID' => $userID,
            'newValue' => $newValue,
        ];
        return $this->db->query('INSERT INTO listUsers (user_id,'.$tableCol.') VALUES (:userID,:newValue)', $params);
    }
//редактирование получателей
    public function editToMail($id,$name,$rowName)
    {
        $params = [
            'id' => $id,
            'id_users' => $name
        ];
        $this->db->query('UPDATE users SET '.$rowName.'=:id_users WHERE id=:id', $params);
    }
//редактирование должности
    public function editPosts($id,$name)
    {
        $params = [
            'id' => $id,
            'namePost' => $name,
        ];
        $this->db->query('UPDATE departmentPost SET postDepartment=:namePost WHERE id=:id', $params);
    }
//редактирование отдела должности
    public function editPostsDepartment($id,$name)
    {
        $params = [
            'id' => $id,
            'nameDepartment' => $name,
        ];
        $this->db->query('UPDATE departmentPost SET nameDepartment=:nameDepartment WHERE id=:id', $params);
    }
//удаление отдела
    public function deleteDepartment($deleteID)
    {
        $params = ['deleteID' => $deleteID];
        $this->db->query('DELETE FROM departments WHERE id=:deleteID', $params);
        $this->db->query('DELETE FROM progression WHERE text=:deleteID AND postDP="department"', $params);
    }
//удаление темы УВД
    public function deleteThemeDoc()
    {
        $params = ['id' => $_POST['deleteThemeID']];
        $this->db->query('DELETE FROM docAddTheme WHERE id=:id', $params);
    }
//удаление организации
    public function deleteOrganization($deleteID)
    {
        $params = ['deleteID' => $deleteID];
        $this->db->query('DELETE FROM organization WHERE id=:deleteID', $params);
    }
//удаление должности
    public function deletePosts($deleteID)
    {
        $params = ['deleteID' => $deleteID];
        $this->db->query('DELETE FROM departmentPost WHERE id=:deleteID', $params);
        $this->db->query('DELETE FROM progression WHERE text=:deleteID AND postDP="posts"', $params);
    }
//добавление отдела
    public function addDepartment($newDepartment)
    {
        $params = [
            'newDepartment' => $newDepartment,
            'bossID' => 0
        ];
        $this->db->query('INSERT INTO departments (nameDepartment,bossID) VALUES (:newDepartment,:bossID)', $params);
        $idLast = $this->db->lastInsertId();
        $this->db->query('INSERT INTO progression (parent,text,positions,postDP) VALUES ("0",'.$idLast.',"0","department")', $params);
    }
//добавление организации
    public function addOrganization($newOrganization,$innOrganization,$kppOrganization)
    {
        $params = [
            'newOrganization' => $newOrganization,
            'innOrganization' => $innOrganization,
            'kppOrganization' => $kppOrganization
        ];
        $this->db->query('INSERT INTO organization (nameOrganization,innOrganization,kppOrganization)
          VALUES (:newOrganization,:innOrganization,:kppOrganization)', $params);
    }
//добавление должности
    public function addPosts($postDepartment,$newPosts)
    {
        $params = [
            'postDepartment' => $postDepartment,
            'newPosts' => $newPosts
        ];
        $this->db->query('INSERT INTO departmentPost (nameDepartment,postDepartment) VALUES (:postDepartment,:newPosts)', $params);
        $idLast = $this->db->lastInsertId();
        $this->db->query('INSERT INTO progression (parent,text,positions,postDP) VALUES ("0",'.$idLast.',"0","posts")', $params);
    }
//добавление уведомления о подписании счета
    public function noticeNextInvoice($invoiceId,$mngrtable)
    {
        if($mngrtable=='invoice'){
            $userTo = $this->getUserToMail($_SESSION['mngr']['id']);
            $whatIs = 'update';
        }else{
            $userTo = $this->getUserToMailPay($_SESSION['mngr']['id']);
            $whatIs = 'updatePay';
        }
        if($this->testNoticeSettings($userTo,'noticeDashSignInvoice')){
            $params = [
                'whatIs' => $whatIs,
                'userTo' => $userTo,
                'userFrom' => $_SESSION['mngr']['id'],
                'invoiceId' => $invoiceId,
                'tableUser' => $mngrtable,
                'initiatorName' => $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName']
            ];
            $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
        }
        if($this->testNoticeSettings($userTo,'noticeMailSignInvoice')){
            $this->sendMailNext($userTo, $invoiceId, $mngrtable,'signature','');
        }
    }
//добавление уведомления при создании служебки
    public function noticeAddPay($invoiceId)
    {
        if($this->testNoticeSettings($this->getUserToMailPay($_SESSION['mngr']['id']),'noticeDashSignInvoice')){
            $params = [
                'whatIs' => 'newpay',
                'userTo' => $this->getUserToMailPay($_SESSION['mngr']['id']),
                'userFrom' => $_SESSION['mngr']['id'],
                'invoiceId' => $invoiceId,
                'tableUser' => 'forPay',
                'initiatorName' => $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName']
            ];
            $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
        }
        if($this->testNoticeSettings($this->getUserToMailPay($_SESSION['mngr']['id']),'noticeMailSignInvoice')){
            $this->sendMailNext($this->getUserToMailPay($_SESSION['mngr']['id']), $invoiceId, 'forPay','newpay','');
        }
    }
//добавление уведомления при входящем документе УВД
    public function noticeAddDoc($whatIs,$userTo,$idAddDoc)
    {
        $params = [
            'whatIs' => $whatIs,
            'userTo' => $userTo,
            'userFrom' => $_SESSION['mngr']['id'],
            'invoiceId' => $idAddDoc,
            'tableUser' => 'forDoc',
            'initiatorName' => $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName']
        ];
        $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                            VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
    }
//добавление уведомления об оплате
    public function noticeInvoiceEnd($mngrID,$invoiceId,$mngrtable)
    {
        if($mngrtable=='invoice'){
            $userTo = $this->getUserToMail($_SESSION['mngr']['id']);
        }else{
            $userTo = $this->getUserToMailPay($_SESSION['mngr']['id']);
        }
        if($this->testNoticeSettings($mngrID,'noticeDashSuccess')){
            $params = [
                'whatIs' => 'success',
                'userTo' => $mngrID,
                'userFrom' => $_SESSION['mngr']['id'],
                'invoiceId' => $invoiceId,
                'tableUser' => $mngrtable,
                'initiatorName' => $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName']
            ];
            $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
        }
        if($this->testNoticeSettings($userTo,'noticeMailSuccess')){
            $this->sendMailNext($mngrID, $invoiceId, $mngrtable,'success','');
        }
    }
//получить значение конкретной опции
    public function getOneOption($str)
    {
        $params = ['optionName' => $str];
        return $this->db->column('SELECT optionValue FROM optionSettings WHERE optionName=:optionName',$params);
    }
//отправка уведомлений на почту
    public function sendMailNext($userTo, $invoiceId, $mngrtable, $what, $paths)
    {

        $dataUser = $this->getOneUsers($userTo);
        $to = $dataUser[0]['userMail']; //получаем email получателя
        $userName = $dataUser[0]['userFirstName'].' '.$dataUser[0]['userLastName']; //имя отчество отправителя
        $addressSite = $this->getOneOption('addressSite'); //адрес сайта
        $contragent = $contragentText = $userInitiator = $numberInvoiceText = $summInvoiceForPayment = $organization = $money = '';

        if($mngrtable=='invoice'){
            $params = ['invoiceId'=>$invoiceId];
            $dataInvoice = $this->db->row('SELECT * FROM invoice WHERE id = :invoiceId',$params);
            $dataInvoice = $dataInvoice[0];
            $urlInvoice = 'staffer/' . $invoiceId;
            $numberInvoice = '<p>Номер счета: '.$dataInvoice['numberInvoice'].'</p>';
            $numberInvoiceText = $dataInvoice['numberInvoice'];
            $project = '<p>Проект: '.$this->getNameProjectForID($dataInvoice['numberContract']).'</p>';
            $organization = '<p>Организация: '.$this->getOrganizationForID($dataInvoice['organizationInvoiceForPayment']).'</p>';
            $btnTransit = 'Перейти в счет';
            $urlScanInvoice = '/file/invoice/'.$dataInvoice['pathScanInvoice'];
            if(!empty($paths)){
                $urlScanInvoice = $paths;
            }
            $prewiev = '<a href="'.$addressSite.$urlScanInvoice.'" target="_blank" rel="noopener noreferrer" style="display:inline-block;border: 1px solid #333;border-radius: 5px;padding:10px;text-decoration: none;margin-right: 20px;background-color: #0b94ea;color: black;">Смотреть счет</a>';
            $contragent = '<p>Поставщик: '.$this->getNameContragentForID($dataInvoice['contragent']).'</p>';
            $contragentText = $this->getNameContragentForID($dataInvoice['contragent']);
            $summInvoiceForPayment = '<p>Сумма счета: '.$dataInvoice['summInvoiceForPayment'].'</p>';
            $money = $dataInvoice['summInvoiceForPayment'];
            //$organization = $dataInvoice['organizationInvoiceForPayment'];

            $dataUserInvoice = $this->getOneUsers($dataInvoice['mngrId']);
            if(!empty($dataUserInvoice[0]['userFirstName'])){
                $firstNameIn = mb_substr($dataUserInvoice[0]['userFirstName'],0,1,"UTF-8").'.';
            }else{$firstNameIn = '';}
            if(!empty($dataUserInvoice[0]['userLastName'])){
                $lastNameIn = mb_substr($dataUserInvoice[0]['userLastName'],0,1,"UTF-8").'.';
            }else{$lastNameIn = '';}
            $userInitiator = $dataUserInvoice[0]['userSurname'].' '.$firstNameIn.' '.$lastNameIn; //имя отчество инициатора

        }elseif($mngrtable=='addDoc'){
            $params = ['invoiceId'=>$invoiceId];
            $dataInvoice = $this->db->row('SELECT * FROM docAdd WHERE id = :invoiceId',$params);
            $dataInvoice = $dataInvoice[0];
            $urlInvoice = 'onedoc/' .$invoiceId;
            $numberInvoice = '';
            $project = '';
            $dataInvoice['noticeInvoiceForPayment']=$dataInvoice['noticeAddDoc'];
            $urlScanInvoice = '/file/addDoc/'.$dataInvoice['fileAddDoc'];
            if(!empty($paths)){
                $urlScanInvoice = $paths;
            }
            $prewiev = '<a href="'.$addressSite.$urlScanInvoice.'" target="_blank" rel="noopener noreferrer" style="display:inline-block;border: 1px solid #333;border-radius: 5px;padding:10px;text-decoration: none;margin-right: 20px;background-color: #0b94ea;color: black;">СМОТРЕТЬ</a>';

            $btnTransit = 'Перейти к документу';
        }else{
            $params = ['invoiceId'=>$invoiceId];
            $dataInvoice = $this->db->row('SELECT * FROM payInvoice WHERE id = :invoiceId',$params);
            $dataInvoice = $dataInvoice[0];
            $urlInvoice = 'onepay/' .$invoiceId;
            $numberInvoice = '';
            $project = '';
            $summInvoiceForPayment = '<p>Сумма счета: '.$dataInvoice['money'].'</p>';
            $money = $dataInvoice['money'];
            $dataInvoice['noticeInvoiceForPayment']=$dataInvoice['notice_pay'];
            $dataInvoice['pathScanInvoice']='no';
            $dataInvoice['urgentPayment']='no';
            $dataInvoice['status_pay'];
            $prewiev = '';
            $btnTransit = 'ПЕРЕЙТИ В СЛУЖЕБКУ';

            $dataUserInvoice = $this->getOneUsers($dataInvoice['user_id']);
            if(!empty($dataUserInvoice[0]['userFirstName'])){
                $firstNameIn = mb_substr($dataUserInvoice[0]['userFirstName'],0,1,"UTF-8").'.';
            }else{$firstNameIn = '';}
            if(!empty($dataUserInvoice[0]['userLastName'])){
                $lastNameIn = mb_substr($dataUserInvoice[0]['userLastName'],0,1,"UTF-8").'.';
            }else{$lastNameIn = '';}
            $userInitiator = $dataUserInvoice[0]['userSurname'].' '.$firstNameIn.' '.$lastNameIn; //имя отчество инициатора

        }

        $imageLogo = $this->getOneOption('imageLogo'); //получаем логотип

        $noticeInvoiceForPayment = $dataInvoice['noticeInvoiceForPayment'];

        if(!empty($_SESSION['mngr']['userFirstName'])){
            $firstName = $_SESSION['mngr']['userFirstName']; //имя получателя
            $firstNameSub = mb_substr($_SESSION['mngr']['userFirstName'],0,1,"UTF-8").'.';
        }else{
            $firstName = $firstNameSub = '';
        }
        if(!empty($_SESSION['mngr']['userLastName'])){
            $lastName = $_SESSION['mngr']['userLastName']; //отчество получателя
            $lastNameSub = mb_substr($_SESSION['mngr']['userLastName'],0,1,"UTF-8").'.';
        }else{
            $lastName = $lastNameSub = '';
        }

        $lastSignInvoice = $this->getOneOption('lastSignInvoice'); //последний согласующий счетов
        $lastSignPay = $this->getOneOption('lastSignPay'); //последний согласующий служебок

        switch ($what){
            case 'newinvoice':
                $theme = 'Получен новый счет от '.$_SESSION['mngr']['userSurname'].' '.$firstNameSub.' '.$lastNameSub;
                $textAlert = '<span style="color: green;">ПОЛУЧЕН НОВЫЙ СЧЕТ, ТРЕБУЮЩИЙ ВАШЕГО СОГЛАСОВАНИЯ</span>';
                if($dataInvoice['urgentPayment']=='on'){
                    $theme = 'СРОЧНО! '.$theme;
                    $textAlert = '<span style="color: red;">ПОЛУЧЕН НОВЫЙ СЧЕТ, ТРЕБУЮЩИЙ ВАШЕГО СРОЧНОГО СОГЛАСОВАНИЯ</span>';
                }
                break;
            case 'signature':
                if ($mngrtable=='invoice') {
                    $theme = 'Получен счет для согласования от '.$userInitiator;
                    $textAlert = '<span style="color: green;">ПОЛУЧЕН СЧЕТ, ТРЕБУЮЩИЙ ВАШЕГО СОГЛАСОВАНИЯ</span>';
                    if ($dataInvoice['urgentPayment'] == 'on') {
                        $theme = 'СРОЧНО! ' . $theme;
                        $textAlert = '<span style="color: red;">ПОЛУЧЕН СЧЕТ, ТРЕБУЮЩИЙ ВАШЕГО СРОЧНОГО СОГЛАСОВАНИЯ</span>';
                    }
                    if ($lastSignInvoice == $userTo) {
                        $theme = 'Требуется оплата счета (' . $numberInvoiceText . ' от  ' . $contragentText . ')';
                        $textAlert = '<span style="color: green;">ПОЛУЧЕН СЧЕТ, ТРЕБУЮЩИЙ ОПЛАТЫ</span>';
                        if ($dataInvoice['urgentPayment'] == 'on') {
                            $theme = 'Требуется срочная оплата счета (' . $numberInvoiceText . ' от  ' . $contragentText . ')';
                            $textAlert = '<span style="color: red;">ПОЛУЧЕН СЧЕТ, ТРЕБУЮЩИЙ СРОЧНОЙ ОПЛАТЫ</span>';
                        }
                    }
                }else{
                    $theme = 'Заявка на выдачу наличных средств от '.$userInitiator;
                    $textAlert = '<span style="color: green;">ПОЛУЧЕНА СЛУЖЕБНАЯ ЗАПИСКА НА ВЫДАЧУ НАЛИЧНЫХ СРЕДСТВ, ТРЕБУЮЩАЯ ВАШЕГО СОГЛАСОВАНИЯ</span>';

                    if ($lastSignPay == $userTo) {
                        $theme = 'Требуется выдача наличных средств';
                        $textAlert = '<span style="color: green;">ПОЛУЧЕНА СЛУЖЕБНАЯ ЗАПИСКА НА ВЫДАЧУ НАЛИЧНЫХ СРЕДСТВ</span>';
                    }
                }
                break;
            case 'comment':
                $theme = 'Новый комментарий';
                $textAlert = 'Получен новый комментарий';
                break;
            case 'failure':
                if($mngrtable=='invoice'){
                    $theme = 'Отказ в подписании счета ('.$numberInvoiceText.' от  '.$contragentText.')';
                    $textAlert = '<span style="color: red;">ВАМ ОТКАЗАЛИ В ПОДПИСАНИИ: '.$_SESSION['mngr']['userSurname'].' '.$firstNameSub.' '.$lastNameSub.'</span>';
                }
                if($mngrtable=='forPay'){
                    $theme = 'Отказ в подписании служебной записки';
                    $textAlert = '<span style="color: red;">ВАМ ОТКАЗАЛИ В ПОДПИСАНИИ СЛУЖЕБНОЙ ЗАПИСКИ НА ВЫДАЧУ НАЛИЧНЫХ СРЕДСТВ: '.$_SESSION['mngr']['userSurname'].' '.$firstNameSub.' '.$lastNameSub.'</span>';
                }
                break;
            case 'newpay':
                $theme = 'Новая заявка на выдачу наличных средств от '.$_SESSION['mngr']['userSurname'].' '.$firstNameSub.' '.$lastNameSub;
                $textAlert = '<span style="color: green;">ПОЛУЧЕНА НОВАЯ СЛУЖЕБНАЯ ЗАПИСКА НА ВЫДАЧУ НАЛИЧНЫХ СРЕДСТВ ТРЕБУЮЩАЯ ВАШЕГО СОГЛАСОВАНИЯ</span>';
                break;
            case 'success':
                $theme = 'Счет ('.$numberInvoiceText.' от  '.$contragentText.') оплачен';
                $textAlert = '<span style="color: green;">ДОКУМЕНТ СОГЛАСОВАН И ОПЛАЧЕН</span>';
                /*if($dataInvoice['urgentPayment']=='on'){
                    $theme = 'Прошла оплата!';
                    $textAlert = '<span 
                    style="color: red;font-size: 18px;
                    "><strong>Срочный счет согласован и оплачен</strong></span>';
                }*/
                break;
            case 'successPay':
                $theme = $money.' выдано';
                $textAlert = '<span style="color: green;">ВАМ ВЫДАНО '.$money.', В СЛУЧАЕ ОШИБКИ, ОБРАТИТЕСЬ К СВОЕМУ НЕПОСРЕДСТВЕННОМУ РУКОВОДИТЕЛЮ</span>';
                break;
            case 'newAddDoc':
                $theme = 'Входящий документ';
                $textAlert = 'Поступил документ требующий Вашего внимания';
                break;
            case 'signDoc':
                $theme = 'Входящий документ';
                $textAlert = 'Поступил документ требующий Вашего согласования';
                break;
            case 'reloadDoc':
                $theme = 'Документ на доработку';
                $textAlert = 'Документ вернулся на доработку';
                break;
            case 'successDoc':
                $theme = 'Документ согласован';
                $textAlert = 'Документ проверен и согласован';
                break;
            default:
                $theme = 'Согласование счета';
                $textAlert = 'Получен счет требующий Вашего согласования';
                break;

                /*<div style="padding-top:16px;padding-bottom:24px;">
                        <table style="width:100%;" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                        <div style="padding-top:2px;text-align:left;">
                                            <a href="$addressSite" target="_blank" rel="noopener noreferrer">
                                                <img alt="motor-logo" style="border:0;padding:0;margin:0;display:block;" src="$addressSite/assets/images/logos/$imageLogo" width="100">
                                            </a>
                                        </div>
                                        <div style="padding-top:9px;color:#9099a3;line-height:17px;font-size:15px;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;">
                Система контроля проектов
            </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>*/
        }
        $message = '<span>Это сообщение от <b>'.$_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'].'</b></span>';
        $message .= <<<HERE
<div style="background-color:#fff;">
    <table style="border-collapse:collapse;" width="100%" cellspacing="0" cellpadding="12" align="center">
        <tbody>
            <tr>
                <td>
                
                    <div style="overflow:hidden;border-top:1px solid #f0f0f0;text-align:left;">
                        <div>
                            <p>Здравствуйте, $userName!</p>
                            <p>$textAlert<br>
                            $contragent
                            $numberInvoice
                            $summInvoiceForPayment
                            $organization
                            $project
                            <p>Примечание: $noticeInvoiceForPayment</p>
                                $prewiev
                                <a href="$addressSite/mngr/$urlInvoice" target="_blank" rel="noopener noreferrer"
                                style="display:inline-block;border: 1px solid #333;border-radius: 5px;padding:10px;text-decoration: none;margin-right: 20px;background-color:#3c9916;color: black;">$btnTransit</a>
                            <p>Если вы получили это письмо по ошибке, просто игнорируйте его.</p>

                        </div>
                    </div>
                    <div style="padding-top:15px;padding-bottom:15px;border-top:1px solid #f0f0f0;margin-top:20px;">
                        <div style="padding-top:3px;color:#b3b3b1;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;font-size:13px;line-height:20px;">
                            © <a href="$addressSite" style="text-decoration:none;color:#b3b3b1;" target="_blank" rel="noopener noreferrer">Система контроля проектов - ipm</a><br />
                            <span> email: info@s-ama.ru</span><br/>
                            <span><a href="https://www.instagram.com/ipm_daily_life/">instagram</a></span>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
HERE;
        $from = array(
            "Система контроля проектов",//$_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'], // Имя отправителя
            $this->getOneOption('postAddress')//$_SESSION['mngr']['userMail']// почта отправителя
        );
        $postSettings = $this->getOneOption('postSettings');
        if($postSettings == 'true'){
            $postAddress = $this->getOneOption('postAddress');
            $postPass = $this->getOneOption('postPass');
            $postSMTPHost = $this->getOneOption('postSMTPHost');
            $postSMTPPort = $this->getOneOption('postSMTPPort');
            $mailInvoice = new SendMail($postAddress, $postPass, $postSMTPHost, $postSMTPPort, "UTF-8");
            $mailInvoice->send($to, $theme, $message, $from);
        }
    }
//обновление аватара
    public function updateAvatar($filenames)
    {
        $params = [
            'id' => $_SESSION['mngr']['id'],
            'userAvatar' => $filenames
        ];
        $this->db->query('UPDATE users SET userAvatar = :userAvatar WHERE id = :id', $params);
    }
//берем путь к аватарке из базы
    public function getPathAvatar()
    {
        $params = ['id' => $_SESSION['mngr']['id']];
        return $this->db->column('SELECT userAvatar FROM users WHERE id = :id', $params);
    }
//смена пароля пользователя
    function changeUserPwd($currentPwd,$newPwd)
    {
        $params = ['id' => $_SESSION['mngr']['id']];
        $oldPwd = $this->db->column('SELECT userPwd FROM users WHERE id = :id' ,$params);
        if($currentPwd == $oldPwd){
            $params = [
                'userPwd' => $newPwd,
                'id' => $_SESSION['mngr']['id']
            ];
            $this->db->query('UPDATE users SET userPwd = :userPwd WHERE id = :id', $params);
            return true;
        }else{
            return false;
        }
    }
//отправка платежки на почту
    public function sendNeedPay($paths)
    {
        $to = $_POST['mailInitiator'];
        $theme = 'платежка';
        $message = 'Сформирована платежка по вашему счету';
        $from = array(
            "Система контроля проектов",//$_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'], // Имя отправителя
            $this->getOneOption('postAddress')//$_SESSION['mngr']['userMail']// почта отправителя
        );
        $postSettings = $this->getOneOption('postSettings');
        if($postSettings == 'true'){
            $postAddress = $this->getOneOption('postAddress');
            $postPass = $this->getOneOption('postPass');
            $postSMTPHost = $this->getOneOption('postSMTPHost');
            $postSMTPPort = $this->getOneOption('postSMTPPort');
            $mailInvoice = new SendMail($postAddress, $postPass, $postSMTPHost, $postSMTPPort, "UTF-8");
            $mailInvoice->addFile($paths);
            $mailInvoice->send($to, $theme, $message, $from);
            return true;
        }else{
            return false;
        }
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
//редактирование опции
    public function editOptions($option,$params)
    {
        $params = [
            'optionName' => $option,
            'optionValue' => $params,
        ];
        $this->db->query('UPDATE optionSettings SET optionValue=:optionValue WHERE optionName=:optionName', $params);
    }
//редактирование уведомлений в админке
    public function editNotice($userID,$notice,$params)
    {
        $params = [
            'userID' => $userID,
            'params' => $params,
        ];
        $this->db->query('UPDATE noticeSettings SET '.$notice.'=:params WHERE user_id=:userID', $params);
    }
//удаление уведомления
    public function deleteNoticeCycle($invoiceId,$mngrtable)
    {
        $params = [
            'userTo' => $_SESSION['mngr']['id'],
            'invoiceId' => $invoiceId,
            'mngrtable' => $mngrtable
        ];
        $this->db->query('DELETE FROM notice WHERE user_id_to=:userTo AND invoice_id = :invoiceId AND tableUser = :mngrtable', $params);
    }
//обновление счета
    public function updateStatusInvoice($invoiceId, $mngrtable, $mngrID, $dateToday, $btn, $userName, $userToMile)
    {
        switch ($mngrtable){
            case 'invoice':
                switch ($btn){
                    case 'success':
                        $params = ['invoiceId' => $invoiceId];
                        $dateAndAutor = $this->db->column('SELECT date_signature FROM invoice WHERE id = :invoiceId', $params);
                        if(empty($dateAndAutor)){
                            $dateAndAutor = [];
                        }else{
                            $dateAndAutor = json_decode($dateAndAutor);
                        }
                        $dateAndAutor[] = array('date'=>$dateToday,'autor'=>$userName);
                        $dateAndAutor = json_encode($dateAndAutor);
                        $params = [
                            'invoiceId' => $invoiceId,
                            'signature' => $userToMile,
                            'statusInvoice' => '2',
                            'dateAndAutor' => $dateAndAutor
                        ];

                        $this->db->query('UPDATE invoice SET signature=:signature,statusInvoice=:statusInvoice,date_signature=:dateAndAutor WHERE id = :invoiceId', $params);

                        break;
                    case 'failure':
                        $params = [
                            'invoiceId' => $invoiceId,
                            'signature' => '0',
                            'statusInvoice' => '5',
                            'dateToday' => $dateToday
                        ];
                        $this->db->query('UPDATE invoice SET signature=:signature,statusInvoice=:statusInvoice,date_false=:dateToday WHERE id = :invoiceId', $params);
                        if($this->testNoticeSettings($mngrID,'noticeDashFailure')) {
                            $params = [
                                'whatIs' => 'failure',
                                'userTo' => $mngrID,
                                'userFrom' => $_SESSION['mngr']['id'],
                                'invoiceId' => $invoiceId,
                                'tableUser' => $mngrtable,
                                'initiatorName' => $userName
                            ];
                            $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                        VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
                        }
                        if($this->testNoticeSettings($mngrID,'noticeMailFailure')){
                            $this->sendMailNext($mngrID, $invoiceId, $mngrtable,'failure','');
                        }
                        break;
                    case 'invoiceEnd':
                        $params = [
                            'invoiceId' => $invoiceId,
                            'signature' => '0',
                            'statusInvoice' => '7',
                            'dateToday' => $dateToday
                        ];
                        $this->db->query('UPDATE invoice SET signature=:signature,statusInvoice=:statusInvoice,date_success=:dateToday WHERE id = :invoiceId', $params);
                        if($this->testNoticeSettings($mngrID,'noticeDashSuccess')) {
                            $params = [
                                'whatIs' => 'success',
                                'userTo' => $mngrID,
                                'userFrom' => $_SESSION['mngr']['id'],
                                'invoiceId' => $invoiceId,
                                'tableUser' => $mngrtable,
                                'initiatorName' => $userName
                            ];
                            $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                        VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
                        }
                        if($this->testNoticeSettings($mngrID,'noticeMailSuccess')){
                            $this->sendMailNext($mngrID, $invoiceId, $mngrtable,'success','');
                        }
                        break;
                }
                break;
            case 'forPay':
                switch ($btn){
                    case 'success':
                        $params = ['invoiceId' => $invoiceId];
                        $dateAndAutor = $this->db->column('SELECT date_signature FROM payInvoice WHERE id = :invoiceId', $params);
                        if(empty($dateAndAutor)){
                            $dateAndAutor = [];
                        }else{
                            $dateAndAutor = json_decode($dateAndAutor);
                        }
                        $dateAndAutor[] = array('date'=>$dateToday,'autor'=>$userName);
                        $dateAndAutor = json_encode($dateAndAutor);

                        $params = [
                            'invoiceId' => $invoiceId,
                            'signature' => $this->getUserToMailPay($_SESSION['mngr']['id']),
                            'status_pay' => '2',
                            'dateAndAutor' => $dateAndAutor
                        ];
                        $this->db->query('UPDATE payInvoice SET signature=:signature,status_pay=:status_pay,date_signature=:dateAndAutor WHERE id = :invoiceId', $params);
                        break;
                    case 'failure':
                        $params = [
                            'invoiceId' => $invoiceId,
                            'signature' => '0',
                            'status_pay' => '5',
                            'dateToday' => $dateToday
                        ];
                        $this->db->query('UPDATE payInvoice SET signature=:signature,status_pay=:status_pay,date_false=:dateToday WHERE id = :invoiceId', $params);
                        if($this->testNoticeSettings($mngrID,'noticeDashFailure')) {
                            $params = [
                                'whatIs' => 'failurepay',
                                'userTo' => $mngrID,
                                'userFrom' => $_SESSION['mngr']['id'],
                                'invoiceId' => $invoiceId,
                                'tableUser' => $mngrtable,
                                'initiatorName' => $_SESSION['mngr']['userSurname'] . ' ' . $_SESSION['mngr']['userFirstName']
                            ];
                            $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                        VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
                        }
                        if($this->testNoticeSettings($mngrID,'noticeMailFailure')){
                            $this->sendMailNext($mngrID, $invoiceId, $mngrtable,'failure','');
                        }
                        break;
                    case 'invoiceEnd':
                        $params = [
                            'invoiceId' => $invoiceId,
                            'signature' => '0',
                            'status_pay' => '7',
                            'dateToday' => $dateToday
                        ];
                        $this->db->query('UPDATE payInvoice SET signature=:signature,status_pay=:status_pay,date_success=:dateToday WHERE id = :invoiceId', $params);
                        if($this->testNoticeSettings($mngrID,'noticeDashSuccess')) {
                            $params = [
                                'whatIs' => 'success',
                                'userTo' => $mngrID,
                                'userFrom' => $_SESSION['mngr']['id'],
                                'invoiceId' => $invoiceId,
                                'tableUser' => $mngrtable,
                                'initiatorName' => $_SESSION['mngr']['userSurname'] . ' ' . $_SESSION['mngr']['userFirstName']
                            ];
                            $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                        VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
                        }
                        if($this->testNoticeSettings($mngrID,'noticeMailSuccess')){
                            $this->sendMailNext($mngrID, $invoiceId, $mngrtable,'successPay','');
                        }
                        break;
                }
            break;
        }
    }
//обновление суммы счета
    public function updateSummInvoice($invoiceId,$inputValueMoney)
    {
        $money = str_replace(',','.',$inputValueMoney);
        $params = [
            'invoiceId' => $invoiceId,
            'money' => $money
        ];
        $this->db->query('UPDATE invoice SET summInvoiceForPayment=:money WHERE id = :invoiceId', $params);
    }
//добавление комментария об отказе
    public function failureComment($invoiceId,$mngrtable,$inputValueFailure)
    {
        $params = [
            'idInvoice' => $invoiceId,
            'type_doc' => $mngrtable,
            'textComment' => $inputValueFailure,
            'autorComment' => $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName']
        ];
        $this->db->query('INSERT INTO comments (idInvoice, type_doc, textComment, autorComment)
                    VALUES (:idInvoice, :type_doc,:textComment, :autorComment)', $params);
    }
//добавление нового контракта
    public function insertContract($numberContract)
    {
        $params = ['numberContract' => $numberContract];
        $this->db->query('INSERT INTO contracts (numberContract) VALUES (:numberContract)', $params);
    }
//добавление служебки
    public function insertPay($underReportPay,$idProjectHiddenPay,$money,$noticeForPay,$paths,$datetimeStamp)
    {
        $params = [
            'signature' => $this->getUserToMailPay($_SESSION['mngr']['id']),
            'under_report' => $underReportPay,
            'contract' => $idProjectHiddenPay,
            'user_id' => $_SESSION['mngr']['id'],
            'initiatorSurname' => $_SESSION['mngr']['userSurname'],
            'initiatorFirstName' => $_SESSION['mngr']['userFirstName'],
            'userDepartment' => $_SESSION['mngr']['userDepartment'],
            'issuedMoney' => $money,
            'money' => $money,
            'money_exp' => '0',
            'notice_pay' => $noticeForPay,
            'paths_pay' => $paths,
            'date_create' => $datetimeStamp,
            'date_edit' => $datetimeStamp
        ];
        $this->db->query('INSERT INTO payInvoice (signature,status_pay, user_id, initiatorSurname, initiatorFirstName, userDepartment, contract, under_report, check_pay, issuedMoney, money, money_exp, notice_pay, paths_pay, date_create, date_edit)
                    VALUES (:signature, "1", :user_id, :initiatorSurname, :initiatorFirstName, :userDepartment, :contract, :under_report, "false", :issuedMoney, :money, :money_exp, :notice_pay, :paths_pay, :date_create, :date_edit)', $params);

        $idInvoice = $this->db->lastInsertId();
        $params = [
            'idInvoice' => $idInvoice,
            'typeAdd' => 'forPay',
            'mngrId' => $_SESSION['mngr']['id']
        ];
        $this->db->query('INSERT INTO comm_partner (idInvoice, typeAdd,idPartner) 
                          VALUES (:idInvoice, :typeAdd, :mngrId)', $params);
        $this->noticeAddPay($idInvoice);
    }
//редактирование служебки
    public function editPay($payID,$dateEdit,$underReportPay,$idProjectHiddenPay,$summForPayment,$noticeForPay)
    {
        $testStatus = $this->getStatus($payID,'invoicePay');
        if($testStatus=='1'){
            $params = [
                'id' => $payID,
                'under_report' => $underReportPay,
                'contract' => $idProjectHiddenPay,
                'issuedMoney' => $summForPayment,
                'money' => $summForPayment,
                'money_exp' => '0',
                'notice_pay' => $noticeForPay
            ];
            $testRow = $this->db->rowCount('UPDATE payInvoice SET under_report=:under_report, contract=:contract, issuedMoney=:issuedMoney, money=:money, money_exp=:money_exp, notice_pay=:notice_pay WHERE id=:id', $params);

            if($testRow>0){
                $params = [
                    'id' => $payID,
                    'date_edit' => $dateEdit
                ];
                $this->db->query('UPDATE payInvoice SET date_edit=:date_edit WHERE id=:id', $params);
            }
            return 'true';
        }else{
            return 'false';
        }

    }
//получение статуса по ID и типу invoice или invoicePay
    public function getStatus ($id,$type)
    {
        if($type == 'invoice'){
            $params = ['id' => $id];
            return $this->db->column('SELECT statusInvoice FROM invoice WHERE id = :id', $params);
        }elseif($type =='invoicePay'){
            $params = ['id' => $id];
            return $this->db->column('SELECT status_pay FROM payInvoice WHERE id = :id', $params);
        }else{
            return 'false';
        }
    }
//получаем кому отправить служебку по ID пользователя
    public function getUserToMailPay($userID)
    {
        $params = ['userID' => $userID];
        return $this->db->column('SELECT userToMailPay FROM users WHERE id = :userID', $params);
    }
//получаем кому отправить счет по ID пользователя
    public function getUserToMail($userID)
    {
        $params = ['userID' => $userID];
        return $this->db->column('SELECT userToMail FROM users WHERE id = :userID', $params);
    }
//добавление id пользователя к комментарию
    public function insertPartner($idInvoice,$typeAdd)
    {
        $params = [
            'idInvoice' => $idInvoice,
            'typeAdd' => $typeAdd
        ];
        $idPartner = $this->db->column('SELECT idPartner FROM comm_partner WHERE idInvoice = :idInvoice AND typeAdd=:typeAdd', $params);
        $idPartner = explode(",",$idPartner);
        $notPartners = false;
        foreach ($idPartner as $item) {
            if ($item == $_SESSION['mngr']['id']) {
                $notPartners = true;
            }
        }
        if($notPartners==false){
            $params = [
                'idInvoice' => $idInvoice,
                'typeAdd' => $typeAdd,
                'mngrId' => $_SESSION['mngr']['id']
            ];
            $this->db->query('UPDATE comm_partner SET idPartner=CONCAT(idPartner,",":mngrId) WHERE idInvoice = :idInvoice AND typeAdd=:typeAdd', $params);
        }
    }
//добавление id пользователя к комментарию из staffer
    public function addPartner($idInvoice,$selectUser,$typeAdd)
    {
        $params = [
            'idInvoice' => $idInvoice,
            'typeAdd' => $typeAdd
        ];
        $idPartner = $this->db->column('SELECT idPartner FROM comm_partner WHERE idInvoice = :idInvoice AND typeAdd=:typeAdd', $params);
        $idPartner = explode(",",$idPartner);
        $notPartners = false;
        foreach ($idPartner as $item) {
            if ($item == $selectUser) {
                $notPartners = true;
            }
        }
        if($notPartners==false){
            $params = [
                'idInvoice' => $idInvoice,
                'typeAdd' => $typeAdd,
                'mngrId' => $selectUser
            ];
            $this->db->query('UPDATE comm_partner SET idPartner=CONCAT(idPartner,",":mngrId) WHERE idInvoice = :idInvoice AND typeAdd=:typeAdd', $params);
        }
    }
//получаем список уведомлений
    public function noticeUserDB($userID)
    {
        $params = ['userID' => $userID];
        return $this->db->row('SELECT * FROM notice WHERE user_id_to = :userID',$params);
    }
//удаление уведомления по ID
    public function deleteNoticeDB($noticeid)
    {
        $params = [
            'noticeid' => $noticeid
        ];
        $this->db->query('DELETE FROM notice WHERE id = :noticeid', $params);
    }
//получаем список комментариев
    public function firstLoadCommentDB($idInvoice,$type)
    {
        $params = [
            'idInvoice' => $idInvoice,
            'type_doc' => $type
        ];
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y %H:%i")) AS dateCreate FROM comments WHERE idInvoice = :idInvoice AND type_doc=:type_doc',$params);

        /*if($type=='invoice'){
            $params = ['idInvoice' => $idInvoice];
            return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y %H:%i")) AS dateCreate FROM comm_invoice WHERE idInvoice = :idInvoice',$params);
        }*/
        /*if($type=='forPay'){
            $params = ['idInvoice' => $idInvoice];
            return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y %H:%i")) AS dateCreate FROM comm_forPay WHERE idInvoice = :idInvoice',$params);
        }*/
    }
    function enterScript(){

            return true;

    }
//получаем последние комментарии
    public function loadCommentDB($idInvoice,$lastIdComment,$typeAdd)
    {
        $params = [
            'idInvoice' => $idInvoice,
            'type_doc' => $typeAdd,
            'lastIdComment' => $lastIdComment
        ];
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y %H:%i")) AS dateCreate FROM comments WHERE id>:lastIdComment AND idInvoice = :idInvoice AND type_doc=:type_doc',$params);

        /*if($typeAdd == 'invoice'){
            $params = [
                'idInvoice' => $idInvoice,
                'lastIdComment' => $lastIdComment
            ];
            return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y %H:%m")) AS dateCreate FROM comments WHERE id>:lastIdComment AND idInvoice = :idInvoice',$params);
        }*/
        /*if($typeAdd == 'forPay'){
            $params = [
                'idInvoice' => $idInvoice,
                'lastIdComment' => $lastIdComment
            ];
            return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y %H:%m")) AS dateCreate FROM comm_forPay WHERE id>:lastIdComment AND idInvoice = :idInvoice',$params);
        }*/
    }
//проверяем можно ли пользователю отправлять уведомления о комментариях
    public function testPartner($idInvoice,$typeAdd)
    {
        $params = [
            'idInvoice' => $idInvoice,
            'typeAdd' => $typeAdd
        ];
        return $this->db->row('SELECT * FROM comm_partner WHERE idInvoice=:idInvoice AND typeAdd=:typeAdd',$params);
    }
//проверяем есть ли проект
    public function testContract($numberProject)
    {
        $params = ['numberProject' => $numberProject];
        return $this->db->row('SELECT * FROM projects WHERE id=:numberProject',$params);
    }
//получаем наименование проекта по ID
    public function getNameProjectForID($numberProject)
    {
        $params = ['numberProject' => $numberProject];
        return $this->db->column('SELECT nameProject FROM projects WHERE id=:numberProject',$params);
    }
//получаем ID контрагента по ID проекта
    public function getContragentID($numberContract)
    {
        $params = ['id' => $numberContract];
        return $this->db->column('SELECT idContragent FROM projects WHERE id=:id',$params);
    }
//проверяем есть ли контрагент
    public function testContragent($newInnContragent)
    {
        $params = ['newInnContragent' => $newInnContragent];
        return $this->db->column('SELECT inn_contragent FROM contragents WHERE inn_contragent=:newInnContragent',$params);
    }
//получаем наименование контрагента по ID
    public function getNameContragentForID($idContragent)
    {
        $params = ['idContragent' => $idContragent];
        return $this->db->column('SELECT name_contragent FROM contragents WHERE id=:idContragent',$params);
    }
//получаем все данные контрагента по ID
    public function getContragentInfoID($getContragentID)
    {
        $params = ['id' => $getContragentID];
        return $this->db->row('SELECT * FROM contragents WHERE id=:id',$params);
    }
//добавление контрагента
    public function insertContragent($newInnContragent,$newNameContragent,$newKppContragent,$newNoticeContragent,$mineOrg,$idInitiator,$datetimeStamp)
    {
        $params = [
            'inn_contragent' => $newInnContragent,
            'name_contragent' => $newNameContragent,
            'kpp_contragent' => $newKppContragent,
            'notice_contragent' => $newNoticeContragent,
            'mineOrg' => $mineOrg,
            'idInitiator' => $idInitiator,
            'date_create' => $datetimeStamp,
            'date_edit' => $datetimeStamp
        ];
        $this->db->query('INSERT INTO contragents (inn_contragent,name_contragent, kpp_contragent, mineOrg, idInitiator, notice_contragent, date_create, date_edit)
                    VALUES (:inn_contragent, :name_contragent, :kpp_contragent, :mineOrg, :idInitiator, :notice_contragent, :date_create, :date_edit)', $params);
        return $this->db->lastInsertId();
    }
//добавление проекта
    public function insertProject($newNameProject,$newNoticeProject,$idContragent,$idInitProject,$expenseProject,$moneyProject,$selectedProject,$profitProject,$datetimeStamp)
    {
        $params = [
            'nameProject' => $newNameProject,
            'notice_project' => $newNoticeProject,
            'idContragent' => $idContragent,
            'idInitiator' => $idInitProject,
            'expenseProject' => $expenseProject,
            'moneyProject' => $moneyProject,
            'selectedProject' => $selectedProject,
            'profitProject' => $profitProject,
            'date_create' => $datetimeStamp,
            'date_edit' => $datetimeStamp
        ];
        $this->db->query('INSERT INTO projects (idInitiator,nameProject, idContragent, notice_project,expenseProject,moneyProject,selectedProject,profitProject,date_create,date_edit)
                    VALUES (:idInitiator, :nameProject, :idContragent, :notice_project,:expenseProject,:moneyProject,:selectedProject,:profitProject,:date_create,:date_edit)', $params);
        return $this->db->lastInsertId();
    }
//добавление дополнения проекта
    public function insertSuppProject($userID,$idProject,$nameSupp,$moneySupp,$datetimeStamp)
    {
        $params = [
            'initiator_supp' => $userID,
            'project_id' => $idProject,
            'name_supp' => $nameSupp,
            'money_supp' => $moneySupp,
            'date_create' => $datetimeStamp
        ];
        $this->db->query('INSERT INTO suppProjects (project_id,name_supp, money_supp, initiator_supp,date_create)
                    VALUES (:project_id, :name_supp, :money_supp, :initiator_supp, :date_create)', $params);
        //return $this->db->lastInsertId();
    }
//редактирование дополнения проекта
    public function editSuppProject($idEditSupp,$nameSupp,$moneySupp)
    {
        $params = [
            'id' => $idEditSupp,
            'name_supp' => $nameSupp,
            'money_supp' => $moneySupp
        ];
        $this->db->query('UPDATE suppProjects SET name_supp=:name_supp,money_supp=:money_supp
                    WHERE id=:id', $params);
        //return $this->db->lastInsertId();
    }
//удаление дополнения проекта
    public function deletSuppProject($idSupp)
    {
        $params = ['id' => $idSupp];
        $this->db->query('DELETE FROM suppProjects WHERE id=:id', $params);
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
//редактирование контрагента
    public function updateContragent($newInnContragent,$newNameContragent,$newKppContragent,$newNoticeContragent,$mineOrg,$idUserEdit,$idCont,$datetimeStamp)
    {
        $params = [
            'inn_contragent' => $newInnContragent,
            'name_contragent' => $newNameContragent,
            'kpp_contragent' => $newKppContragent,
            'notice_contragent' => $newNoticeContragent,
            'mineOrg' => $mineOrg,
            'idUserEdit' => $idUserEdit,
            'idCont' => $idCont,
            'date_edit' => $datetimeStamp
        ];
        $this->db->query('UPDATE contragents SET inn_contragent=:inn_contragent,name_contragent=:name_contragent, kpp_contragent=:kpp_contragent, idEdit=:idUserEdit, notice_contragent=:notice_contragent, mineOrg=:mineOrg, date_edit=:date_edit
                    WHERE id=:idCont', $params);
        return true;
    }
//редактирование проекта
    public function updateProject($nameProject,$nameContragent,$noticeProject,$idProject,$userID,$editMoneyProject,$editExpenseProject,$editSelectedProject,$editProfitProject,$datetimeStamp)
    {
        $params = [
            'nameProject' => $nameProject,
            'idContragent' => $nameContragent,
            'moneyProject' => $editMoneyProject,
            'expenseProject' => $editExpenseProject,
            'selectedProject' => $editSelectedProject,
            'profitProject' => $editProfitProject,
            'notice_project' => $noticeProject,
            'idProject' => $idProject,
            'idEdit' => $userID,
            'date_edit' => $datetimeStamp
        ];
        $this->db->query('UPDATE projects SET nameProject=:nameProject,idContragent=:idContragent,expenseProject=:expenseProject,moneyProject=:moneyProject,selectedProject=:selectedProject,profitProject=:profitProject,notice_project=:notice_project, idEdit=:idEdit, date_edit=:date_edit
                    WHERE id=:idProject', $params);
        return true;
    }
//редактирование опций валюты
    public function editCurrencyOption($currency,$tableValue,$params)
    {
        $params = [
            'currency' => $currency,
            'params' => $params
        ];
        $this->db->query('UPDATE currency SET '.$tableValue.'=:params WHERE codeCurrency=:currency', $params);
        return true;
    }
//редактирование даты и курса определенной валюты
    public function updateDateCurrency($selectCurrency,$dateCurrency,$courseCurrence)
    {
        $params = [
            'currency' => $selectCurrency,
            'rateCurrencyAuto' => $courseCurrence,
            'date_course' => $dateCurrency
        ];
        $this->db->query('UPDATE currency SET rateCurrencyAuto=:rateCurrencyAuto,date_course=:date_course WHERE codeCurrency=:currency', $params);
        return true;
    }
//получение даты курса валюты ЦБ
    public function testDateCurrency($selectCurrency)
    {
        $params = [
            'currency' => $selectCurrency
        ];
        return $this->db->column('SELECT date_course FROM currency WHERE codeCurrency=:currency', $params);
    }
//получаем массив счетов и служебок по номеру контракта
    public function dataContract($numberContract,$dateFrom,$dateTo)
    {
        /*list($day,$month,$year) = explode('.',$dateFrom);
        $dateFrom = $year.'-'.$month.'-'.$day;
        list($day,$month,$year) = explode('.',$dateTo);
        $dateTo = $year.'-'.$month.'-'.$day;*/
        $contractTable=[];

            $params = ['numberContract' => $numberContract];
            $contractTable[] = $this->db->row('SELECT * FROM invoice WHERE numberContract = :numberContract',$params);

            $params = ['numberContract' => $numberContract];
            $contractTable[] = $this->db->row('SELECT * FROM payInvoice WHERE contract = :numberContract',$params);

        return $contractTable;
    }
//поиск проекта
    public function checkProject($numberContract)
    {
        //return $this->db->row('SELECT *, (SELECT DATE_FORMAT(dateContract,"%d.%m.%Y")) AS dateContract FROM contracts WHERE numberContract LIKE "%'.$numberContract.'%"');
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM projects WHERE nameProject LIKE "%'.$numberContract.'%" ORDER BY nameProject LIMIT 10');
    }
//поиск контрагента
    public function checkContragent($numberContract)
    {
        return $this->db->row('SELECT * FROM contragents WHERE contragents.name_contragent LIKE "%'.$numberContract.'%" OR contragents.inn_contragent LIKE "%'.$numberContract.'%"');
    }
//получаем все проекты одного контрагента
    public function getProject($idContra)
    {
        $params = ['idContra' => $idContra];
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM projects WHERE idContragent=:idContra ORDER BY date_edit DESC', $params);
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
//получаем все допы проекта
    public function getSuppProject($idProject)
    {
        $params = ['project_id' => $idProject];
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM suppProjects WHERE project_id=:project_id', $params);
    }
//вставка комментария в базу
    public function insertCommentDB($idInvoice,$textComment,$dateTimeStamp)
    {
        $params = [
            'idInvoice' => $idInvoice,
            'type_doc' => $_POST['typeDoc'],
            'textComment' => $textComment,
            'autorComment' => $_SESSION['mngr']['id'],
            'date_create' => $dateTimeStamp
        ];
        $this->db->query('INSERT INTO comments (idInvoice, type_doc, textComment, autorComment, date_create)
                VALUES (:idInvoice, :type_doc, :textComment, :autorComment, :date_create)', $params);
        $idComment = $this->db->lastInsertId();
        $this->noticeInsertForListingPartner('comment',$idInvoice,$_POST['typeDoc']);
        return $idComment;
        /*if($typeAdd=='forPay'){
            $params = [
                'idInvoice' => $idInvoice,
                'textComment' => $textComment,
                'autorComment' => $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName'],
                'folderAutorAvatar' => $_SESSION['mngr']['userAvatar'],
                'date_create' => $dateTimeStamp
            ];
            $this->db->query('INSERT INTO comm_forPay (idInvoice, textComment, autorComment, folderAutorAvatar, date_create)
                    VALUES (:idInvoice, :textComment, :autorComment, :folderAutorAvatar, :date_create)', $params);
            $idComment = $this->db->lastInsertId();
            $this->noticeInsertForListingPartner('comment',$idInvoice,$typeAdd);
            return $idComment;
        }*/
    }

    public function noticeInsertForListingPartner($whatIs,$idInvoice,$addType)
    {
        if($addType=='invoice'){
            $testPartner = $this->testPartner($idInvoice,$addType);
            $testPartner = explode(",",$testPartner[0]['idPartner']);
            foreach ($testPartner as $item) {
                if($this->testNoticeSettings($item,'noticeDashComment')) {
                    if ($item != $_SESSION['mngr']['id']) {
                        $params = [
                            'whatIs' => $whatIs,
                            'userTo' => $item,
                            'userFrom' => $_SESSION['mngr']['id'],
                            'invoiceId' => $idInvoice,
                            'tableUser' => $addType,
                            'initiatorName' => $_SESSION['mngr']['userSurname'] . ' ' . $_SESSION['mngr']['userFirstName']
                        ];
                        $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                    VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
                    }
                }
                if($this->testNoticeSettings($item,'noticeMailComment')){
                    if ($item != $_SESSION['mngr']['id']) {
                        $this->sendMailNext($item, $idInvoice, $addType, 'comment','');
                    }
                }
            }
        }
        if($addType=='forPay'){
            $testPartner = $this->testPartner($idInvoice,$addType);
            $testPartner = explode(",",$testPartner[0]['idPartner']);
            foreach ($testPartner as $item) {
                if($this->testNoticeSettings($item,'noticeDashComment')) {
                    if ($item != $_SESSION['mngr']['id']) {
                        $params = [
                            'whatIs' => $whatIs,
                            'userTo' => $item,
                            'userFrom' => $_SESSION['mngr']['id'],
                            'invoiceId' => $idInvoice,
                            'tableUser' => $addType,
                            'initiatorName' => $_SESSION['mngr']['userSurname'] . ' ' . $_SESSION['mngr']['userFirstName']
                        ];
                        $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                    VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
                    }
                }
                if($this->testNoticeSettings($item,'noticeMailComment')){
                    if ($item != $_SESSION['mngr']['id']) {
                        $this->sendMailNext($item, $idInvoice, $addType, 'comment','');
                    }
                }
            }
        }
    }
//обновляем labelEdit счета или служебки
    public function labelEdit($idInvoice,$typeAdd,$label)
    {
        if($typeAdd=='invoice'){
            $params = ['idInvoice'=>$idInvoice];
            if($this->db->column('SELECT statusInvoice FROM invoice WHERE id=:idInvoice',$params)=='1'){
                $params = [
                    'idInvoice'=>$idInvoice,
                    'label'=>$label
                ];
                $this->db->query('UPDATE invoice SET editLabel=:label WHERE id=:idInvoice',$params);
            }
        }

    }
//проверяем подписан ли счет или служебка хотя бы один раз
    public function testSignature($idInvoice,$typeAdd)
    {
        if($typeAdd=='invoice'){
            $params = ['idInvoice'=>$idInvoice];
            return $this->db->row('SELECT date_signature FROM invoice WHERE id=:idInvoice',$params);
        }
        if($typeAdd=='forPay'){
            $params = ['idInvoice'=>$idInvoice];
            return $this->db->row('SELECT date_signature FROM payInvoice WHERE id=:idInvoice',$params);
        }
    }
//проверяем редактирование счета или служебки
    public function testEdit($idInvoice,$typeAdd,$dateEdit)
    {
        $result = false;
        if($typeAdd=='invoice'){
            $params = ['id'=>$idInvoice];
            $dateBase = $this->db->column('SELECT date_edit FROM invoice WHERE id=:id',$params);
            if(strtotime($dateEdit)==strtotime($dateBase)){
                $result = true;
            }
        }
        if($typeAdd=='forPay'){
            $params = ['id'=>$idInvoice];
            $dateBase = $this->db->column('SELECT date_edit FROM payInvoice WHERE id=:id',$params);
            if(strtotime($dateEdit)==strtotime($dateBase)){
                $result = true;
            }
        }
        return $result;
    }
//добавление проекта в избранное
    public function insertFavorite($userID,$idProject)
    {
        $params = [
            'user_id' => $userID,
            'project_id' => $idProject
        ];
        $this->db->query('INSERT INTO favorites (user_id, project_id)
                    VALUES (:user_id, :project_id)', $params);
        return $this->db->lastInsertId();
    }
//получение данных УВД по ID
    public function getAddDocID($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT * FROM docAdd WHERE id=:id',$params);
    }
//получение тем УВД
    public function getThemeDoc()
    {
        return $this->db->row('SELECT * FROM docAddTheme');
    }
//добавление темы для УВД
    public function addThemeDoc($themeNew)
    {
        $params = [
            'themeDoc' => $themeNew,
            'chargUser' => $_POST['chargUserNew']
        ];
        $this->db->query('INSERT INTO docAddTheme (themeDoc, chargUser)
                    VALUES (:themeDoc, :chargUser)', $params);
        return $this->db->lastInsertId();
    }
//добавление УВД
    public function addDoc()
    {
        $params = [
            'status' => '4',
            'signature' => $this->getIDUserFromIDdepDoc($_POST['depDoc']),
            'chargeUserID' => $this->getIDUserFromIDdepDoc($_POST['depDoc']),
            'userIDAddDoc' => $_SESSION['mngr']['id'],
            'themeAddDoc' => $_POST['typeDoc'],
            'noticeAddDoc' => $_POST['noticeAddDoc'],
            'fromTo' => $_POST['fromToDoc'],
            'dateAddDoc' => $_POST['datetimeStamp']
        ];
        $this->db->query('INSERT INTO docAdd (status, signature, chargeUserID, userIDAddDoc, themeAddDoc, noticeAddDoc, fromTo, dateAddDoc)
                    VALUES (:status, :signature, :chargeUserID, :userIDAddDoc, :themeAddDoc, :noticeAddDoc, :fromTo, :dateAddDoc)', $params);
        $idInvoice = $this->db->lastInsertId();
        $params = [
            'idInvoice' => $idInvoice,
            'typeAdd' => 'forDoc',
            'mngrId' => $_SESSION['mngr']['id']
        ];
        $this->db->query('INSERT INTO comm_partner (idInvoice, typeAdd,idPartner) 
                          VALUES (:idInvoice, :typeAdd, :mngrId)', $params);
        return $idInvoice;
    }
//получение ID руководителя по ID отдела
    public function getIDUserFromIDdepDoc($id)
    {
        $params = ['id'=>$id];
        return $this->db->column('SELECT bossID FROM departments WHERE id = :id',$params);
    }
//получение ID согласующего по ID темы УВД
    public function getIDUserFromIDThemeDoc($id)
    {
        $params = ['id'=>$id];
        return $this->db->column('SELECT chargUser FROM docAddTheme WHERE id = :id',$params);
    }
//обновление файла в УВД
    public function updatePathsInAddDoc($idAddDoc,$resultPaths)
    {
        $params = [
            'id' => $idAddDoc,
            'fileAddDoc' => $resultPaths
        ];
        $this->db->query('UPDATE docAdd SET fileAddDoc=:fileAddDoc WHERE id = :id', $params);
    }
//смена статуса УВД
    public function editStatusDoc()
    {
        $idDoc = $_POST['idDoc'];
        $dateSuccess = '';
        switch ($_POST['status']){
            case '4':
                $userTo = $_POST['chargeUserID'];
                $this->sendMailNext($userTo, $idDoc, 'addDoc', 'reloadDoc', '/file/addDoc/'.$_POST['fileAddDoc']);
                $this->noticeAddDoc('reloadDoc', $userTo, $idDoc);
                break;
            case '4.1':
                $userTo = $this->getIDUserFromIDThemeDoc($_POST['themeAddDoc']);
                $this->sendMailNext($userTo, $idDoc, 'addDoc', 'signDoc', '/file/addDoc/'.$_POST['fileAddDoc']);
                $this->noticeAddDoc('signDoc', $userTo, $idDoc);
                break;
            case '4.2':
                $userTo = $_POST['chargeUserID'];
                $this->sendMailNext($userTo, $idDoc, 'addDoc', 'successDoc', '/file/addDoc/'.$_POST['fileAddDoc']);
                $this->noticeAddDoc('successDoc', $userTo, $idDoc);
                $userTo = 0;
                $dateSuccess = $_POST['dateToday'];
                break;
        }
        $params = [
            'id' => $idDoc,
            'status' => $_POST['status'],
            'signature' => $userTo,
            'date_success' => $dateSuccess,
        ];
        $this->db->query('UPDATE docAdd SET status=:status,signature=:signature,date_success=:date_success WHERE id = :id', $params);
    }
//редактирование темы для УВД
    public function editThemeDoc($editThemeDoc)
    {
        $params = [
            'id' => $_POST['editThemeID'],
            'themeDoc' => $editThemeDoc,
            'chargUser' => $_POST['editThemeChargUser']
        ];
        $this->db->query('UPDATE docAddTheme SET themeDoc=:themeDoc,chargUser=:chargUser WHERE id = :id', $params);
    }
//удаление проекта в избранное
    public function deleteFavorite($userID,$idProject)
    {
        $params = [
            'user_id' => $userID,
            'project_id' => $idProject
        ];
        $this->db->query('DELETE FROM favorites WHERE user_id=:user_id AND project_id=:project_id', $params);
    }
//удаление уведомлений пользователя по ID
    public function deleteAllNoticeUserID($userID)
    {
        $params = ['user_id_to' => $userID];
        $this->db->query('DELETE FROM notice WHERE user_id_to=:user_id_to', $params);
    }
//сумма расходов
    public function blankSum($idPay)
    {
        $params = ['idPay'=>$idPay];
        return $this->db->row('SELECT SUM(money) AS moneySum FROM expensePay WHERE id_pay = :idPay',$params);
    }
//сумма неподтвержденных расходов
    public function blankSumNotList($idPay)
    {
        $params = ['idPay'=>$idPay];
        return $this->db->row('SELECT SUM(money) AS moneySum FROM expensePay WHERE id_pay = :idPay AND status="true"',$params);
    }
//добавление расхода в подотчет
    public function reportExpenseSave($idPay,$expense,$idProject,$money,$checkPay,$dateExpense)
    {
        $params = [
            'id_pay' => $idPay,
            'user_id' => $_SESSION["mngr"]["id"],
            'text_expense' => $expense,
            'id_project' => $idProject,
            'money' => $money,
            'check_pay' => $checkPay,
            'date_expense' => $dateExpense,
            'status' => 'false',
            'report_class' => 'default',
            'expenseWork' => 'true'
        ];
        $this->db->query('INSERT INTO expensePay (id_pay, user_id, text_expense, id_project, money, check_pay, date_expense, status, report_class, expenseWork)
                    VALUES (:id_pay, :user_id, :text_expense, :id_project, :money, :check_pay, :date_expense, :status, :report_class, :expenseWork)', $params);
        $idExpense = $this->db->lastInsertId();

        $params = ['id_pay' => $idPay];
        $row = $this->db->row('SELECT SUM(money) AS moneySum FROM expensePay WHERE id_pay = :id_pay',$params);

        $params = [
            'id_pay' => $idPay,
            'money_exp' => $row[0]['moneySum']
        ];
        $this->db->query('UPDATE payInvoice SET money_exp=:money_exp WHERE id = :id_pay',$params);

        return $idExpense;
    }
//редактирование расхода в подотчете
    public function expenseSaveEdit($idPay,$id,$expense,$idProject,$money,$checkPay,$dateExpense)
    {
        $params = [
            'id' => $id,
            'text_expense' => $expense,
            'id_project' => $idProject,
            'money' => $money,
            'check_pay' => $checkPay,
            'date_expense' => $dateExpense
        ];
        $this->db->query('UPDATE expensePay SET text_expense=:text_expense, id_project=:id_project, money=:money, check_pay=:check_pay, date_expense=:date_expense WHERE id = :id',$params);

        $params = ['id_pay' => $idPay];
        $row = $this->db->row('SELECT SUM(money) AS moneySum FROM expensePay WHERE id_pay = :id_pay',$params);

        $params = [
            'id_pay' => $idPay,
            'moneyexp' => $row[0]['moneySum']
        ];
        $this->db->query('UPDATE payInvoice SET money_exp=:moneyexp WHERE id = :id_pay',$params);
    }
//редактирование indicator подотчета
    public function updateReport($expid,$reportClass)
    {
        switch ($reportClass){
            case 'success':
                $status = 'true';
                break;
            case 'danger':
                $status = 'false';
                break;
        }
        $params = [
            'id' => $expid,
            'status' => $status,
            'report_class' => $reportClass
        ];
        $this->db->query('UPDATE expensePay SET status=:status, report_class=:report_class WHERE id = :id',$params);
    }
//проверка классов CSS в расходах подотчета
    public function testReportClass($idPay)
    {
        $params = ['id' => $idPay];
        return $this->db->row('SELECT report_class FROM expensePay WHERE id_pay = :id',$params);
    }
//удаление расхода в подотчете
    public function expenseDelete($id,$idPay)
    {
        $params = ['id' => $id];
        $this->db->query('DELETE FROM expensePay WHERE id=:id', $params);

        $params = ['id_pay' => $idPay];
        $row = $this->db->row('SELECT SUM(money) AS moneySum FROM expensePay WHERE id_pay = :id_pay',$params);

        $params = [
            'id_pay' => $idPay,
            'money_exp' => $row[0]['moneySum']
        ];
        $this->db->query('UPDATE payInvoice SET money_exp=:money_exp WHERE id = :id_pay',$params);
    }
//отправка подотчета на проверку
    public function reportSend($idPay,$userTo)
    {
        $params = [
            'id_pay' => $idPay,
            'report_sign' => $userTo
        ];
        $this->db->query('UPDATE payInvoice SET check_pay="true",report_sign=:report_sign WHERE id = :id_pay',$params);

        if($this->testNoticeSettings($userTo,'noticeDashAddInvoice')){
            $params = [
                'whatIs' => 'reportPay',
                'userTo' => $userTo,
                'userFrom' => $_SESSION['mngr']['id'],
                'invoiceId' => $idPay,
                'tableUser' => 'forPay',
                'initiatorName' => $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName']
            ];
            $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);
        }
    }
//обновление статуса подотчета
    public function updateReportReturnSend($idPay,$reportClass,$initiatorID,$lastSignPay,$dateToday)
    {
        if($reportClass == 'reportSuccess'){
            $params = [
                'id' => $idPay,
                'check_pay' => 'true',
                'report_sign' => $lastSignPay,
                'date_reportHeadSign' => $dateToday
            ];
            $this->db->query('UPDATE payInvoice SET check_pay=:check_pay, report_sign=:report_sign, date_reportHeadSign=:date_reportHeadSign WHERE id = :id',$params);

            $params = [
                'whatIs' => 'reportLastSuccess',
                'userTo' => $lastSignPay,
                'userFrom' => $_SESSION['mngr']['id'],
                'invoiceId' => $idPay,
                'tableUser' => 'forPay',
                'initiatorName' => $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName']
            ];
            $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);

        }else{
            $params = [
                'id' => $idPay,
                'check_pay' => 'false',
                'report_sign' => '0'
            ];
            $this->db->query('UPDATE payInvoice SET check_pay=:check_pay, report_sign=:report_sign WHERE id = :id',$params);
        }


        $params = [
            'whatIs' => $reportClass,
            'userTo' => $initiatorID,
            'userFrom' => $_SESSION['mngr']['id'],
            'invoiceId' => $idPay,
            'tableUser' => 'forPay',
            'initiatorName' => $_SESSION['mngr']['userSurname'].' '.$_SESSION['mngr']['userFirstName']
        ];
        $this->db->query('INSERT INTO notice (whatIs, user_id_to, user_id_from, invoice_id, tableUser, initiatorName) 
                                VALUES (:whatIs, :userTo, :userFrom, :invoiceId, :tableUser, :initiatorName)', $params);


    }
//обновление статуса подотчета
    public function updateReportAll($idPay,$report)
    {
        if($report == 'success'){
            $params = [
                'id' => $idPay,
                'status' => 'true',
                'report_class' => $report
            ];
            $this->db->query('UPDATE expensePay SET status=:status, report_class=:report_class WHERE id_pay = :id',$params);
        }else{
            $params = [
                'id' => $idPay,
                'status' => 'false',
                'report_class' => $report
            ];
            $this->db->query('UPDATE expensePay SET status=:status, report_class=:report_class WHERE id_pay = :id',$params);
        }
    }
//возврат наличных с подотчета
    public function updateReportLastBack($idPay,$dateToday)
    {
        $params = [
            'id' => $idPay,
            'date_reportBackCash' => $dateToday
        ];
        $this->db->query('UPDATE payInvoice SET date_reportBackCash=:date_reportBackCash, money=money_exp WHERE id = :id',$params);
    }
//выдача дополнительных наличных с подотчета
    public function updateReportLastPay($idPay,$dateToday)
    {
        $params = [
            'id' => $idPay,
            'date_reportAddCash' => $dateToday
        ];
        $this->db->query('UPDATE payInvoice SET date_reportAddCash=:date_reportAddCash, money=money_exp WHERE id = :id',$params);
    }
//прием подотчета последним согласующим подотчета
    public function updateReportLastSuccess($idPay,$dateToday)
    {
        $params = [
            'id' => $idPay,
            'date_reportLastSign' => $dateToday,
            'under_report' => 'trueOff'
        ];
        $this->db->query('UPDATE payInvoice SET date_reportLastSign=:date_reportLastSign, under_report=:under_report, report_sign="0" WHERE id = :id',$params);

        $params = [
            'id' => $idPay,
            'expenseWork' => 'false'
        ];
        $this->db->query('UPDATE expensePay SET expenseWork=:expenseWork WHERE id_pay = :id',$params);

    }
//проверка счетов на редактировании
    public function testEditInvoice()
    {
        $params = ['mngrId' => $_SESSION['mngr']['id']];
        return $this->db->row('SELECT * FROM invoice WHERE mngrId = :mngrId AND editLabel="true"', $params);
    }
//обновление пути ссылки в счете
    public function updatePathsInInvoice($id,$path)
    {
        $params = [
            'pathScanInvoice' => $path,
            'id' => $id
        ];
        $this->db->query('UPDATE invoice SET pathScanInvoice = :pathScanInvoice WHERE id = :id', $params);
    }
    public function updatePathsInInvoicePay($id,$path)
    {
        $params = [
            'paths_pay' => $path,
            'id' => $id
        ];
        $this->db->query('UPDATE payInvoice SET paths_pay = :paths_pay WHERE id = :id', $params);
    }
//обновление требования платежки в счете
    public function upadeNeedPayInvoice($id)
    {
        $params = ['id' => $id];
        $this->db->query('UPDATE invoice SET needPay = "false" WHERE id = :id', $params);
    }
//разрешенный к показу список счетов
    public function allowedListUsers()
    {
        return $this->db->row('SELECT * FROM listUsers WHERE user_id='.$_SESSION['mngr']['id']);
    }
//получаем список счетов с требованием платежки
    public function updateTableNeedPay()
    {
        return $this->db->row('SELECT * FROM invoice WHERE needPay = "true" AND statusInvoice = 7');
    }
//получаем адрес почты по ID
    public function getEmailMngr($id)
    {
        $params = ['id'=>$id];
        return $this->db->column('SELECT userMail FROM users WHERE id = :id',$params);
    }
//объединение проектов
    public function mergeProjects($idMerge,$arrMergeClean,$idMergeSupp)
    {
        //return $arrMergeClean[0];
        foreach($arrMergeClean as $projectID){
            //меняем id проекта в счетах
            $params = [
                'idMerge' => $idMerge,
                'projectID' => $projectID,
                ];
            $this->db->query('UPDATE invoice SET numberContract = :idMerge WHERE numberContract = :projectID', $params);
            //меняем id проекта в наличке
            $params = [
                'idMerge' => $idMerge,
                'projectID' => $projectID,
                ];
            $this->db->query('UPDATE payInvoice SET contract = :idMerge WHERE contract = :projectID', $params);
            //меняем id проекта в расходах подотчета
            $params = [
                'idMerge' => $idMerge,
                'projectID' => $projectID,
            ];
            $this->db->query('UPDATE expensePay SET id_project = :idMerge WHERE id_project = :projectID', $params);
            $params = ['projectID' => $projectID];
            $this->db->query('DELETE FROM projects WHERE id=:projectID', $params);
        }
        foreach ($idMergeSupp as $supp){
            $params = [
                'idMerge' => $idMerge,
                'id' => $supp,
            ];
            $this->db->query('UPDATE suppProjects SET project_id = :idMerge WHERE id = :id', $params);
        }
    }
//в отпуск из отпуска
    public function updateHoliday($userID,$typeHoliday,$dateToday,$autoDelegate)
    {
        $params = [
            'userID' => $userID,
            'holiday' => $typeHoliday
            ];
        $this->db->query('UPDATE users SET holiday = :holiday WHERE id = :userID', $params);

        if($typeHoliday=='true'){
            $params = ['userID'=>$userID];
            $storyToMail = $this->db->row('SELECT id FROM users WHERE userToMail = :userID',$params);
            $storyToMail = json_encode($storyToMail);

            $params = ['userID'=>$userID];
            $storyToMailPay = $this->db->row('SELECT id FROM users WHERE userToMailPay = :userID',$params);
            $storyToMailPay = json_encode($storyToMailPay);

            $params = [
                'userID' => $userID,
                'storyToMail' => $storyToMail,
                'storyToMailPay' => $storyToMailPay
            ];
            $this->db->query('UPDATE users SET storyToMail = :storyToMail,storyToMailPay=:storyToMailPay WHERE id = :userID', $params);
            /////
            if($autoDelegate=='true'){
                $idToMail = $this->getUserToMail($userID); //кому отправляет счета
                $idToMailPay = $this->getUserToMailPay($userID); //кому отправляет служебку
            }else{
                $idToMail = $autoDelegate; //кому отправляет счета
                $idToMailPay = $autoDelegate; //кому отправляет служебку
            }
            $params = [
                'userID'=>$userID,
                'idToMail'=>$idToMail
            ];
            $this->db->row('UPDATE users SET userToMail = :idToMail WHERE userToMail = :userID',$params);

            $params = [
                'userID'=>$userID,
                'idToMailPay'=>$idToMailPay
            ];
            $this->db->row('UPDATE users SET userToMailPay = :idToMailPay WHERE userToMailPay = :userID',$params);

            ///добавляем запись об отпуске
            $params = [
                'user_id'=>$userID,
                'date_inHoliday'=>$dateToday,
                'type_holiday'=>'holiday'
            ];
            $this->db->query('INSERT INTO holiday (user_id, date_inHoliday, type_holiday) VALUES (:user_id, :date_inHoliday, :type_holiday)', $params);
        }else{
            $params = ['userID'=>$userID];
            $storyToMail = $this->db->column('SELECT storyToMail FROM users WHERE id = :userID',$params);
            $storyToMail = json_decode($storyToMail,true);
            for($i=0;$i<count($storyToMail);$i++){
                $params = [
                    'userID'=>$userID,
                    'toMail'=>$storyToMail[$i]['id']
                ];
                $this->db->row('UPDATE users SET userToMail = :userID WHERE id = :toMail',$params);
            }

            $params = ['userID'=>$userID];
            $storyToMailPay = $this->db->column('SELECT storyToMailPay FROM users WHERE id = :userID',$params);
            $storyToMailPay = json_decode($storyToMailPay,true);
            for($i=0;$i<count($storyToMailPay);$i++){
                $params = [
                    'userID'=>$userID,
                    'toMailPay'=>$storyToMailPay[$i]['id']
                ];
                $this->db->row('UPDATE users SET userToMailPay = :userID WHERE id = :toMailPay',$params);
            }
            ///добавляем запись о выходе из отпуска
            $params = [
                'user_id'=>$userID,
                'date_ofHoliday'=>$dateToday
            ];
            $this->db->query('UPDATE holiday SET date_ofHoliday = :date_ofHoliday WHERE user_id = :user_id AND date_ofHoliday=""', $params);

        }


    }
//наличие текущих дел у пользователя
    public function currentAffairs($userID)
    {
        $params = ['userID'=>$userID];
        $currentInvoce = $this->db->row('SELECT * FROM invoice WHERE signature = :userID',$params);

        $params = ['userID'=>$userID];
        $currentPay = $this->db->row('SELECT * FROM payInvoice WHERE signature = :userID OR report_sign = :userID',$params);

        if(count($currentInvoce)>0 || count($currentPay)>0){
            return true;
        }else{
            return false;
        }
    }
//Проверка пост запроса
    public function getPostPost($invoiceID)
    {
        $params = ['invoiceID' => $invoiceID];
        $dataInvoice = $this->db->row('SELECT * FROM invoice WHERE id = :invoiceID',$params);
        return $dataInvoice[0];
    }
//получаем список счетов по запросу ajax
    public function dataTableAjax($status,$dateFrom,$dateTo,$idProject,$idDepartment,$idInitiator,$idOrganization,$idContragent)
    {
        $statusInvoice = '7';
        switch ($status){
            case 'all':
                $statusInvoice = '1,2,5,7';
                break;
            case 'success':
                $statusInvoice = '7';
                break;
            case 'inwork':
                $statusInvoice = '1,2';
                break;
            case 'danger':
                $statusInvoice = '5';
                break;
        }
        $allowedList = $this->db->row('SELECT from_invoice FROM listUsers WHERE user_id='.$_SESSION['mngr']['id']);

        $tableProject = $tableDepartment = $tableOrganization = $tableContragent = '';

        if(!empty($idProject)){
            $tableProject = 'AND numberContract='.$idProject;
        }
        if(!empty($idDepartment)){
            if(!empty($idDepartment)){
                $arrayPosts = '';
                $allPosts = $this->getAllPosts();
                foreach ($allPosts as $postOne){
                    if($postOne['nameDepartment']==$idDepartment){
                        if($arrayPosts==''){
                            $arrayPosts.=$postOne['id'];
                        }else{
                            $arrayPosts.=','.$postOne['id'];
                        }
                    }
                }
                $tableDepartment = 'AND initiatorRole IN('.$arrayPosts.')';
            }
        }
        if(!empty($idInitiator)){
            $tableInitiator = $idInitiator;
        }else{
            $tableInitiator = $allowedList[0]["from_invoice"];
        }
        if(!empty($idOrganization)){
            $tableOrganization = 'AND organizationInvoiceForPayment='.$idOrganization;
        }
        if(!empty($idContragent)){
            $tableContragent = 'AND contragent='.$idContragent;
        }
        $params = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            /*'numberContract' => $idProject,*/
            /*'mngrId' => $idInitiator,*/
            /*'organizationInvoiceForPayment' => $idOrganization,*/
            /*'contragent' => $idContragent*/
        ];
        return $this->db->row('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM invoice 
                WHERE mngrId IN('.$tableInitiator.')
                AND statusInvoice IN('.$statusInvoice.')
                AND date_create > :dateFrom AND date_create < :dateTo
                '.$tableProject.' '.$tableOrganization.' '.$tableContragent.' '.$tableDepartment.' ',$params);
    }
//получаем список служебок по запросу ajax
    public function dataTableAjaxPay($status,$dateFrom,$dateTo,$typePay,$idProject,$idDepartment,$idInitiator)
    {
        $statusInvoice = '7';
        switch ($status){
            case 'all':
                $statusInvoice = '1,2,5,7';
                break;
            case 'success':
                $statusInvoice = '7';
                break;
            case 'inwork':
                $statusInvoice = '1,2';
                break;
            case 'danger':
                $statusInvoice = '5';
                break;
        }
        $tableReport = 'AND under_report IN(true,false)';
        switch ($typePay){
            case 'all':
                $tableReport = $tableReport;
                break;
            case 'cash':
                $tableReport = "AND under_report='false'";
                break;
            case 'report':
                $tableReport = "AND under_report='true'";
                break;
        }

        $allowedList = $this->db->row('SELECT from_invoicePay FROM listUsers WHERE user_id='.$_SESSION['mngr']['id']);

        $tableProject = $tableDepartment = '';

        if(!empty($idProject)){
            $tableProject = 'AND contract='.$idProject;
        }
        if(!empty($idDepartment)){
            $tableDepartment = 'AND userDepartment='.$idDepartment;
        }
        if(!empty($idInitiator)){
            $tableInitiator = $idInitiator;
        }else{
            $tableInitiator = $allowedList[0]["from_invoicePay"];
        }
        $params = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ];
        return $this->db->query('SELECT *, (SELECT DATE_FORMAT(date_create,"%d.%m.%Y")) AS dateCreate FROM payInvoice 
                WHERE user_id IN('.$tableInitiator.')
                AND status_pay IN('.$statusInvoice.')
                '.$tableReport.'
                AND date_create > :dateFrom AND date_create < :dateTo
                '.$tableProject.' '.$tableDepartment.' ',$params);
    }
//получаем список служебок по запросу ajax
    public function dataTableAjaxDoc($status,$dateFrom,$dateTo,$themeDoc,$fromToDoc,$idDepartment,$idChargeDoc)
    {
        $statusInvoice = '4.2';
        switch ($status){
            case 'all':
                $statusInvoice = '4,4.1,4.2';
                break;
            case 'success':
                $statusInvoice = '4.2';
                break;
            case 'inwork':
                $statusInvoice = '4,4.1';
                break;
        }

        $tableThemeDoc = $tableFromToDoc = $tableIdDepartment = $tableIdChargeDoc = '';

        if(!empty($themeDoc)){
            $tableThemeDoc = 'AND themeAddDoc='.$themeDoc;
        }
        if(!empty($fromToDoc)){
            $tableFromToDoc = 'AND fromTo='.$fromToDoc;
        }
        if(!empty($idDepartment)){
            $tableIdDepartment = 'AND idDepartment='.$idDepartment;
        }
        if(!empty($idChargeDoc)){
            $tableIdChargeDoc = 'AND chargeUserID='.$idChargeDoc;
        }else{
            $allowedList = $this->db->row('SELECT from_doc FROM listUsers WHERE user_id='.$_SESSION['mngr']['id']);
            $tableIdChargeDoc = $allowedList[0]["from_doc"];
        }
        $params = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ];
        return $this->db->query('SELECT *, (SELECT DATE_FORMAT(dateAddDoc,"%d.%m.%Y")) AS dateCreate FROM docAdd 
                WHERE chargeUserID IN('.$tableIdChargeDoc.')
                AND status IN('.$statusInvoice.')
                AND dateAddDoc > :dateFrom AND dateAddDoc < :dateTo
                '.$tableThemeDoc.' '.$tableFromToDoc.' '.$tableIdDepartment.' ',$params);
    }
//проверка Email на повторение
    public function checkUserMail($userMail)
    {
        $params = ['userMail' => $userMail];
        $checkMail = $this->db->column('SELECT userMail FROM users WHERE userMail = :userMail',$params);
        if(empty($checkMail)){
            return 'true';
        }else{
            return 'false';
        }
    }
//добавление пользователя
    public function addUser()
    {
        $params = ['userSurname' => $_POST['userSurname'],
            'userFirstName' => $_POST['userFirstName'],
            'userLastName' => $_POST['userLastName'],
            'userDepartment' => $_POST['userDepartment'],
            'userRole' => $_POST['userRole'],
            'userToMail' => '',
            'userToMailPay' => '',
            'holiday' => 'false',
            'userWorkPhone' => $_POST['userWorkPhone'],
            'userPersonalPhone' => $_POST['userPersonalPhone'],
            'userMail' => $_POST['userMail'],
            'userInitiatorTable' => '',
            'userSkype' => $_POST['userSkype'],
            'userPwd' => $_POST['userPwd'],
            'userAvatar' => 'nophoto.jpg',
            'registrationDate' => $_POST['dateTime']
            ];
        $this->db->query('INSERT INTO users (userSurname, userFirstName, userLastName, userDepartment, userRole, 
                            userToMail, userToMailPay, holiday, userWorkPhone, userPersonalPhone, userMail, userInitiatorTable, userSkype, userPwd, userAvatar, registrationDate )
                    VALUES (:userSurname, :userFirstName, :userLastName, :userDepartment, :userRole, :userToMail, :userToMailPay, :holiday, 
                    :userWorkPhone, :userPersonalPhone, :userMail, :userInitiatorTable, :userSkype, :userPwd, :userAvatar, :registrationDate )', $params);
        $newUserID = $this->db->lastInsertId();
        $params = ['user_id' => $newUserID];
        $this->db->query('INSERT INTO noticeSettings (user_id, noticeMailAddInvoice, noticeMailSignInvoice, noticeMailFailure, noticeMailSuccess, 
                         noticeMailComment, noticeDashAddInvoice, noticeDashSignInvoice, noticeDashFailure, noticeDashSuccess, noticeDashComment)
                    VALUES (:user_id, "true", "true", "true", "true", "true", "true", "true", "true", "true", "true")', $params);
        return $newUserID;
    }
//редактирование пользователя
    public function editUser()
    {
        if($_POST['delete']=='true'){
            $signatureNextInvoice = $this->getUserToMail($_POST['userID']); //следующий согласующий счетов

            $params = [
                'signatureNEW' => $signatureNextInvoice,
                'signatureOLD' => $_POST['userID'],
            ];
            $this->db->query('UPDATE invoice SET signature = :signatureNEW
                          WHERE signature = :signatureOLD', $params);

            $signatureNextPay = $this->getUserToMailPay($_POST['userID']); //следующий согласующий служебок

            $params = [
                'signatureNEW' => $signatureNextPay,
                'signatureOLD' => $_POST['userID'],
            ];
            $this->db->query('UPDATE payInvoice SET signature = :signatureNEW
                          WHERE signature = :signatureOLD', $params);
        }
        $params = [
            'id' => $_POST['userID'],
            'userSurname' => $_POST['userSurname'],
            'userFirstName' => $_POST['userFirstName'],
            'userLastName' => $_POST['userLastName'],
            'userDepartment' => $_POST['userDepartment'],
            'userRole' => $_POST['userRole'],
            'userWorkPhone' => $_POST['userWorkPhone'],
            'userPersonalPhone' => $_POST['userPersonalPhone'],
            'userMail' => $_POST['userMail'],
            'userSkype' => $_POST['userSkype'],
            'userPwd' => $_POST['userPwd'],
            'userAdmin' => $_POST['userAdmin']
        ];
        $this->db->query('UPDATE users SET userSurname = :userSurname,
                          userFirstName = :userFirstName,
                          userLastName = :userLastName,
                          userDepartment = :userDepartment,
                          userRole = :userRole,
                          userWorkPhone = :userWorkPhone,
                          userPersonalPhone = :userPersonalPhone,
                          userMail = :userMail,
                          userSkype = :userSkype,
                          userPwd = :userPwd,
                          adminUser = :userAdmin
                          WHERE id = :id', $params);

        return true;
    }
//получение статуса пользователя
    public function getAdminUsers($userID)
    {
        $params = ['id' => $userID];
        return $this->db->column('SELECT adminUser FROM users WHERE id=:id',$params);
    }

}