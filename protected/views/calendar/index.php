<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/js/fullcalendar/fullcalendar.min.css');
$cs->registerScriptFile($baseUrl.'/js/moment.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl.'/js/fullcalendar/fullcalendar.min.js', CClientScript::POS_END);

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
	<div id="pop-up-div" style="display: none;">
		<form action="<?php echo $baseUrl ?>/calendar/createevent" method="POST">
			<table>
				<tr>
					<td class="field-label">標題</td>
					<td class="field"><input type="text" name="subject"/></td>
					<td class="field-label">負責人員</td>
					<td class="field">
						<select class="chosen" name="assigned_to" data-placeholder="請選擇">
							<?php
							if(isset($assigned_to_users)):
							foreach ($assigned_to_users as $user)
							{
								echo '<option value="'.$user->userid.'">'.$user->username.'</option>';
							}
							endif
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="field-label" style="vertical-align: top;">描述</td>
					<td colspan="3" class="field">
						<textarea placeholder="描述" class="event-textarea" name="description"></textarea>
					</td>
				</tr>
				<tr>
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
				<button class="pop-up-div_delete btn btn-red" style="display: none;">刪除</button>
				<input type="submit" class="btn btn-green" value="創建"/>
			</div>
		</form>
	</div>
<script>
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

function editEvent(fcEvent)
{
	$('.pop-up-div_open').click();
	// load event model
	$('#pop-up-div input[name=subject]').val(fcEvent.title);
	$('#pop-up-div select[name=assigned_to]').val(fcEvent.assigned_to).trigger("chosen:updated");
	$('#pop-up-div textarea[name=description]').val(fcEvent.description);

	$('#pop-up-div input[name=start_date]').val(fcEvent.start.format('MM/DD/YYYY'));
	$('#pop-up-div input[name=start_time]').val(fcEvent.start.format('hh:mm'));
	$('#pop-up-div input[name=end_date]').val(fcEvent.end.format('MM/DD/YYYY'));
	$('#pop-up-div input[name=end_time]').val(fcEvent.end.format('hh:mm'));

	$('<input>').attr({
			type: 'hidden',
			name: 'id',
			value: fcEvent.id
	}).appendTo('#pop-up-div form');

	$('#pop-up-div form').attr("action", "<?php echo $baseUrl ?>/calendar/editevent");
	$('#pop-up-div form .action-bar input[type=submit]').val('修改');
	$('#pop-up-div form .action-bar .pop-up-div_delete').css('display', 'block');
	$('#pop-up-div form .action-bar .pop-up-div_delete').click(function (e) {
		e.preventDefault();
		var form = document.createElement('form');
		form.method = 'POST';
		form.action = "<?php echo $baseUrl ?>/calendar/deleteevent";
		var input = document.createElement('input');
		input.name = 'id';
		input.value = fcEvent.id;
		form.appendChild(input);
		document.body.appendChild(form);
		form.submit();
	});
}

$(document).ready(function() {
    $('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
        theme: true,
				events: <?php
				if(isset($events)){
					echo json_encode($events);
				} else { echo 'new Array()'; }
				?>,
				timeFormat: 'LT',
				eventLimit: true,
				selectable: true,
        selectHelper: true,
        editable: true,
				eventClick: editEvent
    });
	$('#pop-up-div').popup({
		transition: 'all 0.3s',
		background: true
	});

	$('.pop-up-div_open').click(function() {
		$('#pop-up-div input[name=subject]').val('');
		$('#pop-up-div select[name=assigned_to]').val('').trigger("chosen:updated");
		$('#pop-up-div textarea[name=description]').val('');

		$('#pop-up-div input[name=start_date]').val('');
		$('#pop-up-div input[name=start_time]').val('');
		$('#pop-up-div input[name=end_date]').val('');
		$('#pop-up-div input[name=end_time]').val('');

		$('#pop-up-div form').attr("action", "<?php echo $baseUrl ?>/calendar/createevent");
		$('#pop-up-div form .action-bar input[type=submit]').val('創建');

		$('#pop-up-div form .action-bar .pop-up-div_delete').css('display', 'none');
	});

	/* start of time range picker */

	$('.datepicker[name=start_date]').datepicker({
		onSelect: function(date) {
			window.start_date = $('.datepicker[name=start_date]').val();
			checkTimeRange();
		}
	});
	$('.datepicker[name=end_date]').datepicker({
		onSelect: function(date) {
			window.end_date = $('.datepicker[name=end_date]').val();
			checkTimeRange();
		}
	});
	$('.timepicker[name=start_time]').timepicker({
		onSelect: function(time) {
			window.start_time = time;
			checkTimeRange();
		}
	});
	$('.timepicker[name=end_time]').timepicker({
		onSelect: function(time) {
			window.end_time = time;
			checkTimeRange();
		}
	});
	/* end of time range picker */

	/* start of loading events to calendar */

	/* end of loading events to calendar */
});
</script>
