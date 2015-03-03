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
      array('to_datetime', 'required'),
      //array('to_datetime', 'fromToDateTimeRange'),
    );
    return $myRules;
  }

  /*public function fromToDateTimeRange($to_datetime,$params)
  {
    $to_datetime_object = DateTime::createFromFormat('YYYY/MM/dd HH:ii:ss', $to_datetime);
    $from_datetime_object = DateTime::createFromFormat('YYYY/MM/dd HH:ii:ss', $this->from_datetime);
    if ($from_datetime_object > $to_datetime_object) $this->addError($to_datetime, "事件開始時間必須小於結束時間");
  }*/

  public function relations()
  {
    return array('entity'=>array(self::BELONGS_TO, 'Entity', 'entityid'));
  }

  public function getEventsInCalendarFormat()
  {
    $events = EventModel::model()->with('entity')->findAll('assigned_to='.Yii::app()->user->getId().' AND deleted=FALSE');
    /*$events = EventModel::model()->with('entity')->findAllByAttributes(
    array('entity.assigned_to'=>Yii::app()->user->getId(),
      'deleted'=>false));*/
    $events_in_calendar_format = array();
    foreach ($events as $event){
      array_push($events_in_calendar_format,
        array(
          'id'=>$event->entityid,
          'title'=>$event->subject,
          'assigned_to'=>$event->entity->assigned_to,
          'description'=>$event->description,
          'start'=>$event->from_datetime,
          'end'=>$event->to_datetime
        )
      );
    }

    return $events_in_calendar_format;
  }

}
