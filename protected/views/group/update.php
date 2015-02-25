<?php
$baseUrl = Yii::app()->baseUrl;
$this->renderPartial('_form', array('model'=>$model));
?>
<script>
$('.delete-btn').click(function () {
  var id = $('.delete-btn').attr('data-id');
  var form = document.createElement('form');
  form.method = 'POST';
  form.action = "<?php echo $baseUrl ?>/group/delete";
  var input = document.createElement('input');
  input.name = 'groupid';
  input.value = id;
  form.appendChild(input);
  document.body.appendChild(form);
  form.submit();
});
</script>
