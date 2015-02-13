<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
//$cs->registerCssFile($baseUrl.'/js/fullcalendar/fullcalendar.min.css');
//$cs->registerScriptFile($baseUrl.'/js/moment.js');
//$cs->registerScriptFile($baseUrl.'/js/fullcalendar/fullcalendar.min.js');


?>

<div class="cpanel">
  <div class="clist">
    <ul class="clearfix">
      <a href="#"><li>用戶管理</li></a>
      <li class="active">用戶架構</li>
      <li>用戶權限</li>
      <li>用戶群組</li>
    </ul>
  </div>
</div>
