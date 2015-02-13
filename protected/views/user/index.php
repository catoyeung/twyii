<?php
/* @var $this SiteController */

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
    <span class="filter-span">
      <select class="chosen filter-select">
        <option>所有查詢</option>
        <option>心愉軒查詢</option>
        <option>平和坊查詢</option>
        <option>越峰成長中心查詢</option>
      </select>
    </span>
    <span class="pagination-span">
      <button class="prev-page-btn btn">
        <span class="prev-page-span">Prev.</span>
      </button>
      <button class="page-jump-btn btn">
        <span class="page-jump-span">Go to</span>
      </button>
      <button class="next-page-btn btn">
        <span class="next-page-span">Next.</span>
      </button>
    </span>
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
      </tr>
      <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
      )); ?>
      
    </table>
  </div>
</div>
