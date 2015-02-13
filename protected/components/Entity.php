<?php

class Entity extends CActiveRecord
{
  protected $entityid;
  protected $label;
  protected $description;
  protected $assigned_to;
  protected $created_by;
  protected $created_at;
  protected $modified_at;
  protected $deleted;

  public function tableName()
  {
    return 'tbl_entity';
  }

  public function rules()
  {
    return array(
          array('label','length', 'max'=>50),
          array('assigned_to','required'=>true),
          array('assigned_to','integerOnly'=>true),
          array('created_by','required'=>true),
          array('created_by','integerOnly'=>true),
          array('created_at,modified_at','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'insert'),
          array('modified_at','default',
                  'value'=>new CDbExpression('NOW()'),
                  'setOnEmpty'=>false,'on'=>'update')
    );
  }
}
