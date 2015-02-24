<?php

class UserController extends Controller
{
  public function actionIndex()
  {
    $search_text = isset($_GET['search_text']) ? $_GET['search_text'] : '';
    $criteria = new CDbCriteria();
    if(strlen($search_text) > 0)
    {
      $criteria->addSearchCondition( 'username', $search_text, true, 'OR' );
      $criteria->addSearchCondition( 'useremail', $search_text, true, 'OR' );
    }


    $dataProvider=new CActiveDataProvider(
      UserModel::model(),
      array(
        'id'=>'userid',
        'pagination'=>array(
          'pageSize'=>10
        ),
        'criteria'=>$criteria
      )
    );
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
        if (!$model->validate()) {
          $this->render('create',array(
            'model'=>$model
          ));
          return;
        }
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
