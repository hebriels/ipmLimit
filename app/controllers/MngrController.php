<?php

namespace app\controllers;

use app\core\Controller;


class MngrController extends Controller
{
    public $mngrPersonNumber;

    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'default';
    }
    function defaultDownload(){
        $currencySimbol = 'р.';
        $currencyGeneral = $this->model->getOneOption('currencyGeneral'); //Валюта по умолчанию
        $currency = $this->model->getCurrency(); //получить массив валюты
        foreach ($currency as $item){
            if($item['id']==$currencyGeneral){
                $currencySimbol = $item['simbolCurrency'];
            }
        }
        $defaultLoad = [
            'imageLogo' => $this->model->getOneOption('imageLogo'), //Логотип
            'adminUsers' => $this->model->getAdminUsers($_SESSION['mngr']['id']),//разрешено ли администрировать
            'currencyGeneral' => $currencyGeneral,
            'currencySimbol' => $currencySimbol,
            'currency' => $currency,
            'allowedListUsers' => $this->model->allowedListUsers(), //разрешенный к показу список счетов
            'userPathAvatar' => $this->model->getPathAvatar(), //путь до аватарки пользователя
            'timezone' => $this->model->getTimezone(), //timezone
            'userControlHoliday' => $this->controlHoliday() //разрешено или нет показывать меню отпуск
        ];
        return $defaultLoad;
    }

    public function loginAction()
    {
        if(!empty($_POST)){
            if(!$this->model->loginValidate()){
                echo json_encode('incorrect');

                //$this->view->message('Incorrect login information', $this->model->err);
            }
            $_SESSION['mngr'] = $this->model->mngr[0];
            $this->view->redirect('/mngr/dashboard');
        }
        $this->view->render('Вход');
    }

    public function logoutAction()
    {
        unset($_SESSION['mngr']);
        $this->view->redirect('/');
    }

    public function addAction()
    {
        if(!empty($_POST)){
            $id = $this->model->addEntry($_POST);
            if($id){
                $this->model->uploadInvoice($id);
            }
            if(!is_null($this->model->err)) {
                $this->view->message('error', $this->model->err);
            }
            if($this->model->testNoticeSettings($_SESSION['mngr']['userToMail'],'noticeMailAddInvoice')){
                $this->model->sendMail();
            }

            $this->view->redirect('/mngr/document');
        }
        $invoiceDataID = $invoicePayDataID = $typeInvoice = '';
        if(isset($_GET['id'])){
            $typeInvoice = $_GET['type'];
            if($_GET['type']=='invoice'){
                $invoiceDataID = $this->model->getStafferInvoice($_GET['id']);
            }else{
                $invoicePayDataID = $this->model->getOnePayInvoice($_GET['id']);
            }
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'allOrganization' => $this->model->getAllOrganization(),
            'getAllFavorites' => $this->model->getAllFavorites(),
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'moduleAddDoc' => $this->model->getOneOption('moduleAddDoc'), //Модуль документооборот
            'allProjects' => $this->model->getAllProjects(),//список всех проектов
            'profitInProject' => $this->model->getOneOption('profitInProject'), //процент рентабельности
            'mngrData' => $_SESSION['mngr'],
            'testCurrencyCB' => $this->model->getOneOption('currencyCB'), //ЦБ курс валют использовать или нет
            'typeInvoice' => $typeInvoice,
            'themeDoc' => $this->model->getThemeDoc(),
            'invoiceDataID' => $invoiceDataID,
            'invoicePayDataID' => $invoicePayDataID,
            'allContragents' => $this->model->getAllContragents(),//список всех контрагентов
            'allDepartments' => $this->model->getAllDepartments() //список отделов

        ];
        $this->view->render('Добавить счет', $params);
    }

    public function delAction()
    {
        $this->model->postDelete($this->route['id']);
        $this->view->redirect('/admin/add');
    }

    public function dashboardAction()
    {
        $listAction = $this->model->getlistAction($_SESSION['mngr']['id'],$this->model->getOneOption('lastSignInvoice'),$this->model->getOneOption('lastSignPay'));
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'allOrganization' => $this->model->getAllOrganization(),
            'totalInvoice' => $this->model->totalInvoice(),//всего счетов
            'invoicesSigned' => $this->model->statisticInvoice(7),//счетов подписано
            'invoicesRefused' => $this->model->statisticInvoice(5),//счетов отказано
            'invoiceWork' => $this->model->getInvoiceWorkMngr($_SESSION['mngr']['id']),//счета в работе
            'allInvoice' => $this->model->getAllDashboard(),//получить все счета менеджера
            'allPay' => $this->model->getAllPayDashboard(),//получить все служебки менеджера
            'allDoc' => $this->model->getAllDocDashboard(),//получить все документы менеджера
            'themeDocs' => $this->model->getThemeDoc(),//получаем темы документов
            'allDepartments' => $this->model->getAllDepartments(),//список отделов
            'allUsers' => $this->model->getAllUsers(),//получить массив пользователей
            'lastSignInvoice' => $this->model->getOneOption('lastSignInvoice'),//получить ID последнего согласующего счета
            'addressSite' => $this->model->getOneOption('addressSite'),//получить адрес сайта
            'lastSignPay' => $this->model->getOneOption('lastSignPay'),//получить ID последнего согласующего служебки
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'oneC' => $this->model->getOneOption('oneC'), //Модуль 1С
            'oneCLast' => $this->model->getOneOption('oneCLast'), //Модуль 1С последний согласующий
            'oneCServer' => $this->model->getOneOption('oneCServer'), //Адрес сервера 1С
            'allContragents' => $this->model->getAllContragents(),//список всех контрагентов
            'allProjects' => $this->model->getAllProjects(),//список всех проектов
            'listAction' => $listAction,
            'userTestInHoliday' => $this->model->userTestInHoliday($_SESSION['mngr']['id']) //в отпуске пользователь или нет
        ];
        $this->view->render('Панель управления', $params);
    }

    public function profileAction()
    {
        $listAction = $this->model->getlistAction($_SESSION['mngr']['id'],$this->model->getOneOption('lastSignInvoice'),$this->model->getOneOption('lastSignPay'));
        $listActionInvoice = $listAction['arrUserInvoice'];
        $params =[
            'defaultDownload' => $this->defaultDownload(),
            'noticeSettingsUser' => $this->model->getNoticeSettingsUser($_SESSION['mngr']['id']),
            'userToMail' => $this->model->userToMail($_SESSION['mngr']['id']),
            'userToMailPay' => $this->model->userToMailPay($_SESSION['mngr']['id']),
            'allUsers' => $this->model->getAllUsers(),//получить массив пользователей
            'adminUsers' => $this->model->getAdminUsers($_SESSION['mngr']['id']),//разрешено ли администрировать
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'userPathAvatar' => $this->model->getPathAvatar(),
            'allPosts' => $this->model->getAllPosts(), //список должностей
            'allDepartments' => $this->model->getAllDepartments(), //список отделов
            'listActionInvoice' => $listActionInvoice, //список согласующих
        ];
        $this->view->render('Профиль', $params);
    }

    public function avatarAction()
    {
            $this->model->uploadAvatar();
            if (!is_null($this->model->err)) {
                $this->view->message('error', $this->model->err);
            }
            $this->view->redirect('/mngr/profile');
    }

    public function changepwdAction()
    {
        $this->model->changeUserPwdFromProfile();
        if(!is_null($this->model->err)) {
            $this->view->message('error', $this->model->err);
        }
        $this->view->redirect('/mngr/profile');
    }

    public function invoiceAction()
    {
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'allOrganization' => $this->model->getAllOrganization(),
            'allInvoice' => $this->model->getAllInvoice(), //получить все счета менеджера
            'allDepartments' => $this->model->getAllDepartments(), //список отделов
            'allUsers' => $this->model->getAllUsers(), //получить массив пользователей
            'lastSignInvoice' => $this->model->getOneOption('lastSignInvoice'), //получить ID последнего согласующего счета
            'lastSignPay' => $this->model->getOneOption('lastSignPay'), //получить ID последнего согласующего служебки
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allContragents' => $this->model->getAllContragents(),//список всех контрагентов
            'allProjects' => $this->model->getAllProjects(), //список всех проектов
            'mngrTable' => $this->model->getInvoiceSubordinatedEmployees()
            ];
        $this->view->render('Список счетов', $params);

    }

    //получить один счет
    public function onepayAction()
    {
        $projectID = $this->model->getProjectID('invoicePay',$this->route['id']);
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'allProjects' => $this->model->getAllProjects(),//список всех проектов
            'onePay' => $this->model->getOnePayInvoice($this->route['id']),
            'allContragents' => $this->model->getAllContragents(),//список всех контрагентов
            'addCommPartner' => $this->model->getOneOption('addCommPartner'),//получить ID пользователей для разрешения добавления
            'getCommPartners' => $this->model->getCommPartners($this->route['id'],'forPay'), //список участников чата
            'allUsers' => $this->model->getAllUsers(),//получить массив пользователей
            'allPosts' => $this->model->getAllPosts(), //список должностей
            'expensePay' => $this->model->getExpencePayList($this->route['id']),
            'testProfit' => $this->model->testProfit($projectID),//получить рентабельность проекта
            'lastSignPay' => $this->model->getOneOption('lastSignPay'),//получить ID последнего согласующего служебки
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
        ];
        $this->view->render('Детализация служебки', $params);
    }

    //получить один счет
    public function onedocAction()
    {
        $oneDoc = $this->model->getAddDocID($this->route['id']); //получаем данные документа
        $themeDoc = $this->model->getThemeDoc(); //получаем темы документов
        foreach ($themeDoc as $item){
            if($oneDoc[0]['themeAddDoc']==$item['id']){
                $chargeThemeDoc = $item['chargUser'];
            }
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'oneDoc' => $oneDoc,
            'depID' => $this->model->getDepartmentID($oneDoc[0]['chargeUserID']),//получаем ID отдела ответственного
            'themeDoc' => $themeDoc,
            'nameContragent' => $this->model->getNameContragentForID($oneDoc[0]['fromTo']),
            'chargeThemeDoc' => $chargeThemeDoc,//получаем последнего согласующего темы
            'allDepartments' => $this->model->getAllDepartments(), //список отделов
            'addCommPartner' => $this->model->getOneOption('addCommPartner'),//получить ID пользователей для разрешения добавления
            'getCommPartners' => $this->model->getCommPartners($this->route['id'],'forDoc'), //список участников чата
            'allUsers' => $this->model->getAllUsers(),//получить массив пользователей
            //'lastSignDoc' => $this->model->getOneOption('lastSignDoc'),//получить ID последнего согласующего счета
            'modulePay' => $this->model->getOneOption('modulePay') //Модуль наличка
        ];
        $this->view->render('Детализация документа', $params);
    }

    //Для тестов
    public function testsiteAction()
    {
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'testProfit' => $this->model->testProfit(306),
            'modulePay' => $this->model->getOneOption('modulePay') //Модуль наличка
        ];
        $this->view->render('Для тестов', $params);
    }

    //получить один счет
    public function reportpayAction()
    {
        if($this->model->getStatusInvoicePay($this->route['id'])){
            $this->view->redirect('/mngr/onepay/'.$this->route['id'].'');
        }else{
            $params = [
                'defaultDownload' => $this->defaultDownload(),
                'onePay' => $this->model->getOnePayInvoice($this->route['id']),
                'allProjects' => $this->model->getAllProjects(),
                'allProjectsCon' => $this->model->getAllProjectsAndContragents(),
                'allContragents' => $this->model->getAllContragents(),//список всех контрагентов
                'lastSignPay' => $this->model->getOneOption('lastSignPay'),//получить ID последнего согласующего служебки
                'expensePay' => $this->model->getExpencePayList($this->route['id']),
                'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
                'expenseSum' => $this->model->getExpencePaySum($this->route['id']),
                'expenseNoSum' => $this->model->getExpenceNoSum($this->route['id']),
                'visibleBtnFromLastSign' => $this->model->visibleBtnFromLastSign($this->route['id'])
            ];
            $this->view->render('Детализация подотчета', $params);
        }
    }

    //получить счет один счет конкретного сотрудника
    public function stafferAction()
    {

        $projectID = $this->model->getProjectID('invoice',$this->route['id']);
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'allOrganization' => $this->model->getAllOrganization(),
            'oneStafferInvoice' => $this->model->getStafferInvoice($this->route['id']),
            'allContragents' => $this->model->getAllContragents(),//список всех контрагентов
            'lastSignInvoice' => $this->model->getOneOption('lastSignInvoice'),//получить ID последнего согласующего счета
            'addCommPartner' => $this->model->getOneOption('addCommPartner'),//получить ID пользователей для разрешения добавления
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allProjects' => $this->model->getAllProjects(), //список всех проектов
            'allUsers' => $this->model->getAllUsers(),//получить массив пользователей
            'allPosts' => $this->model->getAllPosts(), //список должностей
            'testProfit' => $this->model->testProfit($projectID),//получить рентабельность проекта
            'getCommPartners' => $this->model->getCommPartners($this->route['id'],'invoice') //список участников чата
        ];
        $this->view->render('Детализация счета сотрудника', $params);
    }

    public function editinvoiceAction()
    {
        if(!empty($_POST)){
            $this->model->editInvoice($_POST);
            if(!empty($_FILES['imgInvoice']['name'])){
                list($directorySite, $shell) = explode('app',__DIR__);
                unlink($directorySite.''.$_POST['oldFiles']);
            }
            $this->model->uploadInvoice($_POST['idInvoice']);
            $this->model->endLabelEdit($_POST['idInvoice'],'invoice');
            unset($_SESSION['mngr']['editInvoice']);
            unset($_SESSION['mngr']['idInvoice']);
            $this->view->redirect('/mngr/staffer/'.$_POST['idInvoice'].'');
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'allOrganization' => $this->model->getAllOrganization(),
            'mngrData' => $_SESSION['mngr'],
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allContragents' => $this->model->getAllContragents(),//список всех контрагентов
            'allProjects' => $this->model->getAllProjects(),//список всех проектов
            'oneInvoice' => $this->model->getStafferInvoice($this->route['id'])
        ];
        $this->view->render('Редактирование счета', $params);
    }

    public function editpayAction()
    {
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'mngrData' => $_SESSION['mngr'],
            'onePayInvoice' => $this->model->getOnePayInvoice($this->route['id']),
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allContragents' => $this->model->getAllContragents(),//список всех контрагентов
            'allProjects' => $this->model->getAllProjects(),//список всех проектов
            'profitInProject' => $this->model->getOneOption('profitInProject') //процент рентабельности
        ];
        $this->view->render('Редактирование служебки', $params);
    }

    public function analiticsAction()
    {
        $nameFromTable = '';
        $getSearchProject = '';
        $getSearchContragents = '';
        $summMoneyInvoice = '0';
        $summMoneyPay = '0';
        if(isset($this->route['project'])) {
            $getSearchProject = $this->model->getSearchProject($this->route['project']);
            $nameFromTable = $this->model->getNameProject($this->route['project']);
            $getSearch = $getSearchProject;
        }elseif(isset($this->route['contragent'])){
            $getSearchContragents = $this->model->getSearchContragent($this->route['contragent']);
            $nameFromTable = $this->model->getNameContragent($this->route['contragent']);
            $getSearch = $getSearchContragents;
        }else{
            if(!empty($_POST)){
                $getSearchProject = $this->model->getSearchProject($_POST['idProjectHidden']);
                $nameFromTable = $this->model->getNameProject($_POST['idProjectHidden']);
                $getSearch = $getSearchProject;
            }
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'allUsers' => $this->model->getAllUsers(),//получить массив пользователей
            'allDepartments' => $this->model->getAllDepartments(),//список отделов
            'getSearchProject' => $getSearchProject,
            'getSearchContragents' => $getSearchContragents,
            'summMoneyInvoice' => $summMoneyInvoice,
            'nameFromTable' => $nameFromTable,
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allContragents' => $this->model->getAllContragents(),//список всех контрагентов
            'summMoneyPay' => $summMoneyPay,
            'allProjects' => $this->model->getAllProjects(), //список всех проектов
        ];
        $this->view->render('Аналитика', $params);
    }

    public function documentAction()
    {
        $usersFromSelectInvoice = $usersFromSelectPay = [];
        $allUsers = $this->model->getAllUsers(); //получить массив пользователей
        $allowedListUsers = $this->model->allowedListUsers();//разрешенный к показу список счетов
        $allowedsInvoice = explode(",", $allowedListUsers[0]['from_invoice']);
        $allowedsPay = explode(",", $allowedListUsers[0]['from_invoicePay']);
        foreach ($allUsers as $userOne){
            foreach ($allowedsInvoice as $allowed){
                if($userOne['id']==$allowed && $userOne['adminUser']!='delete'){
                    $usersFromSelectInvoice[] = [
                        'id'=>$userOne['id'],
                        'userName'=>$userOne['userSurname'].' '.$userOne['userFirstName']
                    ];
                }
            }
            foreach ($allowedsPay as $allowedPay){
                if($userOne['id']==$allowedPay && $userOne['adminUser']!='delete'){
                    $usersFromSelectPay[] = [
                        'id'=>$userOne['id'],
                        'userName'=>$userOne['userSurname'].' '.$userOne['userFirstName']
                    ];
                }
            }
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'allOrganization' => $this->model->getAllOrganization(),
            'allInvoice' => $this->model->getAllInvoice(),//получить все счета менеджера
            'lastSignInvoice' => $this->model->getOneOption('lastSignInvoice'),//получить ID последнего согласующего счета
            'allContragents' => $this->model->getAllContragents(),//список всех контрагентов
            'allProjects' => $this->model->getAllProjects(),//список всех проектов
            'userPathAvatar' => $this->model->getPathAvatar(),
            'arrayUserPay' => $this->model->getAllPayInvoice(),
            'themeDoc' => $this->model->getThemeDoc(), //получаем темы документов
            'usersFromSelectInvoice' => $usersFromSelectInvoice,
            'usersFromSelectPay' => $usersFromSelectPay,
            'allDepartments' => $this->model->getAllDepartments(),//список отделов
            'lastSignPay' => $this->model->getOneOption('lastSignPay'),//получить ID последнего согласующего служебки
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allUsers' => $allUsers
        ];
        $this->view->render('Документы', $params);
    }

    public function underreportAction()
    {
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'underReportPay' => $this->model->getUnderReportPay(),
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allPay' => $this->model->getSumPayInvoice(),
            'expensePay' => $this->model->getSumExpencePayList()
        ];

        $this->view->render('Подотчет', $params);
    }

    function controlHoliday()
    {
        $controlHoliday = explode(",",$this->model->getOneOption('controlHoliday'));
        $userControlHoliday = false;
        foreach ($controlHoliday as $item) {
            if ($item == $_SESSION['mngr']['id']) {
                $userControlHoliday = true;
            }
        }
        return $userControlHoliday;
    }

    public function projectsAction()
    {
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'allProjects' => $this->model->getAllProjects(),
            'allSuppProjects' => $this->model->getAllSuppProjects(),
            'allContragents' => $this->model->getAllContragents(),
            'addEditContragent' => $this->model->getOneOption('addEditContragent'),//получить ID пользователей для разрешения добавления
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'profitInProject' => $this->model->getOneOption('profitInProject'), //процент рентабельности
            'getAllInvoiceSuccess' => $this->model->getAllInvoiceSuccess(),
            'getAllFavorites' => $this->model->getAllFavorites()
        ];

        $this->view->render('Проекты', $params);
    }

    public function contragentsAction()
    {
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'allContragents' => $this->model->getAllContragents(),
            'modulePay' => $this->model->getOneOption('modulePay')
        ];

        $this->view->render('Контрагенты', $params);
    }

    public function holidayAction()
    {
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'managers' => $this->model->getAllEntry(),
            'holidayAll' => $this->model->getAllHoliday(),
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
        ];

        $this->view->render('Управление отпусками', $params);
    }

    public function controlsAction()
    {
        if($this->model->getAdminUsers($_SESSION['mngr']['id'])=='false'){
            $this->view->redirect('/mngr/dashboard');
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'userPathAvatar' => $this->model->getPathAvatar(),
            'managers' => $this->model->getAllEntry(),
            'allDepartments' => $this->model->getAllDepartments(),
            'allPosts' => $this->model->getAllPosts(),
            'allOptions' => $this->model->getAllOptions(),
            'noticeSettings' => $this->model->getNoticeSettings(),
            'allCurrency' => $this->model->getAllCurrency()
        ];
        $this->view->render('Управление', $params);
    }

    public function postsAction()
    {
        if($this->model->getAdminUsers($_SESSION['mngr']['id'])=='false'){
            $this->view->redirect('/mngr/dashboard');
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allDepartments' => $this->model->getAllDepartments(),
            'allPosts' => $this->model->getAllPosts()
        ];
        $this->view->render('Список должностей',$params);
    }

    public function departmentsAction()
    {
        if($this->model->getAdminUsers($_SESSION['mngr']['id'])=='false'){
            $this->view->redirect('/mngr/dashboard');
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allUsers' => $this->model->getAllUsers(),//получить массив пользователей
            'allDepartments' => $this->model->getAllDepartments()
        ];
        $this->view->render('Список отделов',$params);
    }

    public function crushtestsAction()
    {
        if($this->model->getAdminUsers($_SESSION['mngr']['id'])=='false'){
            $this->view->redirect('/mngr/dashboard');
        }
        $params = [
            'defaultDownload' => $this->defaultDownload()
        ];
        $this->view->render('Тестирование работы приложения',$params);
    }

    public function organizationAction()
    {
        if($this->model->getAdminUsers($_SESSION['mngr']['id'])=='false'){
            $this->view->redirect('/mngr/dashboard');
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allOrganization' => $this->model->getAllOrganization()
        ];
        $this->view->render('Список организаций',$params);
    }

    public function usersAction()
    {
        if($this->model->getAdminUsers($_SESSION['mngr']['id'])=='false'){
            $this->view->redirect('/mngr/dashboard');
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'managers' => $this->model->getAllEntry(),
            'allDepartments' => $this->model->getAllDepartments(),
            'allPosts' => $this->model->getAllPosts()
        ];
        $this->view->render('Таблица пользователей', $params);
    }

    public function editAction()
    {
        if($this->model->getAdminUsers($_SESSION['mngr']['id'])=='false'){
            $this->view->redirect('/mngr/dashboard');
        }
        if (!$this->model->isEntryExists($this->route['id'])) {
            $this->view->errorCode(404);
        }

        if (!empty($_POST)) {
            $this->model->editEntry($this->route['id']);
            $this->view->redirect('/mngr/users');
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'modulePay' => $this->model->getOneOption('modulePay'), //Модуль наличка
            'allDepartments' => $this->model->getAllDepartments(),
            'allPosts' => $this->model->getAllPosts(),
            'data' => $this->model->getOneEntry($this->route['id'])[0]
        ];
        $this->view->render('Редактировать учетную запись', $params);
    }

    public function alertusersAction()
    {
        if($this->model->getAdminUsers($_SESSION['mngr']['id'])=='false'){
            $this->view->redirect('/mngr/dashboard');
        }
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'managers' => $this->model->getAllEntry(),
            'allDepartments' => $this->model->getAllDepartments()
        ];
        $this->view->render('Оповещение пользователей', $params);
    }
}