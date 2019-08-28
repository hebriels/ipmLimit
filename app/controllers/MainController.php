<?php
/**
 * Created by PhpStorm.
 * User: Slava
 * Date: 10.04.2018
 * Time: 19:22
 */

namespace app\controllers;

use app\core\Controller;

use app\lib\Db;

class MainController extends Controller
{
    function defaultDownload(){
        $defaultLoad = [
            'imageLogo' => $this->model->getOneOption('imageLogo'), //Логотип
            'currencyGeneral' => $this->model->getOneOption('currencyGeneral'), //Валюта по умолчанию
            'timezone' => $this->model->getTimezone(), //timezone
        ];
        return $defaultLoad;
    }

    public function indexAction()
    {
        $params = [
            'defaultDownload' => $this->defaultDownload(),
            'users' => $this->model->getAllEntry()
        ];
        $this->view->render('Главная страница', $params);
    }

}