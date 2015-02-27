<?php
$loggedInUserName = '';
$organisation_name = '';
if(!Yii::app()->user->isGuest)
{
	$logged_in_userid = Yii::app()->user->getId();
	$logged_in_user = UserModel::model()->findByPk($logged_in_userid);
	$loggedInUserName = '('.$logged_in_user->getAttribute('username').')';
	$organisation_name = Yii::app()->user->getGroup()->groupname;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<?php
	$baseUrl = Yii::app()->request->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile($baseUrl.'/css/reset.css');
	$cs->registerCssFile($baseUrl.'/css/main.css');
	$cs->registerCssFile($baseUrl.'/css/jquery-ui.min.css');
	$cs->registerCssFile($baseUrl.'/css/jquery.ui.timepicker.css');
	$cs->registerCssFile($baseUrl.'/css/chosen.min.css');
	$cs->registerCssFile($baseUrl.'/css/sweet-alert.css');
	$cs->registerCssFile($baseUrl.'/css/sweet-ie9.css','screen, projection', 'lt IE 9');
	$cs->registerCssFile($baseUrl.'/css/jquery.datetimepicker.css');
	$cs->registerScriptFile($baseUrl.'/js/jquery-1.11.2.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery-ui.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.ui.timepicker.js');
	$cs->registerScriptFile($baseUrl.'/js/chosen.jquery.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.popupoverlay.js');
	$cs->registerScriptFile($baseUrl.'/js/sweet-alert.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.datetimepicker.js');
	?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>



<div class="container" id="page">

	<div id="header">
		<!--<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>-->
		<div id="mainmenu" class="clearfix">
			<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'首頁', 'url'=>array('/site/index')),
					array('label'=>'日曆', 'url'=>array('/calendar/index'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'心愉軒查詢', 'url'=>array('/icaptinquiry/index'), 'visible'=>$organisation_name=='icapt'),
					array('label'=>'平和坊查詢', 'url'=>array('/eveninquiry/index'), 'visible'=>$organisation_name=='even'),
					array('label'=>'越峰(酒)查詢', 'url'=>array('/crossalcohol_inquiry/index'), 'visible'=>$organisation_name=='cross_alcohol'),
					array('label'=>'越峰(毒)查詢', 'url'=>array('/crossdrug_inquiry/index'), 'visible'=>$organisation_name=='cross_drug'),
					array('label'=>'家庭', 'url'=>array('/family/index'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'聯絡人', 'url'=>array('/contact/index'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'心愉軒個案', 'url'=>array('/icaptcase/index'), 'visible'=>$organisation_name=='icapt'),
					array('label'=>'平和坊個案', 'url'=>array('/evencase/index'), 'visible'=>$organisation_name=='even'),
					array('label'=>'越峰(酒)個案', 'url'=>array('/crossalcohol_case/index'), 'visible'=>$organisation_name=='cross_alcohol'),
					array('label'=>'越峰(毒)個案', 'url'=>array('/crossdrug_case/index'), 'visible'=>$organisation_name=='cross_drug'),
					array('label'=>'回收筒', 'url'=>array('/recyclebin/index'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'設定', 'url'=>array('/config/index'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'登出'.$loggedInUserName, 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
			)); ?>
		</div><!-- mainmenu -->
	</div><!-- header -->

	<div id="search-box">
			<img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/images/twlogo.png" alt="Tung Wah Group"/>
		<!--<div id="search-div">
			<form action="/search/index" method="GET">
				<select id="search-category" class="chosen" name="search_category">
					<option>所有紀錄</option>
					<option>查詢</option>
					<option>聯絡人</option>
					<option>個案</option>
					<option>表格</option>
				</select>
				<input id="search-text" type="text" name="search_txt"/>
				<input id="search-submit" type="submit" value="搜尋" class="btn" />
				<button id="search-advance" class="btn advanced-search-btn">進階搜尋</button>
			</form>
		</div>-->
	</div>

	<div id="wrapper" class="clearfix">
		<?php echo $content; ?>
	</div>

	<div class="clear"></div>

	<div id="footer">
		<p>
		Powered &copy; <?php echo date('Y'); ?> by Smarkglobal.
		All Rights Reserved.
		</p>
	</div><!-- footer -->
	<script>
	$(document).ready(function(){
		$('.chosen').chosen();
		$('.datetimepicker').datetimepicker({
			step: 15
		});
		<?php if(isset($this->popup_message)):?>
		sweetAlert("", "<?php echo $this->popup_message['message']; ?>", "<?php echo $this->popup_message['type']; ?>");
		<?php endif?>
	});
	</script>
</div><!-- page -->

</body>
</html>
