<?php

class RoleController extends Controller
{
  public function actionIndex()
  {
    $role_model = new RoleModel();
    $roles_tree = $role_model->getRoleTree();

    $this->render('index', array(
          'roles_tree'=>$roles_tree));
  }

  public function actionCreate()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
      $model = new RoleModel();
      $this->render('create',array(
        'model'=>$model,
      ));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(isset($_POST['RoleModel']))
      {
        $model = new RoleModel();
        $model->attributes=$_POST['RoleModel'];
        if($model->save())
          $this->redirect(array('index'));
      }
    }
  }

  public function actionUpdate($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
      $model = RoleModel::model()->findByPk($id);
      $this->render('update',array(
        'model'=>$model,
      ));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $model=$this->loadModel($id);
      if(isset($_POST['RoleModel']))
      {
        $model->attributes=$_POST['RoleModel'];
        if($model->save())
          $this->redirect(array('index'));
      }
    }
  }

  public function actionDelete()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $model=$this->loadModel($id);
      if($model->delete()) {
        echo true;
      } else {
        echo false;
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

  public function loadModel($id)
  {
    $model=RoleModel::model()->findByPk($id);
    if($model===null)
      throw new CHttpException(404,'The requested page does not exist.');
    return $model;
  }
}
