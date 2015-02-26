<?php

class Entity extends CActiveRecord
{
  public $entityid;
  public $label;
  public $assigned_to;
  public $description;
  public $created_by;
  public $created_at;
  public $modified_at;
  public $deleted;

  public function tableName()
  {
    return 'tbl_entity';
  }

  public function rules()
  {
    return array(
          array('entityid','safe'),
          array('label','length', 'max'=>50),
          array('description', 'safe'),
          array('assigned_to','numerical','integerOnly'=>true),
          array('assigned_to','required'),
          array('created_by','default','value'=>Yii::app()->user->getId()),
          array('created_at,modified_at','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'insert'),
          array('modified_at','default',
                  'value'=>new CDbExpression('NOW()'),
                  'setOnEmpty'=>false,'on'=>'update'),
          array('deleted', 'default', 'value'=>0)
    );
  }

  public function relations()
  {
    return array(
      'event'=>array(self::HAS_ONE, 'EventModel', 'entityid'),
      'eveninquiry'=>array(self::HAS_ONE, 'EvenInquiryModel', 'entityid')
    );
  }

  public static function model($className=__CLASS__) {
    return parent::model($className);
  }
}
