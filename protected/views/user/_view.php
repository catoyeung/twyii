<?php
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
</tr>
