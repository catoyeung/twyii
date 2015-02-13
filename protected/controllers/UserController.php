<?php

class UserController extends Controller
{
  public function actionIndex()
  {
    //$models = UserModel::model()->findAll();
    //$this->render('index', array('models'=>$models));
    $dataProvider=new CActiveDataProvider(UserModel::model());
    $this->render('index',array(
      'dataProvider'=>$dataProvider,
    ));
  }

  public function actionCreate()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
      $model = new UserModel();
      $this->render('create',array(
        'model'=>$model,
      ));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(isset($_POST['UserModel']))
      {
        $model = new UserModel();
        $model->attributes = $_POST['UserModel'];
        if($model->register())
          $this->redirect(array('index'));
      }
    }
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
