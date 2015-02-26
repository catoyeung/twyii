<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>

<?php
$this->renderPartial('//config/cpanel',
  array('module'=>'profile'));
?>
<div class="workbench" class="clearfix">
  <div class="entity-div">
    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'profile-form',
      'enableAjaxValidation'=>false,
    )); ?>
    <?php echo CHtml::errorSummary($model); ?>
    <table>
      <tr>
        <td>身份</td>
        <td>
          <?php echo $model->rolename; ?>
        </td>
      </tr>
    </table>
    <div class="profile-field-level-control">
      <div class="profile-module">
        <table class="module-table">
          <tr>
            <th>模組</th>
            <th>觀看</th>
            <th>創建/修改</th>
            <th>刪除</th>
            <th></th>
          </tr>
          <tr>
            <td>日曆</td>
            <td><input type="checkbox"/></td>
            <td><input type="checkbox"/></td>
            <td><input type="checkbox"/></td>
            <td><button class="toggle" data-module-id="1">
              <i class="icon-down"></i>
            </button></td>
          </tr>
          <tr class="module-tr" data-module-id="1" style="display: none;">
            <td colspan="5">
              <div class="permission-table clearfix">
                <ul>
                  <li class="clearfix">
                    <div class="field-label">標題</div>
                    <div class="field-slider"><div class="slider" data-field-id="1"></div></div>
                    <div class="slider-value">唯讀</div>
                  </li>
                  <li>
                    <div class="field-label">負責人員</div>
                    <div class="field-slider"><div class="slider" data-field-id="2"></div></div>
                    <div class="slider-value">讀寫</div>
                  </li>
                  <li>
                    <div class="field-label">描述</div>
                    <div class="field-slider"><div class="slider" data-field-id="3"></div></div>
                    <div class="slider-value">讀寫</div>
                  </li>
                  <li>
                    <div class="field-label">開始日期及時間</div>
                    <div class="field-slider"><div class="slider" data-field-id="4"></div></div>
                    <div class="slider-value">隱藏</div>
                  </li>
                  <li>
                    <div class="field-label">結束日期及時間</div>
                    <div class="field-slider"><div class="slider" data-field-id="5"></div></div>
                    <div class="slider-value">隱藏</div>
                  </li>
                </ul>
              </div>
              <!--<table class="permission-table">
                <tr>
                  <td>標題</td>
                  <td><div class="slider"></div></td>
                  <td>負責人員</td>
                  <td><div class="slider"></div></td>
                </tr>
                <tr>
                  <td>描述</td>
                  <td><div class="slider"></div></td>
                  <td>開始日期及時間</td>
                  <td><div class="slider"></div></td>
                </tr>
                <tr>
                  <td>結束日期及時間</td>
                  <td><div class="slider"></div></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>-->
            </td>
          </tr>
        </table>
        <!--<table>
          <tr>
            <td>標題</td>
            <td></td>
            <td>負責人員</td>
            <td></td>
          </tr>
          <tr>
            <td>描述</td>
            <td></td>
            <td>開始日期及時間</td>
            <td></td>
          </tr>
          <tr>
            <td>結束日期及時間</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>-->
      </div>
    </div>
    <div class="model-update-actionbar">
      <?php echo CHtml::submitButton($model->isNewRecord ? '創建' : '修改', array('class'=>'btn')); ?>
      <button type="button" class="btn" onclick="location.href='<?php echo $baseUrl; ?>/profile/index'">取消</button>
    </div>
    <?php $this->endWidget(); ?>
    <!--</form>-->
  </div>
</div>
<script>
$(document).ready(function () {
  $('.slider').slider({
    min: 1,
    max: 3
  });

  $('button.toggle').click(function(e) {
    e.preventDefault();
    if($('.module-tr[data-module-id='+"1"+']').is(":visible"))
    {
      $('.module-tr[data-module-id='+"1"+']').hide();
      $(this).find('.icon-up').addClass('icon-down');
      $(this).find('.icon-up').removeClass('icon-up');
    } else
    {
      $('.module-tr[data-module-id='+"1"+']').show();
      $(this).find('.icon-down').addClass('icon-up');
      $(this).find('.icon-down').removeClass('icon-down');
    }

  });
});
</script>
