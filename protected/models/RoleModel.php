<?php

class RoleModel extends CActiveRecord
{
  public $entityid;
  public $rolename;
  public $parent_id;
  public $children;

  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'tbl_role';
  }

  public function rules()
  {
    return array(
          array('rolename','length','max'=>20),
          array('rolename, parent_id', 'required')
    );
  }

  // recursive function to return Roles as a tree
  // reference: http://stackoverflow.com/questions/4196157/create-array-tree-from-array-list
  protected function createTree(&$list, $parent)
  {
    $tree = array();
    foreach ($parent as $k=>$l){
      if(isset($list[$l->getAttribute('entityid')])) {
        $l->setAttribute('children', $this->createTree($list, $list[$l->getAttribute('entityid')]));
      }
      $tree[] = $l;
    }
    return $tree;
  }

  public function getRoleTree()
  {
    $roles = $this->findAll();
    $roles_in_tree = array();

    $new_roles = array();
    foreach ($roles as $role)
    {
      $new_roles[$role->getAttribute('parent_id')][] = $role;
    }
    $roles_in_tree = $this->createTree($new_roles, $new_roles[0]);


    //print_r($roles_in_tree);
    /*for($i=0;$i<count($roles);$i++)
    {
      if($roles[$i]->getAttribute('parent_id') == 0) {
        $role_info = array();
        $role_info['self_instance'] = $roles[$i];
        $role_info['children'] = array();
        // add to heirarchy
        $roles_in_hierarchy[] = $role_info;
        // remove from list
        unset($roles[$i]);
      }
    }
    $roles = array_values($roles);
    $deleted_role_indexs = array();
    for($i=0;$i<count($roles);$i++)
    {
      for($j=0;$j<count($roles_in_hierarchy);$j++) {
        $parent = $roles_in_hierarchy[$j]['self_instance'];
        if($roles[$i]->getAttribute('parent_id') == $parent->getAttribute('roleid')) {
          $role_info = array();
          $role_info['self_instance'] = $roles[$i];
          $role_info['children'] = array();
          // add to heirarchy
          $roles_in_hierarchy[$j]['children'][] = $role_info;
          // remove from list
          $deleted_role_indexs[] = $i;
          //unset($roles[$i]);
        }
      }
    }
    foreach($deleted_role_indexs as $i)
    {
      unset($roles[$i]);
    }
    $roles = array_values($roles);

    for($i=0;$i<count($roles);$i++)
    {
      for($j=0;$j<count($roles_in_hierarchy);$j++) {
        for($k=0;$k<count($roles_in_hierarchy[$j]['children']);$k++) {
          $parent = $roles_in_hierarchy[$j]['children'][$k]['self_instance'];
          if($roles[$i]->getAttribute('parent_id') == $parent->getAttribute('roleid')) {
            $role_info = array();
            $role_info['self_instance'] = $roles[$i];
            $role_info['children'] = array();
            // add to heirarchy
            $roles_in_hierarchy[$j]['children'][$k]['children'][] = $role_info;
            // remove from list
            $deleted_role_indexs[] = $i;
            //unset($roles[$i]);
          }
        }
      }
    }
    foreach($deleted_role_indexs as $i)
    {
      unset($roles[$i]);
    }
    $roles = array_values($roles);*/

    return $roles_in_tree;
  }
}
