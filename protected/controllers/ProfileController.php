<?php

class ProfileController extends Controller
{
  public function actionIndex()
  {
    $cpanel = $this->renderPartial('//config/cpanel',
      array('module'=>'profile'),
      true);

    $this->render('index', array('cpanel'=>$cpanel));
  }

  public function actionCreate()
  {
    $cpanel = $this->renderPartial('//config/cpanel',
      array('module'=>'profile'), 
      true);

    $this->render('create', array('cpanel'=>$cpanel));
  }

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
}
