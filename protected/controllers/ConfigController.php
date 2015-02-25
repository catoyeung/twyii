<?php

class ConfigController extends Controller
{
  public function actionIndex()
  {
    $this->redirect(Yii::app()->createUrl('user/index'));
  }
}
