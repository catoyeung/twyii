<?php

class GroupController extends Controller
{
  public function actionIndex()
  {
    $search_text = isset($_GET['search_text']) ? $_GET['search_text'] : '';
    $criteria = new CDbCriteria();
    // filter deleted records
    $criteria->compare( 'deleted', 0, false, 'AND' );
    if(strlen($search_text) > 0)
    {
      $criteria2 = new CDbCriteria();
      $criteria2->addSearchCondition( 'groupname', $search_text, true, 'OR' );
      $criteria->mergeWith($criteria2, 'AND');
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
        /* start of transaction */
        $connection=Yii::app()->db;
        $transaction=$connection->beginTransaction();
        try
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
          foreach($_POST['GroupModel']['members'] as $member_id)
          {
            $group2user_model = new Group2UserModel();
            $group2user_model->groupid = $model->groupid;
            $group2user_model->userid = $member_id;
            if (!$group2user_model->validate()) {
              $this->render('//site/error', $group2user_model->getErrors());
              return;
            }
            $group2user_model->save();
          }
          $transaction->commit();
        }
        catch(Exception $e)
        {
           $transaction->rollback();
        }
        $this->redirect(array('index'));
      }
    }
  }

  public function actionUpdate($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
      $model = GroupModel::model()->findByPk($id);
      $this->render('update',array(
        'model'=>$model,
      ));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(isset($_POST['GroupModel']))
      {
        /* start of transaction */
        $connection=Yii::app()->db;
        $transaction=$connection->beginTransaction();
        try
        {
          $model = GroupModel::model()->findByPk($id);
          $model->attributes = $_POST['GroupModel'];
          if (!$model->validate()) {
            $this->render('//site/error', $model->getErrors());
            return;
          }
          $model->save();
          // clean old group members data
          Group2UserModel::model()->deleteAllByAttributes(
            array('groupid'=>$model->groupid)
          );
          foreach($_POST['GroupModel']['members'] as $member_id)
          {
            $group2user_model = new Group2UserModel();
            $group2user_model->groupid = $model->groupid;
            $group2user_model->userid = $member_id;
            if (!$group2user_model->validate()) {
              $this->render('//site/error', $group2user_model->getErrors());
              return;
            }
            $group2user_model->save();
          }
          $transaction->commit();
        }
        catch(Exception $e)
        {
           $transaction->rollback();
        }
        $this->redirect(array('index'));
      }
    }
  }

  public function actionDelete()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = GroupModel::model()->findByPk($_POST['groupid']);
			if($model->delete()){
				$this->redirect(array('index'));
			} else {
				$this->render('error', $error);
			}
		}
	}
}
