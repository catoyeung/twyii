<?php

class ExtendedEntity extends CActiveRecord
{
  public $assigned_to;
  public $created_by;
  public $created_at;
  public $modified_at;
  public $deleted;

  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  protected function beforeSave()
  {
    if ($this->isNewRecord){
      $entity = new Entity();
    } else {
      $entity = Entity::model()->findByPk($this->entityid);
    }

    $entity->setAttributes($this->getAttributes());
    $entity->setAttribute('assigned_to', $this->assigned_to);
    $entity->setAttribute('created_by', Yii::app()->user->getId());
    $entity->setAttribute('created_at', $this->created_at);
    $entity->setAttribute('modified_at', $this->modified_at);
    $entity->setAttribute('deleted', $this->deleted);
    $result = $entity->save();
    $this->entityid = $entity->entityid;
    return $result;
  }

  public function delete()
  {
    $entity = Entity::model()->findByPk($this->entityid);
    $entity->setAttribute('deleted', true);
    $result = $entity->save();
    return $result;
  }

  protected function afterFind()
  {
    parent::afterFind();
    $entity = Entity::model()->findByPk($this->entityid);
    $this->assigned_to = $entity->assigned_to;
    $this->created_by = $entity->created_by;
    $this->created_at = $entity->created_at;
    $this->modified_at = $entity->modified_at;
    $this->deleted = $entity->deleted;
  }
}
