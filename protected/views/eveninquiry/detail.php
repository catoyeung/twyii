<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();

?>
<div class="workbench" class="clearfix">
  <div class="entity-div">
    <h1>
      <?php
      echo '觀看'.$model->modelLabel();
      ?>
    </h1>
    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'user-form',
      'enableAjaxValidation'=>false,
    )); ?>
    <?php echo CHtml::errorSummary($model); ?>
    <?php $field_generator = new FieldGenerator($form); ?>
    <div class="entity-table clearfix">
      <?php
      foreach ($model->sections() as $section_title=>$attribute_keys) {
        echo '<div class="section-title">'.$section_title.'</div>';
        echo '<ul class="clearfix">';
        foreach ($attribute_keys as $attribute_key) {
          echo '<li class="clearfix"><div class="entity-label">'.$form->labelEx($model, $attribute_key).'</div>';
          echo '<div class="entity-field">'.$field_generator->render($model, $attribute_key, array('disabled'=>'disabled')).'</div></li>';
        }
        echo '</ul>';
      }
      ?>
    </div>
    <div class="model-update-actionbar">
      <button type="button" class="btn" onclick="location.href='<?php echo $baseUrl; ?>/eveninquiry/index'">取消</button>
    </div>
    <?php $this->endWidget(); ?>
    <!--</form>-->
  </div>
</div>
