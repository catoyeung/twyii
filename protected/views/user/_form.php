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
    <table>
      <tr>
        <td>登入名稱</td>
        <td>
          <?php echo $form->textField($model,'username'); ?>
        </td>
      </tr>
      <?php
      if($model->isNewRecord) {
        echo '<tr>';
        echo '<td>密碼</td><td>'.$form->passwordField($model,'register_password').'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>確認密碼</td><td>'.$form->passwordField($model,'confirm_register_password').'</td>';
        echo '</tr>';
      }
      ?>
      <tr>
        <td>Email</td>
        <td>
          <?php echo $form->textField($model,'useremail'); ?>
        </td>
      </tr>
      <tr>
        <td>有效</td>
        <td>
          <?php echo $form->checkBox($model,'active'); ?>
        </td>
      </tr>
      <tr>
        <td>是否管理員?</td>
        <td>
          <?php echo $form->checkBox($model,'is_admin'); ?>
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
