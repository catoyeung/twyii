<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();

?>

<?php
$this->renderPartial('//config/cpanel',
  array('module'=>'user'));
?>
<div class="workbench" class="clearfix">
  <div class="entity-div">
    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'user-form',
      'enableAjaxValidation'=>false,
    )); ?>
    <?php echo CHtml::errorSummary($model); ?>
    <table>
      <tr>
        <td>群組名稱</td>
        <td>
          <?php echo $form->textField($model,'groupname'); ?>
        </td>
      </tr>
      <tr>
        <td>群組組員</td>
        <td>
          <?php
          //$model->members = GroupModel::model()->with('members')->findAll();
          echo $form->ListBox($model, 'members',
          CHtml::listData(UserModel::model()->findAll(), 'userid', 'username'),
          array('multiple'=>'multiple', 'class'=>'chosen')); ?>
        </td>
      </tr>
      <tr>
        <td>有效</td>
        <td>
          <?php echo $form->checkBox($model,'active'); ?>
        </td>
      </tr>
      <tr>
        <td>
          <?php echo CHtml::submitButton($model->isNewRecord ? '創建' : '修改', array('class'=>'btn')); ?>
          <!--<input type="submit" class="btn btn-green" value="創建" />-->
          <button type="button" class="btn" onclick="location.href='<?php echo $baseUrl; ?>/user/index'">取消</button>
        </td>
      </tr>
    </table>
    <?php $this->endWidget(); ?>
    <!--</form>-->
  </div>
</div>
