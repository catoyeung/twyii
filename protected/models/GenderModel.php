<?php
class GenderModel extends CActiveRecord
{
  public $id;
  public $value;

  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'tbl_picklist_gender';
  }

  public function rules()
	{
		return array(
			array('id', 'safe'),
			array('value', 'required')
		);
	}

  public function relations()
  {
    return array(
			'even_inquiry'=>array(self::BELONGS_TO, 'EvenInquiryModel', 'gender'),
    );
  }
}
?>
