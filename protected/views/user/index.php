<?php

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

?>

<?php
$this->renderPartial('//config/cpanel',
  array('module'=>'user'));

?>
<div class="workbench" class="clearfix">
  <div class="list-view-action-div clearfix">
    <span class="action-span">
      <a href="<?php echo $baseUrl ?>/user/create"><button class="create-entity-btn btn">新增用戶</button></a>
    </span>
    <?php
    echo CHtml::beginForm(CHtml::normalizeUrl(array('user/index')), 'get', array('class'=>'filter-form'))
    . CHtml::textField('search_text', (isset($_GET['search_text'])) ? $_GET['search_text'] : '', array('id'=>'search_text'))
    . CHtml::submitButton('搜尋', array('name'=>'', 'class'=>"btn"))
    . CHtml::endForm();
    ?>
  </div>
  <div class="list-view-entries-div">
    <table class="list-view-entries-table">
      <tr>
        <th></th>
        <th>登入名稱</th>
        <th>Email</th>
        <th>有效</th>
        <th>是否管理員</th>
        <th>創建時間</th>
        <th>修改時間</th>
        <th></th>
      </tr>
      <?php
      $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'sortableAttributes'=>array(
          'username'=>'登入名稱',
          'useremail'=>'Email',
          'active'=>'有效',
          'created_at'=>'創建時間',
        ),
        'enablePagination'=>true,
        'pager'=>array(
          'maxButtonCount'=>10,
          'header'=>'頁面:'
        ),
        'summaryText'=>"由{start}到{end} 總數:{count}",
        'template'=>"{summary} {sorter} {pager} {items}",
        'emptyText'=>'沒有找到資料',
        'sorterHeader'=>'排序按:',
        'id'=>'ajaxListView'
      )); ?>

    </table>
  </div>
</div>
