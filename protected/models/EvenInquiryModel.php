<?php

class EvenInquiryModel extends ExtendedEntity
{
  public $entityid;
  public $source;
  public $identity;
  public $identity_other;
  public $inquirer_name;
  public $inquirer_phone;
  public $inquirer_gender;
  public $gambler_name;
  public $gambler_phone;
  public $gambler_gender;
  public $gambler_age_range;
  public $gambler_exact_age;
  public $gambler_marriage_status;
  public $gambler_living_area;
  public $inquiry_datetime;

  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'tbl_even_inquiry';
  }

  public function rules()
	{
		return array(
			array('entityid', 'safe'),
			array('source, identity, inquirer_name, inquirer_phone, inquirer_gendar,
        gambler_name, gambler_phone, gambler_gendar, gambler_age_range,
        gambler_marriage_status, gambler_living_area, inquiry_datetime', 'required')
		);
	}

  public function relations()
  {
    return array(
			'entity'=>array(self::BELONGS_TO, 'Entity', 'entityid'),
      'source'=>array(self::HAS_ONE, 'EvenInquirySourceModel', 'source'),
      'identity'=>array(self::HAS_ONE, 'EvenInquiryIdentityModel', 'identity'),
    );
  }

  public function attributeLabels()
  {
    return array(
      'entityid'=>'編號(系統用)',
      'source'=>"形式",
      'identity'=>'查詢者是',
      'identity_other'=>'查詢者是(其他)',
      'inquirer_name'=>'查詢者姓名',
      'inquirer_phone'=>'查詢者電話',
      'inquirer_gender'=>'查詢者姓別',
      'gambler_name'=>'賭徒姓名',
      'gambler_phone'=>'賭徒電話',
      'gambler_gender'=>'賭徒姓別',
      'gambler_age_range'=>'賭徒年齡',
      'gambler_exact_age'=>'賭徒準確年齡',
      'gambler_marriage_status'=>'賭徒的婚姻狀況',
      'gambler_living_area'=>'賭徒居住地區',
      'inquiry_datetime'=>'查詢日期及時間'
    );
  }

  public function attributeUiTypes()
  {
    return array(
      'entityid'=>'',
      'source'=>array("picklist", "list"=>$this->getEvenInquirySources()),
      'identity'=>array("picklist", "list"=>$this->getEvenInquiryIdentities()),
      'identity_other'=>array('textfield'),
      'inquirer_name'=>array('textfield'),
      'inquirer_phone'=>array('textfield'),
      'inquirer_gender'=>array("picklist", "list"=>$this->getGenders()),
      'gambler_name'=>'',
      'gambler_phone'=>'',
      'gambler_gender'=>'',
      'gambler_age_range'=>'',
      'gambler_exact_age'=>'',
      'gambler_marriage_status'=>'',
      'gambler_living_area'=>'',
      'inquiry_datetime'=>''
    );
  }

  public function getEvenInquirySources()
  {
    return EvenInquirySourceModel::model()->findAll();
  }

  public function getEvenInquiryIdentities()
  {
    return EvenInquiryIdentityModel::model()->findAll();
  }

  public function getGenders()
  {
    return GenderModel::model()->findAll();
  }
}
