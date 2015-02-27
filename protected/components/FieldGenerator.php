<?php
class FieldGenerator
{
  public $form;

  public function __construct($form)
  {
    $this->form = $form;
  }

  public function render($model, $field, $options=array())
  {
    $attribute_ui_types = $model->attributeUiTypes();
    $fieldtype = isset($attribute_ui_types[$field][0]) ? $attribute_ui_types[$field][0] : '';

    if($fieldtype == 'picklist') {
      $list = $attribute_ui_types[$field]['list'];
      $id = $attribute_ui_types[$field]['id'];
      $value = $attribute_ui_types[$field]['value'];
      $group = isset($attribute_ui_types[$field]['group']) ? $attribute_ui_types[$field]['group'] : '';
      $data = CHtml::listData($list, $id, $value, $group);
      return $this->dropDownList($model, $field, $data, $options);
    } else if ($fieldtype == 'textfield') {
      return $this->textField($model, $field, $options);
    } else if ($fieldtype == "datetime") {
      return $this->datetimeField($model, $field, $options);
    }
  }

  public function dropDownList($model, $field, $data, $options)
  {
    $options = array_merge($options, array('class'=>'chosen', 'data-placeholder'=>'請選擇', 'empty'=>'') );
    return $this->form->dropDownList($model, $field, $data, $options);
  }

  public function textField($model, $field, $options)
  {
    return $this->form->textField($model, $field, $options);
  }

  public function datetimeField($model, $field, $options)
  {
    $options = array_merge($options, array('class'=>'datetimepicker') );
    return $this->form->textField($model, $field, $options);
  }
}
