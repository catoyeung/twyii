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
}
