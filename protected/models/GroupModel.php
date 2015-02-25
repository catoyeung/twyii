<?php

class GroupModel extends ExtendedAssignedTo
{
	public $groupid;
	public $groupname;
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
        'members'=>array(self::MANY_MANY, 'UserModel', 'tbl_group2user(groupid, userid)'),
				'assigned_to'=>array(self::BELONGS_TO, 'AssignedTo', 'assigned_to_id')
    );
  }

	public function delete()
  {
    $this->setAttribute('deleted', 1);
    $result = $this->save();
    return $result;
  }
}
