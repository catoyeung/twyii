<?php

class CalendarController extends Controller
{
	public function actionIndex()
	{
		$assigned_to_users = AssignedToModel::model()->findAll();
		$events = EventModel::model()->getEventsInCalendarFormat();
		$this->render('index',
			array(
				'assigned_to_users'=>$assigned_to_users,
				'events'=>$events
			)
		);
	}

	public function actionCreateEvent()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new EventModel();
			$model->setAttributes(array(
				'subject'=>$_POST['subject'],
				'description'=>$_POST['description'],
				'assigned_to'=>(int)$_POST['assigned_to'],
				'from_datetime'=>DateTime::createFromFormat('m/d/Y H:i', $_POST['start_date'].' '.$_POST['start_time'])->format('Y-m-d H:i:00'),
				'to_datetime'=>DateTime::createFromFormat('m/d/Y H:i', $_POST['end_date'].' '.$_POST['end_time'])->format('Y-m-d H:i:00')
			));
			if($model->validate()){
				$model->save();
				$this->redirect('index');
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

	public function actionEditEvent()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = EventModel::model()->findByPk($_POST['id']);
			$model->setAttributes(array(
				'subject'=>$_POST['subject'],
				'description'=>$_POST['description'],
				'assigned_to'=>(int)$_POST['assigned_to'],
				'from_datetime'=>DateTime::createFromFormat('m/d/Y H:i', $_POST['start_date'].' '.$_POST['start_time'])->format('Y-m-d H:i:00'),
				'to_datetime'=>DateTime::createFromFormat('m/d/Y H:i', $_POST['end_date'].' '.$_POST['end_time'])->format('Y-m-d H:i:00')
			));
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

	public function actionDeleteEvent()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = EventModel::model()->findByPk($_POST['id']);
			if($model->delete()){
				$this->redirect(array('index'));
			} else {
				$this->render('error', $error);
			}
		}
	}
}
