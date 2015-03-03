<?php

class AssignedToModel
{
  public $assigned_to;
  public $display_name;
  public $group;

  public static function model($className=__CLASS__) {
    return new $className();
  }

  public function findAll()
  {
    $users = UserModel::model()->findAll();
    $groups = GroupModel::model()->findAll();

    $return = array();
    // Merge user & groups
    foreach ($users as $user)
    {
      $model = new AssignedToModel();
      $model->assigned_to = $user->userid;
      $model->display_name = $user->display_name;
      $model->group = '使用者';
      $return[] = $model;
    }
    foreach ($groups as $group)
    {
      $model = new AssignedToModel();
      $model->assigned_to = $group->groupid;
      $model->display_name = $group->label;
      $model->group = '群組';
      $return[] = $model;
    }
    return $return;
  }
}
