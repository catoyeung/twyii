<?php

class UserController extends Controller
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
      $criteria2->addSearchCondition( 'username', $search_text, true, 'OR' );
      $criteria2->addSearchCondition( 'useremail', $search_text, true, 'OR' );
      $criteria->mergeWith($criteria2, 'AND');
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

  public function actionUpdate($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
      $model = UserModel::model()->findByPk($id);
      $this->render('update',array(
        'model'=>$model,
      ));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $model = UserModel::model()->findByPk($id);
      $model->setAttributes($_POST['UserModel']);
			if($model->validate()){
				$model->save();
				$this->redirect(array('index'));
			} else {
				$popup_message = array(
					'type'=>'error',
					'message'=>$model->getErrors()
				);
				$this->popup_message = $popup_message;
				$this->render('index');
			}
    }
  }

  public function actionDelete()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = UserModel::model()->findByPk($_POST['id']);
			if($model->delete()){
				$this->redirect(array('index'));
			} else {
				$this->render('//site/error', $model->getErrors());
			}
		}
	}
}
