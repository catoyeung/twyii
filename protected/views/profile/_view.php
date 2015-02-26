<?php
$baseUrl = Yii::app()->request->baseUrl;
?>
<tr class="list-view-search-tr">
  <td><input type="checkbox" value="1"></td>
  <td>
    <?php echo CHtml::encode($data->entityid); ?>
  </td>
  <td><?php echo CHtml::encode($data->rolename); ?></td>
  <td><?php echo CHtml::encode($data->created_at); ?></td>
  <td><?php echo CHtml::encode($data->modified_at); ?></td>
  <td>
    <button onclick="location.href='<?php echo $baseUrl; ?>/profile/update/<?php echo $data->entityid; ?>'" class="btn">編輯</button>
  </td>
</tr>
