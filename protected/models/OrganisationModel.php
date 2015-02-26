<?php
class OrganisationModel extends CActiveRecord
{
  public $organisation_id;
  public $name;
  public $label;

  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'tbl_organisation';
  }

  public function rules()
	{
		return array(
			array('organisation_id', 'safe'),
			array('name', 'required'),
			array('label', 'required')
		);
	}

  public function relations()
  {
    return array(
				'user'=>array(self::HAS_MANY, 'UserModel', 'userid')
    );
  }
}
?>
