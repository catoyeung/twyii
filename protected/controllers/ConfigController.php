<?php

class ConfigController extends Controller
{
  public function actionIndex()
  {
    $this->redirect(Yii::app()->createUrl('user/index'));
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
