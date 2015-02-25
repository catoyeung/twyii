<?php

class ExtendedAssignedTo extends CActiveRecord
{
  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  public function afterSave()
  {
    $entity = new AssignedTo();
    if ($this::CLASSIFICATION == 'user') {
      $entity->setAttributes(
        array(
          'user_or_group_id'=>$this->userid,
          'u_or_g'=>'user'
        )
      );
    } else if ($this::CLASSIFICATION == 'group') {
      $entity->setAttributes(
        array(
          'user_or_group_id'=>$this->groupid,
          'u_or_g'=>'group'
        )
      );
    }
    $result = $entity->save();
    return $result;
  }

  /*public function delete()
  {
    if ($this::CLASSIFICATION == 'user') {
      $entityid = $this->userid;
    } else if ($this::CLASSIFICATION == 'group') {
      $entityid = $this->groupid;
    }
    $entity = AssignedTo::model()->findByPk($entityid);
    $entity->setAttribute('deleted', true);
    $result = $entity->save();
    return $result;
  }*/
}
