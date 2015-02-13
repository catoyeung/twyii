<?php
class UserIdentity extends CUserIdentity
{
	private $_id;

	public function authenticate()
	{
		$record=UserModel::model()->findByAttributes(array('username'=>$this->username));

    if($record===null)
		{
      $this->errorCode=self::ERROR_USERNAME_INVALID;

		}
  	else if(!$record->validatePassword($this->password))
		{
      $this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
    else
    {
			$this->_id=$record->userid;
			$this->setState('userid', $record->userid);
      $this->errorCode=self::ERROR_NONE;
    }
    return !$this->errorCode;
	}

	public function getId()
    {
        return $this->_id;
    }
}
