<?php

class Group2UserModel extends CActiveRecord
{
	public $groupid;
  public $userid;

	public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'tbl_group2user';
  }

	public function rules()
	{
		return array(
			array('groupid', 'required'),
      array('userid', 'required')
		);
	}

  
}
