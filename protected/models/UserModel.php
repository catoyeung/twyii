<?php

class UserModel extends CActiveRecord
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
			array('confirm_register_password', 'compare', 'compareAttribute'=>'register_password', 'on'=>'insert'),
			array('created_at,modified_at','default',
					'value'=>new CDbExpression('NOW()'),
					'setOnEmpty'=>false,'on'=>'insert'),
			array('modified_at','default',
							'value'=>new CDbExpression('NOW()'),
							'setOnEmpty'=>false,'on'=>'update')
		);
	}

	/* reference to http://www.yiiframework.com/wiki/277/model-password-confirmation-field/ */
	/*public function beforeSave()
	{
		if(empty($this->register_password) && empty($this->confirm_register_password) && !empty($this->initial_password))
			$this->register_password=$this->confirm_register_password=$this->initial_password;

		return parent::beforeSave();
	}*/

	/*public function afterFind()
	{
		$this->initial_password = $this->userpassword;
		$this->userpassword = null;

		parent::afterFind();
	}*/

	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->userpassword);
	}

	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}

	/*public static function authenticate($username, $password)
	{
		$record=UserModel::model()->findByAttributes(array('username'=>$username));
  	if($record===null)
		{
      $errorCode=self::ERROR_USERNAME_INVALID;

		}
    else if(!$record->validatePassword($password))
		{
      $errorCode=self::ERROR_PASSWORD_INVALID;
		}
    else
    {
			Yii::app()->session['logged_in_userid'] = $record->userid;
      $errorCode=self::ERROR_NONE;
    }
    return !$errorCode;
	}

	public static function isGuest()
	{
		return !isset(Yii::app()->session['logged_in_userid']);
	}

	public static function loggedInUser()
	{
		return self::model()->findByAttributes(array('userid'=>Yii::app()->session['logged_in_userid']));
	}

	public static function logout()
	{
		unset(Yii::app()->session['logged_in_userid']);
	}*/

	public function register()
	{
		$this->userpassword = $this->hashPassword($this->register_password);
		return $this->save();
	}
}
