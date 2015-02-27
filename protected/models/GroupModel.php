<?php

class GroupModel extends CActiveRecord
{
	public $groupid;
	public $groupname;
	public $label;
	public $active;
	public $created_at;
	public $modified_at;


	const CLASSIFICATION = 'group';

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
			array('groupid', 'safe'),
      array('groupname', 'required'),
      array('groupname', 'length', 'min'=>3, 'max'=>128),
      array('active', 'required'),
			array('deleted', 'default', 'value'=>0),
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
        'users'=>array(self::MANY_MANY, 'UserModel', 'tbl_group2user(groupid, userid)')
    );
  }

	public function delete()
  {
    $this->setAttribute('deleted', 1);
    $result = $this->save();
    return $result;
  }
}
