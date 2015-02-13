<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

?>

<?php echo $cpanel ?>
<div class="workbench" class="clearfix">
  <div class="entity-div">
    <table>
      <tr>
        <td>用戶名稱</td>
        <td><input name="name" type="text"/></td>
      </tr>
      <tr>
        <td>身份</td>
        <td>
          <select class="chosen">
            <option>心愉軒</option>
            <option>平和坊</option>
            <option>越峰成長中心</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>登入名稱</td>
        <td><input name="username" type="text" /></td>
      </tr>
      <tr>
        <td>密碼</td>
        <td><input name="password" type="password" /></td>
      </tr>
      <tr>
        <td>確認密碼</td>
        <td><input name="password_confirm" type="password" /></td>
      </tr>
      <tr>
        <td>
          <button class="btn btn-green">創建</button>
          <button class="btn">取消</button>
        </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
  </div>
</div>
