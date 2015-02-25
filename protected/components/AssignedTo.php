<?php

class AssignedTo extends CActiveRecord
{
  public $assigned_to_id;
  public $user_or_group_id;
  public $u_or_g;

  public function tableName()
  {
    return 'tbl_assigned_to';
  }

  public function rules()
  {
    return array(
          array('assigned_to_id','safe'),
          array('user_or_group_id','numerical','integerOnly'=>true),
          array('user_or_group_id','required'),
          array('u_or_g','required'),
          array('u_or_g','in','range'=>array('user', 'group'))
    );
  }

  public function relations()
  {
    return array(
      'user'=>array(self::HAS_ONE, 'UserModel', 'userid'),
      'group'=>array(self::HAS_ONE, 'GroupModel', 'groupid')
    );
  }

  public static function model($className=__CLASS__) {
    return parent::model($className);
  }
}
