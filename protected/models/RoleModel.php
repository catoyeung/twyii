<?php

class RoleModel extends CActiveRecord
{
  public $entityid;
  public $rolename;
  public $parent_id;
  public $children;
  public $deleted;
  public $created_at;
  public $modified_at;

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
          array('rolename', 'required'),
          array('deleted', 'default'),
          array('created_at, modified_at','default',
    					'value'=>new CDbExpression('NOW()'),
    					'setOnEmpty'=>false,'on'=>'insert'),
    			array('modified_at','default',
    							'value'=>new CDbExpression('NOW()'),
    							'setOnEmpty'=>false,'on'=>'update')
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

    return $roles_in_tree;
  }
}
