<?php
class FieldGenerator
{
  public $form;

  public function __construct($form)
  {
    $this->form = $form;
  }

  public function render($model, $field)
  {
    $attribute_ui_types = $model->attributeUiTypes();
    $fieldtype = isset($attribute_ui_types[$field][0]) ? $attribute_ui_types[$field][0] : '';

    if($fieldtype == 'picklist') {
      $list = $attribute_ui_types[$field]['list'];
      $data = CHtml::listData($list, 'id', 'value');
      return $this->dropDownList($model, $field, $data);
    }
  }

  public function dropDownList($model, $field, $data)
  {
    return $this->form->dropDownList($model, $field, $data, array('class'=>'chosen', 'data-placeholder'=>'請選擇', 'empty'=>''));
  }
}
