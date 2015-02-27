<?php
$baseUrl = Yii::app()->request->baseUrl;
?>
<tr class="list-view-search-tr">
  <td><input type="checkbox" value="1"></td>
  <td>
    <?php echo CHtml::encode($data->groupid); ?>
  </td>
  <td><?php echo CHtml::encode($data->groupname); ?></td>
  <td><?php echo CHtml::encode($data->label); ?></td>
  <td><?php echo CHtml::activeCheckBox($data, 'active', array('disabled'=>'disabled')); ?></td>
  <td><?php echo CHtml::encode($data->created_at); ?></td>
  <td><?php echo CHtml::encode($data->modified_at); ?></td>
  <td>
    <button onclick="location.href='<?php echo $baseUrl; ?>/group/update/<?php echo $data->groupid; ?>'" class="btn">編輯</button>
  </td>
</tr>
