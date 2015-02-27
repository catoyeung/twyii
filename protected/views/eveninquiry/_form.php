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
      echo $model->isNewRecord ? '創建'.$model->modelLabel() : '修改'.$model->modelLabel();
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
          echo '<div class="entity-field">'.$field_generator->render($model, $attribute_key).'</div></li>';
        }
        echo '</ul>';
      }
      ?>
    </div>
    <div class="model-update-actionbar">
      <?php echo CHtml::submitButton($model->isNewRecord ? '創建' : '修改', array('class'=>'btn')); ?>
      <?php if(!$model->isNewRecord) { ?>
        <button type="button" class="btn btn-red delete-btn" data-id="<?php echo $model->entityid; ?>">刪除</button>
      <?php } ?>
      <button type="button" class="btn" onclick="location.href='<?php echo $baseUrl; ?>/eveninquiry/index'">取消</button>
    </div>
    <?php $this->endWidget(); ?>
    <!--</form>-->
  </div>
</div>
