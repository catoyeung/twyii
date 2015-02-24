<?php

class EventModel extends ExtendedEntity
{
  public $entityid;
  public $subject;
  public $assigned_to;
  public $description;
  public $from_datetime;
  public $to_datetime;


  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'tbl_event';
  }

  public function rules()
  {
    $myRules = array(
      array('entityid', 'numerical', 'integerOnly'=>true),
      array('subject', 'required'),
      array('description', 'safe'),
      array('assigned_to', 'safe'),
      array('from_datetime', 'required'),
      array('from_datetime', 'date', 'format'=>'yyyy-MM-dd HH:mm:ss'),
      array('to_datetime', 'required'),
      array('to_datetime', 'date', 'format'=>'yyyy-MM-dd HH:mm:ss')
    );
    return $myRules;
  }

  public function relations()
  {
    return array('entity'=>array(self::BELONGS_TO, 'Entity', 'entityid'));
  }

  public function getEventsInCalendarFormat()
  {
    $events = EventModel::model()->with('entity')->findAll('assigned_to='.Yii::app()->user->getId());
    $events_in_calendar_format = array();
    foreach ($events as $event){
      array_push($events_in_calendar_format,
        array(
          'id'=>$event->entityid,
          'title'=>$event->subject,
          'assigned_to'=>$event->entity->assigned_to,
          'description'=>$event->description,
          'start'=>DateTime::createFromFormat('Y-m-d H:i:s', $event->from_datetime)->format('Y-m-d\TH:i:00'),
          'end'=>DateTime::createFromFormat('Y-m-d H:i:s', $event->to_datetime)->format('Y-m-d\TH:i:00')
        )
      );
    }

    return $events_in_calendar_format;
  }

  public function delete()
  {
    $entity = Entity::model()->findByPk($this->entityid);
    $entity->setAttribute('deleted', true);
    $result = $entity->save();
    return $result;
  }
}
