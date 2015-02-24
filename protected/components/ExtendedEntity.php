<?php

class ExtendedEntity extends CActiveRecord
{
  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  public function beforeSave()
  {
    if ($this->isNewRecord){
      $entity = new Entity();
    } else {
      $entity = Entity::model()->findByPk($this->entityid);
    }
    $entity->setAttributes($this->getAttributes());
    $entity->setAttribute('assigned_to', $this->assigned_to);
    $result = $entity->save();
    $this->entityid = $entity->entityid;
    return $result;
  }
}
