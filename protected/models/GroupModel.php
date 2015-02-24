<?php

class GroupModel extends CActiveRecord
{
	public $groupid;
	public $groupname;
	public $active;
	public $created_at;
	public $modified_at;

	public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'tbl_group';
  }

	public function rules()
	{
		return array(
			array('groupid', 'required'),
      array('groupname', 'required'),
      array('groupname', 'length', 'min'=>3, 'max'=>128),
      array('active', 'required'),
			array('created_at,modified_at','default',
					'value'=>new CDbExpression('NOW()'),
					'setOnEmpty'=>false,'on'=>'insert'),
			array('modified_at','default',
							'value'=>new CDbExpression('NOW()'),
							'setOnEmpty'=>false,'on'=>'update')
		);
	}
  public function relations()
  {
    return array(
        'members'=>array(self::MANY_MANY, 'UserModel', 'tbl_group2user(groupid, userid)')
    );
  }
}
