<?php


namespace app\interfaces;


interface IUserController
{
	public function actionTry() :void;
	public function actionForm() :void;
	public function actionRegister() :void;
	public function actionLogout() :void;
}