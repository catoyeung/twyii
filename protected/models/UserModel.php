<?php

class UserModel extends ExtendedAssignedTo
{
	public $userid;
	public $username;
	public $userpassword;
	public $useremail;
	public $usersalt;
	public $active;
	public $is_admin;
	public $created_at;
	public $modified_at;

	public $initial_password;
	public $register_password;
	public $confirm_register_password;

	const ERROR_USERNAME_INVALID = 1;
	const ERROR_PASSWORD_INVALID = 2;
	const ERROR_NONE = 0;

	const CLASSIFICATION = 'user';

	public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'tbl_user';
  }

	public function rules()
	{
		return array(
			array('username, useremail, active, is_admin', 'required'),
			array('register_password, confirm_register_password', 'required', 'on' => 'insert'),
			array('register_password, confirm_register_password', 'length', 'min'=>'6', 'max'=>40),
			array('username', 'length', 'min'=>3, 'max'=>128),
			array('useremail', 'email'),
			array('confirm_register_password', 'compare', 'compareAttribute'=>'register_password', 'on'=>'insert'),
			array('created_at,modified_at','default',
					'value'=>new CDbExpression('NOW()'),
					'setOnEmpty'=>false,'on'=>'insert'),
			array('modified_at','default',
							'value'=>new CDbExpression('NOW()'),
							'setOnEmpty'=>false,'on'=>'update')
		);
	}

	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->userpassword);
	}

	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}

	public function register()
	{
		$this->userpassword = $this->hashPassword($this->register_password);
		return $this->save();
	}

	public function relations()
  {
    return array(
        'groups'=>array(self::MANY_MANY, 'Group', 'tbl_group2user(userid, groupid)'),
				'assigned_to'=>array(self::BELONGS_TO, 'AssignedTo', 'assigned_to_id')
    );
  }

	public function delete()
  {
    $this->setAttribute('deleted', true);
    $result = $this->save();
    return $result;
  }
}
