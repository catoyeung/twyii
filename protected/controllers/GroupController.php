<?php

class GroupController extends Controller
{
  public function actionIndex()
  {
    $search_text = isset($_GET['search_text']) ? $_GET['search_text'] : '';
    $criteria = new CDbCriteria();
    if(strlen($search_text) > 0)
    {
      $criteria->addSearchCondition( 'groupname', $search_text, true, 'OR' );
    }

    $dataProvider=new CActiveDataProvider(
      GroupModel::model(),
      array(
        'id'=>'groupid',
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
      $model = new GroupModel();
      $this->render('create',array(
        'model'=>$model,
      ));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(isset($_POST['GroupModel']))
      {
        $model = new GroupModel();
        $model->attributes = $_POST['GroupModel'];
        if (!$model->validate()) {
          $this->render('create',array(
            'model'=>$model
          ));
          return;
        }
        $model->save();
        foreach($_POST['members'] as $member_id)
        {
          $user2model =
        }
        $this->redirect(array('index'));
      }
    }
  }
}
