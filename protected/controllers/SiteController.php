<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionCreate()
	{
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	public function actionLogin()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$this->render('login');
		} else if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$identity = new UserIdentity($username, $password);
			if($identity->authenticate())
			{
				Yii::app()->user->login($identity);
				$this->redirect(Yii::app()->homeUrl);
			} else {
				$popup_message = array(
					'type'=>'error',
					'message'=>'登入名稱及密碼不正確。'
				);
				$this->popup_message = $popup_message;
				$this->render('login');
			}
		}
	}
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
