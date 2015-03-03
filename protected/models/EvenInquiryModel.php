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
  public $gambler_marital_status;
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

  public function modelLabel()
  {
    return '平和坊查詢';
  }

  public function rules()
	{
		return array(
			array('entityid', 'safe'),
			array('assigned_to, source, identity, inquirer_name, inquirer_phone, inquirer_gender,
        gambler_name, gambler_phone, gambler_gender, gambler_age_range,
        gambler_marital_status, gambler_living_area, inquiry_datetime', 'required'),
      array('gambler_exact_age', 'numerical', 'allowEmpty'=>true),
      array('created_at,modified_at','default',
					'value'=>new CDbExpression('NOW()'),
					'setOnEmpty'=>false,'on'=>'insert'),
			array('modified_at','default',
							'value'=>new CDbExpression('NOW()'),
							'setOnEmpty'=>false,'on'=>'update')
		);
	}

  public function relations()
  {
    return array(
			'entity'=>array(self::BELONGS_TO, 'Entity', 'entityid'),
      'source'=>array(self::BELONGS_TO, 'EvenInquirySourceModel', 'source'),
      'identity'=>array(self::BELONGS_TO, 'EvenInquiryIdentityModel', 'identity'),
      'inquirer_gender_object'=>array(self::BELONGS_TO, 'GenderModel', 'inquirer_gender'),
      'gambler_gender_object'=>array(self::BELONGS_TO, 'GenderModel', 'gambler_gender'),
      'gambler_age_range_object'=>array(self::BELONGS_TO, 'EvenInquiryAgeRangeModel', 'gambler_age_range'),
      'gambler_marital_status_object'=>array(self::BELONGS_TO, 'EvenInquiryMaritalStatusModel', 'gambler_marital_status'),
      'gambler_living_area_object'=>array(self::BELONGS_TO, 'EvenInquiryLivingAreaModel', 'gambler_living_area')
    );
  }

  public function attributeLabels()
  {
    return array(
      'entityid'=>'編號(系統用)',
      'assigned_to'=>'負責人',
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
      'gambler_marital_status'=>'賭徒的婚姻狀況',
      'gambler_living_area'=>'賭徒居住地區',
      'inquiry_datetime'=>'查詢日期及時間'
    );
  }

  public function attributeUiTypes()
  {
    return array(
      'entityid'=>'',
      'assigned_to'=>array("picklist", "list"=>AssignedToModel::model()->findAll(), 'id'=>'assigned_to', 'value'=>'display_name', 'group'=>'group'),
      'source'=>array("picklist", "list"=>$this->getEvenInquirySources(), 'id'=>'id', 'value'=>'value'),
      'identity'=>array("picklist", "list"=>$this->getEvenInquiryIdentities(), 'id'=>'id', 'value'=>'value'),
      'identity_other'=>array('textfield'),
      'inquirer_name'=>array('textfield'),
      'inquirer_phone'=>array('textfield'),
      'inquirer_gender'=>array("picklist", "list"=>$this->getGenders(), 'id'=>'id', 'value'=>'value'),
      'gambler_name'=>array('textfield'),
      'gambler_phone'=>array('textfield'),
      'gambler_gender'=>array("picklist", "list"=>$this->getGenders(), 'id'=>'id', 'value'=>'value'),
      'gambler_age_range'=>array("picklist", "list"=>$this->getEvenInquiryAgeRange(), 'id'=>'id', 'value'=>'value'),
      'gambler_exact_age'=>array('textfield'),
      'gambler_marital_status'=>array("picklist", "list"=>$this->getMaritalStatus(), 'id'=>'id', 'value'=>'value'),
      'gambler_living_area'=>array("picklist", "list"=>$this->getEvenInquiryLivingArea(), 'id'=>'id', 'value'=>'value'),
      'inquiry_datetime'=>array('datetime')
    );
  }

  public function sections()
  {
    return array(
      '編號'=>array('entityid', 'assigned_to'),
      '形式'=>array('source'),
      '個人資料'=>array(
        'identity', 'identity_other', 'inquirer_name', 'inquirer_phone',
        'inquirer_gender', 'gambler_name', 'gambler_phone', 'gambler_gender',
        'gambler_age_range', 'gambler_exact_age', 'gambler_marital_status',
        'gambler_living_area', 'inquiry_datetime'
      )
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

  public function getEvenInquiryAgeRange()
  {
    return EvenInquiryAgeRangeModel::model()->findAll();
  }

  public function getMaritalStatus()
  {
    return MaritalStatusModel::model()->findAll();
  }

  public function getEvenInquiryLivingArea()
  {
    return EvenInquiryLivingAreaModel::model()->findAll();
  }
}
