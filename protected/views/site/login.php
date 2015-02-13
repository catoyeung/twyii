<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 登入';
$baseUrl = Yii::app()->getBaseUrl();
?>


<div id="login-div">
	<h1>登入</h1>
	<form action="<?php echo $baseUrl; ?>/site/login" method="POST">
		<table id="login-table">
			<tr>
				<th>登入名稱:</th>
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<th>登入密碼:</th>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<th></th>
				<td><input type="submit" value="登入" class="btn"/></td>
			</tr>
		</table>
	</form>

</div>
