<?php

class EvenInquiryController extends Controller
{
  public function actionIndex()
  {
    $search_text = isset($_GET['search_text']) ? $_GET['search_text'] : '';
    $criteria = new CDbCriteria();
    // filter deleted records
    $criteria->with = array('entity');
    $criteria->compare( 'entity.deleted', 0, false, 'AND' );
    if(strlen($search_text) > 0)
    {
      $criteria2 = new CDbCriteria();
      $criteria2->addSearchCondition( 'inquirer_name', $search_text, true, 'OR' );
      $criteria2->addSearchCondition( 'inquirer_phone', $search_text, true, 'OR' );
      $criteria2->addSearchCondition( 'gambler_name', $search_text, true, 'OR' );
      $criteria2->addSearchCondition( 'gambler_phone', $search_text, true, 'OR' );
      $criteria->mergeWith($criteria2, 'AND');
    }

    $dataProvider=new CActiveDataProvider(
      EvenInquiryModel::model(),
      array(
        'id'=>'entityid',
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
      $model = new EvenInquiryModel();
      $this->render('create',array(
        'model'=>$model,
      ));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

      if(isset($_POST['EvenInquiryModel']))
      {
        $model = new EvenInquiryModel();
        $model->attributes = $_POST['EvenInquiryModel'];
        if (!$model->validate()) {
          $this->render('create',array(
            'model'=>$model
          ));
          return;
        }
        if($model->save())
          $this->redirect(array('detail/'.$model->entityid));
      }
    }
  }

  public function actionDetail($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
      $model = EvenInquiryModel::model()->findByPk($id);
      $this->render('detail',array(
        'model'=>$model,
      ));
    }
  }

  public function actionUpdate($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
      $model = EvenInquiryModel::model()->findByPk($id);
      $this->render('update',array(
        'model'=>$model,
      ));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(isset($_POST['EvenInquiryModel']))
      {
        $model = EvenInquiryModel::model()->findByPk($id);
        $model->attributes = $_POST['EvenInquiryModel'];
        if (!$model->validate()) {
          $this->render('update',array(
            'model'=>$model
          ));
          return;
        }
        if($model->save())
          $this->redirect(array('eveninquiry/detail/'.$model->entityid));
      }
    }
  }
}
