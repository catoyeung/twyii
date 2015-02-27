<?php
$baseUrl = Yii::app()->request->baseUrl;
?>
<tr class="list-view-search-tr">
  <td><input type="checkbox" value="1"></td>
  <td>
    <?php echo CHtml::encode($data->inquirer_name); ?>
  </td>
  <td><?php echo CHtml::encode($data->inquirer_phone); ?></td>
  <td><?php echo CHtml::encode($data->inquirer_gender_object->value); ?></td>
  <td>
    <?php echo CHtml::encode($data->gambler_name); ?>
  </td>
  <td><?php echo CHtml::encode($data->gambler_phone); ?></td>
  <td><?php echo CHtml::encode($data->gambler_gender_object->value); ?></td>
  <td><?php echo CHtml::encode($data->entity->created_at); ?></td>
  <td><?php echo CHtml::encode($data->entity->modified_at); ?></td>
  <td>
    <button onclick="location.href='<?php echo $baseUrl; ?>/eveninquiry/detail/<?php echo $data->entityid; ?>'" class="btn">觀看</button>
    <button onclick="location.href='<?php echo $baseUrl; ?>/eveninquiry/update/<?php echo $data->entityid; ?>'" class="btn">編輯</button>
  </td>
</tr>
