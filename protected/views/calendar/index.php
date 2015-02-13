<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/js/fullcalendar/fullcalendar.min.css');
$cs->registerScriptFile($baseUrl.'/js/moment.js');
$cs->registerScriptFile($baseUrl.'/js/fullcalendar/fullcalendar.min.js');


?>
	<div class="cpanel">
		<div class="clist">
			<ul class="clearfix">
				<a class="pop-up-div_open" href="#"><li>+新增事件</li></a>
				<li class="active">日曆</li>
				<li>事件列表</li>
			</ul>
		</div>
		<div class="shared-list">
			<ul>
				<li><label><input type="checkbox" name="mine" value="checked">我</label></li>
				<li><label><input type="checkbox" name="icapt" value="checked">心愉軒</label></li>
				<li><label><input type="checkbox" name="even" value="checked">平和坊</label></li>
				<li><label><input type="checkbox" name="cross" value="checked">越峰成長中心(酒)</label></li>
				<li><label><input type="checkbox" name="cross" value="checked">越峰成長中心(毒)</label></li>
				<li><label><input type="checkbox" name="tw" value="checked">東華三院</label></li>
			</ul>
		</div>
	</div>
	<div id="calendar-workbench" class="clearfix">
		<div id='calendar'></div>
	</div>
	<div id="pop-up-div">
		<form action="/calendar/create" method="POST">
			<table>
				<tr>
					<td class="field-label">標題</td>
					<td class="field"><input type="text" name="subject"/></td>
					<td class="field-label">負責人員</td>
					<td class="field">
						<select class="chosen">
							<option>請選擇</option>
							<option>我</option>
							<option>心愉軒</option>
							<option>平和坊</option>
							<option>越峰成長中心(酒)</option>
							<option>越峰成長中心(毒)</option>
							<option>東華三院</option>
						</select>
					</td>
				</tr>
				<tr class="datepair" data-language="javascript">
					<td class="field-label">開始日期及時間</td>
					<td class="field"><input type="text" name="start_date" class="datepicker"/>
						<input class="timepicker" type="text" name="start_time"/></td>
					<td class="field-label">結束日期及時間</td>
					<td class="field"><input type="text" name="end_date" class="datepicker"/>
						<input class="timepicker" type="text" name="end_time"/></td>
				</tr>
			</table>
			<div class="action-bar">
				<button class="pop-up-div_close btn">關閉</button>
				<input type="submit" class="btn btn-green" value="創建"/>
			</div>
		</form>
	</div>
<script>
/*function getFormattedDate(date) {
  var year = date.getFullYear();
  var month = (1 + date.getMonth()).toString();
  month = month.length > 1 ? month : '0' + month;
  var day = date.getDate().toString();
  day = day.length > 1 ? day : '0' + day;
  return month + '/' + day + '/' + year;
}

function getFormattedTime(time) {
	var min = (time.getMinutes()+1).toString();
	min = min.length > 1 ? min : '0' + min;
	var hour = (time.getHours() + 1).toString();
	return hour + ':' + min + ':' + '00';
}
*/
function createDateTime(date, time) {
	var dateObject = new Date(date);
	var time_array = time.split(":");
	return new Date(dateObject.getFullYear(), dateObject.getMonth(), dateObject.getDay(), time_array[0], time_array[1]);
}

function checkTimeRange()
{
	if(window.start_date == '' ||
	   window.end_date == '' ||
	   window.start_time == '' ||
	   window.end_time == '') return;
	var startDateTime = createDateTime(window.start_date, window.start_time);
	var endDateTime= createDateTime(window.end_date, window.end_time);
	if (startDateTime > endDateTime) {
		window.start_date = '';
		window.end_date = '';
		window.start_time = '';
		window.end_time = '';
		$('.datepicker[name=start_date]').val('');
		$('.datepicker[name=end_date]').val('');
		$('.timepicker[name=start_time]').val('');
		$('.timepicker[name=end_time]').val('');
	}
}

var start_date = '';
var end_date = '';
var start_time = '';
var end_time = '';

$(document).ready(function() {
    $('#calendar').fullCalendar({
        theme: true,
    });
	$('#pop-up-div').popup({
		transition: 'all 0.3s',
		background: true
	});

	/* start of time range picker */

	$('.datepicker[name=start_date]').datepicker({
		onSelect: function(date) {
			/*start_date = new Date(date);
			if (end_date == '') return;
			end_date = new Date($('.datepicker[name=end_date]').val());
			if (start_date > end_date) {
				$('.datepicker[name=start_date]').val(getFormattedDate(end_date));
			}*/
			window.start_date = $('.datepicker[name=start_date]').val();
			checkTimeRange();
		}
	});
	$('.datepicker[name=end_date]').datepicker({
		onSelect: function(date) {
			/*end_date = new Date(date);
			if (start_date == '') return;
			start_date = new Date($('.datepicker[name=start_date]').val());
			if (end_date < start_date) {
				$('.datepicker[name=end_date]').val(getFormattedDate(start_date));
			}*/
			window.end_date = $('.datepicker[name=end_date]').val();
			checkTimeRange();
		}
	});
	$('.timepicker[name=start_time]').timepicker({
		onSelect: function(time) {
			window.start_time = time;
			checkTimeRange();
			/*if (window.start_date == ''){
				window.start_date = new Date();
				$('.datepicker[name=start_date]').val(getFormattedDate(window.start_date));
			} else {
				window.start_date = new Date($('.datepicker[name=start_date]').val());
			}
			if (window.end_date == '') {
				return false;
			}
			console.log(window.start_date);
			window.start_time = createDateTime(window.start_date, time);
			if (window.end_time == '') return;

			window.end_time = createDateTime(window.end_date, $('.datepicker[name=end_time]').val());
			if (window.start_time > window.end_time) {
				$('.datepicker[name=start_time]').val('');
			}*/
		}
	});
	$('.timepicker[name=end_time]').timepicker({
		onSelect: function(time) {
			window.end_time = time;
			checkTimeRange();
			/*if (window.end_date == ''){
				window.end_date = new Date();
				$('.datepicker[name=end_date]').val(getFormattedDate(window.end_date));
			} else {
				window.end_date = new Date($('.datepicker[name=end_date]').val());
			}
			if (window.start_date == '') {
				return false;
			}
			console.log(window.end_date);
			window.end_time = createDateTime(window.end_date, time);
			if (window.start_time == '') return;
			window.start_time = createDateTime(window.start_date, $('.datepicker[name=start_time]').val());
			if (window.end_time < window.start_time) {
				$('.datepicker[name=end_time]').val('');
			}*/
		}
	});
	/* end of time range picker */
});
</script>
