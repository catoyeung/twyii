<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();

?>
<div class="workbench" class="clearfix">
  <div class="entity-div">
    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'user-form',
      'enableAjaxValidation'=>false,
    )); ?>
    <?php echo CHtml::errorSummary($model); ?>
    <?php $field_generator = new FieldGenerator($form); ?>
    <div class="entity-table clearfix">
      <ul>
        <?php
        $attributes = $model->getAttributes();
        foreach ($attributes as $attributename => $attributevalue) {
          echo '<li class="clearfix"><div class="entity-label">'.$form->labelEx($model, $attributename).'</div>';
          echo '<div class="entity-field">'.$field_generator->render($model, $attributename).'</div></li>';
        }
        ?>

      </ul>
    </div>
    <div class="model-update-actionbar">
      <?php echo CHtml::submitButton($model->isNewRecord ? '創建' : '修改', array('class'=>'btn')); ?>
      <?php if(!$model->isNewRecord) { ?>
        <button type="button" class="btn btn-red delete-btn" data-id="<?php echo $model->userid; ?>">刪除</button>
      <?php } ?>
      <button type="button" class="btn" onclick="location.href='<?php echo $baseUrl; ?>/user/index'">取消</button>
    </div>
    <?php $this->endWidget(); ?>
    <!--</form>-->
  </div>
</div>
