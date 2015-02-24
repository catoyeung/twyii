<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

?>

<?php
$this->renderPartial('//config/cpanel',
  array('module'=>'group'));

?>
<div class="workbench" class="clearfix">
  <div class="list-view-action-div clearfix">
    <span class="action-span">
      <a href="<?php echo $baseUrl ?>/group/create"><button class="create-entity-btn btn">新增群組</button></a>
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
        <th>群組名稱</th>
        <th>組員</th>
        <th>創建時間</th>
        <th>修改時間</th>
        <th></th>
      </tr>
      <?php
      $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'sortableAttributes'=>array(
          'groupname'=>'群組名稱',
          'created_at'=>'創建時間',
        ),
        'enablePagination'=>true,
        'pager'=>array(
          'maxButtonCount'=>10,
          'header'=>'頁面:'
        ),
        'summaryText'=>"由{start}到{end} 總數:{count}",
        'template'=>"{summary} {sorter} {pager} {items}",
        'sorterHeader'=>'排序按:',
        'emptyText'=>'沒有找到資料',
        'id'=>'ajaxListView'
      )); ?>

    </table>
  </div>
</div>
