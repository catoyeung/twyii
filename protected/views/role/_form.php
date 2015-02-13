<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();

?>

<?php
$this->renderPartial('//config/cpanel',
  array('module'=>'role'));
?>
<div class="workbench" class="clearfix">
  <div class="entity-div">
    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'post-form',
      'enableAjaxValidation'=>false,
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <!--<form action="<?php echo $baseUrl ?>/role/create" method="POST">-->
    <table>
      <tr>
        <td>身份名稱</td>
        <td>
          <?php echo $form->textField($model,'rolename',array('size'=>60,'maxlength'=>100)); ?>
        </td>
      </tr>
      <tr>
        <td>管理層</td>
        <td>
          <?php
          if($model->isNewRecord) {
            $list = CHtml::listData(RoleModel::model()->findAll(), 'entityid', 'rolename');
          } else {
            $list = CHtml::listData(RoleModel::model()->findAll('entityid <> '.$model->entityid), 'entityid', 'rolename');
            array_unshift($list, '東華三院');
          }
          echo $form->dropDownList(
            $model,
            'parent_id',
            $list,
            array('class'=>'chosen')
          ); ?>
        </td>
      </tr>
      <tr>
        <td>
          <?php echo CHtml::submitButton($model->isNewRecord ? '創建' : '修改', array('class'=>'btn')); ?>
          <!--<input type="submit" class="btn btn-green" value="創建" />-->
          <button type="button" class="btn" onclick="location.href='<?php echo $baseUrl; ?>/role/index'">取消</button>
        </td>
      </tr>
    </table>
    <?php $this->endWidget(); ?>
    <!--</form>-->
  </div>
</div>
