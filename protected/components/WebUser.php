<?php

class WebUser extends CWebUser {
  public function getGroup()
  {
    if($this->getId()){
      $user_model = UserModel::model()->findByPk($this->getId());
      return $user_model->groups[0];
    } else {
      throw new Exception("Please log in before getting user's organisation");
    }

  }
}
?>
