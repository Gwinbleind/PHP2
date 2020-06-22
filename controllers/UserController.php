<?php


namespace app\controllers;


use app\models\User;
use app\traits\TSingletonController;

class UserController extends Controller
{
    use TSingletonController;
    protected $defaultAction = 'info';

    public function actionInfo() {
        $login = $_GET['login'];
        $pass = $_GET['pass'];
        /** @var User $user */
        $user = User::getRowByProperty('login',$login);
        $user->pass = $pass;
        $this->params['user'] = $user;
        $this->params['menu'] = $this->menu;
        $this->params['links'] = $this->links;
        $this->params['scripts'] = $this->scripts;
        echo $this->actionRenderLayout('user',$this->params);
    }
    public function actionRegister() {

    }
    public function actionLogin() {
        $login = $_GET['login'];
        $pass = $_GET['pass'];
        /** @var User $user */
        $user = User::getRowByProperty('login',$login);
        $user->pass = $pass;
        $user->validation();
    }
    public function actionLogout() {

    }
}