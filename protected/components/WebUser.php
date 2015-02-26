<?php

class WebUser extends CWebUser {
  public function getOrganisation()
  {
    if($this->getId()){
      $user_model = UserModel::model()->findByPk($this->getId());
      return $user_model->organisation;
    } else {
      throw new Exception("Please log in before getting user's organisation");
    }

  }
}
?>
