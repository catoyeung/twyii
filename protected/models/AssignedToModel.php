<?php

class AssignedToModel
{
  public $assigned_to_id;
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
      $assigned_to = new AssignedToModel();
      $assigned_to->assigned_to_id = $user->userid;
      $assigned_to->display_name = $user->display_name;
      $assigned_to->group = '使用者';
      $return[] = $assigned_to;
    }
    foreach ($groups as $group)
    {
      $assigned_to = new AssignedToModel();
      $assigned_to->assigned_to_id = $group->groupid;
      $assigned_to->display_name = $group->label;
      $assigned_to->group = '群組';
      $return[] = $assigned_to;
    }
    return $return;
  }
}
