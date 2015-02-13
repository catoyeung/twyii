<?php

class ExtendedEntity extends Entity
{
  public function beforeSave()
  {
    return parent::save();
  }
}
