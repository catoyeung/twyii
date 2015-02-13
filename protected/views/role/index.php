<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();


// recursive function to display roles as a tree
function displayRolesTree($parents)
{
  $baseUrl = Yii::app()->baseUrl;
  echo '<ul>';
  foreach($parents as $parent)
  {
    $parentid = $parent->getAttribute('entityid');
    $children = $parent->getAttribute('children');
    echo '<li>';
    echo '<a href="#">'.$parent->getAttribute('rolename').'</a> ';
    echo '<button class="btn" onclick="location.href=\''.
      $baseUrl.'/role/update/'.$parentid.
      '\'">編輯</button><button class="btn" onclick="deleteEntity('.
      $parentid.
      ')">刪除</button>';
    if(isset($children)) {
      displayRolesTree($children);
    }
    echo '</li>';
  }
  echo '</ul>';
}

?>

<?php
$this->renderPartial('//config/cpanel',
  array('module'=>'role'));
?>
<div class="workbench" class="clearfix">
  <div class="list-view-action-div clearfix">
    <span class="action-span">
      <a href="<?php echo $baseUrl ?>/role/create"><button class="create-entity-btn btn">創建身份</button></a>
    </span>
  </div>
  <div class="organ-hierarchy">
    <?php
    displayRolesTree($roles_tree);
    ?>
  </div>
</div>
<script>
function deleteEntity(id) {
  var confirmDelete = confirm('確認刪除?');
  if (confirmDelete == true) {
    $.post("<?php echo $baseUrl; ?>/role/delete",{id:id},
      function(data) {
        //var response = jQuery.parseJSON(data);
        console.log(data);
        if(data == true) {
          window.location.href = "<?php echo $baseUrl ?>/role/index";
        }
      }
    );
  }
}
</script>
