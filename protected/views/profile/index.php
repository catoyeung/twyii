<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

?>

<?php echo $cpanel ?>
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
        <th>查詢者姓名</th>
        <th>電話</th>
        <th>負責人員</th>
        <th>創建時間</th>
        <th>修改時間</th>
      </tr>
      <tr class="list-view-search-tr">
        <td></td>
        <td><input type="text" placeholder="例如:楊沛昆"/></td>
        <td><input type="text" placeholder="例如:96330385"/></td>
        <td><input type="text" placeholder="例如:Joseph Tung"/></td>
        <td><input type="text" placeholder="例如:2014-05-16, 2014-05-17"/></td>
        <td><input type="text" placeholder="例如:2014-05-16, 2014-05-17"/></td>
        <td><button class="btn textbtn">搜尋</button></td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>楊沛昆</td>
        <td>96330385</td>
        <td>Joseph Tung</td>
        <td>2014-05-16 2:00:00 PM</td>
        <td>2014-05-16 2:00:00 PM</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>楊沛昆</td>
        <td>96330385</td>
        <td>Joseph Tung</td>
        <td>2014-05-16 2:00:00 PM</td>
        <td>2014-05-16 2:00:00 PM</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>楊沛昆</td>
        <td>96330385</td>
        <td>Joseph Tung</td>
        <td>2014-05-16 2:00:00 PM</td>
        <td>2014-05-16 2:00:00 PM</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>楊沛昆</td>
        <td>96330385</td>
        <td>Joseph Tung</td>
        <td>2014-05-16 2:00:00 PM</td>
        <td>2014-05-16 2:00:00 PM</td>
      </tr>
      <tr>
        <td><input type="checkbox"></td>
        <td>楊沛昆</td>
        <td>96330385</td>
        <td>Joseph Tung</td>
        <td>2014-05-16 2:00:00 PM</td>
        <td>2014-05-16 2:00:00 PM</td>
      </tr>
    </table>
  </div>
</div>
