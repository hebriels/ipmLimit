<?php
/**
 * Created by PhpStorm.
 * User: Slava
 * Date: 19.04.2018
 * Time: 19:59
 */

namespace app\controllers;

use app\core\Controller;


class AdminController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }

    public function loginAction()
    {
        if(!empty($_POST)){
            if(!$this->model->loginValidate()){
                $this->view->message('Incorrect login information', $this->model->err);
                $this->view->redirect('/admin/login');
            }
            $_SESSION['admin'] = true;
            $this->view->location('/admin/table');
        }

        if (isset($_SESSION['admin'])) {
            $this->view->location('/admin/table');
        }
        $params = [
            'imageLogo' => $this->model->getOneOption('imageLogo') //Логотип
        ];
        $this->view->render('Вход',$params);
    
    }

    public function logoutAction()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('/admin/login');
    }

    public function addAction()
    {
       if(!empty($_POST)){
            if(!$this->model->postValidate('add')){
                $this->view->message('error', $this->model->err);
            }
            $id = $this->model->addEntry($_POST);
            $this->model->addNoticeSettings($id);
            if(!$id){
                $this->view->message('error', 'no ADD entry');
            }
            //$this->model->createTable();
            $this->view->location('/admin/controls');
        }
        $params = [
            'imageLogo' => $this->model->getOneOption('imageLogo'), //Логотип
            'allDepartments' => $this->model->getAllDepartments(),
            'allPosts' => $this->model->getAllPosts()
        ];
        $this->view->render('Добавить пользователя',$params);

    }

    public function tableAction()
    {
         $params = [
             'imageLogo' => $this->model->getOneOption('imageLogo'), //Логотип
             'managers' => $this->model->getAllEntry(),
             'allDepartments' => $this->model->getAllDepartments(),
             'allPosts' => $this->model->getAllPosts()
         ];
        //передаем данные во вью (это будет $managers в index.php)
        $this->view->render('Таблица пользователей', $params);
       
    }

    public function controlsAction()
    {
        $params = [
            'imageLogo' => $this->model->getOneOption('imageLogo'), //Логотип
            'managers' => $this->model->getAllEntry(),
            'allDepartments' => $this->model->getAllDepartments(),
            'allPosts' => $this->model->getAllPosts(),
            'allOptions' => $this->model->getAllOptions(),
            'noticeSettings' => $this->model->getNoticeSettings(),
            'allCurrency' => $this->model->getAllCurrency()
        ];
        $this->view->render('Управление', $params);
    }

    public function departmentsAction()
    {
        $params = [
            'imageLogo' => $this->model->getOneOption('imageLogo'), //Логотип
            'allDepartments' => $this->model->getAllDepartments()
        ];
        $this->view->render('Список отделов',$params);

    }

    public function postsAction()
    {
        $params = [
            'imageLogo' => $this->model->getOneOption('imageLogo'), //Логотип
            'allDepartments' => $this->model->getAllDepartments(),
            'allPosts' => $this->model->getAllPosts()
        ];
        $this->view->render('Список должностей',$params);

    }

    public function organizationAction()
    {
        $params = [
            'imageLogo' => $this->model->getOneOption('imageLogo'), //Логотип
            'allOrganization' => $this->model->getAllOrganization()
        ];
        $this->view->render('Список организаций',$params);

    }

    public function editAction()
    {
        if (!$this->model->isEntryExists($this->route['id'])) {
            $this->view->errorCode(404);
        }

        if (!empty($_POST)) {
            if (!$this->model->postValidate($_POST, 'edit')) {
                $this->view->message('error', $this->model->error);
            }
            $this->model->editEntry($this->route['id']);
            //$this->view->message('success', 'Сохранено');

            $this->view->location('/admin/table');
        }
        $params = [
            'imageLogo' => $this->model->getOneOption('imageLogo'), //Логотип
            'allDepartments' => $this->model->getAllDepartments(),
            'allPosts' => $this->model->getAllPosts(),
            'data' => $this->model->getOneEntry($this->route['id'])[0]
        ];
        $this->view->render('Редактировать учетную запись', $params);
    }

    public function delAction()
    {
        $this->model->postDelete($this->route['id']);
        $this->view->redirect('/admin/table');
    }
}