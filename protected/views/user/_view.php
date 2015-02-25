<?php
$baseUrl = Yii::app()->request->baseUrl;
?>
<tr class="list-view-search-tr">
  <td><input type="checkbox" value="1"></td>
  <td>
    <?php echo CHtml::encode($data->username); ?>
  </td>
  <td><?php echo CHtml::encode($data->useremail); ?></td>
  <td><?php echo CHtml::activeCheckBox($data, 'active', array('disabled'=>'disabled')); ?></td>
  <td><?php echo CHtml::activeCheckBox($data, 'is_admin', array('disabled'=>'disabled')); ?></td>
  <td><?php echo CHtml::encode($data->created_at); ?></td>
  <td><?php echo CHtml::encode($data->modified_at); ?></td>
  <td>
    <button onclick="location.href='<?php echo $baseUrl; ?>/user/update/<?php echo $data->userid; ?>'" class="btn">編輯</button>
  </td>
</tr>
