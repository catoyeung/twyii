<?php
$baseUrl = Yii::app()->request->baseUrl;
?>
<div class="cpanel">
  <div class="clist">
    <ul class="clearfix">
      <a href="<?php echo $baseUrl ?>/user/index"><li class="<?php if($module=='user') echo 'active'; ?>">用戶管理</li></a>
      <a href="<?php echo $baseUrl ?>/role/index"><li class="<?php if($module=='role') echo 'active'; ?>">用戶架構</li></a>
      <a href="<?php echo $baseUrl ?>/profile/index"><li class="<?php if($module=='profile') echo 'active'; ?>">用戶權限</li></a>
      <a href="<?php echo $baseUrl ?>/group/index"><li class="<?php if($module=='group') echo 'active'; ?>">用戶群組</li></a>
    </ul>
  </div>
</div>
